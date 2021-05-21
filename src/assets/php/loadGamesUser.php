<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "SELECT * FROM `gamesUser` WHERE `user` = '" .$received_data->user ."'";

$consulta = mysql_query($query);


while($registro = mysql_fetch_array($consulta)){


    $query2 = "SELECT * FROM `games` WHERE `id` = " .$registro[1];

    $consulta2 = mysql_query($query2);
    
    $games1 = [];
    $games2 = [];
    
    while($registro2 = mysql_fetch_array($consulta2)){
    
        if($registro2[3] == $received_data->user){
            $games2[] = $registro2;
        }else{
            $games1[] = $registro2;
        }
    }
}

$respuesta = [];

$respuesta[0] = $games1;
$respuesta[1] = $games2;

    echo json_encode($respuesta);
?>