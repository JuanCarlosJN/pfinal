<?php
session_start(); // Starting Session
$messlog = '';

if (isset($_POST['subadm_login'])) {
  if (empty($_POST['user_adm']) || empty($_POST['passwd_adm'])) {
    $messlog = "<BR><div class=\"alert alert-danger\"><strong>ERROR:</strong> Ingresa un Usuario y Password válido.</div>";
  }else{
    // Define $username and $password
    $adm_user=$_POST['user_adm'];
    $adm_passwd=$_POST['passwd_adm'];

    if ($adm_user=='jcjn' && $adm_passwd=='jcjn') {
      $_SESSION['login_adm']=$adm_user; // Initializing Session
      header("location: adm_account.php"); // Redirecting To Other Page
    } else {
      $messlog = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Usuario o Password inválido.</div>";
    }
  }
}
?>
