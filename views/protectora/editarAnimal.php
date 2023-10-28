<!DOCTYPE html>
<html>
<?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerProtectora.php');
        ?>
        <main >
            <h1>Editar Persona</h1>
            <!-- Trae los datos a partir del id -->
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                   
                    
                    $consulta = "SELECT * FROM animal WHERE animal_id = '".$_POST['animal_id']."'";

                    $resultado = mysqli_query($Sconexion, $consulta);     
                }
                $row = mysqli_fetch_assoc($resultado);
                $json = json_decode($row['clinica']);
                
            ?>
            <form method="POST" enctype="multipart/form-data">
                
                    <input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>" readonly>

                    <div>
                        <label>Nombre:</label><br>
                        <input value="<?php echo $row['nombre']?>" name="nombre"> 
                    </div>
                    <div class="errorCampo" id="campoNombre" >
                        Complete el campo
                    </div>
                    <div class="form-group">
                        <label for="especie">Seleccione especie</label>
                        <select id="especie" name="especie" class="form-select">
                            <option value="<?php echo $row['especie']?>" selected><?php echo $row['especie']?></option>
                            <option value="Canino">Canino</option>
                            <option value="Felino">Felino</option>
                            <option value="Equino">Equino</option>
                            <option value="Bovino">Bovino</option>
                        </select>
                    </div>
                    <div>
                    <?php
                        foreach($json as $key=>$value) {
                            echo '
                                <div class="form-group">
                                    <label>'.$key.'</label>
                                    <input id="'.$key.'" class="form-control" type="date" value="'.$value.'" name="'.$key.'" />
                                    
                                </div>
                            ';
                        }
                    ?>
                    </div>

                <div>
                    <img src="<?php echo '../../fotos/animales/'.$row['foto'].'' ?>" style="width: 100px">
                    <input type="file" name="foto" accept="image/*">
                </div>
                
                <button type="submit" name="guardar" class="formboton">Guardar</button>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="buscarAnimal.php">Volver</a>
        </main>
    </body>
   
    <?php
        include('../../componentes/footer.php');
        
    ?>
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
