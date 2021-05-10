<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();    


    $query = "SELECT * FROM `objectsInventory` WHERE `objectPersonaje` = " .$received_data->object ." AND `inventory` = '" .$received_data->origen ."'";

    $consulta = mysql_query($query);

    while($registro = mysql_fetch_array($consulta)){

        $idOrigen = $registro[0];

    }



if($received_data->opcion == 1){


    $query2 = "SELECT * FROM `objectsInventory` WHERE `objectPersonaje` = " .$received_data->object ." AND `inventory` = '" .$received_data->destino ."'";

    $consulta = mysql_query($query2);

    while($registro = mysql_fetch_array($consulta)){

        $idDestino = $registro[0];

    }    
    
    $query3 = "UPDATE `objectsInventory` SET `cant`= " .$received_data->cantidadDestino ." WHERE `id` = " .$idDestino;

    $consulta = mysql_query($query3);



}
if($received_data->opcion == 2){
    
    
    $query4 = "INSERT INTO `objectsInventory`(`objectPersonaje`, `inventory`, `cant`) VALUES (" .$received_data->object .",'" .$received_data->destino ."'," .$received_data->cantidadDestino .")";

    $consulta = mysql_query($query4);

}


$query5 = "UPDATE `objectsInventory` SET `cant` = " .$received_data->cantidadOrigen ." WHERE `id` = " .$idOrigen;

$consulta = mysql_query($query5);
  


$query6 = "SELECT * FROM `objectsInventory` WHERE `objectPersonaje` = " .$received_data->object ." AND `cant` <= 0";

$consulta = mysql_query($query6);

while($registro = mysql_fetch_array($consulta)){

    $id = $registro[0];

    $query7 = "DELETE FROM `objectsInventory` WHERE `id` = " .$id;

    $consulta = mysql_query($query7);


}   


?>