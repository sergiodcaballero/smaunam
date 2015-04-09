<?php session_start();
//ob_start();
//
	if (!(isset($_SESSION['n_benef']))){
		header('Location:/autogestion/index.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Auto Gesti&oacute;n  - P&aacute;gina principal</title>
<link href="impresion.css" rel="stylesheet" type="text/css" media="print"/>
<link href="mm_restaurant1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">
		//var pagina="/autogestion/index.php"
		//function redireccionar() 
		//{
		//location.href=pagina
		//} 
		//setTimeout ("redireccionar()", 30000);
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
</style>
</head>

<body onLoad="setTimeout(window.close, 90000)">

<input type="button" value="Imprimir Orden " name="imprimir" id="imprimir" onclick="javascript:print()"  style = "width: 100 px; height: 50px  "/>
<?php 
include_once('ordenes.php');
?>

<?php //<div class='saltopagina'></div>
include_once('recetario.php');
?>
</body>
</html>