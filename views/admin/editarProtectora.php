<!DOCTYPE html>
<html>
<?php
        include('../../componentes/head2.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerAdmin.php');
        ?>
        <main>
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <!-- Trae los datos a partir del id -->
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    
                                    $consulta = "SELECT * FROM protectora WHERE protectora_id = '".$_POST['protectora_id']."'";
                                    $resultado = mysqli_query($Sconexion, $consulta);     
                                }
                                $row = mysqli_fetch_assoc($resultado)
                                ?>
                            <form method="POST" class="custom-form contact-form bg-white shadow-lg" enctype="multipart/form-data">
                                <h2>Editar Protectora</h2>
                                <div class="row">
                                    <input style="display: none;" name="protectora_id"  value="<?Php echo $row['protectora_id'] ?>" readonly>
                                    <div>
                                        <label>Nombre:</label><br>
                                        <input value="<?php echo $row['nombre']?>" name="nombre" class="form-control"> 
                                    </div>
                                    <div class="errorCampo" id="campoNombre">
                                            Ingrese un nombre
                                    </div>
                                    <div class="form-group">
                                        <label for="provincia">Provincia</label>
                                        <input name="provinciaAnt" value="<?php echo $row['provincia']?>" class="form-control" readonly>
                                        <select id="provincia" name="provincia" class="form-select"></select>
                                    </div>
                                    <p></p>
                                    <div class="form-group">    
                                        <label for="municipio">Municipio</label>
                                        <input name="municipioAnt" value="<?php echo $row['municipio']?>" class="form-control" readonly>
                                        <select id="municipio" name="municipio" class="form-select"></select>
                                        <div class="errorCampo" id="campoMunicipio">
                                            Si modifica la provincia debe seleccionar un municipio
                                        </div> 
                                    </div>
                                    <div>
                                        <label for="telefono">Telefono</label>
                                        <input name="telefono" value="<?php echo $row['telefono']?>" class="form-control">
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
                                            Ingrese un numero de direccion
                                    </div>
                                    <div>
                                        <label>Foto:</label><br>
                                        <img src="<?php echo '../../fotos/protectora/'.$row['foto'].'' ?>">
                                        <input type="file" name="foto" value="<?Php echo $row['foto'] ?>" class="form-control-file" accept="image/*" >
                                    </div>
                                    
                                    <div>
                                        <label>Responsable:</label><br> 
                                        <?php
                                            $consultaDni = "SELECT dni FROM personas WHERE persona_id = '".$row['id_persona']."'";
                                            $resultadoDni = mysqli_query($Sconexion, $consultaDni); 
                                            $rowDni = mysqli_fetch_assoc($resultadoDni)
                                        ?>
                                        <input value="<?php echo $rowDni['dni']?>" name="dni" class="form-control"> 
                                        <div class="errorCampo" id="campoDni">
                                            Ingrese un DNI
                                        </div>
                                        <div class="errorCampo" id="DNIcargado">
                                            El DNI no está cargado
                                        </div>
                                    </div>
                                    <div>
                                        <label for="activo">Activo:</label>
                                        <select id="activo" name="activo" class="form-select">
                                            <option value="<?php echo $row['activo']?>"><?php echo $row['activo'] == 1 ? "Si" : "No"?></option>
                                            <option value="<?php echo $row['activo'] == 1 ? 0 : 1?>"><?php echo $row['activo'] == 1 ? "No" : "Si"?></option>	
                                        </select> 
                                        </label>
                                    </div>
                                    <button type="submit" name="guardar" class="form-control">Guardar</button>
                                    <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>
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
    
    $provinciaAnt = $row['provincia'];
    $municipioAnt = $row['municipio'];
    
    $fotoProtectora = $row['foto'];
    $idPersona = $row['id_persona'];
    
    if(isset($_POST['guardar'])){
        
        function validar($conexion, &$prov, &$mun, &$dni) {

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
                $consultaDni = "SELECT persona_id, dni FROM personas WHERE dni = '".$_POST['dni']."'";
                $resultadoDni = mysqli_query($conexion, $consultaDni) or die('Error de consulta DNI');
                $rowDni = mysqli_fetch_assoc($resultadoDni);
                if(mysqli_num_rows($resultadoDni) > 0) {
                    $dni = $rowDni['persona_id'];
                    
                } else {
                    echo '<script>
                        this.document.getElementById("DNIcargado").style.display = "block";
                    </script>
                    '; 
                    return false;
                }
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
        $pasa = validar($Sconexion, $provinciaAnt, $municipioAnt, $idPersona);
  
// Verifica si esta vacio el campo guarda los datos anteriores
        
        if(empty($_FILES['foto']['name'])) {
            $foto = $fotoProtectora;
        } else {
            
            $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
            $tmpNombre = $_FILES['foto']['tmp_name'];
            $destino = "../../fotos/protectora/".$foto;
            move_uploaded_file($tmpNombre, $destino);
        }
        
        if($pasa) {
            
            $consulta = "UPDATE protectora SET 
            nombre = '".$_POST['nombre']."',
            provincia = '$provinciaAnt',
            municipio = '$municipioAnt',
            calle = '".$_POST['calle']."',
            numero_dire = '".$_POST['numero_dire']."',
            telefono = '".$_POST['telefono']."',
            activo = '".$_POST['activo']."',
            id_persona = '$idPersona',
            foto = '$foto'
            WHERE protectora_id = '".$_POST['protectora_id']."';
            ";
            
            $resultado = mysqli_query($Sconexion, $consulta) or die('Error de consulta Guarda');

            echo '
            <script>
                window.location.replace("home.php");
            </script>
            '; 
        }
    }
?>