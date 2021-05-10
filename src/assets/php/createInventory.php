<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "INSERT INTO `inventories`(`name`, `system`, `game`, `personaje`) VALUES ('" .$received_data->name ."' ," .$received_data->system ." ," .$received_data->game ." ," .$received_data->personaje .")";

$consulta = mysql_query($query);



$query2 = "SELECT * FROM `inventories` WHERE `name` = '" .$received_data->name ."' AND `system` = " .$received_data->system ." AND `game` = " .$received_data->game ." AND `personaje` = " .$received_data->personaje;

$consulta = mysql_query($query2);

while($registro = mysql_fetch_array($consulta)){

    $inventory = $registro[0];

}



$query3 = "INSERT INTO `inventoriesAccess`(`inventory`, `personaje`, `game`) VALUES (" .$inventory ." ," .$received_data->personaje ." ," .$received_data->game .")";

$consulta = mysql_query($query3);


?>