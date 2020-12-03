<?php 


/*Inicia una sesion*/
session_start();


/*Revisa si el usuario es administrador*/
include("revisar_admin.php");


/*Carga la conexion a base de datos*/
include("conexion.php");






/*Si no se obtiene el id por metodo post se redirije al usuario a el administrador de restaurantes*/
if($_POST['id'] == ""){



        header("location:../restaurantes");



} 



$id = $_POST["id"];




/* consulta de base de datos para obtener borrar la url de la imagen*/
$consulta = "SELECT * FROM restaurantes_meta WHERE id_rest = '".$id."'";



/* Prepara la consulta con la variable $bd que sale de conexion.php*/
$q = $bd->prepare($consulta);


/* ejecuta la consulta*/
$q->execute();


/* ordena las columas en un array alamcenados en una variable llamada $rs*/
$rs = $q->fetchAll();



$imagen = $rs[0]["imagen"];

if (!empty($imagen)) {
	$ruta = "../uploads/";

	/*Se eliminar la imagen del directorio uploads*/
	unlink($ruta.$imagen);
}




/* consulta de base de datos para obtener borrar el restaurante de la tabla restaurantes*/
$consulta = "DELETE FROM restaurantes WHERE id = '".$id."'";

$q = $bd->prepare($consulta);

$q->execute();


/* consulta de base de datos para obtener borrar el restaurante de la tabla restaurantes_bio*/
$consulta = "DELETE FROM restaurantes_bio WHERE id_rest = '".$id."'";

$q = $bd->prepare($consulta);

$q->execute();


/* consulta de base de datos para obtener borrar el restaurante de la tabla restaurantes_meta*/
$consulta = "DELETE FROM restaurantes_meta WHERE id_rest = '".$id."'";

$q = $bd->prepare($consulta);

$q->execute();



header("Location:../restaurantes");

exit();

?>