<?php 
ob_start();
session_start() ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Impresión de Ordenes  AUTO GESTION SMAUNaM</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="mm_restaurant1.css" type="text/css" />
<link href="impresion.css" rel="stylesheet" type="text/css" media="print"/>
<style type="text/css">
<!--
.Estilo1 {font-size: 14px}
.Estilo2 {
	font-size: 10px
}
.Estilo3 {font-size: 12px}
-->
@media print {
    button {
        display: none;
    }
}
@media all {
   div.saltopagina{
      display: none;
   }
}
   
@media print{
   div.saltopagina{ 
      display:block; 
      page-break-before:always;
   }
}
</style>
</head>

<body>
<p>
<?php
	   
		 //Establecimiento de la conexi&oacute;n 
   		require_once('connections/honorarios.php'); 
   		//Preparaci&oacute;n y ejecuci&oacute;n de la consulta
		
	  $N_Afiliado = $_SESSION['N_Afiliado']; 
	  $Afiliado_Solo = substr($N_Afiliado, 0, -2); //Saco el Nº de Afilaido del Titular
	  $Nro_Doc    = $_SESSION['Nro_Doc'];
	 // $Nombre     = $_SESSION['Nombre']; 
	  $especiales = $_SESSION['especial'];
	  // Buscamos Plan 
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
		  //echo $especiales; 	  
		  ////
		  $consulta = "SELECT * FROM ordenes_medicas  where Documento =".$N_Afiliado;
		  $resultado = mysql_query($consulta);
		  $Cantidad_Filas = mysql_num_rows($resultado); 
		 //echo "El último Número cargado es el -->".$MiNumero;
		 //saco el proximo numero 
		  while ($fila = mysql_fetch_array($resultado)){
					 $MiNumero = $fila['NUMERO'];                                                
				 } 
			// contrla la cantidad de ordenes del afiliado 	    	
		  if ($Cantidad_Filas < 1):  
			//echo "<br /> No se saco nunca ordenes<br />\n";
			
		  else: 	 
				 
		   endif;
		  // Liberamos los recursos de las consultas
			  mysql_free_result($resultado);
		  // Buscamos el código en el Comneclador 
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
			// // Cargo las bases. 
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
					  
			// pregunto si es especial Coseguro 0.
			if ($especiales == 'SI'): 
				$Coseguro = 0;				
				$Fecha_Hasta = '31-12-'.$ano; 
				
				//echo "entro"; 
			endif; 
			//echo $Coseguro;
			// 
				 
		 
			  
	//	  $Hora = strftime("%I:%M:%S", time());
		 $Carga_Cabecera ="insert into ordenes_medicas set  regio = 22, Matricula = 11111, MatriRP = 11111, MONTO = '".$Monto."', Documento = '".$N_Afiliado."', Afiliado = '".$Nombre ."', Coseguro = '".$Coseguro."', Fecha_emision = '".$Fecha."', docu_de = '".$Nro_Doc."' , forma_depago = 0 , Operador = 'AutoGestion', nro_practicas = 1, codigo = '".$Codigo."' , hora = '".$Hora."', plan = '".$Plan."', guardo4 = 00000, `Forma_Pago` = 'CCTE', `CUOTAS` = 1, `regional` = 'Posadas'"; 		
		  //Libero Recursos del inser 
		  $Resultado=mysql_query($Carga_Cabecera);
		 //$Resultado=mysql_query($Carga_Cabecera,$link);
		  $Ultimo_numero  =  mysql_insert_id();
		 // echo($Ultimo_numero);
		 // printf ("Nuevo registro con el id %d.\n".$nro_orden );
		//   echo $nro_orden; 
		   //saco el proximo numero 


		 // $consulta_orden = "SELECT * FROM ordenes_medicas";
		 // $resultado_orden = mysql_query($consulta_orden);
		  //$Cantidad_Filas_orden = mysql_num_rows($resultado_orden);
		  //while ($fila = mysql_fetch_array($resultado_orden)){
			//		 $Ultimo_numero = $fila['NUMERO']; 

					                                            

				// } 

				

		// $Ultimo_numero =  $Cantidad_Filas_orden;		
		//  mysql_free_result($resultado_orden); 	  
			
		  // Se cierra la conexion
		  /// Cargo Detalle 
		  $Carga_Detalle = "insert into detalle_orden_medica set orden_nro = '".$Ultimo_numero."', regio = 22, afiliado = '".$N_Afiliado."', codigo = '".$Codigo."', cant = 1, fecha = '".$Fecha."', monto = '".$Monto."' , coseguro = '".$Coseguro."'";   
		  $Resultado_Detalle=mysql_query($Carga_Detalle);
		  
		  /// Cargo Recetario de Farmacia 
		  $Carga_Recetario = "insert into farmacia set n_receta = '".$Ultimo_numero."', regio = 22, n_orden = '".$Ultimo_numero."', N_AFILIADO = '".$N_Afiliado."', afiliado = '".$Afiliado_Solo."', plan = '".$Plan."', fecha_emis = '".$Fecha."', fecha_val ='".$suma_fecha."', hora_emis = '".$Hora."', operador_emis = 'AutoGestion', APELLIDO_Y_NOMBRE='$Nombre'"; 
		  $Resultado_Farmacia=mysql_query($Carga_Recetario);
		  
		  mysql_close();
		  
	   ?><script language="JavaScript">
		alert("Cargue 2 Hojas A4 en su impresora y presione el botón Imprimir, EL sistema cerrará la ventana de impresión automáticamente luego de 30 segundos.");
		</script>&nbsp;
        
          <input type="button" value="Imprimir Orden " name="imprimir" id="imprimir" onclick="javascript:print()"  style = "width: 100 px; height: 50px  "/> 
  <script language="JavaScript" type="text/javascript">
		var pagina="/autogestion/index.php"
		function redireccionar() 
		{
		location.href=pagina
		} 
		setTimeout ("redireccionar()", 30000);
		  </script></p>
