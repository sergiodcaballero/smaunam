<?php 
//print_r($_GET);
require_once('connections/honorarios.php'); 
mysql_select_db($database_honorarios, $honorarios);
$consulta_sql = "SELECT pass,n_afiliado FROM ppadron WHERE email='".$_POST['mail']."' AND n_benef=00";

$res = mysql_query($consulta_sql);
$Cantidad_Filas = mysql_num_rows($res);
//$Cant = mysql_num_rows($resultado);
//$Cantidad_Filas = 1;
if ($Cantidad_Filas < 1){
	$resultado['respuesta'] = 'NO';
}else{
	while ($fila = mysql_fetch_array($res)){
		$pass = $fila['pass'];
		$afiliado = $fila['n_afiliado'];
	}
	$fecha = date("Y-m-d H:i:s");
	$auditoria = "insert into auditoria (N_Afiliado, accion, fecha) values ('".$afiliado."','SOLICITUD DE RECUPERACION DE PASSWORD','".$fecha."')";
//agregamos la dependencia de Swift Mailer
		require_once 'php/ext/Swift-4.2.1/lib/swift_required.php';
		
		//configuracion de la cuenta
		$objCuentaUtilizada=Array(
			'smtp'			=>	'mail.smaunam.com.ar',		//direccion del smtp
			'puerto'		=>	587,						//puerto smtp
			'nombre'		=>	'Autogestion S.M.A.U.Na.M. ',			//nombre que aparecera en los correos
			'cuenta'		=>	'autogestion@smaunam.com.ar',	//cuenta que vamos a usar (colocar con @)
			'usuario'		=>	'irinam@smaunam.com.ar',	//usuario de smtp
			'contrasena'	=>	'Irinamjujuy1745'	//contrasena de smtp
		);
		
		//creamos el nuevo transporte de Swift con los datos de conexion
		$objTransporte=Swift_SmtpTransport::newInstance($objCuentaUtilizada['smtp'],
		$objCuentaUtilizada['puerto'])
			->setUsername($objCuentaUtilizada['usuario'])		//le indicamos el usuario smtp que vamos a usar
			->setPassword($objCuentaUtilizada['contrasena'])	//contrasena del usuario smtp
		;
		
		//instanciamos el mailer con los datos de conexion establecidos anteriormente
		$objMailer=Swift_Mailer::newInstance($objTransporte);
		
		//creamos el mensaje
		$objMensaje=Swift_Message::newInstance('Asunto del mensaje')							//asunto del mensaje
			->setFrom(array($objCuentaUtilizada['cuenta'] => $objCuentaUtilizada['nombre']))	//quien esta enviando el mensaje?
			//->setTo(array('computos@smaunam.com.ar' => 'pruebasma'))								//a quien le enviamos el mensaje?
			->setTo(array('iris.sole.18@gmail.com' => 'autogestion smaunam'))
			->setBody('<p>Sr. Afilado/a:<br>Por la presente le informamos que ha solicitado la recuperación de clave en el sistema de Autogestión S.M.A.U.Na.M.<br>Su clave de acceso es: '.$pass.'</p><p>Trabajamos para mejorar los servicios a los afiliados<br>
			Saludos<br>
			S.M.A.U.Na.M.</p>')					//cuerpo del mensaje	
			->setContentType('text/html')														//mensaje en formato HTML
		;
		
		//enviamos el mensaje
		if($objMailer->send($objMensaje)){
			$resultado['respuesta'] = 'SI';
			mysql_query($auditoria , $honorarios) or die(mysql_error());
		}else{
			$resultado['respuesta'] = 'PROBLEMA';
		}
	//$resultado['enviado'] = $_POST;$resultado['enviado'] = $pass;
 //  $resultado['respuesta'] = 'Gracias por sus datos '.$_POST['mail'];
}
echo json_encode($resultado);
?>