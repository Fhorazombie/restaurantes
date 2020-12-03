<?php 
/*Incluye el header de la pagina*/
include("incl/header.php"); ?>



<?php


/*Si esta editando un restaurante se hace una consulta para extraer datos de lo contrario se dejan los campos vacios*/
if(!isset($_GET["id"])){



        $restaurante = array("id" => "", 'nombre' => "", 'calle' => "", "numero" => "", "colonia" => "", "municipio" => "", "estado" => "", "cp" => "",'correo' => "", 'web' => "", "telefono" => "", "bio" => "", 'lat' => "20.484708", "lon" => "-97.398905", "catego" => "", "imagen" => "" );


/*Titulo de la pagina  */
        $pagina = "Agregar nuevo restaurante";


/*url del fomulario para agregar nuevo restaurante*/
        $url_editor = "../incl/nuevo_restaurante.php";



        $zoom = 12;



} else{


/*revisa el id de la tabla restaurante del restaurante a editar */
  $id = $_GET["id"];


/*Titulo de la pagina */
  $pagina = "Editar restaurante";


/*url del fomulario para editar un restaurante*/
  $url_editor = "../incl/editar_restaurante.php";



  $zoom = 18;



  $consulta = "SELECT restaurantes.id, restaurantes.nombre, restaurantes.calle, restaurantes.numero, restaurantes.colonia, restaurantes.municipio, restaurantes.estado, restaurantes.c_p, restaurantes_bio.correo, restaurantes_bio.web, restaurantes_bio.telefono, restaurantes_bio.bio, restaurantes_meta.lat, restaurantes_meta.lon, restaurantes_meta.categoria, restaurantes_meta.imagen FROM restaurantes JOIN restaurantes_bio ON restaurantes.id =restaurantes_bio.id_rest JOIN restaurantes_meta ON restaurantes.id = restaurantes_meta.id_rest WHERE restaurantes.id = '$id' ORDER BY id DESC";



/* Prepara la consulta con la variable $bd que sale de conexion.php*/

  $q = $bd->prepare($consulta);
/* ejecuta la consulta        */    
  $q->execute();

/* ordena las columas en un array alamcenados en una variable llamada $rs        */     
  $rs = $q->fetchAll();


 /*Se almancena los datos de los restaurantes en una matris que tiene 0 los datos de la direccion, 1 los datos de la bio y 2 los datos de la meta*/

  $restaurante = array("id" => $rs[0]["id"],'nombre' => $rs[0]["nombre"], 'calle' => $rs[0]["calle"], "numero" => $rs[0]["numero"], "colonia" => $rs[0]["colonia"], "municipio" => $rs[0]["municipio"], "estado" => $rs[0]["estado"], "cp" => $rs[0]["c_p"],'correo' => $rs[0]["correo"], 'web' => $rs[0]["web"], "telefono" => $rs[0]["telefono"], "bio" => $rs[0]["bio"], 'lat' => $rs[0]["lat"], "lon" => $rs[0]["lon"], "catego" => $rs[0]["categoria"], "imagen" => $rs[0]["imagen"] );



}



?>







        <div class="app-content content">



          <div class="content-wrapper">



            <div class="content-header row">



              <div class="content-header-left col-md-6 col-12 mb-2">



                <h3 class="content-header-title"><?php echo $pagina; ?></h3>



                <div class="row breadcrumbs-top">



                  <div class="breadcrumb-wrapper col-12">



                    <ol class="breadcrumb">



                      <li class="breadcrumb-item"><a href="index.html">Inicio</a>



                      </li>



                      <li class="breadcrumb-item"><a href="#">Restaurantes</a>



                      </li>



                      <li class="breadcrumb-item active"><?php echo $pagina; ?>



                      </li>



                    </ol>



                  </div>



                </div>



              </div>



            </div>



            <div class="content-body"><!-- List Of All Patients -->



<?php

if(isset($_GET["error"])){


        $error = $_GET["error"];
        $sql_duplicado = "SQLSTATE[23000]";

        if (strpos($error, $sql_duplicado)) {
            echo "<h5 class='text-danger'>Ese usuario ya existe por favor ingresa otro nombre de usuario y correo electronico</h5>";
        } else{
            echo "<h5 class='text-danger'>Ocurrio un error</h5><script> console.log('".$_GET["error"]."')</script>";
        }

}


