<?php 


/*inisia una session */
session_start();


/*revisa si el usario se registro o inicio sesion*/
include("revisar_session.php");


/*carga base de datos */
include("conexion.php");






/*Si no se obtiene el nombre por metodo post se redirije al usuario a el administrador de restaurantes */
if($_POST["nombre"] == null || $_POST["nombre"] == ""){



         header("location:../");



        exit();



} 






/*Si no se administrador se puede editar la configuracion del usuario para ser administrador */
if ($_SESSION["admin"] == 0 || $_SESSION["admin"] == "0") {



	$nombre = $_POST["nombre"];



	$a_paterno = $_POST["a_paterno"];



	$a_materno = $_POST["a_materno"];



	$email = $_POST["email"];



	$ps = $_POST["ps"];



	$id = $_POST["id"];






	/* consulta de base de datos para editar el usuario de la tabla usuarios */
	$consulta = "UPDATE usuarios SET nombre = '".$nombre."', a_paterno = '".$a_paterno."',a_materno = '".$a_materno."',correo = '".$email."',pass = '".$ps."' WHERE id = $id";


	/* Prepara la consulta con la variable $bd que sale de conexion.php */
	$p = $bd->prepare($consulta);
	/* ejecuta la consulta */
	try{
		$p->execute();
	}catch(PDOException $e){
		          
			header("location:../restaurantes_cerca/?error=Ocurrio un error ->" . $e->getMessage());       
			exit();        
	}

	/*Se restablece la sesion del usuario para reconfigurar su nombre, email, id, inicio de sesion y administracion */
	session_unset();



	session_destroy();



	session_start();



	$_SESSION["nombre"] =  $nombre;



	$_SESSION["correo"] =  $email;



	$_SESSION["id"] =  $id;



	$_SESSION["inicio_sesion"] = "si";



	$_SESSION["admin"] = 0;



	header("Location:../restaurantes_cerca");



} else{







	$nombre = $_POST["nombre"];



	$a_paterno = $_POST["a_paterno"];



	$a_materno = $_POST["a_materno"];



	$email = $_POST["email"];



	$usuario = $_POST["usuario"];



	$ps = $_POST["ps"];



	$admin = $_POST["admin"];



	$id = $_POST["id"];






	/* consulta de base de datos para editar el usuario de la tabla usuarios */
	$consulta = "UPDATE usuarios SET nombre = '".$nombre."', a_paterno = '".$a_paterno."',a_materno = '".$a_materno."',correo = '".$email."',usuario = '".$usuario."',pass = '".$ps."' WHERE id = $id";







	$p = $bd->prepare($consulta);



	try{
		$p->execute();
	}catch(PDOException $e){    	
			header("location:../usuarios_admin/?id=".$id."&error=Ocurrio un error ->" . $e->getMessage());           
			 exit();        
	}






	/* consulta de base de datos para editar el usuario de la tabla usuarios_meta */
	$consulta = "UPDATE usuarios_meta SET admin = '".$admin."' WHERE user_id = $id";







	$p = $bd->prepare($consulta);




	/*Cuando el usuario es administador se verifica que el usuario editado sea el mismo que el que manda la consulta para poder regenrar la sesion */
	if ($id == $_SESSION["id"]) {



		session_unset();



		session_destroy();



		session_start();



		$_SESSION["nombre"] =  $nombre;



		$_SESSION["correo"] =  $email;



		$_SESSION["id"] =  $id;



		$_SESSION["admin"] = $admin;



		$_SESSION["inicio_sesion"] = "si";

	}





	header("Location:../usuarios");



}











exit();



?>