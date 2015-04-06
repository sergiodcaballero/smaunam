<?php 
ob_start();
session_start();
if (!(isset($_SESSION['n_benef']))){
		header('Location:index.php');
	}
	//else if (isset($_POST['id_orden'])){
	//	header('Location:consultar_orden.php');
		//echo "existeeeeeeeeeeeeeeeeeeeeeeeeeeeeee";
	
	//	}
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->

<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Auto Gesti&oacute;n  - P&aacute;gina principal</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link href="estilos/mis_estilos.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootbox.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.md5.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap-tooltip.js"></script>
<script type="text/JavaScript">
var pagina="/autogestion/index.php"
		function redireccionar() 
		{
		location.reload();
		} 
		setTimeout ("redireccionar()", 500000);
	
	$(document).ready(function(e){
		
	$("#form_reimprimir").submit( function (E){  
	//alert('holaa'); 
   		var prueba = $(".reimprimir").val();
     // return false; //Si devolvemos false, el formulario ya no se enviará.
  	 });
				
		$(".reimprimir").click(function(evento){
				//var aux= no;
				 var num_orden = $(this).attr('id');//alert (num_orden);
				 bootbox.dialog({
                title: "Términos y condiciones Sistema de Autogestión SMAUNaM "+'<h6>  ORDENES DE CONSULTAS MÉDICAS WEB' +
                    '</h6> ',
                message: '<h5>  Sr/Sra. Afilado/a recuerde que:' +
                    '</h5> ' +
                    '- Las órdenes emitidas por el sistema web serán impresas por el afiliado sin que las mismas puedan ser duplicadas y/o fotocopiadas o alteradas. ' +
                    '<br> ' +
                    '- En el caso que el SMAUNaM detecte el cometido de alguna de estas situaciones o que no correspondan al buen uso del beneficio, descontará el 100% del valor de la orden médica de los haberes del titular; para lo cual el afiliado titular presta entera conformidad. Para el caso de una reiteración de los hechos se suspenderá para el afiliado titular y su grupo familiar el beneficio del uso del sistema de autogestión web. ' ,
                buttons: {
                    success: {
                        label: "Aceptar",
                        className: "btn-success",
                        callback: function () {
							var accion = "reimpresion de la orden N "+ num_orden;
						$.post('agregar_auditoria.php',{accion:accion}
							);
// window.open("reimpresion.php?v1=4&v2=3", "popupId", "location=no,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=500,height=500"); 
							document.getElementById("form_reimprimir").submit();
                        }
                    }
                }
            }
        );
			//if (aux=='si'){alert('hola');}
			});	
	});
//-->
</script>
<style type="text/css">
	.form-horizontal .control-label{
		width:300px;}
	
	
		.scrollspy-example {
  
  overflow: auto;
  position: relative;
}
</style>
</head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<body>
<div class="container">
	<div class="contenido">
    
  <div class="row-fluid">
    <div class="span12">
		<div class="encabezado">
        	<div class="row-fluid" >
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
    <div class="span12 scrollspy-example tabla_afiliado" data-spy="scroll" data-target="#navbarExample">
    	<div class="contenido_base " >
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
					$consulta = "SELECT ordenes_medicas.Numero, ordenes_medicas.Documento, ppadron.nombre as afiliado, DATE_FORMAT(ordenes_medicas.Fecha_emision,'%d-%m-%Y') as Fecha_emision, ordenes_medicas.hora, detalle_orden_medica.codigo, nomenclador.descripcion, ordenes_medicas.coseguro
FROM ordenes_medicas, detalle_orden_medica, nomenclador, ppadron
WHERE ordenes_medicas.Numero = detalle_orden_medica.orden_nro
and detalle_orden_medica.codigo = nomenclador.codigo  
AND ordenes_medicas.documento =".$N_Afiliado." AND ordenes_medicas.Fecha_emision BETWEEN  '".									$fecha_desde."' and '".$Fecha."' and  Forma_Pago <> 'ANUL' and ppadron.n_afiliado=".$N_Afiliado." order by ordenes_medicas.Fecha_emision desc";
					$resultado = mysql_query($consulta);
					$Cantidad_Filas = mysql_num_rows($resultado);
					if ($Cantidad_Filas < 1){ 
						echo "<br /> No se encontraron Cosumos para el Afiliado<br />\n";
					}else{
				?>
                <form id="form_reimprimir" target="_blank" name="form_reimprimir" action="reimpresion.php" method="post" >
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
						$fecha_antigua = strtotime($fila['Fecha_emision'])- 86400;
						$fecha_emision = strtotime($fila['Fecha_emision']);
						$fecha_nueva = strtotime($fila['Fecha_emision'])+ 86400;
						$fecha = date("Y-m-d");
						$fecha_actual = strtotime($fecha);
						if ($fecha_actual==$fecha_emision ){
							$hora =  date("h:i:s", time());
							
			 				$hora1 =  strtotime($hora);
			 				$hora2 =  strtotime($fila['hora']);
							if ($hora2<$hora1){?>
                            	<input type='hidden' name="id_orden" value="<?php echo$fila['Numero'];?>"/>
								<a class='btn reimprimir btn-success ' id="<?php echo$fila['Numero'];?>">Reimprimir</a><?php								
								}else{ ?>
								<a class='btn     btn-success disabled'>Reimprimir</a><?php
							}
						}else if ($fecha_actual==$fecha_nueva){
							$hora =  date("h:i:s", time());
			 				$hora1 =  strtotime($hora);
			 				$hora2 =  strtotime($fila['hora']);
							if ($hora2>$hora1){ ?>
                            <input type='hidden' name="id_orden" value="<?php echo$fila['Numero'];?>"/>
								<a class='btn reimprimir btn-success ' id="<?php echo$fila['Numero'];?>">Reimprimir</a><?php
							}else{ ?>
								<a class='btn  btn-success disabled'>Reimprimir</a><?php
							}
						}else{?>
							<a class='btn  btn-success disabled'>Reimprimir</a><?php
						}
					
						?></td>
    				</tr>
                    <?php }?>
  				</tbody>
             </table>
            
             </form>
             <?php } ?>
             <form class="form-inline" style="margin-left:25%;">             
             	<div class="control-group">
                	<input class="btn btn-info" type="button" value="Imprimir Consulta" name="Imprimir2" onClick="javascript:print()" />
                    <input class="btn"type="button" value="Volver atr&aacute;s" name="volver atr&aacute;s222" onClick="history.back()" />
                </div>
              </form></div></div>
        <div class="span12" >
        <div class="contenido_base">
        <div class="alert alert-info" style="margin-right:5%;margin-top:2%; margin-left:-10%;padding-top:1%; text-align:justify;">
        	<strong>Términos y condiciones Sistema de Autogestión SMAUNaM <br/>
ORDENES DE CONSULTAS MÉDICAS WEB</strong><br/>
            -Las órdenes emitidas por el sistema web serán impresas por el afiliado sin que las mismas puedan ser duplicadas y/o fotocopiadas o alteradas.<br/>
-En el caso que el SMAUNaM detecte el cometido de alguna de estas situaciones o que no correspondan al buen uso del beneficio, descontará el 100% del valor de la orden médica de los haberes del titular; para lo cual el afiliado titular presta entera conformidad. Para el caso de una reiteración de los hechos se suspenderá para el afiliado titular y su grupo familiar el beneficio del uso del sistema de autogestión web.
                       
        
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
