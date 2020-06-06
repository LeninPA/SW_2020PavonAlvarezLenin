<?php
  /*Este programa cifra un mensaje recibido a través de un formulario a través del
  método César con una clave especificada en la variable Cesar y la imprime el
  mensaje en mayúsuculas*/
  //Abecedario
  $ABC=[
    "A",//0
    "B",
    "C",
    "D",
    "E",//4
    "F",
    "G",
    "H",
    "I",
    "J",//9
    "K",
    "L",
    "M",
    "N",
    "Ñ",//14
    "O",
    "P",
    "Q",
    "R",
    "S",//19
    "T",
    "U",
    "V",
    "W",
    "X",//24
    "Y",
    "Z"//26
  ];
  //verificación de los datos
  $texto = (isset($_POST['texto']) && $_POST['texto'] != "") ? $_POST['texto'] : false ;
  if(preg_match('/^[ a-zA-Z\,\.\?]+$/',$texto)&&$texto!==false)
  {
    //Variable de cifrado
    $Cesar=3;
    $llave;
    //Creación de abecedario modificado
    foreach ($ABC as $key => $value) {
      $llave=$key-$Cesar;
      $ABCesar[$llave]=$value;
    }
    $texto=strtoupper($texto);
    //Convierte el texto a etiquetas
    $confusion=str_split($texto);
    foreach ($confusion as $key => $value) {
      foreach ($ABCesar as $llave => $valor) {
        if ($value==="&nbsp;"||$value===","||$value==="."||$value==="?") 
          $confusion[$key]=$value;
        elseif ($value==$valor)
          $confusion[$key]=$llave;
      }
    }
    //Convierte las etiquetas al abecedario modificado
    foreach ($confusion as $key => $value) {
      foreach ($ABC as $llave => $valor) {
        if ($value < 0) 
          $value+=sizeof($ABC);
        if ($value===" "||$value===","||$value==="."||$value==="?") 
          $confusion[$key]=$value;
        elseif ($llave==$value) 
          $confusion[$key]=$valor;
      }
    }
    $difusion=implode($confusion);
    echo "El texto cifrado con clave $Cesar es: $difusion
    <button onclick=\"location.href='../templates/cesar.html'\">Regresar</button>";
  }
  else
    echo "Los datos recibidos no son válidos, vuélvalos a ingresar";
 ?>
