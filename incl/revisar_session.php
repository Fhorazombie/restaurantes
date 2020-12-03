<?php

		/*Si el usuario no inicio sesion se redirige al login*/
        if($_SESSION["inicio_sesion"] != "si" || empty($_SESSION["inicio_sesion"])){

             header("location:../?error=sesion");   

            exit();

        }



?>