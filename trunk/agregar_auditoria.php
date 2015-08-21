<?php session_start();
$afiliado= $_SESSION['N_Afiliado'];
require_once('connections/honorarios.php'); 
mysql_select_db($database_honorarios, $honorarios);
$fecha = date("Y-m-d H:i:s");
$auditoria = "insert into auditoria (N_Afiliado, accion, fecha) values ('".$afiliado."','".$_POST['accion']."','".$fecha."')";
//print_r($auditoria);
mysql_query($auditoria , $honorarios) or die(mysql_error());
?>
