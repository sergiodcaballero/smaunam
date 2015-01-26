<?php 
ob_start();
session_start() ?> 
<html>
<head><title>Auto Gesti&oacute;n </title>
<style type="text/css">
<!--
@import url("mm_restaurant1.css");
-->
</style>
</head>
<body>

<table width="933" height="461" border="1">
<tr>
<th width="911" bgcolor="#99ccff"><div align="left"><font color='blue'><span class="logo"><img src="Image3.gif" alt="Logo" width="351" height="90" border="1" />AUTO GESTI&Oacute;N S.M.A.U.Na.M<br />
</span></font></div></th>
</tr>
<tr>
<td height="169"><div align="center">
<p>&nbsp;</p>
<table width="796" border='1'>
<caption style='font-size:16pt'>
 Consumo de Ordenes de Consulta expendidas por Auto Gesti&oacute;n
<br>
</caption>
<tr>
<th width="51" height="40">Nº Orden </th>
<th width="64"><p>Nº Afiliado</p>  </th>
<th width="152">Nombre</th>
<th width="153">Fecha de Emisión</th>
<th width="38">Hora</th>
<th width="60">C&oacute;digo</th>
<th width="150">Descripci&oacute;n</th>
<th width="76">Coseguro</th>
<?php
 //Establecimiento de la conexi&oacute;n 
require_once('connections/honorarios.php'); 
$N_Afiliado = $_SESSION['N_Afiliado'];
//echo "Nro de Afiliado".$N_Afiliado;
// Controlo que No haya sacado más de 2 ordenes en el mes.- 
$Fecha = date("Y-m-d");
$dia = 1;
$mes = 1;
$ano = date("Y");
$fecha1= mktime(0, 0, 0, $mes, $dia, $ano);
$fecha_desde = date("Y-m-d", $fecha1);

$consulta = "SELECT ordenes_medicas.Numero, ordenes_medicas.Documento, ordenes_medicas.Afiliado, ordenes_medicas.Fecha_emision, ordenes_medicas.hora, detalle_orden_medica.codigo, nomenclador.descripcion, ordenes_medicas.coseguro
FROM ordenes_medicas, detalle_orden_medica, nomenclador
WHERE ordenes_medicas.Numero = detalle_orden_medica.orden_nro
and detalle_orden_medica.codigo = nomenclador.codigo  
AND ordenes_medicas.documento =".$N_Afiliado." AND ordenes_medicas.Fecha_emision BETWEEN  '".$fecha_desde."' and '".$Fecha."' and  Forma_Pago <> 'ANUL'";
$resultado = mysql_query($consulta);
$Cantidad_Filas = mysql_num_rows($resultado);
echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
if ($Cantidad_Filas < 1): 
	echo "<br /> No se encontraron Cosumos para el Afiliado<br />\n";
else: 
	//Recorrido del cursor de fila en fila
	while ($fila = mysql_fetch_array($resultado)){
	//Proceso de cada una de las filas
	echo "<tr>"; 
	echo "<td>", $fila['Numero'], "</td>";
	echo "<td>", $fila['Documento'], "</td>";
	echo "<td>", $fila['Afiliado'], "</td>";
	echo "<td>", $fila['Fecha_emision'], "</td>";
	echo "<td>", $fila['hora'], "</td>";
	echo "<td>", $fila['codigo'], "</td>";
	echo "<td>", $fila['descripcion'], "</td>";
	echo "<td>", $fila['coseguro'], "</td>";
	echo "</tr>\n"; 
	
	} 
	

endif;
// Liberamos los recursos de las consultas 
mysql_free_result($resultado);

// Se cierra la conexion
mysql_close();


?>
</tr>
</table>
<p>&nbsp;</p>
<table width="217" border="0">
  <tr>
    <td width="112"><input type="button" value="Imprimir Consulta" name="Imprimir 2" onClick="javascript:print()" /></td>
    <td width="89"><input type="button" value="Volver atr&aacute;s" name="volver atr&aacute;s222" onClick="history.back()" /></td>
  </tr>
</table>
<p>&nbsp;</p>
</div></td>
</tr>
<tr>
  <td height="46" bgcolor="#0000FF">&nbsp;</td>
</tr>
</table>
<center>
<p>&nbsp;</p>
<p><br>
</p>
<p><br /> 
</p>
<hr />
</body>
</html>