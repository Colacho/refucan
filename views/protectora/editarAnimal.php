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
        <main >
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                        <!-- Trae los datos a partir del id -->
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                               
                                
                                $consulta = "SELECT * FROM animal WHERE animal_id = '".$_POST['animal_id']."'";
                                $resultado = mysqli_query($Sconexion, $consulta);     
                            }
                            $row = mysqli_fetch_assoc($resultado);
                            $json = json_decode($row['clinica']);
                        ?>

                        <form method="POST"  class="custom-form contact-form bg-white shadow-lg" enctype="multipart/form-data">
                                <h2>Editar Animal</h2>
                                <div class="row">
                                    <input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>" readonly>

                                <div>
                                        <label>Nombre:</label><br>
                                        <input value="<?php echo $row['nombre']?>" name="nombre" class="form-control"> 
                                    </div>
                                    <div class="errorCampo" id="campoNombre" >
                                        Complete el campo
                                </div>

                               <div class="form-group">
                                        <label for="especie">Seleccione especie</label>
                                        <select id="especie" name="especie" class="form-select">
                                            <?php
                                                $especieConsulta = "SELECT nombre FROM especies";
                                                $resultadoEspeie = mysqli_query($Sconexion, $especieConsulta);
                                                while($rowEspecie = mysqli_fetch_assoc($resultadoEspeie)){
                                                    if ($rowEspecie["nombre"] == $row['especie']) {
                                                        echo "<option value=".$rowEspecie["nombre"]." selected>".$rowEspecie["nombre"]."</option>";
                                                    }else {
                                                        echo "<option value=".$rowEspecie["nombre"].">".$rowEspecie["nombre"]."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
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

<?php
    $fotoAnimal = $row['foto'];
    if (isset($_POST['guardar'])) {
        
       
        function validar() {

            
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
            $foto = $fotoAnimal;
        } else {
            $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
            $tmpNombre = $_FILES['foto']['tmp_name'];
            $destino = "../../fotos/animales/".$foto;
            move_uploaded_file($tmpNombre, $destino);
        }
        
        if($pasa) {
             
            $consulta = "UPDATE animal SET 
            nombre = '".$_POST["nombre"]."',
            especie = '".$_POST["especie"]."',
            foto = '$foto'
            WHERE animal_id = '".$_POST["animal_id"]."';
            ";
                
            
            $resultado = mysqli_query($Sconexion, $consulta) or die(mysqli_error($Sconexion));
    
            echo '
            <script>
                window.location.replace("buscar.php");
            </script>
            '; 

        } 
        mysqli_close($Sconexion);
    } 

?>
