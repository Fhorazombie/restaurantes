<?php

/*inisia una session*/
session_start();


/*carga base de datos */
include("incl/conexion.php");


/*revisa si el usario se registro o inicio sesion */
include("incl/revisar_session.php"); 







 ?>



<?php






/*revisa el id de la tabla usuarios del usuario existente */
$id = $_SESSION["id"];






/* consulta de base de datos a las tablas usuarios y usuarios_meta */
$consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.a_paterno, usuarios.a_materno, usuarios.correo, usuarios.usuario, usuarios.pass, usuarios_meta.admin FROM usuarios INNER JOIN usuarios_meta ON usuarios.id=usuarios_meta.user_id WHERE usuarios.id = '$id' ORDER BY id DESC";






/* Prepara la consulta con la variable $bd que sale de conexion.php */
$q = $bd->prepare($consulta);


/* ejecuta la consulta */
$q->execute();


/* ordena las columas en un array alamcenados en una variable llamada $rs */
$rs = $q->fetchAll();



$nombre = $rs[0]["nombre"];



$a_paterno = $rs[0]["a_paterno"];



$a_materno = $rs[0]["a_materno"];



$email = $rs[0]["correo"];



$usuario = $rs[0]["usuario"];



$ps = $rs[0]["pass"];



$admin = $rs[0]["admin"];








/* consulta de base de datos a las tablas restaurantes, restaurantes_bio y restaurantes_meta */
   $consulta2 = "SELECT restaurantes.id, restaurantes.nombre, restaurantes.calle, restaurantes.numero, restaurantes.colonia, restaurantes.municipio, restaurantes.c_p, restaurantes_bio.correo, restaurantes_bio.web, restaurantes_bio.telefono, restaurantes_bio.bio, restaurantes.estado,  restaurantes_meta.lat,  restaurantes_meta.lon, restaurantes_meta.categoria, restaurantes_meta.imagen FROM restaurantes JOIN restaurantes_bio ON restaurantes.id =restaurantes_bio.id_rest JOIN restaurantes_meta ON restaurantes.id = restaurantes_meta.id_rest ORDER BY id DESC";






/* Prepara la consulta con la variable $bd que sale de conexion.php */
    $q2 = $bd->prepare($consulta2);


/* ejecuta la consulta */
    $q2->execute();






/* ordena las columas en un array alamcenados en una variable llamada $rs */
    $rs2 = $q2->fetchAll();





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



    <title>Restaurantes - Webstaurant</title>



    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">



    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">



    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">



    <!-- BEGIN VENDOR CSS-->



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">



    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/chartist.css">



    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/chartist-plugin-tooltip.css">



    <!-- END VENDOR CSS-->



    <!-- BEGIN MODERN CSS-->



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/app.css">



    <!-- END MODERN CSS-->



    <!-- BEGIN Page Level CSS-->



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">



    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-support.css">



    <!-- END Page Level CSS-->



  </head>



  <body class="horizontal-layout 2-columns pace-done vertical-layout vertical-overlay-menu fixed-navbar menu-hide" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">







    <!-- fixed-top-->



    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-light fixed-top">



      <div class="navbar-wrapper">



        <div class="navbar-header" style="top: 0;">



          <ul class="nav navbar-nav flex-row">



            <li class="nav-item"><a class="navbar-brand" href="../"><img class="brand-logo" alt="modern admin logo" src="../../../app-assets/images/logo/logo-dark.png" style="
    height: 42px; width: auto;
">



                <h3 class="brand-text">Webstaurant</h3></a></li>



            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>



          </ul>



        </div>



        <div class="navbar-container content">



          <div class="collapse navbar-collapse" id="navbar-mobile">



            <ul class="nav navbar-nav float-right" style="
    margin: auto;
    margin-right: 0px;
">



              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1">Hola,<span class="user-name text-bold-700" style="
    display: contents;
