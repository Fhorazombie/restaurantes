<?php 


/*inisia una session*/
session_start();


/*revisa si el usario se registro o inicio sesion*/
include("revisar_admin.php");


/*carga base de datos */
include("conexion.php");




/*Si no se obtiene el nombre por metodo post se redirije al usuario a el administrador de restaurantes */
if($_POST["nombre"] == null || $_POST["nombre"] == ""){



        header("Location:../restaurantes");



        exit();



} 



$id = $_POST["id"];


/*Array con los datos mandados por POST de un restaurante */
$restaurante = array(array('nombre' => $_POST["nombre"], 'calle' => $_POST["calle"], "numero" => $_POST["numero"], "colonia" => $_POST["colonia"], "municipio" => $_POST["municipio"], "estado" => $_POST["estado"], "cp" => $_POST["cp"] ), array('correo' => $_POST["correo"], 'web' => $_POST["web"], "telefono" => $_POST["telefono"], "bio" => $_POST["bio"] ), array('lat' => $_POST["lat"], "lon" => $_POST["lon"], "catego" => $_POST["catego"] ));


/* consulta de base de datos para editar el restaurante de la tabla restaurantes */
$consulta = "UPDATE restaurantes SET nombre = '".$restaurante[0]["nombre"]."', calle = '".$restaurante[0]["calle"]."', numero = '".$restaurante[0]["numero"]."', colonia = '".$restaurante[0]["colonia"]."', municipio = '".$restaurante[0]["municipio"]."', estado = '".$restaurante[0]["estado"]."', c_p = '".$restaurante[0]["cp"]."' WHERE id = $id";


/* Prepara la consulta con la variable $bd que sale de conexion.php */
$p = $bd->prepare($consulta);
/* ejecuta la consulta */
$p->execute();


/* consulta de base de datos para editar el restaurante de la tabla restaurantes_bio */
$consulta = "UPDATE restaurantes_bio SET correo = '".$restaurante[1]["correo"]."', web = '".$restaurante[1]["web"]."', telefono = '".$restaurante[1]["telefono"]."', bio = '".$restaurante[1]["bio"]."' WHERE id_rest = $id";

$p = $bd->prepare($consulta);

$p->execute();


/* consulta de base de datos para editar el restaurante de la tabla restaurantes_meta */
$consulta = "UPDATE restaurantes_meta SET lat = '".$restaurante[2]["lat"]."', lon = '".$restaurante[2]["lon"]."', categoria = '".$restaurante[2]["catego"]."' WHERE id_rest = $id";

$p = $bd->prepare($consulta);

$p->execute();


/*Si el usuario ingreso una imagen */
if($_FILES["imagen"]["name"] != ""){

    $nombre_archivo = $_FILES["imagen"]["name"];

    $ext = pathinfo($nombre_archivo,PATHINFO_EXTENSION);

    $tam = $_FILES["imagen"]["size"];

    
    /*Si la extension de la imagen es jpg, png, jpeg o el tamaño es menor a 200mb se genera la nueva imagen en el servidor */
    if(($ext=="png"||$ext=="jpg"|| $ext=="jpeg") && ($tam <= "2000000")){

            /*Se borra la imagen anterior */
        $consulta = "SELECT * FROM restaurantes_meta WHERE id_rest = '".$id."'";

        $q = $bd->prepare($consulta);

        $q->execute();

        $rs = $q->fetchAll();

        $imagen_borrada = $rs[0]["imagen"];

        $ruta = "../uploads/";

        unlink($ruta.$imagen_borrada);



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