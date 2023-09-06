<!DOCTYPE html>
<html>
<?php
        include('../componentes/head.php')
    ?>
    <body>
        <?php
            include('../componentes/header.php');
        ?>
        <main>
            <h1>Editar Protectora</h1>
            <!-- Trae los datos a partir del id -->
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                   
                    $consulta = "SELECT * FROM protectora WHERE protectora_id = '".$_POST['protectora_id']."'";
                    $resultado = mysqli_query($Sconexion, $consulta);     
                }
                $row = mysqli_fetch_assoc($resultado)
            ?>
            <form method="POST" enctype="multipart/form-data">
                <div>
                    <input style="display: none;" name="protectora_id"  value="<?Php echo $row['protectora_id'] ?>" readonly>
                    <div>
                        <label>Nombre:</label><br>
                        <input value="<?php echo $row['nombre']?>" name="nombre"> 
                    </div>

                    <div>
                        <label for="provincia">Provincia</label>
                        <input name="provinciaAnt" value="<?php echo $row['provincia']?>" readonly>
                        <select id="provincia" name="provincia"></select>
                        
                        <label for="municipio">Municipio</label>
                        <input name="municipioAnt" value="<?php echo $row['municipio']?>" readonly>
                        <select id="municipio" name="municipio"></select>
                        <div class="errorCampo" id="campoMunicipio">
                            Si modifica la provincia debe seleccionar un municipio
                        </div> 
                    </div>

                    <div>
                        <label>Calle:</label><br>
                        <input value="<?php echo $row['calle']?>" name="calle"> 
                    </div>
                    <div>
                        <label>Número:</label><br>
                        <input value="<?php echo $row['numero_dire']?>" name="numero_dire"> 
                    </div>
                    
                    <div>
                        <label>Foto:</label><br>
                        <img src="<?php echo '../fotos/protectora/'.$row['foto'].'' ?>">
                        <input type="file" name="foto" value="<?Php echo $row['foto'] ?>" class="form-control-file" accept="image/*">
                    </div>
                    
                    <div>
                        <label>Responsable:</label><br> 
                        <?php
                            $consultaDni = "SELECT dni FROM personas WHERE persona_id = '".$row['id_persona']."'";
                            $resultadoDni = mysqli_query($Sconexion, $consultaDni); 
                            $rowDni = mysqli_fetch_assoc($resultadoDni)
                        ?>
                        <input value="<?php echo $rowDni['dni']?>" name="dni"> 
                        <div class="errorCampo" id="DNIcargado">
                            El DNI no está cargado
                        </div>
                    </div>
                    <div>
						<label for="activo">Activo:</label>
						<select id="activo" name="activo">
							<option value="<?php echo $row['activo']?>"><?php echo $row['activo'] == 1 ? "Si" : "No"?></option>
							<option value="<?php echo $row['activo'] == 1 ? 0 : 1?>"><?php echo $row['activo'] == 1 ? "No" : "Si"?></option>	
						</select> 
						</label>
					</div>
                    <button type="submit" name="guardar" class="formboton">Guardar</button>
                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>
        </main>
    </body>
     <!-- Script localidades -->
    <script src="../src/localidades.js"></script>
</html>

<?php
    $nombreAnt = $row['nombre'];
    $provinciaAnt = $row['provincia'];
    $municipioAnt = $row['municipio'];
    $calleAnt = $row['calle'];
    $numeroAnt = $row['numero_dire'];
    $fotoProtectora = $row['foto'];
    $dniAnt = $row['id_persona'];
    
    if(isset($_POST['guardar'])){
        
        function validar(&$prov, &$mun) {
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

        
        $consultaDni = "SELECT persona_id FROM personas WHERE dni = '".$_POST['dni']."'";
        $resultadoDni = mysqli_query($Sconexion, $consultaDni) or die('Error de consulta DNI');
        $rowDni = mysqli_fetch_assoc($resultadoDni);
        if(mysqli_num_rows($resultadoDni) > 0) {
            $guardaDni = $rowDni['persona_id'];
            } else {
            $pasa = false;
            echo '<script>
                this.document.getElementById("DNIcargado").style.display = "block";
            </script>
            '; 
        }  
// Verifica si esta vacio el campo guarda los datos anteriores
        if(empty($_POST['nombre'])) {
            $guardaNombre = $nombreAnt;
        } else {
            $guardaNombre = $_POST['nombre'];
        }
        
        if(empty($_POST['calle'])) {
            $guardaCalle = $calleAnt;
        } else {
            $guardaCalle = $_POST['calle'];
        }
        if(empty($_POST['numero_dire'])) {
            $guardaNumero = $numeroAnt;
        } else {
            $guardaNumero = $_POST['numero_dire'];
        }
         
        if(empty($_FILES['foto']['name'])) {
            $foto = $fotoProtectora;
        } else {
            
            $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
            $tmpNombre = $_FILES['foto']['tmp_name'];
            $destino = "../fotos/protectora/".$foto;
            move_uploaded_file($tmpNombre, $destino);
        }
        
        if($pasa) {
            
            $consulta = "UPDATE protectora SET 
            nombre = '$guardaNombre',
            provincia = '$provinciaAnt',
            municipio = '$municipioAnt',
            calle = '$guardaCalle',
            numero_dire = '$guardaNumero',
            activo = '".$_POST['activo']."',
            id_persona = '$guardaDni',
            foto = '$foto'
            WHERE protectora_id = '".$_POST['protectora_id']."';
            ";
            
            $resultado = mysqli_query($Sconexion, $consulta) or die('Error de consulta Guarda');

            echo '
            <script>
                window.location.replace("../views/buscar.php");
            </script>
            '; 
        }
    }
?>