<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "UPDATE `StatsPersonaje` SET `base`= " .$received_data->base ." ,`actual`= " .$received_data->actual ." WHERE `statsSystem`= " .$received_data->id ." AND `user` = '" .$received_data->user ."' AND `game` = " .$received_data->game ." AND `personaje` = " .$received_data->personaje;

$consulta = mysql_query($query);



    if($received_data->actual == null || $received_data->actual == "null"){
        if($received_data->actual == 0){
            $aux = 0;
        }else{
            $aux = null;
        }
    }else{
        $aux = (float)$received_data->actual;
    }


 echo json_encode([(float)$received_data->base, $aux]);

?>