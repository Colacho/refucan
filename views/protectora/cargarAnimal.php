<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head2.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerProtectora.php');
            include('../../componentes/navBarProtectora.php');
        ?>
        <main>
        <section class="contact-animal section-padding" id="volver">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">      
                            <form class="custom-form contact-form bg-white shadow-lg" id="formCarga" action="" method="POST" enctype="multipart/form-data">                     
                                <h2>Carga de Animales</h2>

                                <div class="row">  

                                <div class="form-group">
                                        <select id="especie" name="especie" class="form-control">
                                            <?php
                                                    $especieConsulta = "SELECT nombre FROM especies";
                                                    $resultadoEspeie = mysqli_query($Sconexion, $especieConsulta);
                                                    while($rowEspecie = mysqli_fetch_assoc($resultadoEspeie)){
                                                    echo "
                                                        <option value=".$rowEspecie["nombre"].">".$rowEspecie["nombre"]."</option>
                                                    ";
                                                    }
                                            ?>
                                        </select>

                                    <div class="errorCampo" id="campoEspecie" >
                                        Seleccione una opción
                                    </div>
                                </div>

                            <!--    <div>
                                    <label for="especie">Seleccione especie</label>
                                    <select id="especie" name="especie" class="form-select">
                                        <option value="<?php if (isset($_POST['especie'])) echo $_POST['especie']; else echo " ";?>">
                                        <?php if (isset($_POST['especie'])) echo $_POST['especie']; else echo "Seleccione una opción";?>
                                    </option>
                                        <option value="Canino">Canino</option>
                                        <option value="Felino">Felino</option>
                                        <option value="Equino">Equino</option>
                                        <option value="Bovino">Bovino</option>
                                    </select>
                                </div>
                                <div class="errorCampo" id="campoEspecie" >
                                    Seleccione una opción
                                </div> -->

                                <div class="col-lg-4 col-md-4 col-12">
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del animal"
                                    value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                                    >
                                </div>
                                <div class="errorCampo" id="campoNombre" >
                                    Complete el campo
                                </div>

                                
                                   <div class="col-12">
                                        <textarea class="form-control" rows="5" id="message" name="message" placeholder="Observaciones"><?php if (isset($_POST['observaciones'])) echo $_POST['observaciones'];?></textarea>
                                    </div>
                            
                                
                                <div class="col-lg-4 col-md-4 col-12">  
                                    <input type="file" name="foto" id="imagen" class="form-control-file custom-file-input" accept="image/*">
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
                        </form>
        </main>

        <!-- JAVASCRIPT FILES -->
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/jquery.sticky.js"></script>
        <script src="../../js/click-scroll.js"></script>
        <script src="../../js/custom.js"></script>

        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
</html>

                        
                            
                       
<!--------------------------------------- CONSULTA --------------------------------------->
<?php
    if (isset($_POST['guardar'])) {
        
        function validar() {

            if($_POST['especie'] == " ") {
                echo '<script>
                        this.document.getElementById("campoEspecie").style.display = "block";
                    </script>
                ';
                return false;
            }
            if(empty($_POST['nombre'])) {
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

            return true;
        }

        $pasa = validar();
        
        if($_FILES['foto']['name'] == "") {
            $foto = "animalDefault.png";
        } else {
            $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
            $tmpNombre = $_FILES['foto']['tmp_name'];
            $destino = "../../fotos/animales/".$foto;
            move_uploaded_file($tmpNombre, $destino);
        }


       $sql = "INSERT INTO animal (persona_id, nombre, especie, institucion, activo, foto) 
       values(
        '$Spersona_id',
        '".$_POST["nombre"]."',
        '".$_POST["especie"]."',
        '$Sinstitucion_id',
         1,
         '$foto'
       
       )";

       $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta');
        
       echo '
            <script>
                window.location.replace("home.php");
            </script>
       '; 
       mysqli_close($Sconexion);
    }
?>