?>



    <section id="basic-form-layouts">



            <div class="row match-height">



    <div class="col-md-12">



      <div class="card">



        <div class="card-content collapse show">



          <div class="card-body">







            <form class="form" method="POST" action="<?php echo $url_editor; ?>" enctype="multipart/form-data">



              <div class="row">



                <div class="col-md-5">



                <?php 

                /*Si el restaurante tiene una imagen la presenta*/
                if ($restaurante["imagen"] != "") { ?>



                  <img src="../uploads/<?php echo $restaurante["imagen"]; ?>" alt="Holi" class="rounded img-fluid align-center mr-2 mb-1" width="400" height="300" data-action="zoom" style="

    text-align: center;

    margin: auto !important;

    width: 50%;

    display: block;

    max-width: 50%;

">



                <?php } ?>



                <input type="hidden" id="id" name="id" value="<?php echo $restaurante["id"]; ?>">



                  <div class="form-body">



                  	<h4 class="form-section"><i class="la la-cutlery"></i>Nombre</h4>



                  	<div class="row">



                  	  <div class="col-12">



                  	    <div class="form-group">



                  	      <input type="text" id="nombre" name="nombre" class="form-control border-primary" value="<?php echo $restaurante["nombre"]; ?>" required>



                  	    </div>



                  	  </div>



                  	</div>



                    <h4 class="form-section"><i class="la la-map-marker"></i> Dirección</h4>



                    <div class="row">



                      <div class="col-md-6">



                        <div class="form-group">



                          <label for="calle">Calle</label>



                          <input type="text" id="calle" name="calle" class="form-control border-primary" value="<?php echo $restaurante["calle"]; ?>" required>



                        </div>



                      </div>



                      <div class="col-md-6">



                        <div class="form-group">



                          <label for="numero">Numero</label>



                          <input type="text" id="numero" name="numero" class="form-control border-primary" value="<?php echo $restaurante["numero"]; ?>" required>



                        </div>



                      </div>



                    </div>



                    <div class="row">



                      <div class="col-md-6">



                        <div class="form-group">



                          <label for="colonia">Colonia</label>



                          <input type="text" id="colonia" name="colonia" class="form-control border-primary" value="<?php echo $restaurante["colonia"]; ?>" required>



                        </div>



                      </div>



                      <div class="col-md-6">



                        <div class="form-group">



                          <label for="municipio">Municipio</label>



                          <input type="text" id="municipio" name="municipio" class="form-control border-primary" value="<?php echo $restaurante["municipio"]; ?>" required>



                        </div>



                      </div>



                    </div>



                    <div class="row">



                      <div class="col-md-6">



                        <div class="form-group">



                          <label for="estado">Estado</label>



                          <input type="text" id="estado" name="estado" class="form-control border-primary" value="<?php echo $restaurante["estado"]; ?>" required>



                        </div>



                      </div>



                      <div class="col-md-6">



                        <div class="form-group">



                          <label for="cp">Código postal</label>



                          <input type="number" id="cp" name="cp" class="form-control border-primary" value="<?php echo $restaurante["cp"]; ?>" required>



                        </div>



                      </div>



                    </div>







                    <h4 class="form-section"><i class="ft-mail"></i> Contacto</h4>







                    <div class="form-group">



                      <label for="correo">Email</label>



                      <input type="email" id="correo" name="correo" class="form-control border-primary" value="<?php echo $restaurante["correo"]; ?>">



                    </div>







                    <div class="form-group">



                      <label for="web">Pagina web</label>



                      <input type="text" id="web" name="web" class="form-control border-primary" value="<?php echo $restaurante["web"]; ?>">



                    </div>







                    <div class="form-group">



                      <label for="telefono">Teléfono</label>



                      <input type="tel" id="telefono" name="telefono" class="form-control border-primary" value="<?php echo $restaurante["telefono"]; ?>">



                    </div>







                    <div class="form-group">



                      <label for="bio">Bio</label>



                      <textarea id="bio" rows="5" class="form-control border-primary" name="bio"><?php echo $restaurante["bio"]; ?></textarea>



                    </div>





                    <div class="form-group">



                      <label for="catego">Categoria</label>



                      <select class="select2 form-control" name="catego">

                      	<optgroup label="Veracruz" >

                      		<option value="Poza rica">Poza rica</option>

                      		<option value="Papantla">Papantla</option>

                      	</optgroup>

                      </select>



                    </div>







                    <div class="form-group">



                      <div class="custom-file">



                                  <input type="file" class="custom-file-input" id="imagen" name="imagen">



                                  <label class="custom-file-label" for="inputGroupFile01">Imagen</label>



                              </div>



                            </div>





                    <input type="hidden" id="lat" name="lat" value="<?php echo $restaurante["lat"]; ?>">



                    <input type="hidden" id="lon" name="lon" value="<?php echo $restaurante["lon"]; ?>">







                  </div>



                </div>







                <div class="col-md-7">



                  <style type="text/css">

                    #map {

                        width: 100%;

                    height: 70vh;

                    }

                  </style>



                    <div id="map"></div>



                  <script>

                    var map;

                    /* funcion inicial de google maps initMap()*/
                    function initMap() {

                      /* se genera el mapa en el Div con identificador "map"*/
                      map = new google.maps.Map(document.getElementById('map'), {

                        center: {lat: <?php echo $restaurante["lat"]; ?>, lng: <?php echo $restaurante["lon"]; ?>},

                        zoom: <?php echo $zoom; ?>,

                        zoomControl: true,

                        mapTypeControl: false,

                        scaleControl: true,

                        streetViewControl: false,

                        rotateControl: false,

                        fullscreenControl: false

                      });


                      /*Se genera un marcador para arrastrar y crear la direccion y el posiscionamiento del restaurante*/
                    var marker = new google.maps.Marker(

                    {position: {lat: <?php echo $restaurante["lat"]; ?>, lng: <?php echo $restaurante["lon"]; ?>},

                        map:map,

                        draggable:true,

                        animation: google.maps.Animation.DROP}

                    );


                    /*Funcion cuando se suelte el puntero rojo, pone en los inputs lat y lon la latitud y longitud donde callo el puntero rojo*/
                    google.maps.event.addListener(marker, 'dragend', function(event) 

                    {

                        geocodePosition(marker.getPosition());

                        document.getElementById("lat").value = event.latLng.lat();

                       document.getElementById("lon").value = event.latLng.lng();

                    });


                    /*Funcion para generar los campos de la direccion*/
                    function geocodePosition(pos) 

                    {

                       geocoder = new google.maps.Geocoder();

                       geocoder.geocode

                        ({

                            latLng: pos

                        }, 

                            function(results, status) 

                            {

                                if (status == google.maps.GeocoderStatus.OK) 

                                {

                                    document.getElementById("numero").value = results[0].address_components[0]["long_name"];

                                    document.getElementById("calle").value = results[0].address_components[1]["long_name"];

                                    document.getElementById("colonia").value = results[0].address_components[2]["long_name"];

                                    document.getElementById("municipio").value = results[0].address_components[3]["long_name"];

                                    document.getElementById("estado").value = results[0].address_components[4]["long_name"];

                                    document.getElementById("cp").value = results[0].address_components[6]["long_name"];

                                    console.log(results[0]);

                                } 

                                else 

                                {

                                    console.log('Cannot determine address at this location.'+status);

                                }

                            }

                        );

                    }

                  }

                  </script>

                  <!-- Se llama la api de google con el id de l api resgistrada y se llama la funcion initMap -->
                  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1gbGBkvwpBepPC1zz9jhD0OnnwdlA-lQ&callback=initMap"

                      async defer></script>



                </div>



              </div>



              <div class="form-actions right">



                <button type="button" class="btn btn-warning mr-1">



                  <i class="ft-x"></i> Cancelar



                </button>



                <button type="submit" class="btn btn-primary">



                  <i class="la la-check-square-o"></i> Guardar



                </button>



              </div>



            </form>







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



<?php include("incl/footer.php"); ?>