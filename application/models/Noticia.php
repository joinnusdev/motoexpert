<?php
class App_Model_Buscador extends App_Db_Table_Abstract {

	protected $_name = 'motos';

	public function listarMarca(){
            $query = $this->_db
                ->select()->from(array('m' => $this->_name));
            return $this->_db->fetchAll($query);
        }

        public function listarModelo($marca){
            $query = $this->_db
                ->select()->from(array('m' => $this->_name))
                ->where('c.idEmpresa = ?', $idEmpresa)
                ->limit(50);
            return $this->_db->fetchAll($query);
        }

	public function reporteAltas($inicio, $fin, $tipo = NULL, $baja=FALSE)
	{
		$db = $this->getAdapter();
		switch ($tipo):
		case self::MES: case self::SEMANA:
			$query = $db->select()->from(array('u' => $this->_name),
					array('COUNT(u.idusuario) as result'))
					->where('u.fecha_registro::date >= ?', $inicio)
					->where('u.fecha_registro::date <= ?', $fin);
			break;
		
		case self::DIA:
			$query = $db->select()->from(array('u' => $this->_name),
					array('COUNT(u.idusuario) as result'))
					->where('u.fecha_registro::date = ?', $fin);
					
			break;
				
		endswitch;
		if ($baja)
			$query->where('u.estado = ?', self::ESTADO_ELIMINADO);
		else 
			$query->where('u.estado = ?', self::ESTADO_ACTIVO);
			
		
		
		
		$result = $db->fetchRow($query);
		

		return  $result;
	}

	
	public function reporteGrafico($inicio, $fin, $tipo = NULL)
	{
		$db = $this->getAdapter();
		
		if ($tipo == 1) 
			$query = "
		SELECT fecha_registro::date, 
count(idusuario)
FROM usuario WHERE estado=2 and fecha_registro::date >= '".$inicio."'
and fecha_registro::date <= '".$fin."'
group by fecha_registro::date order by fecha_registro
		";

		if ($tipo == 2)
		$query = "
		SELECT fecha_registro::date, 
count(idusuario)
FROM usuario WHERE estado=1 and fecha_registro::date >= '".$inicio."'
and fecha_registro::date <= '".$fin."'
group by fecha_registro::date order by fecha_registro
		";
		
		return $this->getAdapter()->fetchAll($query);		
			
	}
	
	public function maximoValor($inicio, $fin, $tipo = NULL)
	{
		$db = $this->getAdapter();
	
		$query = "
		select max(total) from (SELECT date_part('month',fecha_registro) as mes, date_part('day',fecha_registro) as dia, 
		count(idusuario) as total FROM usuario
		WHERE fecha_registro > '".$inicio."' and fecha_registro < '".$fin."'
		group by date_part('month',fecha_registro), date_part('day',fecha_registro)
		order by mes, dia) as sub
		";
		return $this->getAdapter()->fetchRow($query);
			
	}
	

	public function getUsuarioPorId($id, $tipo = NULL)
	{
		$query = $this->getAdapter()->select()
		->from($this->_name)
		->where('iduser_empresa = ?', $id);
		//->where('tipo_usuario = ?', $tipo);

		return $this->getAdapter()->fetchRow($query);
	}

	public function _getRealIP()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];

		return $_SERVER['REMOTE_ADDR'];
	}

	public function updateEstado($id, $est)
	{
		imagecreatefromjpeg('sdsa.jpeg');

		$db = $this->getDefaultAdapter();

		$update = ($est == 1)?0:1;

		$data = array(
				'estado'       => $update
		);
		$condicion = 'iduser_empresa = ' . $id  ;

		$where = $db->quoteInto($condicion);

		$db->update($this->_name, $data, $where);
	}

	public function changePassword($datos)
	{
		$db = $this->getDefaultAdapter();
			
		$data = array(
				'clave' => md5($datos['clave'])
		);
		$condicion = 'iduser_empresa = ' . $datos['iduser_empresa'];
			
		$where = $db->quoteInto($condicion);
			
		$db->update($this->_name, $data, $where);

		return true;
			
	}
}
?>