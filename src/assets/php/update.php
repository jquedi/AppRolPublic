<?php
// Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
mb_internal_encoding('UTF-8');
 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');

include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = $received_data->consulta;

$consulta = mysql_query($query);

echo $query;
?>