<?php 


/*Inicia una sesion*/
session_start();



/*Revisa si el usuario es administrador */
include("revisar_admin.php");


/*Carga la conexion a base de datos */
include("conexion.php");





/*Si no se obtiene el nombre por metodo post se redirije al usuario a el administrador de restaurantes*/
if($_POST["nombre"] == null || $_POST["nombre"] == ""){



         header("location:../");



        exit();



} 


/*Array con los datos mandados por POST de un restaurante*/
$restaurante = array(array('nombre' => $_POST["nombre"], 'calle' => $_POST["calle"], "numero" => $_POST["numero"], "colonia" => $_POST["colonia"], "municipio" => $_POST["municipio"], "estado" => $_POST["estado"], "cp" => $_POST["cp"] ), array('correo' => $_POST["correo"], 'web' => $_POST["web"], "telefono" => $_POST["telefono"], "bio" => $_POST["bio"] ), array('lat' => $_POST["lat"], "lon" => $_POST["lon"], "catego" => $_POST["catego"] ));




/* consulta de base de datos para agregar el restaurante de la tabla restaurantes*/
$consulta = "INSERT INTO restaurantes (nombre, calle, numero, colonia, municipio, estado, c_p) VALUES ('".$restaurante[0]["nombre"]."', '".$restaurante[0]["calle"]."', '".$restaurante[0]["numero"]."', '".$restaurante[0]["colonia"]."', '".$restaurante[0]["municipio"]."', '".$restaurante[0]["estado"]."', '".$restaurante[0]["cp"]."')";


/* Prepara la consulta con la variable $bd que sale de conexion.php */
$p = $bd->prepare($consulta);
/* ejecuta la consulta */
try{
	$p->execute();
}catch(PDOException $e){
	header("location:../?error=Ocurrio un error ->" . $e->getMessage());
	exit();
}



/* Se obtiene el ultimo id ibgresado a base de datos */
$id = $bd->lastInsertId();




/* consulta de base de datos para agregar el restaurante de la tabla restaurantes_bio */
$consulta = "INSERT INTO restaurantes_bio (id_rest,correo,web,telefono,bio) VALUES ('".$id."','".$restaurante[1]["correo"]."','".$restaurante[1]["web"]."','".$restaurante[1]["telefono"]."','".$restaurante[1]["bio"]."')";



$p = $bd->prepare($consulta);

$p->execute();




/* consulta de base de datos para agregar el restaurante de la tabla restaurantes_meta */
$consulta = "INSERT INTO restaurantes_meta (id_rest, fecha, lat, lon, categoria) VALUES ('".$id."',NOW(), '".$restaurante[2]["lat"]."','".$restaurante[2]["lon"]."','".$restaurante[2]["catego"]."')";



$p = $bd->prepare($consulta);

$p->execute();


/*Si el usuario ingreso una imagen*/
if($_FILES["imagen"]["name"] != ""){

    $nombre_archivo = $_FILES["imagen"]["name"];

    $ext = pathinfo($nombre_archivo,PATHINFO_EXTENSION);

    $tam = $_FILES["imagen"]["size"];

    /*Si la extension de la imagen es jpg, png, jpeg o el tamaño es menor a 200mb se genera la nueva imagen en el servidor */
    if(($ext=="png"||$ext=="jpg"|| $ext=="jpeg") && ($tam <= "2000000")){

    	$nombre_archivo = $_FILES["imagen"]["name"];

    	$ext = pathinfo($nombre_archivo,PATHINFO_EXTENSION);

    	$fn = pathinfo($nombre_archivo,PATHINFO_FILENAME);

    	$tam = $_FILES["imagen"]["size"];

    	$ruta_local="../uploads/";

    	$rand = substr(md5(microtime()),rand(0,26),5);

    	/*Se genera un nombre con el nombre del restaurante, caracteres aleatorios el id del restaurante y la extension del archivo */

    	$nombre_archivo = $restaurante[0]["nombre"].$rand."_".$id.".".$ext;

    	$nombre_archivo = preg_replace("/\s+/","_",$nombre_archivo);

    	$ruta = $_FILES["imagen"]["tmp_name"];

        move_uploaded_file($ruta,$ruta_local.$nombre_archivo);

        $consulta = "UPDATE restaurantes_meta SET imagen = '".$nombre_archivo."' WHERE id =".$id;

        $p = $bd->prepare($consulta);

        $p->execute();

    }else{

        $_SESSION["msj"] = "Archivo invalido";

    }

}



header("Location:../restaurantes");



exit();

?>