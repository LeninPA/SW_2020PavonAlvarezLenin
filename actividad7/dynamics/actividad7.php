<?php
  /*Este programa recibe un RFC y una contraseña, junto con otros datos relevantes, y verifica que el primero sea válido y la segunda sea
  segura. Posteriormente imprime si se cumplió alguna o todas las condiciones */
  //Recepción de datos
  $nombre = (isset($_POST['nombre']) && $_POST['nombre'] != "") ? $_POST['nombre'] : false;
  $paterno = (isset($_POST['paterno']) && $_POST['paterno'] != "") ? $_POST['paterno'] : false;
  $materno = (isset($_POST['materno']) && $_POST['materno'] != "") ? $_POST['materno'] : false;
  $fecha = (isset($_POST['fecha']) && $_POST['fecha'] != "") ? $_POST['fecha'] : false;
  $colegio = (isset($_POST['colegio']) && $_POST['colegio'] != "") ? $_POST['colegio'] : false;
  $RFC = (isset($_POST['RFC']) && $_POST['RFC'] != "") ? $_POST['RFC'] : false;
  $password = (isset($_POST['password']) && $_POST['password'] != "") ? $_POST['password'] : false;

  if ($nombre!==false&&$paterno!==false&&$materno!==false&&$fecha!==false&&$colegio!==false&&$RFC!==false&&$password!==false) {
    //Verificación de contraseña
    /*Se verifica que tenga minúsculas, mayúsuclas, caracteres especiales y que tenga una longitud mínima de 10 caracteres*/
    $contra = preg_match_all("/^(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}]).{10,}$/", $password);
    //Reemplazo de los caracteres con acentos por aquellos sin acentos
    $search=['á','é','í','ó','ú','ü','Á','É','Í','Ó','Ú'];
    $replace=['a','e','i','o','u','u','A','E','I','O','U'];
    $nombre=str_replace($search,$replace,$nombre);
    $paterno=str_replace($search,$replace,$paterno);
    $materno=str_replace($search,$replace,$materno);
    //Toma el año, mes, día de la fecha de nacimiento
    $fecha=explode("-",$fecha);
    $fecha[0]=substr($fecha[0],2);
    //Toma las iniciales de cada parte del nombre
    $name=substr($nombre,0,1);
    $surname=substr($paterno,0,2);
    $sursurname=substr($materno,0,1);
    $surname=strtoupper($surname);
    $verif=$surname.$sursurname.$name.$fecha[0].$fecha[1].$fecha[2];
    if ($contra==1) {
      echo "Su contraseña es segura <br>";
    }
    else {
      echo "La contraseña ingresada ($password) es insegura<br>";
    }
    if ($verif==substr($RFC,0,10)) {
      echo "RFC válido uwu<br>
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
