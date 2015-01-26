<?php 
header("Content-Type: text/html;charset=iso-8859-1");
	if(isset($_POST['idProvincia'])) {
		$ciudades = array();
		  include('connections/honorarios.php'); 
		  $provincia =$_POST['idProvincia'];
		  $provincia = str_replace("_", " ", $provincia);
		  mysql_select_db($database_honorarios, $honorarios);
		$sql = "select id,ciudad,os,domicilio from cosun where provincia='".$provincia."' ORDER BY ciudad";
		 $resultado = mysql_query($sql, $honorarios)or die(mysql_error()); 
		 
		 print("<option value=0>Seleccione</option>");
		 while($filaprov=mysql_fetch_array($resultado)){ 
			print("<option value=\"$filaprov[id]\">$filaprov[ciudad]- $filaprov[os]-$filaprov[domicilio]			</option>"); 
			} 
		$options= '
    <option value="1">Ibiza</option>
    <option value="2">Toledo</option>
    <option value="3">Cordoba</option>
    <option value="4">Arosa</option>
    ';  //echo $options;    
	}else{
		$options= '<option value="0">Seleccione la Provincia</option>';  
		echo $options; 	
	}
	
	class ciudad {
		public $id;
		public $nombre;

		function __construct($id, $nombre) {
			$this->id = $id;
			$this->ciudad = $nombre;
		}
	}
?>