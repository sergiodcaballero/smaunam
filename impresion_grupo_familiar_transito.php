<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

<link href="impresion.css" rel="stylesheet" type="text/css" media="print"/>
<title>Documento sin t&iacute;tulo</title>

<script language="JavaScript">
alert("Configure su Impresora y cargue hojas en la misma y después seleccione Imprimir");

</script>
</head>

<body>
 <?php 
 
  require_once('connections/honorarios.php'); 
  date_default_timezone_set('America/Argentina/Buenos_Aires'); 
      $Fecha = date("Y-m-d");
 $hora = date("H:i:s");
  $fech = $_GET['fecha'];
 
  $dia = substr($fech, 0, 2);  // bcd
  
  $mes = substr($fech, 3, 2);
  
  $anio = substr($fech, 5);
  $f= date($anio."-".$mes."-".$dia);
 
 $fecha_desde= date("d/m/Y ",strtotime($f));
 $fecha_desde = substr($f,1);
 $fech = $_GET['fecha_limite'];
 
  $dia = substr($fech, 0, 2);  // bcd
  
  $mes = substr($fech, 3, 2);
  
  $anio = substr($fech, 5);
  $f= date($anio."-".$mes."-".$dia);
 
 $fecha_hasta= date("d/m/Y ",strtotime($f));
 $fecha_hasta = substr($f,1);
 echo "<br/>";
  
		
  $carga_afil_transito = "insert into transito set regio=22, n_afiliado=".$_SESSION['N_Afiliado'].", fecha='$Fecha', fecha_desde='$fecha_desde', fecha_hasta='$fecha_hasta', id_cosun='".$_GET['ciudad']."', hora='".$hora."' ";

   $Resultado=mysql_query($carga_afil_transito);
   $ultimo_ID = mysql_insert_id();
 ?>

  <input type="button" name="imprimir" id="imprimir" value="Imprimir" onclick="javascript:print()"/>
<input type="button" value="Volver atr&aacute;s" id="volver_atras" name="volver_atras" onclick = "location='/autogestion/principal.php'"/>
<form id="form1" name="form1" method="post" action="">
  <p>
    <input type="image" name="imageField" id="imageField" src="images/Logo.gif" />
  </p>
  <h3 align="center">AUTORIZACI&Oacute;N PARA AFILIADOS EN TRANSITO N&ordm; 22 <?php echo $ultimo_ID;?></h3>
  <p>Se&ntilde;ores Obra Social Universitaria:<br />
  <FONT SIZE=2.5>
  <?php 
 require_once('connections/honorarios.php'); 
  if (isset($_GET['ciudad'])){
	  $sql = "select * from cosun where id=".$_GET['ciudad'];
	  $res = mysql_query($sql, $honorarios) or die(mysql_error());
	   while ($lugar = mysql_fetch_array($res)){
		echo $lugar['os'];
		echo "<br/>";
		echo $lugar['domicilio'];
		echo "<br/>";
		echo $lugar['telefono'];
		echo "<br/>";
		echo $lugar['ciudad'];
		echo " - ";
		echo $lugar['provincia'];
		}
	  }?></font>
