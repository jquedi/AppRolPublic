<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();


$query = "SELECT * FROM `stats-system` WHERE `system` = " .$received_data->system ." ORDER BY `orden`";

$consulta = mysql_query($query);


$newobj = new stdClass();
$effect = new stdClass();


$resultado = [];

while($registro = mysql_fetch_array($consulta)){


    $query2 = "SELECT * FROM `StatsPersonaje` WHERE `statsSystem` = " .$registro[0] ." AND `user` = '" .$received_data->user  ."' AND `game` = " .$received_data->game  ." AND `personaje` = " .$received_data->personaje;

    $consulta2 = mysql_query($query2);


    while($registro2 = mysql_fetch_array($consulta2)){
        $base = $registro2[5];
        $actual = $registro2[6];
    }


    $newobj->id = (float)$registro[0];
    $newobj->user = $received_data->user;
    $newobj->character = (float)$received_data->personaje;
    $newobj->game = (float)$received_data->game;
    $newobj->system = (float)$received_data->system;
    $newobj->name = $registro[2];
    $newobj->acronim = $registro[3];
    $newobj->maximunStat = (float)$registro[4];
    $newobj->minimunStat = (float)$registro[5];
    $newobj->base = (float)$base;

    if($actual == null){
        $newobj->actual = $actual;
    }else{
        $newobj->actual = (float)$actual;
    }


    
    $newobj->total = 0;
    $newobj->effects = $effect;
    $newobj->description = $registro[6];
    $newobj->orden = (float)$registro[7];
    $newobj->hide = (float)$registro[8];
    $newobj->editable = (float)$registro[9];

    $new = (array)$newobj;

    $resultado[]=$new;
}


echo json_encode($resultado);



?>



