<?php session_start(); 
require_once('connections/honorarios.php'); 
$pass='no';
$pass1='no';
$pass2='no';
//print_r($_POST);
if (isset($_POST['guardar_cambios']) and $_POST['guardar_cambios']=='si'){
	$_POST['guardar_cambios'] = 'no';
	if ($_POST['pass_actual']==''){
		$pass='actual';
		//$pass_actual = $_POST[['pass_actual'];
	}
	if ($_POST['pass_new']==''){
		$pass1='nueva';
		//$pass_actual = $_POST[['pass_actual'];
		if ($_POST['pass_rep']==''){
			$pass2 = 'nueva_rep2';
	}
	}else if ($_POST['pass_rep']==''){
			$pass2 = 'nueva_rep';
	}
	
	
	if (($_POST['pass_rep']!='') and ($_POST['pass_actual']!='') and ($_POST['pass_new']!='')){
		if ($_POST['pass_new']==$_POST['pass_rep']){
			$sql= "select count(*) as cant from ppadron where pass='".$_POST['pass_actual']."' and N_Afiliado=".$_SESSION['N_Afiliado']."";
			$resultado = mysql_query($sql) or die(mysql_error());
			while ($fila = mysql_fetch_array($resultado)){
				$Cantidad= $fila['cant'];				
			}
			if ($Cantidad==0){
				$_POST['pass_actual'] ='';
				$_POST['pass_rep']='';
				$_POST['pass_new']='';
				$pass = 'no_coincide';
				$pass1='no_coincide';
				$pass2='no_coincide';
			}else{
				include_once('validar_password_new.php');
//				header('Location:validar_password_new.php');
			}
		}else{
			$pass1='distinta';
			$pass2='distinta';
		}
	}
	//print_r('entriva');
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Auto Gesti&oacute;n</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link href="estilos/mis_estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootbox.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.md5.min.js"></script>
<style type="text/css">
	.form-horizontal .control-label{
		width:300px;}
	.scrollspy-example {
  
  overflow: auto;
  position: relative;
}
</style>
</head>

<body>
   <div class="container">
     <div class="contenido">        
      <div class="row-fluid">
        <div class="span12">
            <div class="encabezado">
                <div class="row-fluid">
                    <div class="span4">
                    <img src="images/Logo.gif" class="img-rounded" style="margin-left:1%" /> 
                    </div>
                    <div class="span8">
                        <div class="titulo">
                            <h3>AUTOGESTI&Oacute;N S.M.A.U.Na.M.</h3>
                        </div>
                    </div>
                </div>
                  </div>
        </div>
        <div class="span11 scrollspy-example" data-spy="scroll" data-target="#navbarExample">
        <br />
        	<table class="table table-striped table-condensed table-responsive" style="">
                   <caption > <h3>Mis Datos <br/></h3></caption>
                   <thead>
                		  <tr>
                		    <td ><center><strong>N&ordm; Afiliado</strong></center></td>
                		    <td ><center><strong>Nombre</strong></center></td>
                		    <td ><center><strong>Direcci&oacute;n</strong></center></td>
                		    <td ><center><strong>Plan</strong></center></td>
                		    <td ><center><strong>Parentesco</strong></center></td>
              		    </tr>
                   </thead>
      			   <tbody>
                   <?php
	
  //Establecimiento de la conexi&oacute;n 
  
  mysql_select_db($database_honorarios, $honorarios);
  
  //Preparaci&oacute;n y ejecuci&oacute;n de la consulta
  //session_start();
  $N_Afiliado = $_SESSION['N_Afiliado'];
  //echo "El afiliado es ".$N_Afiliado;
  $Nro_Doc    =$_SESSION['Nro_Doc'];
  
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
		 //echo "<td> <center>", $fila['n_benef'], "</center></td>";
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
                   </tbody>
                 </table>
        </div>
        <div class=" offset1 span8">
           
           
                <center> <h3>Modificar Contraseña</h3></center>
            <form name='datos'  method='post' class="form-horizontal" >
            <?php if ($pass!='no'){?> 
             <div class="control-group error">
            	 <?php }else { ?>
              <div class="control-group"><?php }?>
                <label class="control-label" for="pass_actual" >Contraseña Atual:&nbsp;</label>
                <div class="controls">
                  <input type="password" name="pass_actual" id="pass_actual" maxlength="10" value="<?php echo $_POST['pass_actual']; ?>"/>
                 <?php if ($pass=='actual'){?>   <center> <div id="appDiv1" class="control-group error" style=" margin-top:1px;margin-bottom:-3px; "><span class="help-inline">Ingrese la Contraseña Actual</span></div></center><?php }
				 else if($pass=='no_coincide'){?>
				 		 <center> <div id="appDiv1" class="control-group error" style=" margin-top:1px;margin-bottom:-3px; "><span class="help-inline">La Contraseña ingresada no es correcta</span></div></center>
				 <?php } ?>
                </div>
              </div>
               <?php if ($pass1!='no'){?> 
             <div class="control-group error">
            	 <?php }else { ?>
              <div class="control-group"><?php }?>
                <label class="control-label" for="pass_new" >Nueva Contraseña:&nbsp;</label>
                <div class="controls">
                  <input type="password" name="pass_new" id="pass_new"  maxlength="10" value="<?php echo $_POST['pass_new'];?>"/>
                  <?php if ($pass1=='nueva'){?> <center><div id="appDiv1" class="control-group error" style=" margin-top:1px;margin-bottom:-3px; "><span class="help-inline">Ingrese la Nueva Contraseña</span></div></center><?php } ?>
                </div>
              </div>
                <?php if ($pass2!='no'){?> 
             <div class="control-group error">
            	 <?php }else { ?>
              <div class="control-group"><?php }?>
                <label class="control-label" for="password" >Repetir Contraseña:&nbsp;</label>
                <div class="controls">
                  <input type="password" name="pass_rep" id="password" maxlength="10" value="<?php echo $_POST['pass_rep'];?>"/>
                   <?php if ($pass2=='nueva_rep'){?>   <center> <div id="appDiv1" class="control-group error" style=" margin-top:1px;margin-bottom:-3px;"><span class="help-inline">Repita la nueva Contraseña</span></div></center><?php }
				   else if ($pass2=='nueva_rep2'){?>   <center> <div id="appDiv1" class="control-group error" style=" margin-top:1px;margin-bottom:-3px;"><span class="help-inline">Ingrese la Nueva Contraseña y repita la misma</span></div></center><?php }else if ($pass1=='distinta'){?>
                  	<center> <div id="appDiv1" class="control-group error" style=" margin-top:1px;margin-bottom:-3px; "><span class="help-inline">Las contraseñas no coinciden</span></div></center>
                  <?php } ?>
                </div>
              </div>
              <div class="control-group">
              <a class="btn" href="#" style="margin-left:2%;"><i class="icon-arrow-left"></i>&nbsp;Volver</a>                   
              <button type="submit" name="contraseña" class="btn btn-success pull-right" style="margin-right:15%;"> <i class=" icon-pencil icon-white"></i>&nbsp;Cambiar Contraseña</button> <input type='hidden' name='guardar_cambios' value="si"/>               </div>
            </form>
            </div>
            <div class="span10">
            
            <div class="alert alert-info" style="margin-right:15%;margin-top:2%; margin-left:5%;padding-top:1%">
                <strong>*Señor Afiliado:</strong><br/>
                - El total de su </strong>Grupo Familiar</strong> deberá ingresar con la misma Contraseña<br/>
               
            </div>
            
        </div>
        <div class="span12">
                        
        </div>
      </div>
    </div>
    </div>
   
</body>
</html>