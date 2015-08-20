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
		 $especiales = $_SESSION['especial'];
		$Fecha = date("Y-m-d");
		$Hora = date("H:i:s", time());
		//$Hora = date("H:i:s");
		/// funcion sumar dias 
		//sumar dias 
		$dia = date("d");
		$dia = $dia + 90;
		$mes = date("m");
		$ano = date("Y");
		$suma = mktime(0, 0, 0, $mes, $dia, $ano);
		$suma_fecha = date("Y-m-d", $suma);
		$Fecha_imp = date("d-m-Y");
		$Fecha_Hasta = date("d-m-Y", $suma);
		$Consulta_Nomenclador = "select * from nomenclador where codigo = 420101";
		$Resultado_Nomenclador =  mysql_query($Consulta_Nomenclador);
		while ($fila = mysql_fetch_array($Resultado_Nomenclador)){
				 $Codigo = $fila['Codigo']; 
				 $Descripcion = $fila['Descripcion']; 
				 $Monto = $fila['Monto']; 
				 $Coseguro = $fila['Coseguro'];                                                
		}
		// Libero REsultado_Nomenclador	  
		mysql_free_result($Resultado_Nomenclador);
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
			
		   // Liberamos los recursos de las consultas	
		   mysql_free_result($resultado); 
		   if ($especiales == 'SI'): 
				$Coseguro = 0;				
				$Fecha_Hasta = '31-12-'.$ano; 
				$suma = mktime(0, 0, 0, 12, 31, $ano);
				$suma_fecha = date("Y-m-d", $suma);
				//echo "entro"; 
			endif; 
			$Carga_Cabecera ="insert into ordenes_medicas set  regio = 22, Matricula = 11111, MatriRP = 11111, MONTO = '".$Monto."', Documento = '".$N_Afiliado."', Afiliado = '".$Nombre ."', Coseguro = '".$Coseguro."', Fecha_emision = '".$Fecha."', docu_de = '".$Nro_Doc."' , forma_depago = 0 , Operador = 'AutoGestion', nro_practicas = 1, codigo = '".$Codigo."' , hora = '".$Hora."', plan = '".$Plan."', guardo4 = 00000, `Forma_Pago` = 'CCTE', `CUOTAS` = 1, `regional` = 'Posadas'"; 		
		  //Libero Recursos del inser 
		  $Resultado=mysql_query($Carga_Cabecera);
		 //$Resultado=mysql_query($Carga_Cabecera,$link);
		  $Ultimo_numero  =  mysql_insert_id();
		   /// Cargo Detalle 
		  $Carga_Detalle = "insert into detalle_orden_medica set orden_nro = '".$Ultimo_numero."', regio = 22, afiliado = '".$N_Afiliado."', codigo = '".$Codigo."', cant = 1, fecha = '".$Fecha."', monto = '".$Monto."' , coseguro = '".$Coseguro."'";   
		  $Resultado_Detalle=mysql_query($Carga_Detalle);
		   $_SESSION['mi_id_orden'] = $Ultimo_numero;
		  /// Cargo Recetario de Farmacia 
		  $Carga_Recetario = "insert into farmacia set  regio = 22, n_orden = '".$Ultimo_numero."', N_AFILIADO = '".$N_Afiliado."', afiliado = '".$Afiliado_Solo."',n_benef='".$benef."', plan = '".$Plan."', fecha_emis = '".$Fecha."', fecha_val ='".$suma_fecha."', hora_emis = '".$Hora."', operador_emis = 'AutoGestion', APELLIDO_Y_NOMBRE='$Nombre'"; 
		  $Resultado_Farmacia=mysql_query($Carga_Recetario);
		  $Ultimo_numero  =  mysql_insert_id();
		  mysql_close();
		 // $_POST['id_orden'] = $Ultimo_numero;
$_SESSION['mi_recetario'] = $Ultimo_numero;
 header('Location:impresion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="impresion.css" rel="stylesheet" type="text/css" media="print"/>
<title>Documento sin t&iacute;tulo</title>

</head>

<body>
<input type="button" value="Imprimir Orden " name="imprimir" id="imprimir" onclick="javascript:print()"  style = "width: 100 px; height: 50px  "/>
<?php 
		
		
		  
$_POST['id_orden'] = $Ultimo_numero;
 //$_SESSION['id_orden'] = $_SESSION['N_Afiliado']."__".$Ultimo_numero;
		 
//include_once('ordenes.php');
include_once('ordenes.php');
?>
<br/>
<div class="lineas"></div><br />
<?php //<div class='saltopagina'></div>
//include_once('recetario.php');
$_POST['id_orden'] = $Ultimo_numero;
include_once('recetario.php');
?>
</body>
</html>