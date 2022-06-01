<?php
//Krijimi i lidhjes me databazen
$db_host = 'localhost';
$db_name = 'moviep';
$db_user = 'root';
$db_pass = '';
$con = mysqli_connect($db_host, $db_user, $db_pass);
if (!$con) die("Lidhja me bazen e te dhenave nuk mund te kryhet." . mysqli_error() . "</body></html>");
$db_select = mysqli_select_db($con, $db_name);
if (!$db_select) die("Baza e te dhenave nuk mund te hapet." . mysqli_error() . "</body></html>");
?>
