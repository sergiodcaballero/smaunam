<?php 
ob_start();
session_start();
if (!(isset($_SESSION['n_benef']))){
		header('Location:index.php');
	}
	require_once('connections/honorarios.php'); 
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
							//alert(num_orden);
							$('input[name="id_orden"]').val(num_orden);
							//alert($('input[name="id_orden"]').val());
// window.open("reimpresion.php?v1=4&v2=3", "popupId", "location=no,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=500,height=500");
								 //document.getElementById("id_orden").value(num_orden);
							document.getElementById("form_reimprimir").submit();
                        }
                    }
                }
            }
        );
			
			});	
			
		$(".reimprimir_recetario").click(function(evento){
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
							var accion = "reimpresion del Recetario N "+ num_orden;
						$.post('agregar_auditoria.php',{accion:accion}
							);
							$('input[name="id_recetario"]').val(num_orden);
							document.getElementById("form_reimprimir1").submit();
                        }
                    }
                }
            }
        );
			});	
	});
</script>
<style type="text/css">
	.form-horizontal .control-label{
		width:300px;}
	.scrollspy-example {  
	  overflow: auto;
	  position: relative;
	}
.contenido_base1{
	margin-top: 3%;
	margin-left: 0%;
	}
</style>
<style media="print" type="text/css">
	@page {
  size: auto;/* es el valor por defecto */
  margin-left: -0.8cm;
 margin-right: 0cm; /* margin: 10%;*/
}
</style>
<style type="text/css">
.btn1 {  display: inline;
  margin-left: .3em;
  zoom: 1;
  white-space: nowrap;
}
</style>
<script type="text/javascript">
function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>
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
    </div>    <div class="stylo">
    
    <div class="span11 " style="margin-top:1%;margin-left:3%">
    
     <form class="form-inline" style=" padding-top:3%;">             
             	<div class="control-group">
                <a class="btn" onclick="history.back()"><i class="icon-arrow-left"></i> Volver atr&aacute;s</a>
                <input class="btn" type="button" value="Imprimir Consumo" name="Imprimir" onclick="javascript:print()" />
                	
                </div>
              </form>
             
