<?php		/*Si el usuario inicio sesion y es administrador se redirige al panel de aministracion de lo contrario se redirije al mapa de restaurantes*/        

if($_SESSION["admin"] == "1" && $_SESSION["inicio_sesion"] == "si"){             
	header("location:dashboard");            exit();        
}elseif ($_SESSION["inicio_sesion"] == "si") {        	header("location:restaurantes_cerca");            exit();        
}else{        	
	exit();        
}?>