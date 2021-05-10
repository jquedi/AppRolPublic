<?php

$ruta = $_POST["ruta"];
$fichero = $_FILES["file"];


$target_dir = $ruta;
$target_file = $target_dir . basename($fichero["name"]);
$uploadOk = 1;

$output = array("ruta" => $target_file);

move_uploaded_file($fichero['tmp_name'], $target_file);

echo json_encode($target_file);


// try {
//     if (move_uploaded_file($fichero['tmp_name'], $target_file)) {
//        echo "El archivo es válido y se cargó correctamente.<br><br>";
//       echo"<a href='".$target_file."' target='_blank'><img src='".$target_file."' width='150'></a>";
//      } else {
//         echo "La subida ha fallado";
//      }
//      echo "</div>";
//  } catch (Exception $e) {
//     echo 'Excepción capturada: ',  $e->getMessage(), "\n";
//  }


?>
