<?php
	session_start();
	if (isset($_SESSION['n_benef'])){
		header('Location:principal.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Auto Gesti&oacute;n  - P&aacute;gina principal</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link href="estilos/mis_estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap/js/bootbox.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.md5.min.js"></script>
<script type="text/JavaScript">

$(document).ready(function(e){

	$(".anular").click(function(evento){
		
		});
		
		$(".confirmar").click(function(evento){
			var mail = $(".mail").val();
			if (mail==''){
				alert("Ingrese su Correo!");
			}else{
				var verificar_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
				if (verificar_email.test(mail)==false) {
						alert('El correo ingresado no es válido');
				}else{	
				
				var box=bootbox.dialog({
						message: '</br> Enviando mail..</br></br>'+
						'<div class="progress progress-striped active">'+ 
									'<div class="bar" style="width: 100%;"> ' +
									'</div></br>',
						closeButton: false,	
           });box.modal('show');
				$.ajax({
    url: 'recuperar_clave.php',
    data: {
        mail: mail
    },
    type: 'POST',
    dataType: 'json',
    success: function(datos){
		$('#myModal').modal('hide')
		box.modal('hide');
		if (datos.respuesta=='NO'){
			alert('El correo ingresado no existe');
		}else if(datos.respuesta=='SI'){
			
		 	alert('El correo ha sido enviado exitosamente!');
		}else{
			//$('#myModal').modal('hide')
			alert('No se ha podido enviar el correo. Intente más tarde');
		}
     	//alert(JSON.stringify(datos, null, 4));
       
    }
});
					
				}
			}
		});
	});
	
	
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<style type="text/css">
	.form-horizontal .control-label{
		width:300px;}
	
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
    <div class="span12">
    	<div class="contenido_base">
       	<form name='datos' action='verificadatos.php' method='post' class="form-horizontal" >
       	  <div class="control-group">
       	    <label class="control-label" for="N_Afiliado" >Ingrese el Nro. de Afiliado (sin barra /)&nbsp;</label>
            <div class="controls">
           	  <input type="text" name="N_Afiliado" id="N_Afiliado" maxlength="10"/>
            </div>
          </div>
          <div class="control-group">
       	    <label class="control-label" for="Nro_Doc" >Ingrese el Nro. de Documento:&nbsp;</label>
            <div class="controls">
           	  <input type="text" name="Nro_Doc" id="Nro_Doc" maxlength="8"/>
            </div>
          </div>
          <div class="control-group">
       	    <label class="control-label" for="password" >Ingrese la Contraseña:&nbsp;</label>
            <div class="controls">
           	  <input type="password" name="password" id="password" maxlength="10"/>
            </div>
          </div>
          <div class="control-group">
          <center>
          	<button type="submit" class="btn btn-success" onclick="MM_validateForm('N_Afiliado','','RisNum','Nro_Doc','','RisNum');return document.MM_returnValue">Ingresar</button>
            <a class="btn" href="http://www.smaunam.com.ar" style="margin-left:2%;">Volver</a> 
            <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal"  style="margin-left:2%;">Recuperar Contraseña</a> 
          </center>
          </div>
        </form>
        <div class="alert alert-info" style="margin-right:20%;margin-top:2%; margin-left:-10%;padding-top:1%">
        	<strong>*Señor Afiliado:</strong><br/>
            - Para poder ingresar al sistema de auto Gestión deberá enviar una solicitud <strong>Alta Usuario.</strong><br/>
            - Para descargar el manual de Ayuda, seleccione 
            <a target="_blank" href="http://www.smaunam.com.ar/wp-content/uploads/2015/04/man_sis_auto.pdf" class="btn ">Descargar</a>
           
        </div>
        </div>
    </div>
    <div class="span12">
                	
    </div>
  </div>
</div>
</div>
<div id="myModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:40%;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Recuperar Contraseña</h3>
  </div>
  <div class="modal-body">
    <p>Ingrese su Correo Electrónico</p>
    <div class="control-group">
       	  <div class="controls">
           	  <input name="mail" id="mail" type="email" class="mail form-control"/>
            </div>
          </div>
  </div>
  <div class="modal-footer">
     <button class="btn btn-success reenvio_clave confirmar" >Aceptar</button>
     <button class="btn"  data-dismiss="modal" aria-hidden="true">Cancelar</button>
  </div>
</div>

</body>
</html>
