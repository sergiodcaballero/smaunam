<?php 
	ob_start();
	session_start();  
	
	//Establecimiento de la conexi&oacute;n 
	require_once('connections/honorarios.php'); 
	mysql_select_db($database_honorarios, $honorarios);
	  
	//Preparaci&oacute;n y ejecuci&oacute;n de la consulta
	$N_Afiliado = $_SESSION['N_Afiliado'];
	$Afiliado_Solo = substr($N_Afiliado, 0, -2); //Saco el Nº de Afilaido del Titular
	$Nro_Doc    = $_SESSION['Nro_Doc'];
	$Nombre     = $_SESSION['Nombre']; 
	// Controlo que No haya sacado más de 2 ordenes en el mes.- 
	
	$sql = "SELECT * FROM farmacia WHERE MONTH(now())=MONTH(fecha_emis) and n_orden='' and N_AFILIADO='".$N_Afiliado."'";
	$resultado = mysql_query($sql) or die(mysql_error());
	$Cantidad_Filas = mysql_num_rows($resultado);
	if ($Cantidad_Filas >= 2){
		$puede = 'no'; ?>
		<script language="JavaScript">
			alert("Ud. ha retirado su límite máximo de recetarios para el mes");
			var pagina="/autogestion/principal.php";
			location.href=pagina
		</script> 
		<?php
	}else{
		$Fecha = date("Y-m-d");
		$Hora = date("H:i:s", time());
		$dia = date("d");
		$dia = $dia + 90;
		$mes = date("m");
		$ano = date("Y");
		$suma = mktime(0, 0, 0, $mes, $dia, $ano);
		$suma_fecha = date("Y-m-d", $suma);
		
			 $consulta_plan = "SELECT  Plan_ , Parentesco, n_benef,nombre  FROM ppadron where N_afiliado =".$N_Afiliado." and  Num_Doc =".$Nro_Doc;
	 $resultado = mysql_query($consulta_plan) or die(mysql_error());
	 $Cantidad_Filas = mysql_num_rows($resultado);
	  //echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
	  if ($Cantidad_Filas < 1):  
		echo "<br /> No se econtr&oacute; el Afiliado<br />\n";
	  else: 
	  	   //Recorrido del cursor de fila en fila
			  while ($fila = mysql_fetch_array($resultado)){
				 //Proceso de cada una de las filas
				 $Plan = $fila['Plan_'];
				 $benef = $fila['n_benef'];   
				 $Nombre = $fila['nombre'];									
				 }	
		  	endif; 
		
		 $Carga_Recetario = "insert into farmacia set  regio = 22, n_orden = '', N_AFILIADO = '".$N_Afiliado."', afiliado = '".$Afiliado_Solo."',n_benef='".$benef."', plan = '".$Plan."', fecha_emis = '".$Fecha."', fecha_val ='".$suma_fecha."', hora_emis = '".$Hora."', operador_emis = 'AutoGestion', APELLIDO_Y_NOMBRE='$Nombre'"; 
		  $Resultado_Farmacia=mysql_query($Carga_Recetario);
		   $Ultimo_numero  =  mysql_insert_id();
		 //  print_r($Ultimo_numero);
		  mysql_close();
		 // $_POST['id_orden'] = $Ultimo_numero;
 $_SESSION['mi_id_orden'] = $Ultimo_numero;
// print_r($_SESSION['mi_id_orden']);
		?>
		<script language="JavaScript">
			//alert("Ud. ha retirado su límite máximo de recetarios para el mes");
			var pagina="/autogestion/impresion_recetario.php";
			location.href=pagina
		</script> 
		<?php
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="impresion.css" rel="stylesheet" type="text/css" media="print"/>
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
</body>
</html>