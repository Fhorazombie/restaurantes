<?php session_start(); 



if (isset($_SESSION["inicio_sesion"])) {



    include("incl/revisar_login.php"); 



}



?>



<!DOCTYPE html>



<html class="loading" lang="en" data-textdirection="ltr">



  <head>



    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



    <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">



    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">



    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">



    <meta name="author" content="PIXINVENT">



    <title>Login | Webstaurant</title>



    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">



    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">



    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">



    <!-- BEGIN VENDOR CSS-->



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">



    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/icheck/icheck.css">



    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/icheck/custom.css">



    <!-- END VENDOR CSS-->



    <!-- BEGIN MODERN CSS-->



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/app.css">



    <!-- END MODERN CSS-->



    <!-- BEGIN Page Level CSS-->



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/login-register.css">



    <!-- END Page Level CSS-->



    <style type="text/css">

    	.blank-page .content-wrapper .flexbox-container {

    	    height: inherit;

    	   }

    </style>



  </head>



  <body class="vertical-layout vertical-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">



    <!-- ////////////////////////////////////////////////////////////////////////////-->



    <div class="app-content content">



      <div class="content-wrapper">



        <div class="content-header row">



        </div>



        <div class="content-body"><section class="flexbox-container">



    <div class="col-12 d-flex align-items-center justify-content-center">



        <div class="col-md-4 col-10 box-shadow-2 p-0">



            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">



                <div class="card-header border-0">



                    <div class="card-title text-center">



                        <img src="../../../app-assets/images/logo/logo-dark.png" alt="branding logo">



                        <p>Bienvenido a Webstaurant, dentro de este sitio web encontrarás los mejores restaurantes de Poza Rica y Papantla mediante un mapa interactivo que te ayudará a saber la ubicación de los mismos así como una breve descripcion de ellos y sus menús más aclamados por la clientela. </p>



                    </div>



                </div>



                <div class="card-content">



                    <div class="card-body">



                        <?php



                            



                            /*isset() verifica si la variable contiene datos*/



                            if(isset($_GET["error"])){



                                if($_GET["error"]=="invalido") echo "<h5 class='text-danger'>Usuario invalido</h5>";



                                else if($_GET["error"]=="sesion") echo "<h5 class='text-danger'>Por favor ingresa a tu sesion para poder ver el contenido</h5>";

                                else{
                                    $error = $_GET["error"];
                                    $sql_duplicado = "SQLSTATE[23000]";

                                    if (strpos($error, $sql_duplicado)) {
                                        echo "<h5 class='text-danger'>Ese usuario ya existe por favor ingresa otro nombre de usuario y correo electronico</h5>";
                                    } else{
                                        echo "<h5 class='text-danger'>Ocurrio un error</h5><script> console.log('".$_GET["error"]."')</script>";
                                    }
                                }



                            }







                        ?>



                        <form class="form-horizontal" action="incl/login_action.php" method="POST">



                            <fieldset class="form-group position-relative has-icon-left">



                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" required>



                                <div class="form-control-position">



                                    <i class="ft-user"></i>



                                </div>



                            </fieldset>



                            <fieldset class="form-group position-relative has-icon-left">



                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>



                                <div class="form-control-position">



                                    <i class="la la-key"></i>



                                </div>



                            </fieldset>



                            <div class="form-group row">



                                <div class="col-12 float-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Olvidaste tu contraseña?</a></div>



                            </div>



                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Ingresar</button>



                        </form>



                    </div>



                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Nuevo en Webstaurant ?</span></p>



                    <div class="card-body">



                                                        <div class="form-group">



                                    <!-- Button trigger modal -->



                                    <button type="button" class="btn btn-outline-warning block btn-lg" data-toggle="modal" data-target="#inlineForm">



                                        Registrarse



                                    </button>







                                    <!-- Modal -->



                                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">



                                        <div class="modal-dialog" role="document">



                                            <div class="modal-content">



                                                <div class="modal-header">



                                                    <h1 class="modal-title" id="myModalLabel27">Ingresa tus datos</h1>



                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                                      <span aria-hidden="true">&times;</span>



                                                    </button>



                                                </div>



                                                <form action="incl/nuevo_usuario.php" method="POST">



                                                  <div class="modal-body">



                                                    



                                                    <div class="form-group">



                                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre o nombres" required>



                                                    </div>



                                                    <div class="form-group">



                                                        <input type="text" class="form-control" id="a_paterno" name="a_paterno" placeholder="Apellido paterno" required>



                                                    </div>



                                                    <div class="form-group">



                                                        <input type="text" class="form-control" id="a_materno" name="a_materno" placeholder="Apellido materno" required>



                                                    </div>



                                                    <div class="form-group">



                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electronico" required>



                                                    </div>



                                                    <div class="form-group">



                                                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" required>



                                                    </div>



                                                    <div class="form-group">



                                                        <input type="password" class="form-control" id="ps" name="ps" placeholder="Contraseña" onkeyup='check();' required>



                                                    </div>



                                                    <div class="form-group">



                                                        <input type="password" class="form-control" id="ps_2" name="ps_2" placeholder="Confirma la contraseña" onkeyup='check();' >



                                                        <span id='message'></span>



                                                    </div>

<!-- Funcion de javascript check() para verificar que se esta confirmando el pasword de manera correcta -->

                                                    <script type="text/javascript">


//Se compara que los dos inputs ps y ps_2 sean iguales
                                                        var check = function() {



                                                          if (document.getElementById('ps').value ==



                                                            document.getElementById('ps_2').value) {



                                                            document.getElementById('message').style.color = 'green';



                                                            document.getElementById('message').innerHTML = '<i class="la la-check-circle-o"></i> Las contraseñas son iguales';



                                                          } else {



                                                            document.getElementById('message').style.color = 'red';



                                                            document.getElementById('message').innerHTML = '<i class="la la-times-circle"></i> Las contraseñas no son iguales';



                                                          }



                                                        }



                                                    </script>



                                                    <input type="hidden" name="admin" id="admin" value="0"> 



                                                  </div>



                                                  <div class="modal-footer">



                                                    <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Cerrar">



                                                    <input type="submit" class="btn btn-outline-primary btn-lg" value="Registrar">



                                                  </div>



                                                </form>



                                            </div>



                                        </div>



                                    </div>



                                </div>



                    </div>



                </div>



            </div>



        </div>



    </div>



</section>







        </div>



      </div>



    </div>



    <!-- ////////////////////////////////////////////////////////////////////////////-->







    <!-- BEGIN VENDOR JS-->



    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>



    <!-- BEGIN VENDOR JS-->



    <!-- BEGIN PAGE VENDOR JS-->



    <script src="../../../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>



    <script src="../../../app-assets/vendors/js/forms/icheck/icheck.min.js"></script>



    <!-- END PAGE VENDOR JS-->



    <!-- BEGIN MODERN JS-->



    <script src="../../../app-assets/js/core/app-menu.js"></script>



    <script src="../../../app-assets/js/core/app.js"></script>



    <!-- END MODERN JS-->



    <!-- BEGIN PAGE LEVEL JS-->



    <script src="../../../app-assets/js/scripts/forms/form-login-register.js"></script>



    <!-- END PAGE LEVEL JS-->



  </body>



</html>