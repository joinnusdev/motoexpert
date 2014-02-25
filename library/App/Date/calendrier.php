<?
//----------------------------------------------------------------
// Voici un petit calendrier qui affiche entre autre,les numeros 
// de semaine, tous les jours feries, les week end ...
//
// Version 1.0
//
// Auteur: Patrice FROMHOLTZ
// email: webmaster@lafoireinformatique.com
// web: http://www.lafoireinformatique.com/
//
//----------------------------------------------------------------

//Page vers laquelle rediriger
if(!isset($pageGo)){
	$pageGo="test.php";
}

/*
//FranÁais
//$tabmonth  = Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin","Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre","Décembre");
//$tabday  = Array("Lun", "Mar", "Mer", "Jeu", "Ven", "Sam","Dim");
//$titleWeek="Sem";

//Anglais
//$tabmonth  = Array("January", "February", "MarCh", "April", "May", "June","July", "August", "September", "October", "November","December");
//$tabday  = Array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat","Sun");
//$titleWeek="Week";

//Espagnol
$tabmonth  = Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio", "Augusto", "Septiembre", "Octubre", "Noviembre","Diciembre");
$tabday  = Array("Lun", "Mar", "Mier", "Jue", "Vie", "Sab","Dom");
*/

$lang=$_SESSION["LANG"];
$weekdays=$_SESSION["weekdays"];
$month=$_SESSION["month"];
$tabmonth=$month[$lang];
$tabday=$weekdays[$lang];
$titleWeek=$tabday[7];

// selectionne la date d aujourd hui si aucune saisie
$dt=date("Y+m+d", mktime(0,0,0,$moisCrtNum,$jourCrtNum,$anCrt));
if (!isset($dt)){
	$year = date("Y");
	$now   = date("Y/m/d");
	$month  = date("n");
	$day = date("d");
}else{
	$data=explode("+",$dt);
	$year=$data[0];
	$month=$data[1];
	$day=$data[2];
	$now=date("Y/m/d", mktime(0,0,0,$month,$day,$year));
}
$moyear=$tabmonth[$month-1]."&nbsp;&nbsp;".$year;
?>

<table WIDTH="160" BORDER="0" CELLSPACING="0" CELLPADDING="2">
  <tr> 
    <td CLASS='titremois' colspan="8" ALIGN="center">
<?
	$lien=date("Y+m+d", mktime(0,0,0,$month-1,$day,$year));
	$newMonth=$month-1;
	echo "<A CLASS='titremois' href=\"".$pageGo."?jourCrtNum=$day&moisCrtNum=$newMonth&anCrt=$year\"><<</a>";

	echo "<A CLASS='titremois'>&nbsp;$moyear&nbsp;</a>";

	$lien=date("Y+m+d", mktime(0,0,0,$month+1,$day,$year));
	$newMonth=$month+1;
	echo "<A CLASS='titremois' href=\"".$pageGo."?jourCrtNum=$day&moisCrtNum=$newMonth&anCrt=$year\">>></a>";
?>
    </td>
  </tr>

  <tr> 
<?
echo"<td WIDTH=20 class='titreweek' ALIGN='center'>Sem</td>\n";
for ($i=0;$i<7;$i++) {
	$day=substr($tabday[$i], 0, 3);
	echo"<td WIDTH=20 class='titrejours' ALIGN='center'>$day</td>\n";
}
?>
  </tr>

<?
$num_day=date("w", mktime(0,0,0,$month,01,$year));
if($num_day==0){$num_day=7;}
$max_day=date("t", mktime(0,0,0,$month,01,$year));
$cpt_day=2;
while ($cpt_day<=$max_day+$num_day) {
  echo "<tr>";

// calcul le numero de semaine

  $nb_day=date("z", mktime(0,0,0,$month,$cpt_day-$num_day+3,$year));
  $val=intval($nb_day/7)+1;
  echo "<td width=20 class='titreweek2' align='center'>".(($val < 10) ? "0".$val : $val)."</td>\n";

// affiche les jours du mois

  for ($i=0;$i<7;$i++) {
	$theday=date("D", mktime(0,0,0,$month,$cpt_day-$num_day,$year));
	$val=date("d", mktime(0,0,0,$month,$cpt_day-$num_day,$year));
	$jourferie=calcul_joursferies($month,$cpt_day-$num_day,$year);
	$class="titrenum";
	if (($theday=="Sun") or ($theday=="Sat")or ($jourferie)){ $class="titrewend";}
	if ($now==date("Y/m/d",mktime(0,0,0,$month,$cpt_day-$num_day,$year))){ $class="titrenow";}
	if ((($cpt_day-$num_day)<1) or (($cpt_day-$num_day)>$max_day)){
	  $class="titrenum2";	  
	  if (($theday=="Sun") or ($theday=="Sat")or ($jourferie)){ $class="titrewend2";}
	}
	$cpt_day++;
	
	if($cpt_day>7 && $val<"07"){
		$linkMonth=$month+1;
	}else{
		$linkMonth=$month;
	}
	echo "<td width=20 class='$class' align='center'><a href=\"".$pageGo."?jourCrtNum=$val&moisCrtNum=$linkMonth&anCrt=$year\">".$val."</a></td>\n";
  }
  echo "</tr>";

}



