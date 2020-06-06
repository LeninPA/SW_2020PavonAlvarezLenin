<?php
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
    foreach ($clave as $key => $value) {
      foreach ($ABC as $llave => $valor) {
        if ($value==$valor) {
          $clave[$key]=$llave;
        }
      }
    }
    $len_clave = count($clave) - 1;
    $contador = 0;
    $aux = 0;
    $prohibidos = [];
    $ABCmod = [];
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
    $texto_separado = str_split($texto, 3);
    $caracteres = [];
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
    foreach ($caracteres as $key => $value) {
      $unu = chr($value);
      $caracteres[$key] = $unu;
    }
    foreach ($caracteres as $key => $value) {
      foreach ($ABCmod as $llave => $valor) {
        if($value == $valor){
          $caracteres[$key] = $llave;
        }
      }
      foreach ($ABC as $llave => $valor) {
        if($caracteres[$key] == $llave){
          $caracteres[$key] = $valor;
        }
      }
    }
    $decifrado = implode($caracteres);
    echo "El mensaje decifrado es: <br>".$decifrado."<br><br>";
  }
  else {
    echo "Error al recibir sus datos, por favor vuélvalos a ingresar";
  }
  echo "<button onclick=\"location.href='../templates/actividad9.html'\">Regresa al formulario</button>";
 ?>
