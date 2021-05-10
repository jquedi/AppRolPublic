<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();    


$query = "SELECT * FROM `objectsPersonaje` WHERE `system` = " .$received_data->system ." AND `game` = " .$received_data->game ." AND `personaje` = " .$received_data->personaje;

$consulta = mysql_query($query);

while($registro = mysql_fetch_array($consulta)){


    if($registro[7] == $received_data->inventoryOld){
        $query4 = "UPDATE `objectsPersonaje` SET `equipedOrigen`= '" .$received_data->inventoryNew ."' WHERE `id` = " .$registro[0];

        $consulta4 = mysql_query($query4);
    }
    

    $query2 = "SELECT * FROM `objectsInventory` WHERE `objectPersonaje` = " .$registro[0] ." AND `inventory` = '" .$received_data->inventoryOld ."'";

    $consulta2 = mysql_query($query2);

    while($registro2 = mysql_fetch_array($consulta2)){

        $query3 = "UPDATE `objectsInventory` SET `inventory`= '" .$received_data->inventoryNew ."' WHERE `id` = " .$registro2[0];

        $consulta3 = mysql_query($query3);

    }

}




$query = "SELECT * FROM `objectsPersonaje` WHERE `system` = " .$received_data->system ." AND `game` = " .$received_data->game ." AND `personaje` = " .$received_data->personaje;

$consulta = mysql_query($query);

while($registro = mysql_fetch_array($consulta)){

    $query2 = "SELECT * FROM `objectsInventory` WHERE `objectPersonaje` = " .$registro[0] ." AND `inventory` = '" .$received_data->inventoryNew ."'";

    $consulta2 = mysql_query($query2);

    $anterior = "";
    $nuevo = "";

    while($registro2 = mysql_fetch_array($consulta2)){


        $nuevo = $registro2;

        echo "Nuevo: " .json_encode($nuevo) ." Anterior: " .json_encode($anterior);
        
        if($nuevo[1] == $anterior[1] && $nuevo[2] == $anterior[2]){

            $cant = (float)$nuevo[3] + (float)$anterior[3];

            $query3 = "UPDATE `objectsInventory` SET `cant`= " .$cant ." WHERE `id` = " .$nuevo[0];

            $consulta3 = mysql_query($query3);

            $query3 = "DELETE FROM `objectsInventory` WHERE `id` = " .$anterior[0];

            $consulta3 = mysql_query($query3);


        }
        $anterior = $registro2;


    }

}

?>