<?php
  /* Este programa decifra un mensaje escrito con el abecedario
  decrito a continuación, y que fue cifrado usando una palabra clave 
  para trasposicionar el abecedario. Al término del proceso, imprime
  los resultados */
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
    "Z",
    "Á",
    "É",
    "Í",//29
    "Ó",
    "Ú",
    "Ü",
    "a",
    "b",//34
    "c",
    "d",
    "e",
    "f",
    "g",//39
    "h",
    "i",
    "j",
    "k",
    "l",//44
    "m",
    "n",
    "ñ",
    "o",
    "p",//49
    "q",
    "r",
    "s",
    "t",
    "u",//54
    "v",
    "w",
    "x",
    "y",
    "z",//59
    "á",
    "é",
    "í",
    "ó",
    "ú",//64
    ",",
    ".",
    "?",
    "¿",
    "!",//69 Nice
    "1",
    "2",
    "3",
    "4",
    "5",//74
    "6",
    "7",
    "8",
    "9",
    "0" //79
  ];
  //Recepción de datos
  $recibo_clave = (isset($_POST['clave']) && $_POST['clave'] != "") ? $_POST['clave'] : false;
  $texto = (isset($_POST['mensaje']) && $_POST['mensaje'] != "") ? $_POST['mensaje'] : false;
  if ($recibo_clave !== false && $texto !== false) {
    $boceto_clave = str_split($recibo_clave);
    $clave = [];
    //Creación de llave
    foreach ($boceto_clave as $key => $value) {
      $bool_clave=true;
      foreach ($clave as $llave => $valor) {
        if ($valor == $value) {
          $bool_clave=false;
        }
      }
      if ($bool_clave) {
        $clave[] = $value;
      }
    }
    //Cambio de los caracteres de la llave por sus caracteres
    foreach ($clave as $key => $value) {
      foreach ($ABC as $llave => $valor) {
        if ($value==$valor) {
          $clave[$key]=$llave;
        }
      }
    }
    //Variables auxiliares
    $len_clave = count($clave) - 1;
    $contador = 0;
    $aux = 0;
    $prohibidos = [];
    $ABCmod = [];
    //Creación del abecedario modificado
    foreach ($ABC as $key => $value) {
      $identificador = -1;
      if($aux <= $len_clave)
      {
        $identificador = $clave[$aux];
        $prohibidos[] = $clave[$aux];
        $aux++;
      }
      if ($identificador != -1) {
        $ABCmod[$identificador] = $value;
      }
      else{
        foreach ($prohibidos as $llave => $valor) {
          if ($contador == $valor) {
            $contador++;
          }
        }
        $ABCmod[$contador] = $value;
        $contador++;
      }
    }
    //Inicio de decifrado
    //Separación del texto enviado
    $texto_separado = str_split($texto, 3);
    $caracteres = [];
    //Eliminación de los ceros iniciales
    foreach($texto_separado as $key => $value)
    {
      $num_separado = str_split($value);
      if ($num_separado[0] == "0") {
        $num_separado[0] = "";
      }
      $textito = "";
      foreach ($num_separado as $key => $value) {
        $textito .= $value;
      }
      $caracteres[] = $textito;
    }
    // Conversión de los caracteres numéricos a caracteres
    foreach ($caracteres as $key => $value) {
      $ascii = chr($value);
      $caracteres[$key] = $ascii;
    }
    foreach ($caracteres as $key => $value) {
      // Conversión de caracteres a etiquetas del abecedario modificado
      foreach ($ABCmod as $llave => $valor) {
        if($value == $valor){
          $caracteres[$key] = $llave;
        }
      }
      // Conversión de etiquetas a caracteres del abecedario modificado
      foreach ($ABC as $llave => $valor) {
        if($caracteres[$key] == $llave){
          $caracteres[$key] = $valor;
        }
      }
    }
    $decifrado = implode($caracteres);
    // Impresión de resultados
    echo "El mensaje decifrado es: <br>".$decifrado."<br><br>";
  }
  else {
    echo "Error al recibir sus datos, por favor vuélvalos a ingresar";
  }
  echo "<button onclick=\"location.href='../templates/actividad9.html'\">Regresa al formulario</button>";
 ?>
