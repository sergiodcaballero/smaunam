<?php 
session_start();

//print_r($_POST);
	if (isset($_SESSION['id_orden'])){
		$datos = explode("__", $_SESSION['id_orden']);		
		if ($datos[0]==$_SESSION['N_Afiliado']){
			$codeContents = $datos[1].' 22'; 
			include_once ('qrcode/phpqrcode.php');
			QRcode::png($codeContents);
		}
		unset($_SESSION['id_orden']);
		
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
</body>
</html>