<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "SELECT `password` FROM `users` WHERE `user` = '" .$received_data->user ."'";

$consulta = mysql_query($query);

$contraseña = "";

while($registro = mysql_fetch_array($consulta)){

    $contraseña = $registro;
}





if($contraseña[0] != $received_data->password){
    $devolver = false;
}else{
    $devolver = true;
}

    echo $devolver;
?>