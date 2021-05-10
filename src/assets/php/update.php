<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = $received_data->consulta;

$consulta = mysql_query($query);

echo $query;
?>