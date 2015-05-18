<?php 
    require_once('connections/honorarios.php'); 
    //$N_Afiliado = $_SESSION['N_Afiliado']; 
    //$Afiliado_Solo = substr($N_Afiliado, 0, -2); //Saco el Nº de Afilaido del Titular
    //$Nro_Doc    = $_SESSION['Nro_Doc'];
 // $Nombre     = $_SESSION['Nombre']; 
   // $especiales = $_SESSION['especial'];
	if (isset($_POST['id_orden'])){
		$numero_orden = $_POST['id_orden'];
		
	}else if ($_SESSION['id_orden']){
		$datos = explode("__", $_SESSION['id_orden']);
		$numero_orden = $datos[1];$_POST['id_orden'] =$datos[1];
	}
		 // Configuring SVG
    
  //  $dataText   = 'PHP QR Code :)';
   // $svgTagId   = 'id-of-svg';
    //$saveToFile = false;
   // $imageWidth = 250; // px
    
    // SVG file format support
   // $svgCode = QRcode::svg($dataText, $svgTagId, $saveToFile, QR_ECLEVEL_L, $imageWidth);
    
  //  echo $svgCode; 
	//	include('../autogestion/qrcode/qrlib.php');
	 // text output   
	//$codeContents = $numero_orden.' 22'; 
	 // generating 
	//$text = QRcode::text($codeContents); 
	//$raw = join("<br/>", $text); 
	//$raw = strtr($raw, array( 
	//	'0' => '<span style="color:white">&#9608;&#9608;</span>', 
	//	'1' => '&#9608;&#9608;' 
	//)); 	
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
		$fech = "DATE_FORMAT(DATE_ADD(DATE_FORMAT(d.fecha,'%Y-%m-%d'), INTERVAL 90 DAY) ,'%d-%m-%Y')";
	}

	$sql = "select d.orden_nro as numero,d.afiliado, p.nombre, p.PLAN_ as plan, d.codigo, DATE_FORMAT(d.fecha,'%d-%m-%Y') as fecha,".$fech."  as fecha_hasta, n.Descripcion, d.coseguro from nomenclador n inner join (detalle_orden_medica d inner join ppadron p on p.N_afiliado=d.afiliado) on n.codigo=d.codigo where d.orden_nro=".$_POST['id_orden']." ";
	$resultado = mysql_query($sql, $honorarios) or die(mysql_error());
while ($fila = mysql_fetch_array($resultado)){ 
	$num_afiliado = $fila['afiliado'];
	$Fecha_imp = $fila['fecha'];
	$Ultimo_numero = $fila['numero'];
	$Plan = $fila['plan'];
	$Nombre = $fila['nombre'];
	$Descripcion = $fila['Descripcion'];
	$Coseguro = $fila['coseguro'];
	$Fecha_Hasta = $fila['fecha_hasta'];
	$codigo = $fila['codigo'];
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html;  charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
	table{
		
	
	font-size: 12px;
}
.mi_estilo{
	border-collapse: collapse;
	border: 1px solid gray;
	}
	
	  .tamanio {
	font-size: 10px;
}
body p {
	font-size: 9px;
}
body{
	
	font-size:10px;}
.pageName strong {
	font-size: 14px;
}
</style>
</head>

<body>
<table width="679"  border="1" class="mi_estilo">
  <tr border="0" style="font-size:0px;">
    <td width="158">&nbsp;</td>
    <td width="9">&nbsp;</td>
    <td width="59">&nbsp;</td>
    <td width="7">&nbsp;</td>
    <td width="311">&nbsp;</td>
    <td width="102">&nbsp;</td>
  </tr>
  <tr>
     <td height="58" colspan="2" ><img src="images/Logo.gif" width="173" height="49" /></td>
    <td colspan="4" >
      <table width="497" border="0">
        <tr>
          <td width="75">&nbsp;                  </td>
          <td width="303"><p align="center" class="pageName"><strong>Expendio de Ordenes WEB</strong></p>
    <p align="center" class="pageName">AUTO GESTI&Oacute;N S.M.A.U.Na.M</p></td>
          <td width="26">&nbsp;</td>
          <td width="118"><strong>Orden N&ordm; 022 - <?php echo $Ultimo_numero; ?></strong></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="6" class="tamanio"><div style="float:left">Sede Central: Tucum&aacute;n N&ordm;2452 Posadas Tel-Fax 0376-4438504 - Eldorado: Tel: 03751-430621 - Ober&aacute; Tel: 03755-420423 -<br/> 
    IVA Exento - CUIT: 30-65776243-8 - Fecha Inic. Actv.: 01/11/89 </div>
    <div style="float:right; "><strong>
	Fecha:<?php echo $Fecha_imp;?><br />
    V&aacute;lido hasta: <?php echo $Fecha_Hasta?></strong>
    </div></td>
  </tr>
  <tr>
    <td colspan="2">Orden de Pr&aacute;ctica N&ordm;: 022 -<?php echo $Ultimo_numero; ?></td>
    <td colspan="3">F. de Presentacion: __ / __ / ____</td>
    <td>Regional: Auto Gesti&oacute;n</td>
  </tr>
  <tr>
    <td height="31" colspan="2">Afiliado Nro: &nbsp;<?php echo $num_afiliado;?></td>
    <td colspan="3">Nombre y Apellido: &nbsp;<?php echo $Nombre;?></td>
    <td>Plan:&nbsp; <?php echo $Plan;?></td>
  </tr>
  <tr>
    <td colspan="2">R/P:</td>
    <td colspan="3">N&ordm; de Orden de Internaci&oacute;n:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Codigo</td>
    <td colspan="3">Descripci&oacute;n</td>
    <td>Coseguro a cargo del Afiliado</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $codigo;?></td>
    <td colspan="3"><?php echo $Descripcion;?></td>
    <td><?php echo $Coseguro;?></td>
  </tr>
  <tr border="0">
    <td colspan="6">Diagnostico</td>
  </tr>
  <tr border="0">
    <td height="95" colspan="6">
    <div style="float:left;">
   <!--[if IE]>
   	<?php include('../autogestion/qrcode/qrlib.php');
	 // text output   
$codeContents = $numero_orden.' 22'; 
	 // generating 
	$text = QRcode::text($codeContents); 
	$raw = join("<br/>", $text); 
	$raw = strtr($raw, array( 
		'0' => '<span style="color:white">&#9608;&#9608;</span>', 
		'1' => '&#9608;&#9608;' 
	)); echo '<tt style="font-size:3px">'.$raw.'</tt>'; 
		?>
   <![endif]-->
<!--[if !IE]><!-->
		<?php echo '<img  src="qr.php" />';
	
 //<![endif]-->?>
    <!-- <![endif]-->

    </div>
    <div style="float:right">
    	<table width="97%"   border="0">
    	  <tr>
    	    <td width="57" >&nbsp;</td>
    	    <td width="143" height="48"><p>&nbsp;</p>
   	        <p>.......................................................................</p></td>
    	    <td width="26">&nbsp;</td>
    	    <td width="188"><p>&nbsp;</p>
   	        <p> ..............................................................................................</p></td>
    	    <td width="10">&nbsp;</td>
  	      </tr>
    	  <tr>
    	    <td>&nbsp;</td>
    	    <td><center>Firma del Afiliado</center></td>
    	    <td>&nbsp;</td>
    	    <td><center>
    	      Firma y sello del Prestador <br />
    	      elegido por el Afiliado
    	    </center></td>
    	    <td></td>
  	      </tr>
  	  </table>
    </div>
    </td>
  </tr>
</table>

</body>
</html>