//##############################################################################
//Mes fonctions
//##############################################################################

//---------------------------------------------------------------------------------------
//Fonction d'ecriture explicite de date
//jj/mm/aaaa => [jour] jj [mois] aaaa
//---------------------------------------------------------------------------------------
Function DateToExplicitDate($MyDate, $WeekDayOn=1, $YearOn=1)
{
  $MyMonths = array("Janvier", "FÈvrier", "Mars", "Avril", "Mai", "Juin",
        "Juillet", "Ao˚t", "Septembre", "Octobre", "Novembre", "DÈcembre");
  $MyDays = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi",
                  "Vendredi", "Samedi");

  $DF=explode('/',$MyDate);
  $TheDay=getdate(mktime(0,0,0,$DF[1],$DF[0],$DF[2]));

  $MyDate=$DF[0]." ".$MyMonths[$DF[1]-1];
  if($WeekDayOn){$MyDate=$MyDays[$TheDay["wday"]]." ".$MyDate;}
  if($YearOn){$MyDate.=" ".$DF[2];}

  return $MyDate;
}

//---------------------------------------------------------------------------------------
//Fonction de formatage de Date mySQL->FranÁais
//aaaa-mm-jj => jj/mm/aaaa
//---------------------------------------------------------------------------------------
function formate_date($dat){
	$an=substr($dat, 0, 4);
	$mois=substr($dat, 5, 2);
	$jour=substr($dat, 8, 2);
	
	$dat=$jour."/".$mois."/".$an;
	return($dat);
}

//---------------------------------------------------------------------------------------
//Fonction de formatage de Date inverse
//jj/mm/aaaa => aaaa-mm-jj
//ou jj/mm/aa => aaaa-mm-jj
//---------------------------------------------------------------------------------------
function deformate_date($dat){
//Format jj/mm/aaaa
	if(strlen($dat)==10)
	{
		$an=substr($dat, 6, 4);
		$mois=substr($dat, 3, 2);
		$jour=substr($dat, 0, 2);
	}

//Format jj/mm/aa
	if(strlen($dat)==8)
	{
		$an=substr($dat, 6, 2);
		$mois=substr($dat, 3, 2);
		$jour=substr($dat, 0, 2);
	}
	
	if($an<20)
		$an="20".$an;
	elseif($an<99)
		$an="19".$an;
	
	$dat=$an."-".$mois."-".$jour;
	return($dat);
}

// ------------------------------------------------------------------------- //
// Premier lundi ( ou autre jour de la semaine) du mois suivant.             //
// ------------------------------------------------------------------------- //
// Auteur: Johan Guenver <johan.guenver@primus.ca>                           //
// Web:    http://membres.lycos.fr/f4u/                                      //
// ------------------------------------------------------------------------- //

/*
Ce script permet d'obtenir le premier lundi (ou autre jour de la semaine) du
mois suivant. Il peut etre utilisÈ dans le developpement d'un calendrier ou pour
passer la variable obtenu a un autre fichier (flash par exemple).
*/
function firstMonday($month, $day, $year, $searched="Monday")
{
/*
	// Date de rÈfÈrence
	$month = '04';
	$day = '18';
	$year = '02';
*/
	
	// On commence une boucle correspondant au nombre de jour pour une semaine
	
	for ($i = 0; $i <= 6; $i++){
	  
	  // Au premier du mois, on incrÈmente de $i a chaque tour de boucle jusqu'‡ ce
	  // que l'on rencontre le jour de la semaine choisie (Ici, lundi)
	  $firstDayOfMonth = $day + $i;
	
	  // On ajoute 1 au mois, de facon a traiter le mois suivant la date
	  // envoyÈe ou passÈe en argument
	  if ((date("l", mktime(0,0,0, $month, $firstDayOfMonth, $year)) == $searched)){
		$newDate = date('l d F Y', mktime(0,0,0, $month, $firstDayOfMonth, $year));
		break;
	  }
	}
	
//	echo $newDate;
	
	// Pour recuperer une valeur spÈcifique de la date, il suffit d'utiliser la
	// commande suivante :
	$var = date('m/d', mktime(0,0,0, $month, $firstDayOfMonth, $year));
	return($var);
}

