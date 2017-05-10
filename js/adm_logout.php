<?php
session_start();

if(session_destroy()) // Destroying All Sessions
{
header("Location: ../adm_register.php"); // Redirecting To Home Page
}
?>
