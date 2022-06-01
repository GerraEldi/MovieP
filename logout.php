<?php
session_start();
session_destroy();
if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){ //kontrollon nqs jane krijuar cookie username dhe password, pra nqs perdoruesi ka shtypur me mbaj mend
$username=$_COOKIE['username'];
$password=$_COOKIE['password'];
setcookie('username', '', time()-3600); //fshihet cookie username
setcookie ('password', '', time()-3600);} //fshihet cookie password
header("location:index.php"); //ridrejtim ne faqen kryesore Home per user "guest"
?>