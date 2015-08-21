<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="impresion.css" rel="stylesheet" type="text/css" media="print"/>
<title>Documento sin título</title>
<script language="JavaScript">
		alert("Cargue con Hojas A4 en su impresora y presione el botón Imprimir, EL sistema cerrará la ventana de impresión automáticamente luego de 30 segundos.");
		</script>
 <script language="JavaScript" type="text/javascript">
		var pagina="/autogestion/index.php"
		function redireccionar() 
		{
		location.href=pagina
		} 
		setTimeout ("redireccionar()", 30000);
		  </script>
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

<body>
<input type="button" value="Imprimir Orden " name="imprimir" id="imprimir" onclick="javascript:print()"  style = "width: 100 px; height: 50px  "/>
<?php 
		
		
		  
$_POST['id_orden'] = $_SESSION['mi_id_orden'];
 $_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$_SESSION['mi_id_orden'];;
		 
//include_once('ordenes.php');
include_once('ordenes.php');
?>
<br/>
<div class="lineas"></div><br />
<?php //<div class='saltopagina'></div>
//include_once('recetario.php');
 $_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$_SESSION['mi_recetario'];
$_POST['id_orden'] = $_SESSION['mi_recetario'];
include_once('recetario.php');
?>
</body>
</html>