"><?php echo $_SESSION["nombre"]; ?></span></span><span class="avatar avatar-online"><img src="../../../app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></a>



                <div class="dropdown-menu dropdown-menu-right">



                              <div class="form-group">



                                    <!-- Si el usuario no es admin pon un modal para editar informacion, si el usuario es admin edita su informacion en el panel de administracion de usuarios -->



                                    <?php if($_SESSION["admin"] == 0 || $_SESSION["admin"] == "0") { ?>



                                    <button type="button" class="dropdown-item btn btn-primary-outline" data-toggle="modal" data-target="#inlineForm">



                                       <i class="ft-user"></i>  Editar Perfil



                                    </button>



                                    <?php } else { ?>



                                      <a class="dropdown-item" href="../incl/editar_usuario.php?id=<?php echo $id;?>"> Editar Perfil</a>



                                    <?php } ?>







                                    



                                </div>



                  <div class="dropdown-divider"></div><a class="dropdown-item" href="../logout"><i class="ft-power"></i> Cerrar sesión</a>



                </div>



              </li>



            </ul>



          </div>



        </div>



      </div>



    </nav>



                                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">



                                        <div class="modal-dialog" role="document">



                                            <div class="modal-content">



                                                <div class="modal-header">



                                                    <h1 class="modal-title" id="myModalLabel27">Edita tus datos</h1>



                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                                      <span aria-hidden="true">&times;</span>



                                                    </button>



                                                </div>



                                                <form action="../incl/editar_usuario.php" method="POST">



                                                  <div class="modal-body">







                                                    <h1 class="modal-title" id="myModalLabel27">Usuario: <?php echo $usuario; ?></h1>



                                                    <br>



                                                    <div class="form-group">



                                                      <label for="nombre">Nombre</label>



                                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>" required>



                                                    </div>



                                                    <div class="form-group">



                                                      <label for="a_paterno">Apellido paterno</label>



                                                        <input type="text" class="form-control" id="a_paterno" name="a_paterno" value="<?php echo $a_paterno; ?>">



                                                    </div>



                                                    <div class="form-group">



                                                      <label for="a_materno">Apellido materno</label>



                                                        <input type="text" class="form-control" id="a_materno" name="a_materno" value="<?php echo $a_materno; ?>">



                                                    </div>



                                                    <div class="form-group">



                                                      <label for="email">Email</label>



                                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>



                                                    </div>



                                                    <div class="form-group">



                                                      <label for="ps">Contraseña</label>



                                                        <input type="password" class="form-control" id="ps" name="ps" value="<?php echo $ps; ?>" required onkeyup='check();'>



                                                    </div>



                                                    <div class="form-group">



                                                      <label for="ps_2">Repite la contraseña</label>



                                                        <input type="password" class="form-control" id="ps_2" name="ps2" value="<?php echo $ps; ?>" required onkeyup='check();'>
                                                        <span id='message'></span> 



                                                    </div>

                                                    <!-- Funcion de javascript check() para verificar que se esta confirmando el pasword de manera correcta -->

                                                    <script type="text/javascript">



                                                        var check = function() {


                                                          /*Se compara que los dos inputs ps y ps_2 sean iguales*/

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



                                                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">



                                                  </div>



                                                  <div class="modal-footer">



                                                    <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="Cerrar">



                                                    <input type="submit" class="btn btn-outline-primary btn-lg" value="Guardar">



                                                  </div>



                                                </form>



                                            </div>



                                        </div>



                                    </div>



    <!-- ////////////////////////////////////////////////////////////////////////////-->







    <div class="app-content content">



      <div class="content-wrapper">



        <div class="content-header row">



        </div>



        <div class="content-body"><!-- Statistics with grouped cards -->



<?php



if(isset($_GET["error"])){

        $error = $_GET["error"];
        $sql_duplicado = "SQLSTATE[23000]";

        if (strpos($error, $sql_duplicado)) {
            echo "<h5 class='text-danger' style='padding: 2%;background-color: #fff;'>Ese correo electrónico ya existe por favor ingresa otro correo electronico</h5>";
        } else{
            echo "<h5 class='text-danger' style='padding: 2%;background-color: #fff;'>Ocurrio un error</h5><script> console.log('".$_GET["error"]."')</script>";
        }



}




?>



<div class="row">



    <div class="col-12">



      <style type="text/css">

        #map {

            width: 100%;

        height: 80vh;

        }

      </style>



