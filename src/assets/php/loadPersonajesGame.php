<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "SELECT * FROM `gamesPersonaje` WHERE `game` = " .$received_data->game;

$consulta = mysql_query($query);


while($registro = mysql_fetch_array($consulta)){


    $query2 = "SELECT * FROM `personajes` WHERE `id` = " .$registro[1] ." AND `user` = '" .$received_data->user ."'";

    $consulta2 = mysql_query($query2);
    
    $personajes = [];
    
    while($registro2 = mysql_fetch_array($consulta2)){
    
            $personajes[] = $registro2;
    }
}


    echo json_encode($personajes);
?>