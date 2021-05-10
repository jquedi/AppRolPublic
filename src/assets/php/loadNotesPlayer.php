<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "SELECT * FROM `notesPlayer` WHERE `user` = '" .$received_data->user ."' AND `game` = " .$received_data->game;

$consulta = mysql_query($query);




$resultado = [];

while($registro = mysql_fetch_array($consulta)){

    $newobj = new stdClass();


    $newobj->id = (float)$registro[0];
    $newobj->tittle = $registro[1];
    $newobj->content = $registro[4];


    $new = (array)$newobj;

    $resultado[]=$new;
}


echo json_encode($resultado);

?>