<?php 
/*Incluye el header de la pagina*/
include("incl/header.php"); ?>
<?php                

/*Si esta editando un usuario se hace una consulta para extraer datos de lo contrario se dejan los campos vacios*/
if(!isset($_GET["id"])){                        $nombre = "";                        $a_paterno = "";                        $a_materno = "";                        $email = "";                        $usuario = "";                        $ps = "";                        $admin ="";                        $pagina = "Agregar nuevo usuario";                        $url_editor = "../incl/nuevo_usuario.php";                } 
else{

	/*revisa el id de la tabla usuarios del usuario a editar          */      
	$id = $_GET["id"];
	/*Titulo de la pagina     */             
	$pagina = "Editar usuario";
	/*url del fomulario para editar un usuario           */      
	$url_editor = "../incl/editar_usuario.php";

	/* consulta de base de datos a las tablas usuarios y usuarios_meta   */            
	$consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.a_paterno, usuarios.a_materno, usuarios.correo, usuarios.usuario, usuarios.pass, usuarios_meta.fecha, usuarios_meta.admin FROM usuarios INNER JOIN usuarios_meta ON usuarios.id=usuarios_meta.user_id WHERE usuarios.id = '$id' ORDER BY id DESC";                  
	/* Prepara la consulta con la variable $bd que sale de conexion.php*/
	$q = $bd->prepare($consulta);  
	/* ejecuta la consulta        */        
	$q->execute();    

/* ordena las columas en un array alamcenados en una variable llamada $rs        */      
	$rs = $q->fetchAll();                  

	$nombre = $rs[0]["nombre"];                  $a_paterno = $rs[0]["a_paterno"];                  $a_materno = $rs[0]["a_materno"];                  $email = $rs[0]["correo"];                  $usuario = $rs[0]["usuario"];                  $ps = $rs[0]["pass"];                  $admin = $rs[0]["admin"];                }?>        


	<div class="app-content content">          <div class="content-wrapper">            <div class="content-header row">              <div class="content-header-left col-md-6 col-12 mb-2">                <h3 class="content-header-title"><?php echo $pagina; ?></h3>                <div class="row breadcrumbs-top">                  <div class="breadcrumb-wrapper col-12">                    <ol class="breadcrumb">                      <li class="breadcrumb-item"><a href="../">Inicio</a>                      </li>                      <li class="breadcrumb-item"><a href="#">Usuarios</a>                      </li>                      <li class="breadcrumb-item active"><?php echo $pagina; ?>                      </li>                    </ol>                  </div>                </div>              </div>            </div>

<?php

if(isset($_GET["error"])){

        $error = $_GET["error"];
        $sql_duplicado = "SQLSTATE[23000]";

        if (strpos($error, $sql_duplicado)) {
            echo "<h5 class='text-danger' style='padding: 2%;background-color: #fff;'>Ese usuario ya existe,el correo y nombre de usuario no pueden ser iguales, por favor ingresa otro nombre de usuario y correo electronico</h5>";
        } else{
            echo "<h5 class='text-danger' style='padding: 2%;background-color: #fff;'>Ocurrio un error</h5><script> console.log('".$_GET["error"]."')</script>";
        }



}

 ?>

	            <div class="content-body"><!-- List Of All Patients -->    <section id="basic-form-layouts">          <div class="row justify-content-md-center">            <div class="col-md-6">              <div class="card">                <div class="card-content collapse show">                  <div class="card-body">                    <form class="form" action="<?php echo $url_editor; ?>" method="POST">                      <div class="form-body">                        <div class="form-group">                          <label for="nombre">Nombre</label>                          <input type="text" id="nombre" class="form-control" placeholder="" name="nombre" value="<?php  echo $nombre; ?>" required>                        </div>                        <div class="form-group">                          <label for="a_paterno">Apellido paterno</label>                          <input type="text" id="a_paterno" class="form-control" placeholder="" name="a_paterno" value="<?php  echo $a_paterno; ?>">                        </div>                        <div class="form-group">                          <label for="a_materno">Apellido materno</label>                          <input type="text" id="a_materno" class="form-control" placeholder="" name="a_materno" value="<?php  echo $a_materno; ?>">                        </div>                        <div class="form-group">                          <label for="email">Email</label>                          <input type="email" id="email" class="form-control" placeholder="" name="email" value="<?php  echo $email; ?>" required>                        </div>                        <div class="form-group">                          <label for="usuario">Nombre de usuario</label>                          <input type="text" id="usuario" class="form-control" placeholder="" name="usuario" value="<?php  echo $usuario; ?>" required>                        </div>                        <div class="form-group">                          <label for="ps">Contraseña</label>                          <input type="password" id="ps" class="form-control"  name="ps" value="<?php  echo $ps; ?>" required onkeyup='check();'>                        </div>                        <div class="form-group">                          <label for="ps_2">Repite la contraseña</label>                          <input type="password" id="ps_2" class="form-control" " name="ps_2" value="<?php  echo $ps; ?>" required onkeyup='check();'>                          <span id='message'></span>                        </div>                                               
  <!-- Funcion de javascript check() para verificar que se esta confirmando el pasword de manera correcta -->
	 <script type="text/javascript">                            
	 	/*Se compara que los dos inputs ps y ps_2 sean iguales*/
	 	var check = function() {                              if (document.getElementById('ps').value ==                                document.getElementById('ps_2').value) {                                document.getElementById('message').style.color = 'green';                                document.getElementById('message').innerHTML = '<i class="la la-check-circle-o"></i> Las contraseñas son iguales';                              } else {                                document.getElementById('message').style.color = 'red';                                document.getElementById('message').innerHTML = '<i class="la la-times-circle"></i> Las contraseñas no son iguales';                              }                            }                        </script>

	                        <div class="form-group">                          <label>¿Es administrador?</label>                          <div class="input-group">                            <div class="d-inline-block custom-control custom-radio mr-1">                                                 <script type="text/javascript">                                                  function quitar_si(){                                                    document.getElementById("no").removeAttribute("checked");                                                  }                                                  function quitar_no(){                                                    document.getElementById("si").removeAttribute("checked");                                                  }                                                                                                  </script>                                                 <input type="radio" name="admin" class="custom-control-input" id="si"value="1" <?php if($admin == 1){ ?>checked="checked" <?php } ?> onclick="quitar_no()">                                                    <label class="custom-control-label" for="si" onclick="quitar_si()">Si</label>                                                </div>                                                <div class="d-inline-block custom-control custom-radio">                                                    <input type="radio" name="admin" class="custom-control-input" id="no"value="0" <?php if($admin == 0){ ?>checked="checked" <?php } ?> onclick="quitar_si()">                                                    <label class="custom-control-label" for="no" onclick="quitar_no()">No</label>                                                </div>                          </div>                        </div>                        <?php if($pagina == "Editar usuario") {?>                         <input type="hidden" name="id" id="id" value="<?php  echo $id; ?>">                         <?php } ?>                      </div>                      <div class="form-actions center">                        <button type="button" class="btn btn-warning mr-1">                          <i class="ft-x"></i> Cancelar                        </button>                        <button type="submit" class="btn btn-primary">                          <i class="la la-check-square-o"></i> Guardar                        </button>                      </div>                    </form>                  </div>                </div>              </div>            </div>          </div>    </section>            </div>          </div>        </div>    <!-- ////////////////////////////////////////////////////////////////////////////--><?php include("incl/footer.php"); ?>