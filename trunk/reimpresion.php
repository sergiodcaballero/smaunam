<?php session_start();//print_r($_GET);print_r($_REQUEST);

//include ('qrcode/phpqrcode.php');
//QRcode::png('some othertext 1234'); 
//ob_start();
//
	if (!(isset($_SESSION['n_benef']))){
		header('Location:/autogestion/index.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1" />
<title>Auto Gesti&oacute;n  - P&aacute;gina principal</title>
<link href="impresion.css" rel="stylesheet" type="text/css" media="print"/>
<style type="text/css">
<!--
.Estilo1 {font-size: 14px}
.Estilo2 {
	font-size: 10px
}
.Estilo3 {font-size: 12px}
-->
@media print {
    button {
        display: none;
    }
}
@media all {
   div.saltopagina{
      display: none;
   }
}
   
@media print{
   div.saltopagina{ 
      display:block; 
      page-break-before:always;
   }
}
.lineas{
	border-bottom-style: dashed; border-bottom-width: 4px; 
	}
</style>
</head>

<body onLoad="setTimeout(window.close, 90000)">

<input type="button" value="Imprimir Orden " name="imprimir" id="imprimir" onclick="javascript:print()"  style = "width: 100 px; height: 50px  "/>
<?php 
//print_r($_POST);
//include_once('ordenes.php');
//include('qr.php');
if (isset($_POST['id_orden']) or isset($_GET['id_orden'])){
	if (isset($_GET['id_orden'])){
		$_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$_GET['id_orden'];
		$_POST['id_orden'] = $_GET['id_orden'];
	}else{
		$_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$_POST['id_orden'];
	}
	include_once('ordenes.php');
?>
<br/>
<div class="lineas"></div><br />
 <?php //<div class='saltopagina'></div>
//include_once('recetario.php');


if (isset($_GET['id_orden'])){
	$consultar_recetario = "select n_receta from farmacia where n_orden='".$_GET['id_orden']."'";
}else{
	$consultar_recetario = "select n_receta from farmacia where n_orden='".$_POST['id_orden']."'";
}

require_once('connections/honorarios.php'); 
mysql_select_db($database_honorarios, $honorarios);
  
 $resultado = mysql_query($consultar_recetario) or die(mysql_error());
 while ($fila = mysql_fetch_array($resultado)){
				 $recetario = $fila['n_receta']; 
				                                              
		}
 mysql_close();
	$_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$recetario;
	$_POST['id_orden'] = $recetario;
	

include_once('recetario.php');

}else{
	include_once ('qrcode/phpqrcode.php');
	if (isset($_GET['id_recetario'])){
		$_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$_GET['id_recetario'];
		$_POST['id_orden'] = $_GET['id_recetario'];
	}else{
		$_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$_POST['id_recetario'];
		$_POST['id_orden'] = $_POST['id_recetario'];
	}
	
	include_once('recetario.php');
}
?>
</body>
</html>