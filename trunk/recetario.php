<?php 
//session_start();
//print_r($_POST);
$N_Afiliado = $_SESSION['N_Afiliado'];
require_once('connections/honorarios.php'); 
mysql_select_db($database_honorarios, $honorarios);
$sql = "select DATE_FORMAT(Fecha_emision,'%d-%m-%y') as fecha,numero, plan from ordenes_medicas where numero=".$_POST['id_orden']."";
$sql = "select coseguro from detalle_orden_medica where orden_nro=".$_POST['id_orden']." and coseguro=0";
$resultado = mysql_query($sql, $honorarios) or die(mysql_error());
$Cantidad_Filas = mysql_num_rows($resultado);
if ($Cantidad_Filas==1){ //sin coseguro
$anio = date("Y");
		$fech = "'31-12-".$anio."'";
	}else{ // con coseguro
		$fech = "DATE_FORMAT(DATE_ADD(DATE_FORMAT(ordenes_medicas.Fecha_emision,'%Y-%m-%d'), INTERVAL 90 DAY) ,'%d-%m-%Y') ";
	}
	//print_r($fech);
$sql = "SELECT ordenes_medicas.Numero, ordenes_medicas.Documento, ppadron.nombre as afiliado,  DATE_FORMAT(ordenes_medicas.Fecha_emision,'%d-%m-%Y') as fecha,
".$fech." as fecha_hasta,  ordenes_medicas.Plan, detalle_orden_medica.codigo,
ppadron.n_benef as benef
FROM ordenes_medicas, detalle_orden_medica, nomenclador, ppadron
WHERE ordenes_medicas.Numero = detalle_orden_medica.orden_nro
and detalle_orden_medica.codigo = nomenclador.codigo  
AND ordenes_medicas.documento =".$N_Afiliado." and  Forma_Pago <> 'ANUL' and ppadron.n_afiliado=".$N_Afiliado." and ordenes_medicas.Numero=".$_POST['id_orden']." order by ordenes_medicas.Fecha_emision DESC";
//print_r($sql);
$resultado = mysql_query($sql, $honorarios) or die(mysql_error());
while ($fila = mysql_fetch_array($resultado)){ 
	$Fecha_imp = $fila['fecha'];
	$Ultimo_numero = $fila['Numero'];
	$Plan = $fila['Plan'];
	$Nombre = $fila['afiliado'];
	//$Descripcion = $fila['descripcion'];
	//$Coseguro = $fila['coseguro'];
	$Fecha_Hasta = $fila['fecha_hasta'];
  $benef = $fila['benef'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="819" border="1">
  <tr>
           <td width="346"><span class="logo"><img src="Logo.gif" alt="logo" width="328" height="78" align="left" /></span></td>
           <td width="728"><p align="center" class="pageName"><strong>Recetario de Farmacia</strong></p>
           <p align="center" class="pageName">AUTO GESTI&Oacute;N S.M.A.U.Na.M</p></td>
         </tr>
       </table>
<div align="left">
  <table width="662" border="0">
    <tr>
      <td><span class="bodyText Estilo2">Sede Central: Jujuy N&ordm; 1745 Posadas Tel-Fax 03752-438504 - Eldorado: Tel: 03751-430621 - Ober&aacute;: Tel: 03755-420423</span></td>
      <td class="subHeader">&nbsp;</td>
    </tr>
    <tr>
      <td width="579"><p class="bodyText Estilo2">IVA Exento - CUIT: 30-65776243-8 - Fecha Inic. Actv.: 01/11/89 </p></td>
      <td width="73" class="subHeader"><div align="right" class="subHeader">
          <div align="left"></div>
      </div></td>
    </tr>
    </table>
</div>
         <div align="left">
           <table width="707" border="0">
           <tr>
             <td width="369" class="subHeader Estilo3">&nbsp;</td>
             <td width="328" class="subHeader Estilo3"><span class="subHeader">Recetario N&ordm;22 - </span><?php echo "$Ultimo_numero" ?></td>
           </tr>
           <tr>
             <td class="subHeader Estilo3">&nbsp;</td>
             <td class="subHeader Estilo3"><p><span class="subHeader">Valido Hasta: </span><?php echo "$Fecha_Hasta" ?> </p>
             <p> 50% Descuento Plan: <?php echo "$Plan"?> - SIN VADEMECUM</p></td>
           </tr>
                  </table>
         </div>
       <table width="789" border="1">
         <tr>
           <td colspan="3"><span class="Estilo2">Fecha Prescripci&oacute;n </span></td>
           <td width="192">N&uacute;mero de Beneficiario </td>
           <td width="39">Categ</td>
           <td width="102">Edad</td>
           <td width="330" rowspan="12"><img src="images/recet2.gif" width="330" height="374" /></td>
         </tr>
         <tr>
           <td width="26">&nbsp;</td>
           <td width="27">&nbsp;</td>
           <td width="27">&nbsp;</td>
           <td align="center"><?php echo "$N_Afiliado" ?></td>
           <td align="center"><?php echo "$benef" ?></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td colspan="4" rowspan="2"><span class="Estilo2">Apellido y Nombre/s: <?php echo "$Nombre" ?></span>  </td>
           <td><span class="Estilo2">M</span>             <div align="center" class="Estilo2"></div></td>
           <td><span class="Estilo2">F</span></td>
         </tr>
         
         <tr>
           <td><span class="Estilo2">N&ordm; </span></td>
           <td><span class="Estilo2">Letras</span></td>
         </tr>
         <tr>
           <td height="29" colspan="4"><p class="Estilo2">Generico</p></td>
           <td rowspan="2">&nbsp;</td>
           <td rowspan="2">&nbsp;</td>
         </tr>
         <tr>
           <td height="23" colspan="4"><p class="Estilo2">R/P</p></td>
         </tr>
         <tr>
           <td height="25" colspan="4"><p class="Estilo2">Gen&eacute;rico</p></td>
           <td rowspan="2">&nbsp;</td>
           <td rowspan="2">&nbsp;</td>
         </tr>
         <tr>
           <td height="25" colspan="4"><p>R/P</p></td>
         </tr>
         <tr>
           <td colspan="2">C&oacute;digo</td>
           <td colspan="4">Diagn&oacute;stico Principal: </td>
         </tr>
         <tr>
           <td colspan="2">C&oacute;digo</td>
           <td colspan="4">Diagn&oacute;stico Secundario: </td>
         </tr>
         <tr>
           <td height="59" colspan="3" rowspan="2"><p>Emitido: </p>
           <p><span class="subHeader Estilo3"><?php echo "$Fecha_imp" ?></span></p></td>
           <td height="59" colspan="3">Matricula: </td>
         </tr>
         <tr>
           <td height="55" colspan="3"><p>Firma y Sello del Profesional:</p></td>
         </tr>
       </table>
       <table width="422" height="79" border="1">
         <tr>
           <td width="106"><div align="center">TROQUEL 1 </div></td>
           <td width="99"><div align="center">TROQUEL2 </div></td>
           <td width="103"><div align="center">TROQUEL3</div></td>
           <td width="86"><div align="center">TROQUEL 4  </div></td>
         </tr>
</table>
       <table width="61" border="0">
         <tr>
           <td width="20" align="center"><?php
	
		// displaying 
	echo '<tt style="font-size:4px">'.$raw.'</tt>'; 

    ?></td>
         </tr>
       </table>
</body>
</html>