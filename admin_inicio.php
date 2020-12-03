<?php 
//Incluye el header de la pagina
include("incl/header.php"); ?>



<?php






/* consulta de base de datos a las tablas usuarios y usuarios_meta*/
    $consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.a_paterno, usuarios.correo, usuarios.usuario, usuarios_meta.fecha FROM usuarios INNER JOIN usuarios_meta ON usuarios.id=usuarios_meta.user_id ORDER BY id DESC LIMIT 5";






/* Prepara la consulta con la variable $bd que sale de conexion.php*/
    $q = $bd->prepare($consulta);


/* ejecuta la consulta */
    $q->execute();





/* ordena las columas en un array alamcenados en una variable llamada $rs*/


    $rs = $q->fetchAll();





/*Se genera un array para los meses y conseguir un formato de fecha mas entendible*/


    $losmeses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];




/* consulta de base de datos a las tablas restaurantes, restaurantes_bio y restaurantes_meta*/
   $consulta2 = "SELECT restaurantes.id, restaurantes.nombre, restaurantes.calle, restaurantes.numero, restaurantes.municipio, restaurantes_bio.web, restaurantes.estado, restaurantes_meta.categoria, restaurantes_meta.imagen, restaurantes_meta.fecha FROM restaurantes JOIN restaurantes_bio ON restaurantes.id =restaurantes_bio.id_rest JOIN restaurantes_meta ON restaurantes.id = restaurantes_meta.id_rest ORDER BY id DESC LIMIT 5";






/* Prepara la consulta con la variable $bd que sale de conexion.php*/

    $q2 = $bd->prepare($consulta2);

/* ejecuta la consulta */


    $q2->execute();






/* ordena las columas en un array alamcenados en una variable llamada $rs2*/

    $rs2 = $q2->fetchAll();





 ?>







    <div class="app-content content">



      <div class="content-wrapper">



        <div class="content-header row">



        </div>



        <div class="content-body"><!-- Hospital Info cards -->



<!-- Hospital Info cards Ends -->







<!-- Appointment Table -->



<div class="row match-height">



  <div class="col-12 col-md-4">



    <div class="card">



      <div class="card-header">



        <h4 class="card-title">Restaurantes recientemente agregados</h4>



      </div>



      <div class="card-content">



        <div class="table-responsive">



          <table id="recent-orders" class="table table-hover table-xl mb-0">



          <tbody>



            <?php 


                /* ciclo for para mostrar los restaurantes, cuenta cuantos elementos existen en el array de $rs2 */

                for($i = 0; $i< count($rs2); $i++){







                    $la_fecha_desde_bd  =  $rs2[$i]["fecha"];



                    $fecha_correcta = date_create($la_fecha_desde_bd);



                    $dia_mes = date_format( $fecha_correcta  , "d" );



                    $mes_numerico = date_format( $fecha_correcta  , "n" );



                    $anio_actual = date_format( $fecha_correcta  , "Y" );


                    /*Se almancena los datos de los restaurantes en una matris que tiene 0 los datos de la direccion, 1 los datos de la bio y 2 los datos de la meta*/

                    $restaurante = array(

                        array('nombre' => $rs2[$i]["nombre"], 'calle' => $rs2[$i]["calle"], "numero" => $rs2[$i]["numero"], "municipio" => $rs2[$i]["municipio"], "estado" => $rs2[$i]["estado"]), 

                            array('web' => $rs2[$i]["web"]), 

                            array("catego" => $rs2[$i]["categoria"])

                        );

                    if ($rs2[$i]["imagen"] == null) {
                      $restaurante[2]["imagen"] = "../../../app-assets/images/logo/logo-dark.png";
                    }else{
                      $restaurante[2]["imagen"] = "../uploads/".$rs2[$i]["imagen"];
                    }



             ?>



            <tr>



              <td class="text-truncate p-1 border-top-0">



                <div class="avatar avatar-md">



                  <img class="media-object rounded-circle" src="<?php echo $restaurante[2]["imagen"]; ?>"



                    alt="Avatar">



                </div>



              </td>



              <td class="text-truncate pl-0 border-top-0">



                <div class="name"><?php echo $restaurante[0]["nombre"]; ?></div>



                <div class="designation text-light font-small-2"><?php echo $restaurante[1]["web"]; ?></div>



              </td>



              <td class="text-right border-top-0">



                <div class="designation text-light font-small-2"><?php echo $restaurante[2]["catego"]; ?></div>



                <div class="designation text-light font-small-2">Creado desde <?php echo $dia_mes ."-" . $losmeses[$mes_numerico-1] . "-" . $anio_actual;; ?></div>



              </td>



            </tr>



          <?php } ?>



          </tbody>



          </table>



        </div>



      </div>



    </div>



  </div>



  <div id="recent-appointments" class="col-12 col-md-8">



    <div class="card">



      <div class="card-header">



        <h4 class="card-title">Usuarios Recientes</h4>



        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>



        <div class="heading-elements">



          <ul class="list-inline mb-0">



            <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="usuarios"



                target="_blank">Ver todos</a></li>



          </ul>



        </div>



      </div>



      <div class="card-content mt-1">



        <div class="table-responsive">



            <table id="recent-orders-doctors" class="table table-hover table-xl mb-0">



                <thead>



                  <tr>



                      <th>Nombre</th>



                      <th>Apellido Paterno</th>



                      <th>Correo</th>



                      <th>Usuario</th>



                      <th>Fecha de creación</th>



                  </tr>



                </thead>



                <tbody>



                  <?php 


/* ciclo for para mostrar los usuarios, cuenta cuantos elementos existen en el array de $rs*/
                      for($i = 0; $i< count($rs); $i++){






                                            /*Se da formato a la fecha*/

                          $la_fecha_desde_bd  =  $rs[$i]["fecha"];



                          $fecha_correcta = date_create($la_fecha_desde_bd);







                          $dia_mes = date_format( $fecha_correcta  , "d" );



                          $mes_numerico = date_format( $fecha_correcta  , "n" );



                          $anio_actual = date_format( $fecha_correcta  , "Y" );



                   ?>



            <tr class="pull-up">



              <td class="text-truncate"><?php echo $rs[$i]["nombre"] ?></td>



              <td class="text-truncate"><?php echo $rs[$i]["a_paterno"] ?></td>



              <td class="text-truncate"><?php echo $rs[$i]["correo"] ?></td>



              <td class="text-truncate"><?php echo $rs[$i]["usuario"] ?></td>



              <td class="text-truncate"><?php 



                  



                  echo $dia_mes ."-" . $losmeses[$mes_numerico-1] . "-" . $anio_actual; ?>



                  



              </td>



            </tr>



          <?php } ?>



              </tbody>



            </table>



        </div>



      </div>



    </div>



  </div>



</div>



<!-- Appointment Table Ends -->



        </div>



      </div>



    </div>



    <!-- ////////////////////////////////////////////////////////////////////////////-->



<?php include("incl/footer.php"); ?>