//---------------------------------------------------------------------------------------
//Fonction de calcul des jours fÈriÈs FR
//---------------------------------------------------------------------------------------
function calcul_joursferies($month,$day,$year)
{
	$lang="fr";
	$resultat=false;
	
	$jf1=$year-1900;
	$jf2=$jf1%19;
	$jf3=intval((7*$jf2+1)/19);
	$jf4=(11*$jf2+4-$jf3)%29;
	$jf5=intval($jf1/4);
	$jf6=($jf1+$jf5+31-$jf4)%7;
	$jfj=25-$jf4-$jf6;
	$jfm=4;
	if ($jfj<=0){
		$jfm=3;
		$jfj=$jfj+31;
		}
	
	
	//Paques
	$paques=(($jfm < 10) ? "0".$jfm : $jfm)."/".(($jfj < 10) ? "0".$jfj : $jfj);
	$venpaq=firstMonday($jfm, $jfj-7, $year, "Friday");
	$lunpaq=date("m/d",mktime(12,0,0,$jfm,$jfj+1,$year));
	
	$ascension=date("m/d",mktime(12,0,0,$jfm,$jfj+39,$year));
	$lunpent=date("m/d",mktime(12,0,0,$jfm,$jfj+50,$year));
	
	//Jours spÈcifiques au QuÈbec
	//le lundi avant le 25 mai
	$lunmai=firstMonday("05", "18", $year);
	//1er ou 2 juillet
	if(date("D",mktime(12,0,0,"07","01",$year))<>"Sun"){
		$fjuill=date("m/d",mktime(12,0,0,"07","01",$year));
	}else{
		$fjuill=date("m/d",mktime(12,0,0,"07","02",$year));
	}
	//1er lundi de sept
	$lunsep=firstMonday("08", "31", $year);
	//2e lundi d'oct
	$lunoct=firstMonday("10", "07", $year);
	
	if($lang=="fr"){
		$JourFerie= Array("01/01","05/01","05/08","07/14","08/15","11/01","11/11","12/25","$paques","$lunpaq","$ascension","$lunpent");
	}elseif($lang="en"){
		$JourFerie= Array("01/01","06/24","12/25","$lunmai","$venpaq","$lunpaq","$fjuill","$lunsep","$lunoct");
	}
	
	$nbj=0;
	$val=	$lien=date("m/d", mktime(0,0,0,$month,$day,$year));
	while ($nbj<count($JourFerie)){
	
		if ($JourFerie[$nbj]==$val){
			$resultat=true;
			$nbj=15;
		}
		$nbj++;
	}
	return($resultat);
}

//---------------------------------------------------------------------------------------
//Fonction de traduction de date
//Sun => Dimanche
//---------------------------------------------------------------------------------------
function translate_date($dat){
    switch($dat)
	{
		//Jours
		case "Sun" :
			return("Dim");
		case "Mon" :
			return("Lun");
		case "Tue" :
			return("Mar");
		case "Wed" :
			return("Mer");
		case "Thu" :
			return("Jeu");
		case "Fri" :
			return("Ven");
		case "Sat" :
			return("Sam");
			
		//Mois
		case "Jan" :
			return("Jan");
		case "Feb" :
			return("Fev");
		case "Mar" :
			return("Mar");
		case "Apr" :
			return("Avr");
		case "May" :
			return("Mai");
		case "Jun" :
			return("Juin");
		case "Jul" :
			return("Juil");
		case "Aug" :
			return("Ao&ucirc;t");
		case "Sep" :
			return("Sep");
		case "Oct" :
			return("Oct");
		case "Nov" :
			return("Nov");
		case "Dec" :
			return("Dec");
	}
}

//---------------------------------------------------------------------------------------
//Fonction de calcul de diffÈrence entre 2 dates
//rÈsultat en jours
//AAAA-MM-JJ
//---------------------------------------------------------------------------------------
function diff_date($date1, $date2)
{
	$jour=substr($date1, 8, 2);
	$mois=substr($date1, 5, 2);
	$an=substr($date1, 0, 4);
	$jour2=substr($date2, 8, 2);
	$mois2=substr($date2, 5, 2);
	$an2=substr($date2, 0, 4);

	$timestamp = mktime(0, 0, 0, $mois, $jour, $an);
	$timestamp2 = mktime(0, 0, 0, $mois2, $jour2, $an2);

	$diff = floor(($timestamp - $timestamp2) / (3600 * 24));
	return $diff;
}

?>

</table>
