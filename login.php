<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
  if (empty($_POST['email_log']) || empty($_POST['password_log'])) {
    $error = "<BR><div class=\"alert alert-danger\"><strong>ERROR:</strong> Ingresa un Email y Password invalido.</div>";
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
      $error = "<BR><div class=\"alert alert-danger\"><strong>ERROR:</strong> Email o Password es invalido.</div>";
    }
    mysqli_close($connection); // Closing Connection
  }
}
?>
