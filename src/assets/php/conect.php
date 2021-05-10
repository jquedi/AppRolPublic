<?php
	$servername = "rdbms.strato.de";
	$username = "dbu1248464";
	$password = "George21444267";
	$dbname = "dbs1733210";

	
	$conexion = mysql_connect($servername, $username, $password);
	if (!$conexion) {exit();}
	$seleccionar_bd=mysql_select_db($dbname);
	if (!$seleccionar_bd) {exit();}
	mysql_set_charset('utf8');
?>