<?php 


/*Carga la conexion a base de datos */
    include('conexion.php');







    $pass = $_POST['pass'];



    $usuario = $_POST['usuario'];






    /*Consulta a la base de datos para saber si los datos de inicio de sesion son correctos */
    $consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.a_paterno, usuarios.a_materno, usuarios.correo, usuarios.usuario, usuarios.pass, usuarios_meta.fecha, usuarios_meta.admin FROM usuarios INNER JOIN usuarios_meta ON usuarios.id=usuarios_meta.user_id WHERE usuarios.usuario = '$usuario' AND usuarios.pass = '$pass' ORDER BY id DESC";


/* Prepara la consulta con la variable $bd que sale de conexion.php */
    $q = $bd->prepare($consulta);



/* ejecuta la consulta */
    $q->execute();


/* ordena las columas en un array alamcenados en una variable llamada $rs */
    $rs = $q->fetchAll();






    /* Si se tiene resultado de la consulta se inisia un sesion guradando los datos nombre, correo, id, si el usuario inicio sesion, y el tipo de usuario */
    if(count($rs) == 0){



        header("location:../?error=invalido");



    } else{



        session_start();



        $_SESSION["nombre"] = $rs[0]["nombre"];



        $_SESSION["correo"] = $rs[0]["correo"];



        $_SESSION["id"] = $rs[0]["id"];



        $_SESSION["inicio_sesion"] = "si";



        $_SESSION["admin"] = $rs[0]["admin"];


        /*Dependiendo el tipo de usuario lo redirige a el panel de administracion o el mapa de restaurantes */

        if ($_SESSION["admin"] == 1) {



            header("Location:../dashboard");
            exit();



        } else {



            header("Location:../restaurantes_cerca");
            exit();



        }



    }







?>