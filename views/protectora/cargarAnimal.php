<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerProtectora.php');
        ?>
        <main>
            <h1>Carga de Animales</h1>

            <form id="formCarga" action="" method="POST" enctype="multipart/form-data">
               
                    
                    <div class="form-group">
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
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre del animal</label>
                        <input type="text" name="nombre" class="form-control"
                        value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoNombre" >
                        Complete el campo
                    </div>

                    
                    <div class="form-group">
                        <label for="observaciones">observaciones</label>
                        <input type="text" name="observaciones" id="observaciones" class="form-control"
                        value="<?php if (isset($_POST['observaciones'])) echo $_POST['observaciones'];?>"
                        >
                    </div>
                
                    
                    <div class="col-lg-4 col-md-4 col-12">  
                        <input type="file" name="foto" id="imagen" class="form-control-file custom-file-input" accept="image/*">
                    </div>
                    
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
        </main>

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
                window.location.replace("cargar.php");
            </script>
       '; 
       mysqli_close($Sconexion);
    }
?>