<table width="819" border="1">
  <tr>
      <td width="349"><span class="logo"><img src="Logo.gif" alt="1" width="328" height="78" align="left" /></span></td>
      <td width="454"><p align="center"><strong>Expendio de Ordenes WEB</strong></p>
      <p align="center" class="pageName"><strong>AUTO GESTI&Oacute;N S.M.A.U.Na.M</strong></p></td>
  </tr>
</table>
  <div align="left">
    <table width="663" border="0">
             
             <tr>
               <td><span class="bodyText Estilo2">Sede Central: Tucum&aacute;n 2452 - Posadas Tel-Fax 0376-4438504 - Eldorado: Tel: 03751-430621 - Ober&aacute;: Tel: 03755-420423</span></td>
               <td class="subHeader">&nbsp; </td>
             </tr>
             <tr>
               <td width="592"><p class="bodyText Estilo2">IVA Exento - CUIT: 30-65776243-8 - Fecha Inic. Actv.: 01/11/89 </p>             </td>
               <td width="61" class="subHeader"><div align="right"></div></td>
             </tr>
    </table>
           <table width="662" border="0">
             <tr>
               <td width="445" class="subHeader Estilo3">&nbsp;</td>
               <td width="207" class="subHeader Estilo3"><span class="subHeader">Fecha: </span><?php echo "$Fecha_imp" ?></td>
             </tr>
             <tr>
               <td class="subHeader Estilo3">&nbsp;</td>
               <td class="subHeader Estilo3">Valido Hasta: <?php echo "$Fecha_Hasta" ?></td>
             </tr>
           </table>
           <table width="665" border="1">
             <tr>
               <td width="254"><span class="subHeader">Orden de Práctica Nº: 022 - <?php echo "$Ultimo_numero" ?> </span></td>
               <td width="278"><span class="subHeader">F. de Prestaci&oacute;n: __/__/____</span></td>
               <td width="142" class="subHeader">Regional : Auto Gesti&oacute;n </td>
             </tr>
             <tr>
               <td><span class="subHeader">Afiliado Nro: <?php echo "$N_Afiliado" ?></span></td>
               <td bordercolor="1"><span class="subHeader">Nombre: <?php echo $Nombre; ?> </span></td>
               <td class="subHeader">Plan: <?php echo "$Plan"?></td>
             </tr>
             <tr>
               <td class="subHeader">R/P: </td>
               <td class="subHeader">N&ordm; de Orden de internaci&oacute;n: </td>
               <td>&nbsp;</td>
             </tr>
    </table>
           <p>&nbsp;</p>
  </div>
           
  <div align="left">
    <table width="666" border="1">
             <tr>
               <td width="131"><div align="center" class="subHeader">C&oacute;digo </div></td>
               <td width="303" class="subHeader"><div align="center">Descripci&oacute;n </div></td>
               <td width="210" class="subHeader"><div align="center">Coseguro a cargo del Afliado </div></td>
             </tr>
             <tr>
               <td><div align="center">42.01.01</div></td>
               <td><div align="left"><?php echo "$Descripcion" ?> </div></td>
               <td> <div align="center"> <?php echo "$Coseguro" ?>  </div></td>
             </tr>
    </table>
    <table width="666" border="0">
             <tr>
               <td width="340">Diagn&oacute;stico: </td>
               <td width="316"><strong>Coseguro a Cargo del Afiliado $</strong> <?php echo "$Coseguro" ?></td>
             </tr>
    </table>
    <table width="47" border="0" align="left">
      <tr>
        <td width="37" align="center"><?php
	include('../autogestion/qrcode/qrlib.php');
	 // text output   
	$codeContents = $Ultimo_numero.' 22'; 
	 // generating 
	$text = QRcode::text($codeContents); 
	$raw = join("<br/>", $text); 
	$raw = strtr($raw, array( 
		'0' => '<span style="color:white">&#9608;&#9608;</span>', 
		'1' => '&#9608;&#9608;' 
	)); 
	
	// displaying 
	echo '<tt style="font-size:4px">'.$raw.'</tt>'; 

    ?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div align="center">
             <table width="437" border="0">
               <tr>
                 <td width="205">----------------------------------------------</td>
                 <td width="13">&nbsp;</td>
                 <td width="197"><div align="center">----------------------------------------------</div></td>
               </tr>
               <tr>
                 <td><div align="center">Firma de Afiliado </div></td>
                 <td>&nbsp;</td>
                 <td><div align="center">Firma y sello del Prestador elegido por el Afiliado </div></td>
               </tr>
      </table>
    </div>
   
  </div>
 
 <div class='saltopagina'></div>

