<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
  if (empty($_POST['email_log']) || empty($_POST['password_log'])) {
    $error = "Email o Password es invalido";
  }else{
    // Define $username and $password
    $email_log=$_POST['email_log'];
    $password_log=$_POST['password_log'];
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysql_connect("localhost", "juancarlos_jn", "950704");
    // To protect MySQL injection for Security purpose
    //$email = mysqli_real_escape_string($connection, $_POST['email_log']);
    //$password = mysqli_real_escape_string($connection, $_POST['password_log']);
    // Selecting Database
    mysql_select_db("mydb", $connection);
    // SQL query to fetch information of registerd users and finds user match.
    $query = mysql_query("select * from usuario where password='$password_log' AND email='$email_log'", $connection);
    $rows = mysql_num_rows($query);
    if ($rows = 1) {
      $_SESSION['login_user']=$email_log; // Initializing Session
      header("location: index.html"); // Redirecting To Other Page
    } else {
      $error = "Email o Password es invalido";
    }
    mysql_close($connection); // Closing Connection
  }
}
?>
