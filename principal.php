<?php session_start();
require_once('connections/honorarios.php'); 


		  mysql_select_db($database_honorarios, $honorarios);
  
  //Preparaci&oacute;n y ejecuci&oacute;n de la consulta
  //session_start();
  $N_Afiliado = $_SESSION['N_Afiliado'];
  //echo "El afiliado es ".$N_Afiliado;
  $Nro_Doc    =$_SESSION['Nro_Doc'];
  $n_benef = $_SESSION['n_benef'];
 // echo $_SESSION['n_benef']; 
  $consulta = "SELECT N_Afiliado, Nombre, Domicilio, Plan_ , Parentesco, n_benef FROM ppadron where N_afiliado =".$N_Afiliado." and  Num_Doc =".$Nro_Doc;//beneficiario
 $resultado = mysql_query($consulta, $honorarios) or die(mysql_error());
 $Cantidad_Filas = mysql_num_rows($resultado);
//  echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
  if ($Cantidad_Filas < 1):  
  	//echo "<br /> No se econtr&oacute; el Afiliado<br />\n";
  else: 	 
	  //Recorrido del cursor de fila en fila
	  while ($fila = mysql_fetch_array($resultado)){
		 //Proceso de cada una de las filas
		
		 $Nombre =  $fila['Nombre']; 
		 $Plan = $fila['Plan_']; 
		 $benef = $fila['n_benef'];                                              
		 }
		 $puede = '';
		 if ($n_benef === '00') {
			$puede = 'X';
			//print_r($puede);
			
		 } 
		 
		 
  endif;
  // Liberamos los recursos de las consultas	
  
  
  // Se cierra la conexion
 
  
 ?> 
<!--Cap11/cursor.php-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Auto Gesti&oacute;n  - P&aacute;gina principal</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link href="estilos/mis_estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootbox.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.md5.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap-tooltip.js"></script>
<script type="text/JavaScript">

$(document).ready(function(e){
	$(".orden").click(function(evento){
		if (confirm("¿Esta seguro de imprimir la orden? "))
			{
				//alert('hola');
				location.href = "/autogestion/control_cant_ordenes.php";
			 	//return true;
			}else{
				return false;
			}
	});
	
});
	
	

</script>
<style type="text/css">
	
	.contenido-base{
		margin-left: -20%;}
	
