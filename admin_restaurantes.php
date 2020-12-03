<?php 
/*Incluye el header de la pagina*/
include("incl/header.php"); ?>





<?php 


/* consulta de base de datos a las tablas restaurantes, restaurantes_bio y restaurantes_meta*/
$consulta = "SELECT restaurantes.id, restaurantes.nombre, restaurantes.calle, restaurantes.numero, restaurantes.municipio, restaurantes_bio.web, restaurantes.estado, restaurantes_meta.categoria, restaurantes_meta.imagen, restaurantes_meta.fecha FROM restaurantes JOIN restaurantes_bio ON restaurantes.id =restaurantes_bio.id_rest JOIN restaurantes_meta ON restaurantes.id = restaurantes_meta.id_rest ORDER BY id DESC";




/* Prepara la consulta con la variable $bd que sale de conexion.php*/
$q = $bd->prepare($consulta);
/*ejecuta la consulta*/
$q->execute();
/* ordena las columas en un array alamcenados en una variable llamada $rs*/
$rs = $q->fetchAll();


/*Se genera un array para los meses y conseguir un formato de fecha mas entendible*/
    $losmeses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];



?>







        <div class="app-content content">



          <div class="content-wrapper">



            <div class="content-header row">



              <div class="content-header-left col-md-6 col-12 mb-2">



                <h3 class="content-header-title">Lista de restaurantes</h3>



                <div class="row breadcrumbs-top">



                  <div class="breadcrumb-wrapper col-12">



                    <ol class="breadcrumb">



                      <li class="breadcrumb-item"><a href="index.html">Inicio</a>



                      </li>



                      <li class="breadcrumb-item"><a href="#">Restaurantes</a>



                      </li>



                      <li class="breadcrumb-item active">Todos los restaurantes



                      </li>



                    </ol>



                  </div>



                </div>



              </div>



            </div>



            <div class="content-body"><div id="doctors-list">


<?php

if(!empty($_SESSION["msj"])){
            echo "<h5 class='text-danger' style='padding: 2%;background-color: #fff;'>".$_SESSION["msj"].", por favor ingrese una imagen con peso menor a 200mb</h5>";

}

$_SESSION["msj"] = "";

 ?>




        <div class="row match-height">



            <?php 


                /* ciclo for para mostrar los restaurantes, cuenta cuantos elementos existen en el array de $rs*/
                for($i = 0; $i< count($rs); $i++){






                    /*Se da formato a la fecha*/
                    $la_fecha_desde_bd  =  $rs[$i]["fecha"];



                    $fecha_correcta = date_create($la_fecha_desde_bd);



                    $dia_mes = date_format( $fecha_correcta  , "d" );



                    $mes_numerico = date_format( $fecha_correcta  , "n" );



                    $anio_actual = date_format( $fecha_correcta  , "Y" );



                    /*Se almancena los datos de los restaurantes en una matris que tiene 0 los datos de la direccion, 1 los datos de la bio y 2 los datos de la meta*/
                    $restaurante = array(

                        array('nombre' => $rs[$i]["nombre"], 'calle' => $rs[$i]["calle"], "numero" => $rs[$i]["numero"], "municipio" => $rs[$i]["municipio"], "estado" => $rs[$i]["estado"]), 

                            array('web' => $rs[$i]["web"]), 

                            array("catego" => $rs[$i]["categoria"])

                        );

                    if ($rs[$i]["imagen"] == null) {
                      $restaurante[2]["imagen"] = "../../../app-assets/images/logo/logo-dark.png";
                    }else{
                      $restaurante[2]["imagen"] = "../uploads/".$rs[$i]["imagen"];
                    }



             ?>





            <div class=" col-xl-3 col-lg-4 col-md-6">



                <div class="card">



                    <img src="<?php echo $restaurante[2]["imagen"]; ?>" alt="" class="card-img-top img-fluid rounded-circle w-25 mx-auto mt-1">



                    <div class="card-body">



                        <h6 class="card-title font-large-1 mb-0 text-center"><?php echo $restaurante[0]["nombre"]; ?></h6>



                        <a class="card-text card font-medium-1 text-center mb-0" href="<?php echo $restaurante[1]["web"]; ?>"><?php echo $restaurante[1]["web"]; ?></a>



                        <p class="card-text card font-medium-1 text-center mb-0"><?php echo $restaurante[2]["catego"]; ?></p>



                        <p class="font-small-3 mb-2 text-center">Creado desde <?php echo $dia_mes ."-" . $losmeses[$mes_numerico-1] . "-" . $anio_actual;; ?></p>



                        <p class="font-small-3 text-center"><i class="la la-map-marker"></i><?php echo $restaurante[0]["calle"]; ?> #<?php echo $restaurante[0]["numero"]; ?>, <?php echo $restaurante[0]["municipio"]; ?>, <?php echo $restaurante[0]["estado"]; ?></p>







                    </div>



                    <div class="card-footer mx-auto">



                        <a class="btn btn-outline-warning btn-sm" href="../restaurantes_admin/?id=<?php echo $rs[$i]["id"];?>"><i class="ft-edit text-warning"></i> Editar</a>



                        <button type="button" type="button" class="btn btn-outline-danger btn-sm ml-1" data-toggle="modal" data-target="#restaurante_<?php echo $rs[$i]["id"] ?>">



                                                    <i class="ft-trash-2 text-danger"></i> Borrar



                        </button>





                        <div class="modal fade text-left" id="restaurante_<?php echo $rs[$i]["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">



                            <div class="modal-dialog" role="document">



                                <div class="modal-content">



                                    <div class="modal-header">


                                         <!-- Para borrar un restaurante son dos pasos -->
                                        <h1 class="modal-title" id="myModalLabel27">Borrar Restaurante</h1>


                                         <!-- Mediante un modal se pregunta si esta seguro de borrar ese restaurante -->
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



                                          <span aria-hidden="true">&times;</span>



                                        </button>



                                    </div>


                                    <!-- Si le da en eliminar se manda a borrar_restaurante.php que lo elimina de la base de datos -->
                                    <form action="../incl/borrar_restaurante.php" method="POST">



                                      <div class="modal-body">







                                        <h1 class="modal-title" id="myModalLabel27">¿Seguro que quieres borrar el restaurante <?php echo $rs[$i]["nombre"]; ?>?</h1>



                                        <br>



                                        <input type="hidden" name="id" id="id" value="<?php echo $rs[$i]["id"] ?>">



                                      </div>



                                      <div class="modal-footer">



                                        <input type="reset" class="btn btn-outline-secondary btn-lg btn-info" data-dismiss="modal" value="Cerrar">



                                        <input type="submit" class="btn btn-outline-primary btn-lg btn-danger" value="Eliminar">



                                      </div>



                                    </form>



                                </div>



                            </div>



                        </div>



                    </div>



                </div>



            </div>



            <?php } ?>



        </div>



    </div>



            </div>



          </div>



        </div>



    <!-- ////////////////////////////////////////////////////////////////////////////-->







<?php include("incl/footer.php"); ?>