<div class="accordion " id="accordion2" >
  <div class="accordion-group">
    <div class="accordion-heading well well-small" style="padding:0px; margin-bottom:0%;padding-bottom:1%">
    <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" ><i class="icon-chevron-right"></i> <strong>Consumo de Ordenes de Consulta con Recetarios por Auto Gestión</strong></a>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner">
        <span class="contenido_base1 scrollspy-example tabla_afiliado">
        <?php 
					 //Establecimiento de la conexi&oacute;n 
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
						echo "<br />No se encontraron Consumos de ordenes para el Afiliado<br />\n";
					}else{
				?>
        </span>
        <div class="contenido_base1 scrollspy-example tabla_afiliado" data-spy="scroll" data-target="#navbarExample" style="margin-top:0%; margin-bottom:-2%">
        		  <form id="form_reimprimir" target="_blank" name="form_reimprimir" action="reimpresion.php" method="get,post">
        		    <table class="table table-striped table-bordered" style=" font-size: 11px;">
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
						$fecha = date("d-m-Y");
						$fecha_actual = strtotime($fecha);
						if ($fecha_actual==$fecha_emision ){
							
							$hora =  date("H:i:s", time());
							
			 				$hora1 =  strtotime($hora);
			 				$hora2 =  strtotime($fila['hora']);
							if ($hora2<$hora1){?>
        		            <input type='hidden' name="id_orden" value="<?php echo$fila['Numero'];?>"/>
        		            <a class='btn reimprimir btn-success ' id="<?php echo$fila['Numero'];?>">Reimprimir</a>
        		            <?php								
								}else{ ?>
        		            <a class='btn btn-success disabled'>Reimprimir</a>
        		            <?php
							}
						}else if ($fecha_actual==$fecha_nueva){
							
							$hora =  date("H:i:s", time());
			 				$hora1 =  strtotime($hora);
			 				$hora2 =  strtotime($fila['hora']);
							if ($hora2>$hora1){ ?>
        		            <input type='hidden' name="id_orden" value="<?php echo$fila['Numero'];?>"/>
        		            <a class='btn reimprimir btn-success ' id="<?php echo$fila['Numero'];?>">Reimprimir</a>
        		            <?php
							}else{ ?>
        		            <a class='btn  btn-success disabled'>Reimprimir</a>
        		            <?php
							}
						}else{?>
        		            <a class='btn  btn-success disabled'>Reimprimir</a>
        		            <?php
						}					
						?></td>
      		          </tr>
        		        <?php }?>
      		        </tbody>
      		      </table>
    		    </form>
        		  <?php } ?>
        		  <center>
        		 <!--   <input class="btn " type="button" value="Imprimir Consumo" name="Imprimir2" onclick="javascript:print()" /> -->
      		    </center>
        		<!--  <a href="javascript:imprSelec('muestra')">Imprimir Tabla</a> -->
                </div>
        		<div class="contenido_base1 scrollspy-example tabla_afiliado" data-spy="scroll" data-target="#navbarExample">
       		

    <div id="collapseOne" class="accordion-body collapse ">
      <div class="accordion-inner"></div></div></div></div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading well well-small" style="padding:0px; margin-bottom:0%;padding-bottom:1%">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        <i class="icon-chevron-right "></i> <strong style="font-size:16px; margin-top:3%;padding_bottom:-2%;">Consumo de Recetarios de Farmacia Adicionales por Auto Gestión</strong>
       
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse in">
      <div class="accordion-inner">
         <?php 
					 //Establecimiento de la conexi&oacute;n 
					
					$N_Afiliado = $_SESSION['N_Afiliado'];
					//echo "Nro de Afiliado".$N_Afiliado;
					// Controlo que No haya sacado más de 2 ordenes en el mes.- 
					$Fecha = date("Y-m-d");
					$dia = 1;
					$mes = 1;
					$ano = date("Y");
					$fecha1= mktime(0, 0, 0, $mes, $dia, $ano);
					$fecha_desde = date("Y-m-d", $fecha1);
					$consulta = "SELECT n_receta, n_afiliado, apellido_y_nombre, fecha_emis,hora_emis FROM farmacia WHERE n_afiliado =".$N_Afiliado." and n_orden='' order by fecha_emis desc";
					$resultado = mysql_query($consulta);
					$Cantidad_Filas = mysql_num_rows($resultado);
					if ($Cantidad_Filas < 1){ 
						echo "<br /> No se encontraron Consumos de recetarios de Farmacia especiales para el Afiliado<br />\n";
					}else{ ?>
						<form id="form_reimprimir1" target="_blank" name="form_reimprimir1" action="reimpresion.php" method="get,post">
                        <table class="table table-striped table-bordered" style=" font-size: 11px;">
                             <thead>
                                <tr>
                                    <th>Nº de Recetario</th>
                                    <th>Nº de Afiliado</th>
                                    <th>Nombre</th>
                                    <th>Fecha de Emisión</th>
                                    <th>Hora</th>
                                    <th></th>
                                </tr>
                            </thead>               
                            <tbody>
                                <?php while ($fila = mysql_fetch_array($resultado)){ ?>
                                <tr>
                                    <td><?php echo $fila['n_receta'];?></td>
                                    <td><?php echo $fila['n_afiliado'];?></td>
                                    <td><?php echo $fila['apellido_y_nombre'];?></td>
                                    <td><?php echo $fila['fecha_emis'];?></td>
                                    <td><?php echo $fila['hora_emis'];?></td>
                                   
                                    <td><?php 
                                    
                                    $fecha_antigua = strtotime($fila['fecha_emis'])- 86400;
                                    
                                    $fecha_emision = strtotime($fila['fecha_emis']);
                                    $fecha_nueva = strtotime($fila['fecha_emis'])+ 86400;
                                    $fecha = date("d-m-Y");
                                    $fecha_actual = strtotime($fecha);
                                    if ($fecha_actual==$fecha_emision ){
                                        
                                        $hora =  date("H:i:s", time());
                                        
                                        $hora1 =  strtotime($hora);
                                        $hora2 =  strtotime($fila['hora_emis']);
                                        if ($hora2<$hora1){?>
                                            <input type='hidden' name="id_recetario" value="<?php echo$fila['n_receta'];?>"/>
                                            <a class='btn reimprimir_recetario btn-success ' id="<?php echo$fila['n_receta'];?>">Reimprimir</a><?php								
                                            }else{ ?>
                                            <a class='btn btn-success disabled'>Reimprimir</a><?php
                                        }
                                    }else if ($fecha_actual==$fecha_nueva){                                 
                                        $hora =  date("H:i:s", time());
                                        $hora1 =  strtotime($hora);
                                        $hora2 =  strtotime($fila['hora_emis']);
                                        if ($hora2>$hora1){ ?>
                                        <input type='hidden' name="id_recetario" value="<?php echo$fila['n_receta'];?>"/>
                                            <a class='btn reimprimir_recetario btn-success ' id="<?php echo$fila['n_receta'];?>">Reimprimir</a><?php
                                        }else{ ?>
                                            <a class='btn  btn-success disabled'>Reimprimir</a><?php                                   }
                                    }else{?>
                                        <a class='btn  btn-success disabled'>Reimprimir</a><?php
                                    }					
                                    ?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                         </table>                        
                         </form>
					<?php }
				?> <center>
					<!--<input class="btn" type="button" value="Imprimir Consumo" name="Imprimir" onclick="javascript:print()" /> -->
               </center>
      </div>
    </div></div>
   
  </div>
</div>
   
    <div class="span12" >        
        <div class="span12" >
        <div class="contenido_base" style="margin-top:-1%;">
        <div class="alert alert-info" style="margin-right:5%;margin-top:2%; margin-left:-10%;padding-top:1%; text-align:justify;"><strong>Términos y condiciones Sistema de Autogestión SMAUNaM <br/>
ORDENES DE CONSULTAS MÉDICAS WEB</strong><br/>
            -Las órdenes emitidas por el sistema web serán impresas por el afiliado sin que las mismas puedan ser duplicadas y/o fotocopiadas o alteradas.<br/>
-En el caso que el SMAUNaM detecte el cometido de alguna de estas situaciones o que no correspondan al buen uso del beneficio, descontará el 100% del valor de la orden médica de los haberes del titular; para lo cual el afiliado titular presta entera conformidad. Para el caso de una reiteración de los hechos se suspenderá para el afiliado titular y su grupo familiar el beneficio del uso del sistema de autogestión web.
        </div>
        </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
