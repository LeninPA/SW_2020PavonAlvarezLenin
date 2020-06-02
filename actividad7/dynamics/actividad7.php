<?php
  $nombre = (isset($_POST['nombre']) && $_POST['nombre'] != "") ? $_POST['nombre'] : false;
  $paterno = (isset($_POST['paterno']) && $_POST['paterno'] != "") ? $_POST['paterno'] : false;
  $materno = (isset($_POST['materno']) && $_POST['materno'] != "") ? $_POST['materno'] : false;
  $fecha = (isset($_POST['fecha']) && $_POST['fecha'] != "") ? $_POST['fecha'] : false;
  $colegio = (isset($_POST['colegio']) && $_POST['colegio'] != "") ? $_POST['colegio'] : false;
  $RFC = (isset($_POST['RFC']) && $_POST['RFC'] != "") ? $_POST['RFC'] : false;

  if ($nombre!==false&&$paterno!==false&&$materno!==false&&$fecha!==false&&$colegio!==false&&$RFC!==false) {
    $search=['á','é','í','ó','ú','Á','É','Í','Ó','Ú'];
    $replace=['a','e','i','o','u','A','E','I','O','U'];
    $nombre=str_replace($search,$replace,$nombre);
    $paterno=str_replace($search,$replace,$paterno);
    $materno=str_replace($search,$replace,$materno);
    $fecha=explode("-",$fecha);
    $fecha[0]=substr($fecha[0],2);
    $name=substr($nombre,0,1);
    $surname=substr($paterno,0,2);
    $sursurname=substr($materno,0,1);
    $surname=strtoupper($surname);
    $verif=$surname.$sursurname.$name.$fecha[0].$fecha[1].$fecha[2];
    if ($verif==substr($RFC,0,10)) {
      echo "RFC válido uwu
      <button class=\"center\" onclick=\"location.href='../templates/actividad7.html'\">Volver al formulario</button>";
    }
    else {
      echo "El RFC ingresado ($RFC) no coincide con los demás datos ingresados, ingrese un RFC válido.<br>
      <button class=\"center\" onclick=\"location.href='../templates/actividad7.html'\">Volver al formulario</button>
      ";
    }
  }
  else {
    echo "Error al recibir sus datos, por favor vuélvalos a ingresar.";
  }
 ?>
