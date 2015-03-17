<?php 
ob_start();
session_start(); ?> 
<html>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/jquery.dialog2.css"/>
 <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootbox.js"></script>
<head>
<title>Auto Gesti&oacute;n</title>
<style type="text/css">
<!--
@import url("mm_restaurant1.css");
-->
</style>
<style type="text/css">
body{
font-weight:normal;
}
</style>
<script type="text/javascript">
 
$(document).ready(function(e){
			 $(".anular").click(function(evento){
				 var num_orden = $(this).attr('id');
				//  bootbox.alert("Hello world!", function() {
              //  console.log("Alert Callback");
            //});
			bootbox.confirm(
			"¿Esta seguro de anular la orden Nº "+num_orden+"?", 			
			function(result) {
				//var box=bootbox.dialog({
					//	message: '</br> Se está enviando su petición de Anulación</br></br></br>'+
					//	'<div class="progress progress-striped active">'+ 
					//				'<div class="bar" style="width: 100%;"> ' +
					//				'</div></br>',
					//	closeButton: false,	
         //  });
				if (result==true){
					
		  //box.modal('show');
					var url ="anulacion.php"; 
					$.post(url,{orden:num_orden},function(valor,suceso){
						//alert(valor);
						if (suceso=='success'){
							//box.modal('hide');
								alert('La orden ha sido eliminada exitosamente');	
								
							}else{
								//box.modal('hide');
								alert('Intente más tarde');
						}
						 location.reload();
					
					});
					
					
					}
			}); 
				// alert (num_orden);
			//	 if (confirm("¿Esta seguro de anular la orden? Una vez que se anule la orden no se la puede utilizar."))
		//	{
			//	var url ="anulacion.php";
				//$.post(url,{orden:num_orden},function(valor){
					//alert(valor);
					//});
		//}
				// alert('holaaaaaaaaaaaaaaaaaaaaaaaa');
				// alert($(this).attr('id'));
				});
				});
	
	
	
</script>
</head>
<body>
 
<table width="933" height="461" border="1">
<tr>
<th width="911" bgcolor="#99ccff"><div align="left"><font color='blue'><span class="logo"><img src="Image3.gif" alt="Logo" width="351" height="90" border="1" />AUTO GESTI&Oacute;N S.M.A.U.Na.M<br />
</span></font></div></th>
</tr>
<tr>
<td height="169"><div align="center">

<br/>
<h4>
 Consumo de Ordenes de Consulta por Auto Gesti&oacute;n
<br/>
</h4>
<br/><br/>
<table width="94%" class='table table-striped' style="width:92%;">
<thead>
<tr>
<th width="9%" ><center>Nº Orden </center></th>
<th width="9%" ><center>Nº Afiliado</center></th>
<th width="9%" ><center>Nombre</center></th>
<th width="15%"><center>Fecha de Emisión</center></th>
<th width="7%" ><center>Hora</center></th>
<th width="9%"><center>C&oacute;digo</center></th>
<th width="13%" ><center>Descripci&oacute;n</center></th>
<th width="11%" ><center>Coseguro</center></th>
<th width="18%" ></th>
</tr></thead><tbody>
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
//echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
if ($Cantidad_Filas < 1): 
	echo "<br /> No se encontraron Cosumos para el Afiliado<br />\n";
else: 
//date_default_timezone_set('America/Argentina/Buenos_Aires'); 
	//Recorrido del cursor de fila en fila
	while ($fila = mysql_fetch_array($resultado)){
	//Proceso de cada una de las filas
	
	echo "<tr>"; 
	echo "<td>", $fila['Numero'], "</td>";
	echo "<td>", $fila['Documento'], "</td>";
	echo "<td>", $fila['Afiliado'], "</td>";
	echo "<td><center>", $fila['Fecha_emision'], "</center></td>";
	echo "<td>", $fila['hora'], "</td>";
	echo "<td>", $fila['codigo'], "</td>";
	echo "<td>", $fila['descripcion'], "</td>";
	echo "<td>", $fila['coseguro'], "</td>";
	if ($fila['Fecha_emision']==date("Y-m-d")){
		echo "<td> 
	<a class='btn anular btn-danger' id=",$fila['Numero'],">Anular Orden</a>
				</td>";
		}else{
		 $nuevafecha = date('Y-m-d', strtotime($fila['Fecha_emision']) + 86400); 
		 if ($nuevafecha==date("Y-m-d")){
			 $hora =  date("h:i:s", time());
			 $hora1 =  strtotime($hora);
			 $hora2 =  strtotime($fila['hora']);
			 //echo $hora;
			 if ($hora2>$hora1){
				 	echo "<td> 
	<a class='btn anular btn-danger' id=",$fila['Numero'],">Anular Orden</a>
				</td>";
				 }else{
					  echo "<td> 
	<a class='btn btn-danger disabled' >Anular Orden</a>
				</td>";
				 }
			 
			 }else{
				 echo "<td> 
	<a class='btn btn-danger disabled' >Anular Orden</a>
				</td>";
			 }
	}
	echo "</tr>\n "; 
	
	} 
	

endif;
// Liberamos los recursos de las consultas 
mysql_free_result($resultado);

// Se cierra la conexion
mysql_close();


?>
</tbody>
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