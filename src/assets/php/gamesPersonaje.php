<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "SELECT * FROM `gamesPersonaje` WHERE `personaje` = " .$received_data->personaje;

$consulta = mysql_query($query);

$game = 0;

while($registro = mysql_fetch_array($consulta)){

    $game = $registro[2];



    $query2 = "SELECT * FROM `games` WHERE `id` = " .$game;

    $consulta2 = mysql_query($query2);
    
    $respuesta = [];
    
    while($registro2 = mysql_fetch_array($consulta2)){
    
        $respuesta[] = $registro2;
    }
}

    echo json_encode($respuesta);
?>