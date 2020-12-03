<?php	/*Si el usuario no es administrador se redirije a mapa de restaurantes, si no se registro o inicio sesion se redigire al login*/        
if($_SESSION["admin"] != "1" && $_SESSION["inicio_sesion"] != "si"){             
	header("location:../?error=sesion");           
	exit();        
}elseif ($_SESSION["admin"] != "1") {        	
	header("location:../restaurantes_cerca");           
	 exit();        
}