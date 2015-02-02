<?php ob_start();
session_start();
		//header('Location:consultar_autorizacion_afiliado.php');
 //$verifica = $_SESSION["verifica"]; 
 if (isset($_SESSION["verifica"])){ ?>
<script type='text/javascript' >
location.href= 'consultar_autorizacion_afiliado.php';
</script><?php
 
 	unset($_SESSION["verifica"]);

 }else{}
 ?> 
<!--Cap11/cursor.php-->
<html>
<head><title>Auto Gesti&oacute;n </title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
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
-->
</style>
<link type="text/css" rel="stylesheet" href="calendario/estilos.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="calendario/opciones_js.js?random=20060118"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" >

	function verificar_fecha(valor){
		if (valor.value!=''){
			if (validar(valor.value,valor)==true){
				var sumarDias=parseInt(30);
				//var fecha=calcular_fecha(valor.value,sumarDias);
				//document.forms[0].fecha_limite.value = fecha;
				var fecha = nuevaFecha(valor.value, '+30');
				document.forms[0].fecha_limite.value = fecha;
			}
		}
	}
	function validar_datos(form){
		if (form.fecha.value==''){
			alert('Ingrese la fecha');
		}else if(form.provincia.value==0){
			alert('Seleccione la Provincia');
		}else if(form.localidad.value==0){
			alert('Seleccione la ciudad');
		}else{
			if (confirm("¿Esta seguro de imprimir la autorización? "))
			{
			 form.submit();
			}
			
		}
	}
	function omitirAcentos(text) {
    var acentos = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç";
    var original = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc";
    for (var i=0; i<acentos.length; i++) {
        text = text.replace(acentos.charAt(i), original.charAt(i));
    }
    return text;
}
	$(document).ready(function(){
			$("#provincia").change(function() {
				var provincia = $(this).val();
				provincia = omitirAcentos(provincia);
				if (provincia!=0){
					$.post("cosun.php",{idProvincia: provincia}, function(datos) {
						$("#localidad").html(datos);					 
					});
					
				}else{
					var ciudad = $("#localidad").val();
					if (ciudad != 0){
						$("#localidad").val(0);
						$.post("cosun.php",function(datos) {
			        	$("#localidad").html(datos);
					 
					});
					}
					alert('Seleccione la Provincia');
				}						
			});
		});	
</script>
</head>
<body>
 
<table width="1100" height="369" border="1">
  <tr>
    <th width="1161" colspan="4" bgcolor="#99ccff"><div align="left"><font color='blue'><span class="logo"><img src="Image3.gif" alt="Logo" width="351" height="90" border="1" />AUTO GESTI&Oacute;N S.M.A.U.Na.M<br />
    </span></font></div></th>
  </tr>
  <tr>
    <td height="176" colspan="4"><div align="center">
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
            <th>Benef</th>
			 <?php
	
  //Establecimiento de la conexi&oacute;n 
  require_once('connections/honorarios.php'); 
  mysql_select_db($database_honorarios, $honorarios);
  
  //Preparaci&oacute;n y ejecuci&oacute;n de la consulta
  //session_start();
  $N_Afiliado = $_SESSION['N_Afiliado'];
 // echo "El afiliado es ".$N_Afiliado;
  $Nro_Doc    =$_SESSION['Nro_Doc'];
  $n_benef = $_SESSION['n_benef'];
 // echo $_SESSION['n_benef']; 
  $consulta = "SELECT N_Afiliado, Nombre, Domicilio, Plan_ , Parentesco, n_benef FROM ppadron where N_afiliado =".$N_Afiliado." and  Num_Doc =".$Nro_Doc;//beneficiario
 $resultado = mysql_query($consulta, $honorarios) or die(mysql_error());
 $Cantidad_Filas = mysql_num_rows($resultado);
  //echo "<br /> Cantidad de Filas Encontradas :$Cantidad_Filas <br />\n";
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
		 echo "<td>", $fila['n_benef'], "</td>";
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
  
  
?>
          </tr>
        </table>
      <form name="form1" id= "form1" method="get" action="impresion_afiliado_titular_transito.php">
        <p>&nbsp;</p>
        <h2>Autorizaci&oacute;n para Afiliados en transito</h2>
        <table width="588" border="0">
          <tr>
            <td width="148" height="30">Seleccione Provincia a viajar</td>
            <td width="408"><?php 
				
				   require_once('connections/honorarios.php');  
				  mysql_select_db($database_honorarios, $honorarios); 
				  $sql = "select DISTINCT provincia from cosun where provincia<>'' ORDER BY provincia";
				 $resultado = mysql_query($sql, $honorarios)or die(mysql_error());
				 // print_r($resultado);
				 ?>
              <select name="provincia" id="provincia">
                <option value="0">Seleccione</option>
                <?php
				  while ($row=mysql_fetch_array($resultado)){
					  $provincia=$row['provincia'];
					  $provincia=str_replace(" ", "_", $provincia);
				  ?>
                <option value=<?php echo $provincia;?>><?php echo $row['provincia'];?></option>
                <?php  }?>
              </select></td>
          </tr>
          <tr>
            <td height="29">Ciudad </td>
            <td><select id="localidad" name="ciudad">
              <option value="0">Seleccione la Provincia</option>
            </select></td>
          </tr>
          <tr>
            <td height="30">Fecha Inicio del Viaje</td>
            <td><input name="fecha_limite" type="hidden" id="fecha_limite" maxlength="10" readonly />
              <input  type="text" readonly name="fecha" onChange=							"verificar_fecha(document.forms[0].fecha)"/>
              <button  type= 'button' onClick=			   "displayCalendar(document.forms[0].fecha,'dd/mm/yyyy',this)"> <img src="calendario/imagenes/evento.png" width="16" height="16" /></button></td>
          </tr>
          </table>
        <p>
          <input type="button" name="confirmar_autorizacion" id="confirmar_autorizacion" value="Aceptar" onClick="validar_datos(document.forms[0]);">
          &nbsp;
          &nbsp;
          <input type="button" value="Volver atr&aacute;s" name="volver atr&aacute;s222" onClick="history.back()" />
    </p>
        <p>&nbsp;</p>
       
      </form>
    </div></td>
  </tr>
   
  <tr>
    <td height="46" colspan="4" bgcolor="#0000FF">
      <form action="" method="post" name="form4" class="Blanco">
        Ante 
      cualquier duda o consulta sobre el funcionamiento del sistema por favor enviar un email a 
      <span class="blancoresaltado">autogestion@smaunam.com.ar </span>
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
