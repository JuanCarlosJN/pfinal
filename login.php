<?php
session_start(); // Starting Session
$messlog = $messreg = '';
$nombre = $apellido = $correo = $passwd = $passwda = $fechanac = $direccion = $cp = '';

if (isset($_POST['submit_login'])) {
  if (empty($_POST['email_log']) || empty($_POST['password_log'])) {
    $messlog = "<BR><div class=\"alert alert-danger\"><strong>ERROR:</strong> Ingresa un Email y Password válido.</div>";
  }else{
    // Define $username and $password
    $email_log=$_POST['email_log'];
    $password_log=$_POST['password_log'];
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    // SQL query to fetch information of registerd users and finds user match.
    $query = mysqli_query($connection, "SELECT nombre_usuario FROM usuario WHERE password_usuario='$password_log' AND correo_usuario='$email_log'");
    $rows = mysqli_num_rows($query);
    if ($rows == 1) {
      $_SESSION['login_user']=$email_log; // Initializing Session
      header("location: index.html"); // Redirecting To Other Page
    } else {
      $messlog = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Email o Password inválido.</div>";
    }
    mysqli_close($connection); // Closing Connection
  }
}else if (isset($_POST['submit_register'])){
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $correo = $_POST["correo"];
  $passwd = $_POST["passwd"];
  $passwda = $_POST["passwda"];
  $tarjeta = $_POST["tarjeta"];
  $fechanac = $_POST["fechanac"];
  $direccion = $_POST["direccion"];
  $cp = $_POST["cp"];

  if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo']) || empty($_POST['passwd']) || empty($_POST['passwda'])
        || empty($_POST['fechanac']) || empty($_POST['tarjeta']) || empty($_POST['direccion']) || empty($_POST['cp'])) {
    // verificar si los campos no estan en blanco
    $messreg = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Rellena todos los campos.</div>";
  }else{
    // verificar si los campos tienen los datos correctos
    if (!preg_match("/^[a-zA-Z ]*$/",$nommbre) || !preg_match("/^[a-zA-Z ]*$/",$apellido)) {
      $nombre = $apellido = '';
      $messreg = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Solo se permiten letras y espacios en blanco en nombre y apellido.</div>";
    }else if ($passwd != $passwda){
      $passwd = $passwda = '';
      $messreg = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Las contraseñas no coinciden.</div>";
    }else if (!filter_var($cp, FILTER_VALIDATE_INT)) {
      $cp = '';
      $messreg = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Código postal incorrecto.</div>";
    }else if ( strlen($tarjeta) < 15) {
      $tarjeta = '';
      $messreg = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Número de tarjeta incorrecto.</div>";
    }else{
      // agregar los datos a la base de datos
      $connectionreg = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
      $queryreg = mysqli_query($connectionreg, "SELECT * FROM usuario WHERE correo_usuario='$correo'");
      $rowsreg = mysqli_num_rows($queryreg);
      if ($rowsreg == 1) {
        $correo = '';
        $messreg = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Correo electrónico ya registrado, intente con otro.</div>";
        mysqli_close($connectionreg);
      }else{
        $queryreg = mysqli_query($connectionreg, "INSERT INTO usuario (nombre_usuario, apellido_usuario,
            correo_usuario, password_usuario, nacimiento_usuario, tarjeta_usuario, direccion_usuario, cp_usuario) VALUES ('$nombre', '$apellido',
            '$correo', '$passwd', '$fechanac', '$tarjeta', '$direccion', '$cp')");
        mysqli_close($connectionreg);
        $messreg = "<div class=\"alert alert-success\"><strong>FELICIDADES:</strong> Usuario creado, ahora inicia sesión para empezar a comprar.</div>";
      }
    }
  }
}
?>
