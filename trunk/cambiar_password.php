<?php session_start() ?> 
<!--Cap11/cursor.php-->
<html>
<head><title>Auto Gesti&oacute;n </title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
@import url("mm_restaurant1.css");
-->
</style>
</head>
<body>
 
<table width="933" height="369" border="1">
  <tr>
    <th width="911" bgcolor="#99ccff"><div align="left"><font color='blue'><span class="logo"><img src="Image3.gif" alt="Logo" width="351" height="90" border="1" />AUTO GESTI&Oacute;N S.M.A.U.Na.M<br />
    </span></font></div></th>
  </tr>
  <tr>
    <td height="176" align="center"><div align="center">
      <p>&nbsp;</p>
      <table border='1'>
          <caption style='font-size:16pt'>
            Datos del Afiliado
            <br>
          </caption>
          <tr>
            <th>N&ordm; Afiliado </th>
            <th>Nombre</th>
            <th>Direcci&oacute;n</th>
            <th>Plan</th>
            <th>Parentesco</th>
            <th>Beneficiario</th>
			 <?php
	
  //Establecimiento de la conexi&oacute;n 
  require_once('connections/honorarios.php'); 
  mysql_select_db($database_honorarios, $honorarios);
  //Preparaci&oacute;n y ejecuci&oacute;n de la consulta
  $N_Afiliado = $_SESSION['N_Afiliado'];
  //$Afiliado_Solo = substr($N_Afiliado, 0, -2); //Saco el Nº de Afilaido del Titular
  $Nro_Doc    = $_SESSION['Nro_Doc'];
  $consulta = "SELECT N_Afiliado, Nombre, Domicilio, Plan_ , Parentesco, N_benef FROM ppadron where N_afiliado =".$N_Afiliado." and 	   Num_Doc =".$Nro_Doc;
 $resultado = mysql_query($consulta, $honorarios) or die(mysql_error());
  $Cantidad_Filas = mysql_num_rows($resultado);
  echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
  if ($Cantidad_Filas < 1):  
  	echo "<br /> No se econtr&oacute; el Afiliado<br />\n";
  else: 	 
	  //Recorrido del cursor de fila en fila
	  while ($fila = mysql_fetch_array($resultado)){
		 //Proceso de cada una de las filas
		 echo "<tr>";       
		 echo "<td>", $fila['N_Afiliado'], "</td>";
		 echo "<td>", $fila['Nombre'], "</td>";
		 echo "<td>", $fila['Domicilio'], "</td>";
		 echo "<td>", $fila['Plan_'], "</td>";
		 echo "<td>", $fila['Parentesco'], "</td>";
		 echo "<td>", $fila['N_benef'], "</td>";
		 echo "</tr>\n";  
		 $Nombre =  $fila['Nombre']; 
		 $Plan = $fila['Plan_'];    
		 $Benef =  $fila['N_benef'];                                         
		 } 
		 
		 
  endif;
  // Liberamos los recursos de las consultas	
  mysql_free_result($resultado);
  
  // Se cierra la conexion
  mysql_close();
  
  
?>
          </tr>
        </table>
      <form name="form1" method="post" action="validar_password.php">
        <p>
          <label for="Contraseña">Contrase&ntilde;a Actual : </label>
          <input name="pass_actual" type="password" maxlength="10">
        </p>
        <p>
          <label for="Nueva_Contraseña"> Nueva Contrase&ntilde;a : </label>
          <input name="pass_new" type="password" maxlength="10">
        </p>
        <p>
          <label for="Repetir_Contrasenñ">Repetir Contrase&ntilde;a:</label>
          <input name="pass_rep" type="password" maxlength="10">
        </p>
        <p>
         <input type="submit" name="Cambiar Contraseña" id="Cambiar Contraseña" value="Cambiar Contraseña">
         </p>
      </form>
      <strong>El Total de su grupo familiar deber&aacute; ingresar con la misma contrase&ntilde;a</strong></div>
     
    <p>&nbsp;</p></td>
  </tr>
  <tr>
 
  </tr>
  <tr>
    <td height="46" bgcolor="#0000FF"><input type="button" value="volver atr&aacute;s" name="volver atr&aacute;s22" onClick="history.back()" /></td>
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