<?php session_start();
$n_benef = $_SESSION['n_benef'];
$puede = "";
if ($n_benef === '00') {
			$puede = 'X';
			//print_r($puede);
			
		 } 
 ?> 
<!--Cap11/cursor.php-->
<html>
<head><title>Auto Gesti&oacute;n </title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript">
	function confirmacion_impresion(form){
		if (confirm("¿Esta seguro de imprimir la orden? "))
			{
			 form.submit();
			}
		}
</script>
<style type="text/css">
<!--
@import url("mm_restaurant1.css");
.Blanco {
	color: #FFFFFF;
	font-size: 14px;
}
.Blanco {
	font-weight: normal;
}
.blancoresaltado {
	font-weight: bold;
}
.menu {
	font-size: 14px;
}
-->
</style>
</head>
<body>
 
<table width="1000" height="369" border="1">
  <tr>
    <th colspan="5" bgcolor="#99ccff"><div align="left"><font color='blue'><span class="logo"><img src="Image3.gif" alt="Logo" width="351" height="90" border="1" />AUTO GESTI&Oacute;N S.M.A.U.Na.M<br />
    </span></font></div></th>
  </tr>
  <tr>
  	<th>
  <table width="216" height="266">
  
  <tr>
    <td width="206">
    <br/>
    <div align="center" class="menu"><strong>
      Orden de Consulta M&eacute;dica    </strong><br/>
    </div>
    
    <table width="200" border="0">
      <tr>
        <td>
        <form name="Pricipal" method="post" action="control_cant_ordenes.php">
     <div align="center">
          <input type="hidden" name="N_Afiliado" value="<?php echo $N_Afiliado?>">
          <input type="hidden" name="Nro_Doc" value="<?php echo $Nro_Doc?>">
          <input type="hidden" name="Nombre" value="<?php echo $Nombre?>">
          <input type="hidden" name="Plan" value="<?php echo $Plan?>">
          <input type="button" name="Imprimir_orden2" value="Imprimir Orden de Consulta" onClick="confirmacion_impresion(document.forms[0]);">
        </div>
    </form></td>
      </tr>
      <tr>
        <td>
        <form name="form1" method="post" action="consultar_orden.php">
      <div align="center">
          <input name="Consulta_Consumo" type="submit" id="Consulta_Consumo" value="Consultar Consumo Web Anual">
        </div>
    </form>
       </td>
      </tr>
    </table><hr></td>
  </tr>
  <tr>
    <td>
    <br/>
    <div align="center" class="menu"><strong>
      Afiliados en Transito  </strong><br/> 
      <table width="200" border="0">
  <tr>
    <td>
    <form name="form5" method="post" action="consultar_autorizacion_afiliado.php">
      <div align="center">
      <input type="submit" name="button" id="button" value="Formulario Personal">
    </div>
    </form>
    </td>
  </tr>
  <tr>
    <td>
    <form name="form6" method="post" action="autorizacion_afiliado_grupo_flia.php"><div align="center">
      <input type="submit" name="afiliado_transito" id="afiliado_transito" value="Formulario Grupo Familar"
        <?php if($puede=='X'){echo 'enabled';} else{ echo 'disabled'; }?>>
        
    </div>
    </form>
      </td>
  </tr>
</table>
<hr/>
    </div></td>
  </tr>
  <tr>
    <td height="50"><br/><div align="center" class="menu"><strong>
    Mis Datos </strong><br/>
    </div>
    	<div align="center">
    	  <table width="200" border="0">
    	    <tr>
    	      <td height="13"><div align="center">
              <form name="form2" method="post" action="cambiar_password.php">
       <div align="center">
        <input type="submit" name="contrasena" id="contrasena" value="Modificar Contraseña"<?php if($puede=='X'){echo 'enabled';} else{ echo 'disabled'; }?>>
       </div>     
    </form>
    	       
  	        </div></td>
    	      </tr>
  	    </table>
  	  </div>

    </td>
  </tr>
 
  
</table>

    </th>
    <th height="176" colspan="5">
    <div align="center">
    	<table width="688" border='1'>
          <caption style='font-size:16pt'>Datos del Afiliado
            <br>
          <br>
          </caption>
          <tr>
            <th width="89">N&ordm; Afiliado </th>
            <th width="132">Nombre</th>
            <th width="96">Direcci&oacute;n</th>
            <th width="99">Plan</th>
            <th width="143">Parentesco</th>
            <th width="89">Benef</th>
			 <?php
	
  //Establecimiento de la conexi&oacute;n 
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
          </tr>
        </table>
      </div>
    </th>
  </tr>
  <tr>
  
  </tr>
   
    <tr>
    <td height="46" colspan="5" bgcolor="#0000FF"><form name="form3" method="post" action="Inicio.html">
      <input type="submit" name="Volver_atras" id="Volver_atras" value="Volver al Inicio" onClick="location='/autogestion/Inicio.html' ">
    </form>
      <form action="" method="post" name="form4" class="Blanco">
        <p>Recuerde configurar su impresora para imprimir en Hojas A4</p>
        <p>Ante 
          cualquier duda o consulta sobre el funcionamiento del sistema por favor enviar un email a <span class="blancoresaltado">autogestion@smaunam.com.ar </span></p>
      </form>
    <p>&nbsp;</p></td>
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
