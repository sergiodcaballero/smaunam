<?php 
ob_start();
session_start();
$N_Afiliado = $_SESSION['N_Afiliado'];
//print_r($_POST);
require_once('connections/honorarios.php'); 
mysql_select_db($database_honorarios, $honorarios);
$sql = "select DATE_FORMAT(Fecha_emision,'%d-%m-%y') as fecha,numero, plan from ordenes_medicas where numero=".$_POST['id_orden']."";
$sql = "SELECT ordenes_medicas.Numero, ordenes_medicas.Documento, ppadron.nombre as afiliado,  DATE_FORMAT(ordenes_medicas.Fecha_emision,'%d-%m-%y') as fecha,
DATE_FORMAT(DATE_ADD(DATE_FORMAT(ordenes_medicas.Fecha_emision,'%Y-%m-%d'), INTERVAL 90 DAY) ,'%d-%m-%Y') as fecha_hasta,  ordenes_medicas.Plan, detalle_orden_medica.codigo, nomenclador.descripcion, ordenes_medicas.coseguro
FROM ordenes_medicas, detalle_orden_medica, nomenclador, ppadron
WHERE ordenes_medicas.Numero = detalle_orden_medica.orden_nro
and detalle_orden_medica.codigo = nomenclador.codigo  
AND ordenes_medicas.documento =".$N_Afiliado." and  Forma_Pago <> 'ANUL' and ppadron.n_afiliado=".$N_Afiliado." and ordenes_medicas.Numero=".$_POST['id_orden']." order by ordenes_medicas.Fecha_emision DESC";
$resultado = mysql_query($sql, $honorarios) or die(mysql_error());
while ($fila = mysql_fetch_array($resultado)){ 
	$Fecha_imp = $fila['fecha'];
	$Ultimo_numero = $fila['Numero'];
	$Plan = $fila['Plan'];
	$Nombre = $fila['afiliado'];
	$Descripcion = $fila['descripcion'];
	$Coseguro = $fila['coseguro'];
	$Fecha_Hasta = $fila['fecha_hasta'];
}
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Impresión de Ordenes  AUTO GESTION SMAUNaM</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<style type="text/css">
<!--

</style>

</head>

<body>

<table width="819" border="1">
  <tr>
      <td width="349"><span class="logo"><img src="Logo.gif" alt="1" width="328" height="78" align="left" /></span></td>
      <td width="454"><p align="center"><strong>Expendio de Ordenes WEB</strong></p>
      <p align="center" class="pageName"><strong>AUTO GESTI&Oacute;N S.M.A.U.Na.M</strong></p></td>
  </tr>
</table>
  <div align="left">
    <table width="663" border="0">
             
             <tr>
               <td><span class="bodyText Estilo2">Sede Central: Tucum&aacute;n 2452 - Posadas Tel-Fax 0376-4438504 - Eldorado: Tel: 03751-430621 - Ober&aacute;: Tel: 03755-420423</span></td>
               <td class="subHeader">&nbsp; </td>
             </tr>
             <tr>
               <td width="643"><p class="bodyText Estilo2">IVA Exento - CUIT: 30-65776243-8 - Fecha Inic. Actv.: 01/11/89 </p>             </td>
               <td width="10" class="subHeader"><div align="right"></div></td>
             </tr>
    </table>
           <table width="662" border="0">
             <tr>
               <td width="445" class="subHeader Estilo3">&nbsp;</td>
               <td width="207" class="subHeader Estilo3"><span class="subHeader">Fecha: </span><?php echo "$Fecha_imp" ?></td>
             </tr>
             <tr>
               <td class="subHeader Estilo3">&nbsp;</td>
               <td class="subHeader Estilo3">Valido Hasta: <?php echo "$Fecha_Hasta" ?></td>
             </tr>
           </table>
           <table width="665" border="1">
             <tr>
               <td width="254"><span class="subHeader">Orden de Práctica Nº: 022 - <?php echo "$Ultimo_numero" ?> </span></td>
               <td width="278"><span class="subHeader">F. de Prestaci&oacute;n: __/__/____</span></td>
               <td width="142" class="subHeader">Regional : Auto Gesti&oacute;n </td>
             </tr>
             <tr>
               <td><span class="subHeader">Afiliado Nro: <?php echo "$N_Afiliado" ?></span></td>
               <td bordercolor="1"><span class="subHeader">Nombre: <?php echo "$Nombre" ?> </span></td>
               <td class="subHeader">Plan: <?php echo "$Plan"?></td>
             </tr>
             <tr>
               <td class="subHeader">R/P: </td>
               <td class="subHeader">N&ordm; de Orden de internaci&oacute;n: </td>
               <td>&nbsp;</td>
             </tr>
    </table>
           <p>&nbsp;</p>
  </div>
           
  <div align="left">
    <table width="666" border="1">
             <tr>
               <td width="131"><div align="center" class="subHeader">C&oacute;digo </div></td>
               <td width="303" class="subHeader"><div align="center">Descripci&oacute;n </div></td>
               <td width="210" class="subHeader"><div align="center">Coseguro a cargo del Afliado </div></td>
             </tr>
             <tr>
               <td><div align="center">42.01.01</div></td>
               <td><div align="left"><?php echo "$Descripcion" ?> </div></td>
               <td> <div align="center"> <?php echo "$Coseguro" ?>  </div></td>
             </tr>
    </table>
    <table width="666" border="0">
             <tr>
               <td width="340">Diagn&oacute;stico: </td>
               <td width="316"><strong>Coseguro a Cargo del Afiliado $</strong> <?php echo "$Coseguro" ?></td>
             </tr>
    </table>
    <table width="47" border="0" align="left">
      <tr>
        <td width="37" align="center"><?php
	include('../autogestion/qrcode/qrlib.php');
	 // text output   
	$codeContents = $Ultimo_numero.' 22'; 
	 // generating 
	$text = QRcode::text($codeContents); 
	$raw = join("<br/>", $text); 
	$raw = strtr($raw, array( 
		'0' => '<span style="color:white">&#9608;&#9608;</span>', 
		'1' => '&#9608;&#9608;' 
	)); 
	
	// displaying 
	echo '<tt style="font-size:4px">'.$raw.'</tt>'; 

    ?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div align="center">
             <table width="437" border="0">
               <tr>
                 <td width="205">----------------------------------------------</td>
                 <td width="13">&nbsp;</td>
                 <td width="197"><div align="center">----------------------------------------------</div></td>
               </tr>
               <tr>
                 <td><div align="center">Firma de Afiliado </div></td>
                 <td>&nbsp;</td>
                 <td><div align="center">Firma y sello del Prestador elegido por el Afiliado </div></td>
               </tr>
      </table>
    </div>
   
  </div>
 
 <div class='saltopagina'></div>

<p align="center" class="subHeader">&nbsp;</p>


       
</body>
</html>
