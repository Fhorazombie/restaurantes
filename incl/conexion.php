<?php

/*



Conexion a base de datos





*/





 $host_bd = "localhost";


/*Base de datos*/
 $basededatos_bd = "webstaur_restaurante";


/*Usuario*/
 $usuario_bd = "webstaur_menu";


/*Constraseña*/
 $password_bd = "~zYRf79SfNo*";



 $puerto_bd = "3306";






/*Try catch para la conexion a base de datos*/
try{

/*objeto para la manipulacion de base de datos*/
    $bd = new PDO 



                ("mysql:host=".$host_bd.";



                dbname=".$basededatos_bd.";



                port=".$puerto_bd.";



                charset=utf8",



                $usuario_bd, 



                $password_bd);







    $bd-> setAttribute 



                (PDO::ATTR_ERRMODE,



                    PDO::ERRMODE_EXCEPTION); 



}catch(PDOException $e){







    echo "<br>Ocurrio un error ->" . $e->getMessage();







}



?>