</p>
  <p>Por la presente solicitamos, en el marco del Convenio de Reciprocidad del Consejo de Obra Sociales Universitarias, las prestaciones a los afilados que a continuaci&oacute;n se detallan:</p>
  <table width="647" border="1" style="font-size:12px;">
  
    <tr>
      <td width="94"><div align="center">N&ordm; Afiliado</div></td>
      <td width="147"><div align="center">Nombre</div></td>
      <td width="55"><div align="center">Plan</div></td>
      <td width="90"><div align="center">N&ordm; Doc</div></td>
      <td width="117"><div align="center">Parentesco</div></td>
      <td width="104"><div align="center">Fecha de Nacimiento</div></td>
     
    </tr>
    <?php
	
  //Establecimiento de la conexi&oacute;n 
 
  mysql_select_db($database_honorarios, $honorarios);
  
  //Preparaci&oacute;n y ejecuci&oacute;n de la consulta
  //session_start();
  $N_Afiliado = $_SESSION['N_Afiliado'];
 // echo "El afiliado es ".$N_Afiliado;
  $Nro_Doc    =$_SESSION['Nro_Doc'];
  $n_benef = $_SESSION['n_benef'];
 // echo $_SESSION['n_benef']; 
  $consulta = "SELECT N_Afiliado, Nombre, NUM_DOC, Plan_ , Parentesco, date_format(F_NAC,'%d-%m-%Y') as fecha,n_benef FROM ppadron where afili =".$Nro_Doc;//grupo familiar
 $resultado = mysql_query($consulta, $honorarios) or die(mysql_error());
 $Cantidad_Filas = mysql_num_rows($resultado);
  //echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
  if ($Cantidad_Filas < 1):  
  	echo "<br /> No se econtr&oacute; el Afiliado<br />\n";
  else: 	 
	  //Recorrido del cursor de fila en fila
	  while ($fila = mysql_fetch_array($resultado)){
		 // print_r(date_format($fila['F_NAC'],'d/m/y'));
		// $date = date_create($fila['F_NAC']);
		// echo($date_format($date, 'Y-m-d H:i:s'));
		//$num_afiliado = 
		 //Proceso de cada una de las filas
		 echo "<tr>";       
		 echo "<td> <div align='center'>", $fila['N_Afiliado'], "</div></td>";
		 echo "<td> <div align='center'>", $fila['Nombre'], "</div></td>";
		 echo "<td><div align='center'>", $fila['Plan_'], "</div></td>";
		 echo "<td><div align='center'>", $fila['NUM_DOC'], "</div></td>";
		 echo "<td><div align='center'>", $fila['Parentesco'], "</div></td>";
		 echo "<td><div align='center'>", $fila['fecha'], "</div></td>";
		 echo "</tr>\n";  
		 $Nombre =  $fila['Nombre']; 
		 $Plan = $fila['Plan_']; 
		 $benef = $fila['n_benef'];                                              
		 }
		 $puede = '';
		 if ($n_benef === '00') {
			$puede = 'X';
			
		 } 
		 
		 
  endif;
  // Liberamos los recursos de las consultas	
  mysql_free_result($resultado);
  
  // Se cierra la conexion
  mysql_close();
  
  
?></center>
  </table>
  <p>Prestaciones autorizadas: pr&aacute;cticas en situaciones de EMERGENCIA exclusivamente a saber::</p>
  <p><strong>a- Consulta m&eacute;dica a consultorio de URGENCIA
  <br />b- Pr&aacute;cticas m&eacute;dicas ambulatorias de URGENCIA.
    <br /> c- Pr&aacute;cticas bioqu&iacute;micas de URGENCIA.
  <br />d- Internaciones cl&iacute;nicas y quir&uacute;rgicas hasta tres de internanci&oacute;n como m&aacute;ximo, previa comunicaci&oacute;n al S.M.A.U.Na.M.</strong></p>
  <p>Las prestaciones que no sean contempladas como urgencia ser&aacute;n a exclusivo cargo del afiliado sin derecho a reintegro alguno.
  <br />No se cubren accidentes de transito conforme a la legislaci&oacute;n correspondiente.
  <br />No se cubre accidentes debenidos de pr&aacute;cticas deportivas.</p>
  <p>Valido Desde: <?php echo $_GET['fecha'];?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>
  Hasta: <?php echo $_GET['fecha_limite'];?></strong></p>
  <p><strong>Nota: El servicio notificar&aacute; a la obra social receptora toda novedad en cuanto a la modificaci&oacute;n de la vigencia del presente.</strong></p>
  <table width="689" height="100" border="0">
    <tr>
      <td width="476"><p>Fecha de Emisi&oacute;n: <?php echo date("d-m-Y");?> </p>
      <p>Autogesti&oacute;n S.M.A.U.Na.M</p></td>
      <td width="197"><img src="images/Firma.jpg" width="129" height="92" /></td>
    </tr>
  </table>
</form>
</body>
</html>