<div id="map"></div>

    <script>

      

      var map, infoWindow;

      /* funcion inicial de google maps initMap() */
      function initMap() {

        /* se genera el mapa en el Div con identificador "map" */
        map = new google.maps.Map(document.getElementById('map'), {

          center: {lat: -34.397, lng: 150.644},

          zoom: 19

        });

        infoWindow = new google.maps.InfoWindow;



        /* Localizacion html5 obtiene la localizacion del usuario mediante una funcion html */

        if (navigator.geolocation) {

          navigator.geolocation.getCurrentPosition(function(position) {

            var pos = {

              lat: position.coords.latitude,

              lng: position.coords.longitude

            };



            infoWindow.setPosition(pos);

            infoWindow.setContent('Tu estas aquí.');

            infoWindow.open(map);

            map.setCenter(pos);

          }, function() {

            handleLocationError(true, infoWindow, map.getCenter());

          });

        } else {

          /* el navegador no soporta geolocalizacion o no tiene certificado ssl el servidor */

          handleLocationError(false, infoWindow, map.getCenter());

        }



        <?php 


          /* ciclo for para mostrar los restaurantes, cuenta cuantos elementos existen en el array de $rs2 */
            for($i = 0; $i< count($rs2); $i++){



                $restaurante = array(

                    array('nombre' => $rs2[$i]["nombre"], 'calle' => $rs2[$i]["calle"], "numero" => $rs2[$i]["numero"], "colonia" => $rs2[$i]["colonia"], "municipio" => $rs2[$i]["municipio"], "estado" => $rs2[$i]["estado"], "cp" => $rs2[$i]["c_p"]), 

                        array('correo' => $rs2[$i]["correo"], 'web' => $rs2[$i]["web"], 'telefono' => $rs2[$i]["telefono"], 'bio' => $rs2[$i]["bio"]), 

                        array("lat" => $rs2[$i]["lat"], "lon" => $rs2[$i]["lon"], "catego" => $rs2[$i]["categoria"], "imagen" => $rs2[$i]["imagen"] )

                    );



         ?>


         /* *************Genera el contenido del puntero rojo de cada restaurante en el mapa */

         var contentString_<?php echo $i; ?> = '<div id="content">'+

            '<div id="siteNotice">'+

            '</div>'+

            '<img style="height:100px;" src="../uploads/<?php echo $restaurante[2]["imagen"]; ?>">'+

            '<h1 id="firstHeading" class="firstHeading"><?php echo $restaurante[0]["nombre"]; ?></h1>'+

            '<div id="bodyContent">'+

            '<a href="<?php echo $restaurante[1]["web"]; ?>"><?php echo $restaurante[1]["web"]; ?></a>'+

            '<p><?php echo $restaurante[1]["correo"]; ?></p>'+

            '<p><?php echo $restaurante[1]["telefono"]; ?></p>'+

            '<p><?php echo $restaurante[1]["bio"]; ?></p>'+

            '<p><?php echo $restaurante[0]["calle"]; ?> <?php echo $restaurante[0]["numero"]; ?>, <?php echo $restaurante[0]["colonia"]; ?>, <?php echo $restaurante[0]["municipio"]; ?>, <?php echo $restaurante[0]["estado"]; ?>, C.P. <?php echo $restaurante[0]["cp"]; ?></p>'+

            '</div>'+

            '</div>';



        var infowindow_<?php echo $i; ?> = new google.maps.InfoWindow({

          content: contentString_<?php echo $i; ?>

        });


        /* genera un marcador nuevo para cada restaurante */
        var marker_<?php echo $i; ?> = new google.maps.Marker({position: {lat: <?php echo $restaurante[2]["lat"]; ?>, lng: <?php echo $restaurante[2]["lon"]; ?>}, map: map, title: "<?php echo $restaurante[0]["nombre"]; ?>" });


        /*Funcion para cuando le den click muestre el contenido de el puntero rojo */
        marker_<?php echo $i; ?>.addListener('click', function() {

          infowindow_<?php echo $i; ?>.open(map, marker_<?php echo $i; ?>);

        });



         <?php } ?>

      }



      function handleLocationError(browserHasGeolocation, infoWindow, pos) {

        infoWindow.setPosition(pos);

        infoWindow.setContent(browserHasGeolocation ?

                              'Error: Geolocalizacion fallo.' :

                              'Error: Tu navegador no soporta la tecnología.');

        infoWindow.open(map);

      }

    </script>


    <!-- Se llama la api de google con el id de l api resgistrada y se llama la funcion initMap -->

    <script async defer

    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1gbGBkvwpBepPC1zz9jhD0OnnwdlA-lQ&callback=initMap">

    </script>

    </div>



</div>







        </div>

      </div>

      </div>



    <!-- ////////////////////////////////////////////////////////////////////////////-->











    <footer class="footer fixed-bottom footer-static footer-light navbar-shadow">



      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Bienvenido <?php echo $_SESSION["nombre"]; ?> TU dirección ip es: <?php echo $_SERVER['REMOTE_ADDR']; ?></span>



        Los restaurantes cercanos a tu ubicación los puedes ver en el mapa de arriba 



      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Copyright  &copy; 2018 <i class="ft-heart pink"></i></span></p>



    </footer>







    <!-- BEGIN VENDOR JS-->



    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>



    <!-- BEGIN VENDOR JS-->



    <!-- BEGIN PAGE VENDOR JS-->



    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>



    <script src="../../../app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>



    <script src="../../../app-assets/vendors/js/charts/chartist.min.js"></script>



    <script src="../../../app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js"></script>



    <!-- END PAGE VENDOR JS-->



    <!-- BEGIN MODERN JS-->



    <script src="../../../app-assets/js/core/app-menu.js"></script>



    <script src="../../../app-assets/js/core/app.js"></script>



    <!-- END MODERN JS-->



    <!-- BEGIN PAGE LEVEL JS-->



    <script src="../../../app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>



    <script src="../../../app-assets/js/scripts/pages/dashboard-support.js"></script>



    <!-- END PAGE LEVEL JS-->



  </body>



</html>