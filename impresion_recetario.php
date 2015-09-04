<?php
ob_start();
session_start();  

//Establecimiento de la conexi&oacute;n 
require_once('connections/honorarios.php'); 
mysql_select_db($database_honorarios, $honorarios);
  
//Preparaci&oacute;n y ejecuci&oacute;n de la consulta
$N_Afiliado = $_SESSION['N_Afiliado'];
$Afiliado_Solo = substr($N_Afiliado, 0, -2); //Saco el Nº de Afilaido del Titular
$Nro_Doc    = $_SESSION['Nro_Doc'];
$Nombre     = $_SESSION['Nombre']; 
// Controlo que No haya sacado más de 2 ordenes en el mes.- 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="impresion.css" rel="stylesheet" type="text/css" media="print"/>
<title>Documento sin t&iacute;tulo</title>
<script language="JavaScript">
		alert("Cargue con Hojas A4 en su impresora y presione el botón Imprimir, EL sistema cerrará la ventana de impresión automáticamente luego de 30 segundos.");		
		var pagina="/autogestion/index.php"
		function redireccionar() 
		{
		location.href=pagina
		} 
		setTimeout ("redireccionar()", 30000);
</script>
</head>

<body>
<input type="button" value="Imprimir Recetario" name="imprimir" id="imprimir" onclick="javascript:print()"  style = "width: 100 px; height: 50px  "/>
<input type="button" value="Volver atr&aacute;s " name="volver" id="volver_atras" onclick="history.back()"  style = "width: 100 px; height: 50px  "/>
<?php 
include_once ('qrcode/phpqrcode.php');
//print_r($_SESSION['mi_id_orden']);
$_POST['id_orden'] = $_SESSION['mi_id_orden'];
 $_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$_SESSION['mi_id_orden'];
// print_r($_POST['id_orden']);

include_once('recetario.php');
?>
</body>
</html>