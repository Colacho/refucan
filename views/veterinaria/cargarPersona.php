<!DOCTYPE html>
<html>
<?php
    include('../../componentes/head.php')
?>
    <body>
<?php
    include('../../componentes/headerVeterinaria.php');
    include('../../componentes/navBarVeterinaria.php');
    
?>
<nav class="navbar navbar-expand-lg">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="../views/admin/home.php" class="navbar-brand mx-auto mx-lg-0">
                    <img class="logo" src="../../images/logo.jpg"/>
                    <span class="brand-text">Refucan</span>
                </a>

                <form action="../../src/logout.php" method="POST">
                
                    <button type="submit" name="logout" class="nav-link custom-btn btn d-lg-none">Log Out</button>
                </form>
                


                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">

                            <form action="../../src/logout.php" method="POST">
                                <button type="submit" name="logout" class="nav-link custom-btn btn d-none d-lg-block">Log Out</button>
                            </form>
                            
                        </li>
                    </ul>
                <div>
                        
            </div>
        </nav>
        <main>
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <form class="custom-form contact-form bg-white shadow-lg" id="formulario" method="POST">
                                <h2>Carga de Personas</h2>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control"
                                        value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"          
                                        >
                                    </div>
                                    <div class="errorCampo" id="campoNombre" >
                                        Ingrese Nombre
                                    </div>
                                    <div class="errorCampo" id="errordetipo" >
                                    Tipo de dato incorrecto
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input name="apellido" id="apellido" class="form-control"
                                        value="<?php if (isset($_POST['apellido'])) echo $_POST['apellido'];?>"
                                        >
                                    </div>
                                    <div class="errorCampo" id="campoApellido" >
                                        Ingrese apellido
                                    </div>
                                    <div class="errorCampo" id="errordetipo" >
                                    Tipo de dato incorrecto
                                    </div>
                                    <div class="form-group">
                                        <label for="dni">Documento</label>
                                        <input type="text" name="dni" id="dni" class="form-control"
                                        value="<?php if (isset($_POST['dni'])) echo $_POST['dni'];?>"
                                        >
                                    </div>
                                    <div class="errorCampo" id="campoDni" >
                                        Ingrese un documento
                                    </div>
                                    <div class="errorCampo" id="DNIcargado">
                                        El DNI ya está cargado
                                    </div>
                                    <div class="errorCampo" id="errordetipo" >
                                    Tipo de dato incorrecto
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control"
                                        value="<?php if (isset($_POST['telefono'])) echo $_POST['telefono'];?>"
                                        >
                                    </div>
                                    <div class="errorCampo" id="campoTelefono" >
                                            Ingrese un teléfono
                                    </div>
                                    <div class="errorCampo" id="errordetipo" >
                                    Tipo de dato incorrecto
                                    </div>
                                    <div class="form-group">
                                        <select id="provincia" name="provincia" class="form-select">
                                            <option value="<?php if (isset($_POST['provincia'])) echo $_POST['provincia'];?>">Seleccione una provincia</option>
                                        </select>
                                        <div class="errorCampo" id="campoProvincia">
                                            Selecione una Provincia
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <select id="municipio" name="municipio" class="form-select">
                                            <option value="<?php if (isset($_POST['municipio'])) echo $_POST['municipio'];?>">Seleccione una localidad</option>
                                        </select>
                                        <div class="errorCampo" id="campoMunicipio">
                                            Selecione una Localidad
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label for="calle">Calle</label>
                                        <input type="text" name="calle" id="calle" class="form-control"
                                        value="<?php if (isset($_POST['calle'])) echo $_POST['calle'];?>"
                                        >
                                    </div>
                                    <div class="errorCampo" id="campoCalle">
                                        Ingrese una calle
                                    </div> 
                    
                                    <div class="form-group">
                                        <label for="numero_dire">Número</label>
                                        <input type="text" name="numero_dire" id="numero_dire" class="form-control"
                                        value="<?php if (isset($_POST['numero_dire'])) echo $_POST['numero_dire'];?>"
                                        >
                                    </div>
                                    <div class="errorCampo" id="campoNumero_dire">
                                        Ingrese un número
                                    </div> 
                                    <div class="errorCampo" id="errordetipo" >
                                    Tipo de dato incorrecto
                                    </div>
                                    
                                    <div>
                                        <button type="submit" name="cargarPersona" class="form-control">Agregar Persona</button>
                                    </div>
                                    <p></p>
                                    <a class="btn btn-light border-dark btn-lg" type="button" href="cargar.php">Volver</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
    <!-- Script localidades -->
    <script src="../../src/localidades.js"></script>
    <?php
        include('../../componentes/footer.php');
    ?>
    </html>
    
    <?php
    
    if (isset($_POST['cargarPersona'])) {
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaActual = date("Y-m-d");


       function validar ($conexion) {
           if(empty($_POST["nombre"])){
               echo '<script>
                   this.document.getElementById("campoNombre").style.display = "block";
               </script>
               ';
               return false;
           } else if(is_numeric($_POST['nombre'])){
                echo '<script>
                    this.document.getElementById("campoNombre").style.display = "block";
                </script>
                ';
                return false;
            }
           if(empty($_POST["apellido"])){
            echo '<script>
                this.document.getElementById("campoApellido").style.display = "block";
            </script>
            ';
            return false;
            } else if(is_numeric($_POST['apellido'])){
                echo '<script>
                    this.document.getElementById("campoApellido").style.display = "block";
                </script>
                ';
                return false;
            }
            if(empty($_POST["dni"])){
                echo '<script>
                    this.document.getElementById("campoDni").style.display = "block";
                </script>
                ';
                return false;
            } else if(!is_numeric($_POST['dni'])){
                echo '<script>
                    this.document.getElementById("campoDni").style.display = "block";
                </script>
                ';
                return false;
            }
            if(!empty($_POST["dni"])){
                  
                $verifica = "SELECT dni from personas WHERE dni = '".$_POST["dni"]."' ;";
                $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta');
                if(mysqli_num_rows($resultadoVerifica)>0) {
                    echo '<script>
                        this.document.getElementById("DNIcargado").style.display = "block";
                    </script>
                    ';
                    return false;
                }
            }
            if(empty($_POST["telefono"])){
                echo '<script>
                    this.document.getElementById("campoTelefono").style.display = "block";
                </script>
                ';
                return false;
            } else if(!is_numeric($_POST['telefono'])){
                echo '<script>
                    this.document.getElementById("campoTelefono").style.display = "block";
                </script>
                ';
                return false;
            }
            if($_POST["provincia"] == "provincia"){
                echo '<script>
                    this.document.getElementById("campoProvincia").style.display = "block";
                </script>
                ';
                return false;
            }
            if($_POST["municipio"] == "municipio"){
                echo '<script>
                    this.document.getElementById("campoMunicipio").style.display = "block";
                </script>
                ';
                return false;
            }
            if(empty($_POST["calle"])){
                echo '<script>
                    this.document.getElementById("campoCalle").style.display = "block";
                </script>
                ';
                return false;
            }else if(is_numeric($_POST['calle'])){
                echo '<script>
                    this.document.getElementById("campoCalle").style.display = "block";
                </script>
                ';
                return false;
            }
            if(empty($_POST["numero_dire"])){
                echo '<script>
                    this.document.getElementById("campoNumero_dire").style.display = "block";
                </script>
                ';
                return false;
            }else if(!is_numeric($_POST['numero_dire'])){
                echo '<script>
                    this.document.getElementById("campoNumero_dire").style.display = "block";
                </script>
                ';
                return false;
            }

           return true;
       }
        
       $pasa = validar($Sconexion);
    
       if($pasa) {
           $sql = "INSERT INTO personas (nombre, apellido, dni, telefono, provincia, municipio, calle, numero_dire)
           VALUES (
                       '".$_POST["nombre"]."',
                       '".$_POST["apellido"]."',
                       '".$_POST["dni"]."', 
                       '".$_POST["telefono"]."',
                       '".$_POST["provincia"]."',
                       '".$_POST["municipio"]."',
                       '".$_POST["calle"]."',
                       '".$_POST["numero_dire"]."'
                   );";
            $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta');   
            echo '
                <script>
                    window.location.replace("home.php");
                </script>
                '; 
        }  
        mysqli_close($Sconexion);
    }
?>