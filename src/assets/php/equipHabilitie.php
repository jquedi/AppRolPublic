<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "UPDATE `habilitiesPersonaje` SET `equiped`= " .$received_data->val ." WHERE `id` = " .$received_data->id;

$consulta = mysql_query($query);

?>