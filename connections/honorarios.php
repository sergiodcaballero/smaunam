<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
#$hostname_honorarios = "179.43.127.254";
#$database_honorarios = "autogestion";
#$username_honorarios = "afiliados";
#$password_honorarios = "jujuy1745";
#$honorarios = mysql_pconnect($hostname_honorarios, $username_honorarios, $password_honorarios) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php

#  $hostname_honorarios = '179.43.127.254';
#  $username_honorarios = 'afiliados';
#  $password_honorarios = 'jujuy1745'; // NOTA: Reemplace password por el password de su cuenta de hosting
#  $honorarios = mysql_connect($hostname_honorarios, $username_honorarios, $password_honorarios) or die ('Ocurrió un error al conectarse al servidor mysql');
#  $database_honorarios = 'autogestion';
#   mysql_select_db($database_honorarios);

?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
  $hostname_honorarios = 'localhost';
  $username_honorarios = 'afiliados';
  $password_honorarios = 'jujuy1745'; // NOTA: Reemplace password por el password de su cuenta de hosting
 // $username_honorarios = 'root';
 // $password_honorarios = 'root';
  $honorarios = mysql_connect($hostname_honorarios, $username_honorarios, $password_honorarios) or die ('Ocurrió un error al conectarse al servidor mysql');
  $database_honorarios = 'autogestion';
   mysql_select_db($database_honorarios);
?>


