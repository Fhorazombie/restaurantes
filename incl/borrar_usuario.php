<?php 


/*Inicia una sesion */
session_start();


/*Revisa si el usuario es administrador */
include("revisar_admin.php");


/*Carga la conexion a base de datos */
include("conexion.php");






/*Si no se obtiene el id por metodo post se redirije el usuario a el panel de administracion */
if($_POST['id'] == ""){



        header("location:../dashboard");



} 







$id = $_POST["id"];






/* consulta de base de datos para obtener borrar el usuario de la tabla usuarios */
$consulta = "DELETE FROM usuarios WHERE id = '".$id."'";







$q = $bd->prepare($consulta);



$q->execute();





/* consulta de base de datos para obtener borrar el usuario de la tabla usuarios_meta */

$consulta = "DELETE FROM usuarios_meta WHERE user_id = '".$id."'";







$q = $bd->prepare($consulta);



$q->execute();



$id = strval($id);



/* Si el usuario administrador que esta borrando es el mismo que se elimino de la base de datos, se cierra la sesion y se redirije al inicio de la pagina */
if ($id == $_SESSION["id"]) {

	header("location:logout.php");

	exit();

} else {

	header("location:../usuarios");

	exit();

}



?>