<?php
include("conect.php");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

                                            $query = "SELECT * FROM `inventoriesAccess` WHERE `game` = " .$received_data->game ." AND `personaje`= " .$received_data->personaje;

                                            $consulta = mysql_query($query);


                                            $resultado = [];

                                            while($registro = mysql_fetch_array($consulta)){

                                                $inventario = new stdClass();



                                                $query2 = "SELECT * FROM `inventories` WHERE `id` = " .$registro[1]; ;

                                                $consulta2 = mysql_query($query2);
                                                
                                                
                                                while($registro2 = mysql_fetch_array($consulta2)){
                                                    $inventario->id = $registro2[0];
                                                    $inventario->name = $registro2[1];
                                                }

                                                if($registro[4] == 1){
                                                    $inventario->block = true;
                                                }else{
                                                    $inventario->block = false;
                                                }

                                                $new = (array)$inventario;

                                                $resultado[]=$new;

                                            }





$query3 = "SELECT * FROM `objectsPersonaje` WHERE `game` = " .$received_data->game ." AND `personaje`= " .$received_data->personaje ." AND `system`= " .$received_data->system;

$consulta3 = mysql_query($query3);

$resultado2 = [];

while($registro3 = mysql_fetch_array($consulta3)){

    $objeto = new stdClass();
    $effect = new stdClass();
    $distribution = new stdClass();
    $vacio = new stdClass();

    $objeto->id = (float)$registro3[0];
    $objeto->cant = (float)$registro3[2];
    $objeto->capacity = (float)$registro3[3];
    $objeto->letter = $registro3[4];
    $objeto->hide = $registro3[5];
    $objeto->equiped = (float)$registro3[6];
    $objeto->equipedOrigen = $registro3[7];
    $objeto->system = $registro3[8];
    $objeto->game = $registro3[9];
    $objeto->character = $registro3[10];


    $query4 = "SELECT * FROM `objects` WHERE `id` = " .$registro3[1];

    
    $consulta4 = mysql_query($query4);

    while($registro4 = mysql_fetch_array($consulta4)){
        $objeto->name = $registro4[1];
        $objeto->description = $registro4[2];
        $objeto->type = $registro4[3];
        $objeto->weight = (float)$registro4[4];
        $objeto->image = $registro4[5];
    }

    $query5 = "SELECT * FROM `objectsEffect` WHERE `objectPersonaje` = " .$registro3[0];

    
    $consulta5 = mysql_query($query5);

    $i = 0;
    while($registro5 = mysql_fetch_array($consulta5)){

        $effect->$i = [$registro5[2], (float)$registro5[3], $registro5[4], (float)$registro5[5], $registro5[6]];
        $i++;
    }


    $objeto->effect = (array)$effect;


    

    $query6 = "SELECT * FROM `objectsInventory` WHERE `objectPersonaje` = " .$registro3[0];

    
    $consulta6 = mysql_query($query6);

    $j = 0;
    while($registro6 = mysql_fetch_array($consulta6)){

        // $query7 = "SELECT * FROM `inventories` WHERE `id` = " .$registro6[2];

    
        // $consulta7 = mysql_query($query7);

        // while($registro7 = mysql_fetch_array($consulta7)){
        //     $name = $registro7[1];
        // }


        $list = $registro6[2];
        $distribution->$j = [$registro6[2], (float)$registro6[3]];
        $j++;
    }

    if(count((array)$distribution) == 1){
        $objeto->list = $list;
        $objeto->distribucion = $vacio;
    }else{
        $objeto->list = "";
        $objeto->distribucion = (array)$distribution;
    }




    $objeto->habilities = 0;



    $new = (array)$objeto;

    $resultado2[]=$new;

}





$general = [];

$general[0] = $resultado2;
$general[1] = $resultado;

echo json_encode($general);

?>



