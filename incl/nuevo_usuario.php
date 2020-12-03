<?php 


/*inisia una session*/
session_start();


/*carga base de datos*/
include("conexion.php");






/*Si no se obtiene el nombre por metodo post se redirije al usuario al inicio*/
if($_POST["nombre"] == null || $_POST["nombre"] == "" || empty($_POST["nombre"])){



         header("location:../");



        exit();



} 







$nombre = $_POST["nombre"];



$a_paterno = $_POST["a_paterno"];



$a_materno = $_POST["a_materno"];



$email = $_POST["email"];



$usuario = $_POST["usuario"];



$ps = $_POST["ps"];



if (isset($_POST["admin"])) {

	$admin = $_POST["admin"];

}else{

	$admin = 0;

}












/* consulta de base de datos para agregar un usuario de la tabla usuarios*/
$consulta = "INSERT INTO usuarios (nombre,a_paterno,a_materno,correo,usuario,pass) VALUES ('".$nombre."','".$a_paterno."','".$a_materno."','".$email."','".$usuario."','".$ps."')";





/* Prepara la consulta con la variable $bd que sale de conexion.php */
$p = $bd->prepare($consulta);


/* ejecuta la consulta */

try{
	$p->execute();
}catch(PDOException $e){
	
	if($_SESSION["inicio_sesion"] != "si"){             
		header("location:../?error=Ocurrio un error ->" . $e->getMessage());       
		exit();        
	}elseif ($_SESSION["admin"] == "1") {        	
		header("location:../usuarios_admin/?error=Ocurrio un error ->" . $e->getMessage());           
		 exit();        
	}
	exit();
}








/* Se obtiene el ultimo di agregado a la base de datos */
$id = $bd->lastInsertId();






/* consulta de base de datos para agregar un usuario de la tabla usuarios_meta */
$consulta = "INSERT INTO usuarios_meta (user_id,admin,fecha) VALUES ('".$id."','".$admin."',NOW())";







$p = $bd->prepare($consulta);



$p->execute();










/*Si el usuario es administrador se regrea al panel de administracion
Si el usuario es nuevo se crea una session con sus catos nombre, correo, id, inicio sesion y tipo de administracion, se redirije a mapa de restaurantes*/
if (isset($_SESSION["admin"])) {

	header("Location:../usuarios");
	exit();

} else {



	$_SESSION["inicio_sesion"] = "si";



	$_SESSION["nombre"] = $nombre;



	$_SESSION["correo"] = $email;



	$_SESSION["admin"] = $admin;



	$_SESSION["id"] = $id;



	header("Location:../restaurantes_cerca");
	exit();



}



?>