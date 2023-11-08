<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head2.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerUsuario.php');
            include('../../componentes/navbarUsuario.php');
        ?>
        <main>
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                                    <?php
                                        
                                        $consulta = "SELECT * FROM personas WHERE persona_id = $Spersona_id";

                                        $resultado = mysqli_query($Sconexion, $consulta);     
                                           
                                        $row = mysqli_fetch_assoc($resultado)
                                    ?>
                                <form method="POST" class="custom-form contact-form bg-white shadow-lg">
                                    <h2>Editar Persona</h2>
                                    <div class="row">   

                                        <div>
                                            <label>Nombre:</label><br>
                                                <input value="<?php echo $row['nombre']?>" name="nombre" class="form-control"> 
                                        </div>
                                            <div class="errorCampo" id="campoNombre" >
                                                Ingrese Nombre
                                        </div>    

                                        <div>
                                            <label>Apellido:</label><br>
                                            <input value="<?php echo $row['apellido']?>" name="apellido" class="form-control"> 
                                        </div>
                                        <div class="errorCampo" id="campoApellido" >
                                            Ingrese apellido
                                        </div>
                                        <div>
                                            <label>DNI:</label><br>
                                            <input value="<?php echo $row['dni']?>" name="dni" class="form-control"> 
                                            <div class="errorCampo" id="DNIcargado">
                                                El DNI ya existe
                                            </div>
                                            <div class="errorCampo" id="campoDni">
                                                Ingrese un DNI
                                            </div>
                                        </div>
                                        <div>
                                            <label>Telefono:</label><br>
                                            <input value="<?php echo $row['telefono']?>" name="telefono" class="form-control"> 
                                        </div>
                                        <div class="errorCampo" id="campoTelefono" >
                                                Ingrese un teléfono
                                        </div>

                                        <div>
                                            <input name="provinciaAnt" value="<?php echo $row['provincia']?>" readonly>
                                            <select id="provincia" name="provincia" class="form-select"></select>
                                            <input name="municipioAnt" value="<?php echo $row['municipio']?>" readonly>
                                            <select id="municipio" name="municipio" class="form-select"></select>
                                            <div class="errorCampo" id="campoMunicipio">
                                                Si modifica la provincia seleccione un municipio
                                            </div> 
                                        </div>
                                        <div>
                                            <label>Calle:</label><br>
                                            <input value="<?php echo $row['calle']?>" name="calle" class="form-control"> 
                                        </div>
                                        <div class="errorCampo" id="campoCalle">
                                            Ingrese una calle
                                        </div> 
                                        <div>
                                            <label>Número:</label><br>
                                            <input value="<?php echo $row['numero_dire']?>" name="numero_dire" class="form-control"> 
                                        </div>
                                        <div class="errorCampo" id="campoNumero_dire">
                                            Ingrese un número
                                        </div> 
                                        
                                        <p></p>
                                        <div>
                                            <img src="<?php echo '../../fotos/animales/'.$row['foto'].'' ?>" style="width: 100px">
                                            <input type="file" name="foto" accept="image/*" class="form-control">
                                        </div>
                                        <p></p>
                                        <div class="col-12">
                                            <button type="submit" name="guardar" class="form-control">Agregar Animal</button>
                                        </div>                            
                                        <p></p>
                                        <div class="col-12">
                                            <a class="form-control text-center" href="home.php">Volver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </main>

                      <!-- JAVASCRIPT FILES -->
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/jquery.sticky.js"></script>
        <script src="../../js/click-scroll.js"></script>
        <script src="../../js/custom.js"></script>
        
    </body>
    <!-- Script localidades -->
    <script src="../../src/localidades.js"></script>
        <?php
            include('../../componentes/footer.php');
        ?>
</html>

<?php
    
    //  Requerido para comprara en la funcion
    $dniAnt = $row['dni'];
    $provinciaAnt = $row['provincia'];
    $municipioAnt = $row['municipio'];
    

    if(isset($_POST['guardar'])){
        
        function validar($conexion, &$prov, &$mun, $dni) {

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

             if (!empty($_POST["dni"])){
                $consultaDni = "SELECT dni FROM personas WHERE dni = '".$_POST['dni']."'";
                $resultadoDni = mysqli_query($conexion, $consultaDni) or die('Error de consulta DNI');
                $rowDni = mysqli_fetch_assoc($resultadoDni);
                if(mysqli_num_rows($resultadoDni) > 0) {
                    if($rowDni['dni'] != $dni) {
                        echo '<script>
                        this.document.getElementById("DNIcargado").style.display = "block";
                        </script>
                        '; 
                    return false;
                    }
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

            if(empty($_POST["calle"])){
                echo '<script>
                    this.document.getElementById("campoCalle").style.display = "block";
                </script>
                ';
                return false;
            } else if(is_numeric($_POST['calle'])){
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
            } else if(!is_numeric($_POST['numero_dire'])){
                echo '<script>
                    this.document.getElementById("campoNumero_dire").style.display = "block";
                </script>
                ';
                return false;
            }

            if(($_POST["provincia"] == "provincia")){
                
                return true;
            } else {
                $prov = $_POST['provincia'];
                if($_POST["municipio"] == "municipio"){
                    echo '<script>
                        this.document.getElementById("campoMunicipio").style.display = "block";
                    </script>
                    ';
                    return false;
                } else {
                    $mun = $_POST['municipio'];
                    return true;
                }
                
            }
        }
        $pasa = validar($Sconexion, $provinciaAnt, $municipioAnt, $dniAnt);


        if($pasa) {

            $consulta = "UPDATE personas SET 
            nombre = '".$_POST['nombre']."',
            apellido = '".$_POST['apellido']."',
            dni = '".$_POST['dni']."',
            telefono = '".$_POST['telefono']."',
            provincia = '$provinciaAnt',
            municipio = '$municipioAnt',
            calle = '".$_POST['calle']."',
            numero_dire = '".$_POST['numero_dire']."',
            WHERE persona_id = '$Spersona_id';
            ";
            
            $resultado = mysqli_query($Sconexion, $consulta) or die('Error de consulta');

            echo '
            <script>
                window.location.replace("home.php");
            </script>
            '; 
        }

    }
?>