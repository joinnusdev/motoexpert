<?
	
	//DÈfinition des variables rÈgionales pour les dates
	//Jours
	$_SESSION["weekdays"]=array();
	$_SESSION["weekdays"]["fr"] = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Sem");
	$_SESSION["weekdays"]["gb"] = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Week");
	$_SESSION["weekdays"]["es"] = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "S&aring;bado", "Sem");
	$_SESSION["weekdays"]["de"] = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Sastag", "Sem");
	$_SESSION["weekdays"]["it"] = array("Domenica", "Luned&igrave;", "Marted&igrave;", "Miercoled&igrave;", "Gioved&igrave;", "Venerd&iquest;", "Sabato", "Sem");
	$_SESSION["weekdays"]["pt"] = array("Domingo", "Segunda-feira", "Ter&ccedil;a-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "S&aring;bado", "Sem");
	$_SESSION["weekdays"]["nl"] = array("Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag", "Sem");
	$_SESSION["weekdays"]["da"] = array("S&#x00F8;ndag", "Mandag", "Tirsdag", "Onsdag", "Torsdag", "Fredag", "L&#x00F8;rdag", "Sem");
	$_SESSION["weekdays"]["sv"] = array("S&ouml;ndag", "M&#x00E5;ndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "L&ouml;rdag", "Sem");
	$_SESSION["weekdays"]["cy"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["gd"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["ga"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["el"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["fi"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["et"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["pl"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["ru"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["sw"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["zh"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["ko"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["ja"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["ar"] = array("", "", "", "", "", "", "", "Sem");
	$_SESSION["weekdays"]["fa"] = array("", "", "", "", "", "", "", "Sem");
//	$_SESSION["weekdays"][""] = array("", "", "", "", "", "", "", "Sem");
	
	//Mois
	$_SESSION["month"]=array();
	$_SESSION["month"]["fr"] = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "Décembre");
	$_SESSION["month"]["gb"] = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$_SESSION["month"]["es"] = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$_SESSION["month"]["de"] = array("", "Januar", "Februar", "M&auml;rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
	$_SESSION["month"]["it"] = array("", "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno","Luglio", "Agosto", "Settembre", "Ottobre", "Novembre","Dicembre");
	$_SESSION["month"]["pt"] = array("", "Janeiro", "Fevereiro", "Mar&ccedil;o", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
	$_SESSION["month"]["nl"] = array("", "Januari", "February", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December");
	$_SESSION["month"]["da"] = array("", "Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December");
	$_SESSION["month"]["sv"] = array("", "Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December");
	$_SESSION["month"]["cy"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["gd"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["ga"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["el"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["fi"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["et"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["pl"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["ru"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["sw"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["zh"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["ko"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["ja"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");

	$_SESSION["month"]["ar"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
	$_SESSION["month"]["fa"] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
//	$_SESSION["month"][""] = array("", "", "", "", "", "", "", "", "", "", "", "", "");
?>
