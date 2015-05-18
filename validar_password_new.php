<?php session_start() ?> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>
<body>
<?php
    //Establecimiento de la conexi&oacute;n 
  require_once('connections/honorarios.php'); 
  mysql_select_db($database_honorarios, $honorarios);
  //Preparaci&oacute;n y ejecuci&oacute;n de la consulta
  $fecha = date("Y-m-d H:i:s");
  $N_Afiliado = $_SESSION['N_Afiliado'];
  $Nro_Doc = $_SESSION['Nro_Doc'];
  $Pass_new = $_POST['pass_new'];
  $Pass_rep = $_POST['pass_rep'];
  $consulta = "SELECT N_Afiliado, Nombre, Domicilio, Plan_ , Parentesco FROM ppadron where N_afiliado =".$N_Afiliado." and 	   Num_Doc =".$Nro_Doc;
	$resultado = mysql_query($consulta, $honorarios) or die(mysql_error());
	 $Cantidad_Filas = mysql_num_rows($resultado);
  if ($Cantidad_Filas < 1){  
  	echo "<br /> El Password actual ingresado No es el Correcto<br />\n";
  }
  else { 
  	echo "<br /> Password Correcto <br />\n";
	$blanco = strlen($Pass_new) * strlen($Pass_rep);
	if ($blanco > 0 ) {
		if ($Pass_new === $Pass_rep)  {
			$cambio = "update ppadron set  pass = ".$Pass_new.", nuevo = 'NO' where Afili =".$Nro_Doc;
			$cargo = mysql_query($cambio, $honorarios) or die(mysql_error());
			$auditoria = "insert into auditoria (N_Afiliado, accion, fecha) values ('".$N_Afiliado."','ALTA PASSWORD','".$fecha."')";
			
			$cargo_audit = mysql_query($auditoria , $honorarios) or die(mysql_error());
			?>
						<script language="JavaScript">
						alert("A Modificado Su contraseña Con Exito");
						</script>
						 <script language="JavaScript" type="text/javascript">
							//var pagina
							location.href="/autogestion/index.php"
							//function redireccionar() 
							//{
							//=pagina
							//} 
							//setTimeout ("redireccionar()", 0);
							  </script> <?	
		} else {
			?>
						<script language="JavaScript">
						alert("Las Contraseñas cargadas No son Iguales");
						</script>
						 <script language="JavaScript" type="text/javascript">
							var pagina="/autogestion/cambiar_password_nuevo.php"
							function redireccionar() 
							{
							location.href=pagina
							} 
							setTimeout ("redireccionar()", 1000);
							  </script> <?
		}
	} else {
		?>
						<script language="JavaScript">
						alert("Los Campos de Contraseñas son Necesarias");
						</script>
						 <script language="JavaScript" type="text/javascript">
							var pagina="/autogestion/cambiar_password_nuevo.php"
							function redireccionar() 
							{
							location.href=pagina
							} 
							setTimeout ("redireccionar()", 1000);
							  </script> <?
	}
  }
  
  
  
  // Liberamos los recursos de las consultas	
 
  
  
  // Se cierra la conexion
  mysql_close(); 
?>
</body>
</html>