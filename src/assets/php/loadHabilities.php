<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

$query = "SELECT * FROM `habilitiesPersonaje` WHERE `user` = '" .$received_data->user ."' AND `game` = " .$received_data->game ." AND `personaje`= " .$received_data->personaje;

$consulta = mysql_query($query);




$resultado = [];

while($registro = mysql_fetch_array($consulta)){

    $newobj = new stdClass();
    $effect = new stdClass();
    $difficulty = new stdClass();
    $cost = new stdClass();

    $query2 = "SELECT * FROM `habilities` WHERE `id` = " .$registro[1];

    $consulta2 = mysql_query($query2);


    while($registro2 = mysql_fetch_array($consulta2)){
        $name = $registro2[1];
        $atribute = $registro2[2];
        $type = $registro2[3];
        $class = $registro2[4];
        $description = $registro2[5];
    }


    $newobj->id = (float)$registro[0];
    $newobj->name = $name;
    $newobj->atribute = $atribute;
    $newobj->type = $type;
    $newobj->class = $class;


    $query5 = "SELECT * FROM `habilitiesEffect` WHERE `habilitiePersonaje` = " .$newobj->id;

    $consulta5 = mysql_query($query5);

    $i = 0;
    while($registro5 = mysql_fetch_array($consulta5)){
        $effect->$i = [$registro5[2], (float)$registro5[3], $registro5[4], (float)$registro5[5], $registro5[6], $registro5[7]];
        $i++;
    }



    $newobj->effect = (array)$effect;



    $query3 = "SELECT * FROM `habilitiesDifficulty` WHERE `habilitiePersonaje` = " .$newobj->id;

    $consulta3 = mysql_query($query3);


    while($registro3 = mysql_fetch_array($consulta3)){
        $stat = $registro3[2];
        $modificador = $registro3[3];
        $dice = $registro3[4];
    }

    $difficulty->stat = $stat;
    $difficulty->modificador = (float)$modificador;
    if($dice == null){
        $difficulty->dice = $dice;
    }else{
        $difficulty->dice = (float)$dice;
    }

    $newobj->difficulty = (array)$difficulty;





    $query4 = "SELECT * FROM `habilitiesCost` WHERE `habilitiePersonaje` = " .$newobj->id;

    $consulta4 = mysql_query($query4);

    $value = 0;
    $stat2 = "";

    while($registro4 = mysql_fetch_array($consulta4)){
        $value = $registro4[2];
        $stat2 = $registro4[3];
    }


    $cost->stat = $stat2;
    $cost->value = (float)$value;

    $newobj->cost = (array)$cost;




    $newobj->description = $description;
    $newobj->from = (float)$registro[5];
    $newobj->fromName = "";
    $newobj->equiped = (float)$registro[6];
    $newobj->see = true;


    $new = (array)$newobj;

    $resultado[]=$new;
}


echo json_encode($resultado);

?>