</style>
</head>
<body data-spy="scroll" >
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
    	<div class="contenido_principal">
       	<div class="row-fluid">
       		  <div class="span3">
              	<ul class="nav nav-list bs-docs-sidenav">                	
                    <li class="active"><a href="#"><i class="icon-home"></i><i class="icon-chevron-right"></i> Inicio</a></li>
                          <li><a href="cerrar_sesion.php"><i class="icon-remove "></i> Salir</a></li>
                    <li class="nav-head"><a style=" color:#999;"><strong>ORDEN DE CONSULTA MEDICA</strong></a> </li>
              
                    <li><a href="#" class="orden"><i class="icon-chevron-right"></i>Imprimir Orden de consulta</a></li>
                          <li><a href="consultar_orden.php"><i class="icon-chevron-right"></i>Consultar consumo web anual</a></li>
                    <li class="nav-head"><a style=" color:#999;"><strong>AFILIADOS EN TRANSITO</strong></a> </li>
                      <li ><a href="consultar_autorizacion_afiliado.php"><i class="icon-chevron-right"></i>Formulario Personal</a></li>
                      <?php if($puede=='X'){?>
                          <li><a href="autorizacion_afiliado_grupo_flia.php"><i class="icon-chevron-right" ></i>Formulario Grupo Familiar</a></li> <?php } else{ ?>
                           <li class="disabled"><a ><i class="icon-chevron-right" ></i>Formulario Grupo Familiar</a></li>
                          <?php } ?>
                           <li class="nav-head"><a style=" color:#999;"><strong>MIS DATOS</strong></a> </li>
                             <?php if($puede=='X'){?>
                            <li ><a href="/autogestion/cambiar_password.php"><i class="icon-chevron-right"></i>Modificar Contrase&ntilde;a</a></li>
                            <?php } else{ ?>
                            	<li class="disabled"><a><i class="icon-chevron-right"></i>Modificar Contrase&ntilde;a</a></li>
                             <?php } ?>
                </ul>
               		
                </div>
                <div class="span8">
                <br />
                <table class="table table-striped table-condensed table-responsive">
                   <caption > <h3>Mis Datos <br/></h3></caption>
                   <thead>
                		  <tr>
                		    <td ><center><strong>N&ordm; Afiliado</strong></center></td>
                		    <td ><center><strong>Nombre</strong></center></td>
                		    <td ><center><strong>Direcci&oacute;n</strong></center></td>
                		    <td ><center><strong>Plan</strong></center></td>
                		    <td ><center><strong>Parentesco</strong></center></td>
                		    <td ><center><strong>Beneficiario</strong></center></td>
              		    </tr>
                   </thead>
      			   <tbody>
                   <?php
	
  //Establecimiento de la conexi&oacute;n 
  
  mysql_select_db($database_honorarios, $honorarios);
  
  //Preparaci&oacute;n y ejecuci&oacute;n de la consulta
  //session_start();
  $N_Afiliado = $_SESSION['N_Afiliado'];
  //echo "El afiliado es ".$N_Afiliado;
  $Nro_Doc    =$_SESSION['Nro_Doc'];
  $n_benef = $_SESSION['n_benef'];
 // echo $_SESSION['n_benef']; 
  $consulta = "SELECT N_Afiliado, Nombre, Domicilio, Plan_ , Parentesco, n_benef FROM ppadron where N_afiliado =".$N_Afiliado." and  Num_Doc =".$Nro_Doc;//beneficiario
 $resultado = mysql_query($consulta, $honorarios) or die(mysql_error());
 $Cantidad_Filas = mysql_num_rows($resultado);
//  echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
  if ($Cantidad_Filas < 1):  
  	//echo "<br /> No se econtr&oacute; el Afiliado<br />\n";
  else: 	 
	  //Recorrido del cursor de fila en fila
	  while ($fila = mysql_fetch_array($resultado)){
		 //Proceso de cada una de las filas
		 echo "<tr>";       
		 echo "<td> <center>", $fila['N_Afiliado'], " </center></td>";
		 echo "<td> <center>", $fila['Nombre'], " </center></td>";
		 echo "<td> <center>", $fila['Domicilio'], "</center></td>";
		 echo "<td> <center>", $fila['Plan_'], "</center></td>";
		 echo "<td> <center>", $fila['Parentesco'], "</center></td>";
		 echo "<td> <center>", $fila['n_benef'], "</center></td>";
		 echo "</tr>\n";  
		 $Nombre =  $fila['Nombre']; 
		 $Plan = $fila['Plan_']; 
		 $benef = $fila['n_benef'];                                              
		 }
		 $puede = '';
		 if ($n_benef === '00') {
			$puede = 'X';
			//print_r($puede);
			
		 } 
		 
		 
  endif;
  // Liberamos los recursos de las consultas	
  mysql_free_result($resultado);
  
  // Se cierra la conexion
  mysql_close();
  
  
?>
                   </tbody>
                 </table>
                 <form name="form3" method="post" action="cerrar_sesion.php">
           		    <center><input name="cerrar_sesion" type="submit" class="btn btn-large btn-primary" id="button" value="Cerrar Sesión" /></center>
       		      </form>
                </div>
                
        
        </div>
       
    </div>
    <div class="span12">
             <div class="alert alert-info" style="margin-right:6%;margin-top:2%; padding-top:1%;padding-left:-10px;margin-left:0%;">
        	<strong>*Señor Afiliado:</strong><br/>
            - Ante cualquier duda o consulta sobre el funcionamiento del sistema por favor enviar un email a <strong>autogestion@smaunam.com.ar </strong>
           
        </div>    	
    </div>
  </div>
</div>
</div>


</body>
</html>