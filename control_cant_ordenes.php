<?php
ob_start();
session_start() ?> 
<?php


//Establecimiento de la conexi&oacute;n 
require_once('connections/honorarios.php'); 
mysql_select_db($database_honorarios, $honorarios);
  
//Preparaci&oacute;n y ejecuci&oacute;n de la consulta
$N_Afiliado = $_POST['N_Afiliado'];
$Afiliado_Solo = substr($N_Afiliado, 0, -2); //Saco el Nº de Afilaido del Titular
$Nro_Doc    = $_POST['Nro_Doc'];
$Nombre     = $_POST['Nombre']; 
// Controlo que No haya sacado más de 2 ordenes en el mes.- 
$Fecha = date("Y-m-d");

/// funcion sumar dias 
//sumar dias 
$dia = 1;
$mes = date("m");
$ano = date("Y");
$fecha1= mktime(0, 0, 0, $mes, $dia, $ano);
$fecha_desde = date("Y-m-d", $fecha1);
$consulta_fecha = "SELECT numero FROM ordenes_medicas WHERE Documento = ".$N_Afiliado." and  Fecha_emision BETWEEN  '".$fecha_desde."' and '".$Fecha."'  and  Forma_Pago <> 'ANUL'";
$resultado1 = mysql_query($consulta_fecha) or die(mysql_error());
$Cantidad_Filas = mysql_num_rows($resultado1);
echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
if ($Cantidad_Filas >= 3): 
	
	?>
			<script language="JavaScript">
			alert("Ud. ha retirado su límite máximo de ordenes por la Web para el mes");
			</script>
			 <script language="JavaScript" type="text/javascript">
				var pagina="/autogestion/principal.php"
				function redireccionar() 
				{
				location.href=pagina
				}
				setTimeout ("redireccionar()", 1000); 
				</script> <?php
	
else:
	// verifico la cantidad en el año. Si es  > 3 se le cobra coseguro
	/// funcion sumar dias 
	//sumar dias
	$dia = 1;
	$mes = 1;
	$ano = date("Y");
	$fecha1= mktime(0, 0, 0, $mes, $dia, $ano);
	$fecha_desde = date("Y-m-d", $fecha1); 
	$consulta_fecha = "SELECT numero FROM ordenes_medicas WHERE Documento = ".$N_Afiliado." and  Fecha_emision BETWEEN  '".	$fecha_desde."' and '".$Fecha."' and  Forma_Pago <> 'ANUL' ";
	 $resultado2 = mysql_query($consulta_fecha) or die(mysql_error());
	 $Cantidad_Filas2 = mysql_num_rows($resultado2);
	 echo "<br /> En el año extrajo $Cantidad_Filas , para este afiliado <br />\n";
	 
	if ($Cantidad_Filas2 > 2): 
		$especiales  = 'NO';
	else:
		$especiales  = 'SI';	 
	endif; 	
	// llamar a sacar_orden
	$_SESSION['N_Afiliado'] = $N_Afiliado;
	$_SESSION['Nro_Doc'] = $Nro_Doc;
	$_SESSION['n_benef'] = $n_benef; // paso el beneficiario para activar el botón contraseña
	$_SESSION['Nombre'] = $Nombre;
	$_SESSION['especial'] = $especiales; 
	header('Location:sacar_orden.php');
endif;
//mysql_free_result($resultado1); 
//mysql_free_result($resultado2); 	
