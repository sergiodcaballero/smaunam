<?php 
ob_start();
session_start() ?> 
<?php

	//Establecimiento de la conexi&oacute;n 
   require_once('connections/honorarios.php'); 
  
  //Preparaci&oacute;n y ejecuci&oacute;n de la consulta
  $N_Afiliado = $_POST['N_Afiliado'];
  $Nro_Doc = $_POST['Nro_Doc'];
  $Pass  = $_POST['password'];
  $blanco = strlen($Pass);
   mysql_select_db($database_honorarios, $honorarios);
  $consulta = "SELECT N_Afiliado, Nombre, Domicilio, Plan_ , Parentesco, pass, n_benef, estado, nuevo  FROM ppadron where N_afiliado =".$N_Afiliado." and  Num_Doc =".$Nro_Doc;

	$resultado = mysql_query($consulta, $honorarios) or die(mysql_error());
	 $Cantidad_Filas = mysql_num_rows($resultado);  //print_r($Cantidad_Filas);
  if ($Cantidad_Filas < 1):  
  	?>
						<script language="JavaScript">
						alert("Carga de Datos Erroneos Verifique");
						</script>
						 <script language="JavaScript" type="text/javascript">
							var pagina="/autogestion/index.php"
							function redireccionar() 
							{
							location.href=pagina
							} 
							setTimeout ("redireccionar()", 1000);
							  </script> <?php
  
  else :
		while ($fila = mysql_fetch_array($resultado)){
		//Proceso de cada una de las filas
			 $contra =  $fila['pass']; 
			 $n_benef = $fila['n_benef'];
			 $estado =  $fila['estado']; 
			 $nuevo =   $fila['nuevo']; 
			
			 //echo "<tr>";       
			 //echo "<td>", $fila['pass'], "</td>";
			 //echo "<td>", $fila['n_benef'], "</td>";
			 //echo "<td>", $fila['nuevo'], "</td>";
			// echo "</tr>\n";  
			 
													  
		}
		if ($estado === 'A') {
			if ($blanco > 0) {
				if ($Pass <> $contra ){
						?>
							<script language="JavaScript">
							alert("La Contraseña es Incorrecta");
							</script>
							 <script language="JavaScript" type="text/javascript">
								var pagina="/autogestion/index.php"
								function redireccionar() 
								{
								location.href=pagina
								} 
								setTimeout ("redireccionar()", 1000);
								  </script> <?php
					
				} else {
					
					if ($nuevo  === 'SI' AND $n_benef === '00') {
						$_SESSION['N_Afiliado'] = $_REQUEST['N_Afiliado'];
						$_SESSION['Nro_Doc'] = $_REQUEST['Nro_Doc'];
						header('Location:cambiar_password_nuevo1.php');						
										
					} else {
						if ($nuevo  === 'SI') {
							?>
							<script language="JavaScript">
							alert("El Afiliado TITULAR debe realizar el primer ingreso");
							</script>
							 <script language="JavaScript" type="text/javascript">
								var pagina="/autogestion/index.php"
								function redireccionar() 
								{
								location.href=pagina
								} 
								setTimeout ("redireccionar()", 1000);
								  </script> <?php
						} else {
					
							$_SESSION['N_Afiliado'] = $_REQUEST['N_Afiliado'];
					
							$_SESSION['Nro_Doc'] = $_REQUEST['Nro_Doc'];
							$_SESSION['n_benef'] = $n_benef; // paso el beneficiario para activar el botón contraseña
							header('Location:principal.php');
							//header('Location:prueba.php');
				        }
					}
				}
			} else {
				?>
							<script language="JavaScript">
							alert("La Contraseña No puede están en Blanco");
							</script>
							 <script language="JavaScript" type="text/javascript">
								var pagina="/autogestion/index.php"
								function redireccionar() 
								{
								location.href=pagina
								} 
								setTimeout ("redireccionar()", 1000);
								  </script> <?php
			}
	 	} else {
				?>
							<script language="JavaScript">
							alert("No puede utilizar el Sistema de Auto Gestión, Por Favor comuniquese  a autogestion@smaunam.com.ar ");
							</script>
							 <script language="JavaScript" type="text/javascript">
								var pagina="/autogestion/index.php"
								function redireccionar() 
								{
								location.href=pagina
								} 
								setTimeout ("redireccionar()", 1000);
								  </script> <?php
			}
 endif; 

  // Liberamos los recursos de las consultas	
  mysql_free_result($resultado);
  // Se cierra la conexion
  mysql_close(); 
?>
<html>
<head><title></title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>

</body>
</html>