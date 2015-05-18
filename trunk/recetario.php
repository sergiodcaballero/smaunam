<?php 
 require_once('connections/honorarios.php'); 
$numero_orden = $_POST['id_orden'];
		//include('../autogestion/qrcode/qrimage.php');
		
	 // text output   


	$sql= "SELECT f.n_orden,f.afiliado,f.n_benef, p.nombre, DATE_FORMAT(f.fecha_emis,'%d-%m-%Y') as fecha, DATE_FORMAT(f.fecha_val,'%d-%m-%Y') as fecha_hasta FROM farmacia f inner join ppadron p on p.N_afiliado=f.N_afiliado where f.n_orden=$numero_orden";
	$resultado = mysql_query($sql, $honorarios) or die(mysql_error());
while ($fila = mysql_fetch_array($resultado)){ 
	$num_afiliado = $fila['afiliado'];
	$Fecha_imp = $fila['fecha'];
	$Ultimo_numero = $fila['n_orden'];
	$categ = $fila['n_benef'];
	$Nombre = $fila['nombre'];
	
	$Fecha_Hasta = $fila['fecha_hasta'];
	$codigo = $fila['n_benef'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin título</title>
<style type="text/css">

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
.mi_estilo{	
border-collapse: collapse;
	border: 1px solid gray;
	}
	
</style>
</head>

<body>

<table width="682"   border="1" class="mi_estilo">
 
  <tr border="0" style="font-size:0px;">
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td width="33" >&nbsp;</td>
    <td width="105" align="right" >&nbsp;</td>
    <td width="147" align="right" >&nbsp;</td>
    <td colspan="3" align="right" >&nbsp;</td>
    <td width="37" align="right" >&nbsp;</td>
    <td width="61" align="right" >&nbsp;</td>
    
  </tr>
  <tr>
    <td height="72"  colspan="4" ><img src="images/Logo.gif" width="173" height="68"  /></td>
    <td colspan="10"  >
    <table width="487" border="0">
  <tr>
    <td width="29" height="59" rowspan="2" >&nbsp;</td>
    <td width="263" rowspan="2" ><p align="center" style="font-size:15px"><strong>Recetario de Farmacia</strong></p>
    <p align="center" style="font-size:15px">AUTO GESTI&Oacute;N S.M.A.U.Na.M</p></td>
    <td width="122"><strong>Recetario Nº22-<?php echo $Ultimo_numero;?> </strong></td>
    <td width="55" rowspan="2" >
		<!--[if IE]>
			<?php 
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
    </td>
  </tr>
  <tr>
    <td width="122" height="49"></td>
    </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="14" class="tamanio"><div style="float:left">Sede Central: Tucum&aacute;n N&ordm;2452 Posadas Tel-Fax 0376-4438504 - Eldorado: Tel: 03751-430621 - Ober&aacute; Tel: 03755-420423 -<br/> 
    IVA Exento - CUIT: 30-65776243-8 - Fecha Inic. Actv.: 01/11/89 </div>
    <div style="float:right; font-size:15px;">
   <strong>
    50% </strong><br/><div style="font-size:10px">Plan Descuento</div>
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="3" >Fecha Preinscripci&oacute;n</td>
    <td colspan="3">N&uacute;mero de Beneficiario</td>
    <td width="29">Categ</td>
    <td width="27">Edad</td>
    <td colspan="2"><center>Sexo</center></td>
    <td colspan="4" rowspan="4">TROQUEL 1</td>
  </tr>
  <tr>
    <td width="31">&nbsp;</td>
    <td width="42" height="16">&nbsp;</td>
    <td width="51">&nbsp;</td>
    <td colspan="3"><?php echo $num_afiliado;?></td>
    <td ><?php echo $categ;?></td>
    <td >&nbsp;</td>
    <td width="30" rowspan="2" style="font-size:12px" >M</td>
    <td rowspan="2" style="font-size:12px">F</td>
  </tr>
  <tr>
    <td colspan="6" rowspan="2">Apellido/s y Nombre/s: <?php echo $Nombre;?></td>
    <td rowspan="2">N&ordm;</td>
    <td rowspan="2">Letras</td>
  </tr>
  <tr>
    <td height="29">PU</td>
    <td>TOTAL</td>
  </tr>
  <tr>
    <td height="30" colspan="6">Gen&eacute;rico:<br />
    </td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td colspan="4" rowspan="2">TROQUEL 2</td>
  </tr>
  <tr>
    <td height="29" colspan="6">R/P:<br />
    </td>
  </tr>
  <tr>
    <td height="28" colspan="6">Gen&eacute;rico:<br /></td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td colspan="4" rowspan="3">TROQUEL 3</td>
  </tr>
  <tr>
    <td height="26" colspan="6">R/P:<br /></td>
  </tr>
  <tr>
    <td height="16" colspan="3">Codigo</td>
    <td colspan="7">Diagn&oacute;stico Principal <br /></td>
  </tr>
  <tr>
    <td height="16" colspan="3">Codigo</td>
    <td colspan="7">Diagn&oacute;stico Secundario <br /></td>
    <td colspan="4" rowspan="2">TROQUEL 4</td>
  </tr>
  <tr>
    <td colspan="3"><strong>Emitido 
      <?php echo $Fecha_imp;?> <br  />
      V&aacute;lido hasta <?php echo $Fecha_Hasta; ?><br  />
      Recetario N&ordm; 22 - <?php echo $Ultimo_numero;?></strong></td>
    <td height="60" colspan="3">Firma y Sello del Profesional</td>
    <td height="60" colspan="4">Matricula</td>
  </tr>
  <tr>
    <td colspan="5">DATOS DEL AFILIADO</td>
    <td colspan="9">EXCLUSIVO USO FARMACIA</td>
  </tr>
  <tr>
    <td height="35" colspan="3" >&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="35" colspan="2">Fecha vta</td>
    <td height="35">&nbsp;</td>
    <td height="35">&nbsp;</td>
    <td height="35" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Firma</td>
    <td colspan="2">Aclaraci&oacute;n</td>
    <td>A/C Afiliado</td>
    <td colspan="8" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="34" colspan="3">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">DNI</td>
    <td colspan="2">Telefono</td>
    <td>A/C SMAUNAM</td>
    <td colspan="8">Sello y Firma</td>
  </tr>
</table>

</body>
</html>