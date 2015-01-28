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
<title>Auto Gesti&oacute;n  - P&aacute;gina principal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="mm_restaurant1.css" type="text/css" />
<script type="text/JavaScript">
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
</head>
<body bgcolor="#0066cc">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr bgcolor="#99ccff">
	<td height="60" nowrap="nowrap" bgcolor="#99ccff" class="logo"><img src="Image3.gif" width="351" height="90" border="1" /> AUTO GESTI&Oacute;N S.M.A.U.Na.M</td>
	</tr>


	<tr bgcolor="#ffffff">
	<td width="75" height="334" valign="top">
	<form name='datos' action='verificadatos.php' method='post' >
      <p align="center">&nbsp;</p>
      
        <div align="center">
          <table width="681" height="103" border="0">
            <tr>
              <td width="348" bordercolor="1"><div align="right" class="letra">Ingrese el Nro. de Afiliado (sin barra /)  </div></td>
              <td width="315" bordercolor="1"><label>
                <div align="left">
                  <input name="N_Afiliado" type="text" maxlength="10" />
                  </div>
              </label></td>
            </tr>
            <tr>
              <td bordercolor="1"><div align="right" class="letra">Ingrese el Nro. de Documento: </div></td>
              <td bordercolor="1"><label>
                
                <div align="left">
                  <input name="Nro_Doc" type="text" maxlength="8" />
                  </label>
              </div></td>
            </tr>
            <tr>
              <td bordercolor="1"><div align="right"><span class="letra">Ingrese la Contrase&ntilde;a</span>: </div></td>
              <td bordercolor="1"><div align="left">
                <input name="password" type="password" maxlength="10" />
              </div></td>
            </tr>
            <tr>
              <td align="center" bordercolor="1"><label>
                <input name="submit" type="submit" onclick="MM_validateForm('N_Afiliado','','RisNum','Nro_Doc','','RisNum');return document.MM_returnValue" value="Ingresar" />
                
              </label></td>
              <td align="center" bordercolor="1"><a href="http://www.smaunam.com.ar" style="margin-left:2%;">
	  <input type="button" value="Volver" name="submit" /></a></td>
            </tr>
          </table>
        </div>
        <p align="center">
        <label></label></p>
        <table width="679" border="1">
          <tr>
            <td class="letra">* <strong>Se&ntilde;or Afiliado: </strong>Para poder ingresar al sistema de auto Gesti&oacute;n deber&aacute; ingresar los datos de N&ordm; de afiliado y DNI de la persona a utilizar el sistema.  </td>
          </tr>
        </table>
	</form>
	  <p style="margin-left:4%;">
	    <label></label>
	  Para descargar el manual de Ayuda, seleccione el bot&oacute;n <strong>&quot;Descargar&quot;</strong> <a target="_blank" href="http://www.smaunam.com.ar/wp-content/uploads/2015/01/Manual-Sistema-Autogestión.pdf" style="margin-left:2%;">
	  <input type="button" value="Descargar" name="submit" /></a></p>
	</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td bgcolor="#0000FF"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>
</table>
</body>
</html>