<p align="center" class="subHeader">&nbsp;</p>
<table width="819" border="1">
  <tr>
           <td width="346"><span class="logo"><img src="Logo.gif" alt="logo" width="328" height="78" align="left" /></span></td>
           <td width="728"><p align="center" class="pageName"><strong>Recetario de Farmacia</strong></p>
           <p align="center" class="pageName">AUTO GESTI&Oacute;N S.M.A.U.Na.M</p></td>
         </tr>
       </table>
<div align="left">
  <table width="662" border="0">
    <tr>
      <td><span class="bodyText Estilo2">Sede Central: Jujuy N&ordm; 1745 Posadas Tel-Fax 03752-438504 - Eldorado: Tel: 03751-430621 - Ober&aacute;: Tel: 03755-420423</span></td>
      <td class="subHeader">&nbsp;</td>
    </tr>
    <tr>
      <td width="579"><p class="bodyText Estilo2">IVA Exento - CUIT: 30-65776243-8 - Fecha Inic. Actv.: 01/11/89 </p></td>
      <td width="73" class="subHeader"><div align="right" class="subHeader">
          <div align="left"></div>
      </div></td>
    </tr>
    </table>
</div>
         <div align="left">
           <table width="707" border="0">
           <tr>
             <td width="369" class="subHeader Estilo3">&nbsp;</td>
             <td width="328" class="subHeader Estilo3"><span class="subHeader">Recetario N&ordm;22 - </span><?php echo "$Ultimo_numero" ?></td>
           </tr>
           <tr>
             <td class="subHeader Estilo3">&nbsp;</td>
             <td class="subHeader Estilo3"><p><span class="subHeader">Valido Hasta: </span><?php echo "$Fecha_Hasta" ?> </p>
             <p> 50% Descuento Plan: <?php echo "$Plan"?> - SIN VADEMECUM</p></td>
           </tr>
                  </table>
         </div>
       <table width="789" border="1">
         <tr>
           <td colspan="3"><span class="Estilo2">Fecha Prescripci&oacute;n </span></td>
           <td width="192">N&uacute;mero de Beneficiario </td>
           <td width="39">Categ</td>
           <td width="102">Edad</td>
           <td width="330" rowspan="12"><img src="images/recet2.gif" width="330" height="374" /></td>
         </tr>
         <tr>
           <td width="26">&nbsp;</td>
           <td width="27">&nbsp;</td>
           <td width="27">&nbsp;</td>
           <td align="center"><?php echo "$N_Afiliado" ?></td>
           <td align="center"><?php echo "$benef" ?></td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td colspan="4" rowspan="2"><span class="Estilo2">Apellido y Nombre/s: <?php echo "$Nombre" ?></span>  </td>
           <td><span class="Estilo2">M</span>             <div align="center" class="Estilo2"></div></td>
           <td><span class="Estilo2">F</span></td>
         </tr>
         
         <tr>
           <td><span class="Estilo2">N&ordm; </span></td>
           <td><span class="Estilo2">Letras</span></td>
         </tr>
         <tr>
           <td height="29" colspan="4"><p class="Estilo2">Generico</p></td>
           <td rowspan="2">&nbsp;</td>
           <td rowspan="2">&nbsp;</td>
         </tr>
         <tr>
           <td height="23" colspan="4"><p class="Estilo2">R/P</p></td>
         </tr>
         <tr>
           <td height="25" colspan="4"><p class="Estilo2">Gen&eacute;rico</p></td>
           <td rowspan="2">&nbsp;</td>
           <td rowspan="2">&nbsp;</td>
         </tr>
         <tr>
           <td height="25" colspan="4"><p>R/P</p></td>
         </tr>
         <tr>
           <td colspan="2">C&oacute;digo</td>
           <td colspan="4">Diagn&oacute;stico Principal: </td>
         </tr>
         <tr>
           <td colspan="2">C&oacute;digo</td>
           <td colspan="4">Diagn&oacute;stico Secundario: </td>
         </tr>
         <tr>
           <td height="59" colspan="3" rowspan="2"><p>Emitido: </p>
           <p><span class="subHeader Estilo3"><?php echo "$Fecha_imp" ?></span></p></td>
           <td height="59" colspan="3">Matricula: </td>
         </tr>
         <tr>
           <td height="55" colspan="3"><p>Firma y Sello del Profesional:</p></td>
         </tr>
       </table>
       <table width="422" height="79" border="1">
         <tr>
           <td width="106"><div align="center">TROQUEL 1 </div></td>
           <td width="99"><div align="center">TROQUEL2 </div></td>
           <td width="103"><div align="center">TROQUEL3</div></td>
           <td width="86"><div align="center">TROQUEL 4  </div></td>
         </tr>
</table>
       <table width="61" border="0">
         <tr>
           <td width="20" align="center"><?php
	
		// displaying 
	echo '<tt style="font-size:4px">'.$raw.'</tt>'; 

    ?></td>
         </tr>
       </table>
</body>
</html>
