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
        <main>
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <?php
                                $consulta = "SELECT * FROM veterinaria WHERE veterinaria_id = $Sinstitucion_id";
                                $resultado = mysqli_query($Sconexion, $consulta);      
                                $row = mysqli_fetch_assoc($resultado)
                            ?>
                            <form method="POST" class="custom-form contact-form bg-white shadow-lg" enctype="multipart/form-data">
                                <h2>Editar Veterinaria</h2>
                                <div class="row">
                                    <input style="display: none;" name="veterinaria_id"  value="<?Php echo $row['veterinaria_id'] ?>" readonly>
                                    <div>
                                        <label>Nombre:</label><br>
                                        <input value="<?php echo $row['nombre']?>" name="nombre" class="form-control"> 
                                    </div>
                                    <div class="errorCampo" id="nombreCargado">
                                            Ese nombre ya existe
                                        </div> 

                                    <div>
                                        <label for="provincia">Provincia</label>
                                        <input name="provinciaAnt" value="<?php echo $row['provincia']?>" readonly>
                                        <select id="provincia" name="provincia" class="form-select"></select>
                                        
                                        <label for="municipio">Municipio</label>
                                        <input name="municipioAnt" value="<?php echo $row['municipio']?>" readonly>
                                        <select id="municipio" name="municipio" class="form-select"></select>
                                        <div class="errorCampo" id="campoMunicipio">
                                            Si modifica la provincia debe seleccionar un municipio
                                        </div> 
                                    </div>

                                    <div>
                                        <label>Calle:</label><br>
                                        <input value="<?php echo $row['calle']?>" name="calle" class="form-control"> 
                                    </div>
                                    <div>
                                        <label>Número:</label><br>
                                        <input value="<?php echo $row['numero_dire']?>" name="numero_dire" class="form-control"> 
                                    </div>
                                    <div>
                                        <label>Telefono:</label><br>
                                        <input value="<?php echo $row['telefono']?>" name="telefono" class="form-control"> 
                                    </div>
                                    <div>
                                        <label>Foto:</label><br>
                                        <img src="<?php echo '../fotos/veterinaria/'.$row['foto'].'' ?>">
                                        <input type="file" name="foto" value="<?Php echo $row['foto'] ?>" class="form-control-file" accept="image/*">
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
    <script src="../src/localidades.js"></script>
    <?php
            include('../../componentes/footer.php');
        ?>
</html>

<?php
    //  Requerido para comprara en la funcion
    //$guardaNombre = $row['nombre'];
    $provinciaAnt = $row['provincia'];
    $municipioAnt = $row['municipio'];
    $fotoVeterinaria = $row['foto'];
    
    if(isset($_POST['guardar'])){
        
        function validar(&$prov, &$mun) {

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
        $pasa = validar($provinciaAnt, $municipioAnt);
  
        if(empty($_FILES['foto']['name'])) {
            $foto = $fotoVeterinaria;
        } else {
            
            $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
            $tmpNombre = $_FILES['foto']['tmp_name'];
            $destino = "../fotos/veterinaria/".$foto;
            move_uploaded_file($tmpNombre, $destino);
        }
        
        if($pasa) {
            
            $consulta = "UPDATE veterinaria SET 
            nombre = '".$_POST['npmbre']."',
            provincia = '$provinciaAnt',
            municipio = '$municipioAnt',
            calle = '".$_POST['calle']."',
            numero_dire = '".$_POST['numero_dire']."',
            telefono = '".$_POST['telefono']."',
            foto = '$foto'
            WHERE veterinaria_id = '$Sinstitucion_id';
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