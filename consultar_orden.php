<?php 
ob_start();
session_start();
if (!(isset($_SESSION['n_benef']))){
		header('Location:index.php');
	}
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->

<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
<meta http-equiv="Content-Type" content=" charset=iso-8859-1;width=device-width, initial-scale=1.0, user-scalable=no" />

<title>Auto Gesti&oacute;n  - P&aacute;gina principal</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link href="estilos/mis_estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootbox.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.md5.min.js"></script>
<script type="text/JavaScript">

//-->
</script>
<style type="text/css">
	.form-horizontal .control-label{
		width:300px;}
	
</style>
</head>
<body>
<div class="container">
	<div class="contenido">
    
  <div class="row-fluid">
    <div class="span12">
		<div class="encabezado">
        	<div class="row-fluid">
            	<div class="span4">
           	    <img src="images/Logo.gif" class="img-rounded" style="margin-left:1%" /> 
                </div>
                <div class="span8">
                	<div class="titulo">
                    	<h3>AUTOGESTI&Oacute;N S.M.A.U.Na.M.</h3>
                    </div>
                </div>
        	</div>
        	  </div>
    </div>
    <div class="span12">
    	<div class="contenido_base">
       		<h4>Consumo de Ordenes de Consulta por Auto Gesti&oacute;n</h4>
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
					$consulta = "SELECT ordenes_medicas.Numero, ordenes_medicas.Documento, ppadron.nombre as afiliado, ordenes_medicas.Fecha_emision, ordenes_medicas.hora, detalle_orden_medica.codigo, nomenclador.descripcion, ordenes_medicas.coseguro
FROM ordenes_medicas, detalle_orden_medica, nomenclador, ppadron
WHERE ordenes_medicas.Numero = detalle_orden_medica.orden_nro
and detalle_orden_medica.codigo = nomenclador.codigo  
AND ordenes_medicas.documento =".$N_Afiliado." AND ordenes_medicas.Fecha_emision BETWEEN  '".									$fecha_desde."' and '".$Fecha."' and  Forma_Pago <> 'ANUL' and ppadron.n_afiliado=".$N_Afiliado;
					$resultado = mysql_query($consulta);
					$Cantidad_Filas = mysql_num_rows($resultado);
					if ($Cantidad_Filas < 1){ 
						echo "<br /> No se encontraron Cosumos para el Afiliado<br />\n";
					}else{
				?>
            <table class="table table-striped table-bordered" style="margin-right: 20%; margin-left: -8%; font-size: 11px;">
             	 <thead>
    				<tr>
      					<th>Nº de Orden</th>
      					<th>Nº de Afiliado</th>
                        <th>Nombre</th>
                        <th>Fecha de Emisión</th>
                        <th>Hora</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Coseguro</th>
                        <th></th>
    				</tr>
  				</thead>
               
  				<tbody>
					<?php while ($fila = mysql_fetch_array($resultado)){ ?>
   					<tr>
      					<td><?php echo $fila['Numero'];?></td>
      					<td><?php echo $fila['Documento'];?></td>
                        <td><?php echo $fila['afiliado'];?></td>
      					<td><?php echo $fila['Fecha_emision'];?></td>
                        <td><?php echo $fila['hora'];?></td>
      					<td><?php echo $fila['codigo'];?></td>
                        <td><?php echo $fila['descripcion'];?></td>
      					<td><?php echo $fila['coseguro'];?></td>
                        <td><?php 
							$nuevafecha = date('Y-m-d', strtotime($fila['Fecha_emision']) + 86400); //fecha de emision + 1 dia
		 					if ($nuevafecha==date("Y-m-d")){ //verifica si la fecha d emision (+1 dia) es igual a la fecha actual
			 				$hora =  date("h:i:s", time());
			 				$hora1 =  strtotime($hora);
			 				$hora2 =  strtotime($fila['hora']);
							if ($hora2>$hora1){ ?>
								<a class='btn reimprimir btn-success ' id=",$fila['Numero'],">Reimprimir</a><?php
							}else{ ?>
								<a class='btn reimprimir btn-success disabled'>Reimprimir</a><?php
							}
							}else{ ?>
							<a class='btn reimprimir btn-success ' id=",$fila['Numero'],">Reimprimir</a>
							<?php }
						?></td>
    				</tr>
                    <?php }?>
  				</tbody>
             </table>
             <?php } ?>
             <form class="form-inline" style="margin-left:25%;">             
             	<div class="control-group">
                	<input class="btn btn-info" type="button" value="Imprimir Consulta" name="Imprimir2" onClick="javascript:print()" />
                    <input class="btn"type="button" value="Volver atr&aacute;s" name="volver atr&aacute;s222" onClick="history.back()" />
                </div>
              </form>
        <div class="alert alert-info" style="margin-right:20%;margin-top:2%; margin-left:-10%;padding-top:1%">
        	<strong>*Señor Afiliado:</strong><br/>
            - Para poder ingresar al sistema de auto Gestión deberá enviar una solicitud <strong>Alta Usuario.</strong><br/>
            - Para descargar el manual de Ayuda, seleccione 
            <a target="_blank" href="http://www.smaunam.com.ar/wp-content/uploads/2015/01/Manual-Sistema-Autogestión.pdf" class="btn ">Descargar</a>
           
        </div>
        </div>
    </div>
    <div class="span12">
                	
    </div>
  </div>
</div>
</div>


</body>
</html>
