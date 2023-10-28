<!DOCTYPE html>
<html>
<?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerVeterinaria.php');
        ?>
        <main >
            <h1>Editar Animal</h1>
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
                <div id="containerInputs" class="containerInputs">
                    <input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>" readonly>

                    <div class="col-lg-4 col-md-4 col-12">                                    
                        <h7 class="text-center">Esta en una protectora?</h7>
                        <br>
                        <select name="enProtectora" id="enProtectora">
                            <option value="0">No</option>
                            <?php
                                $nombreProtectora = "SELECT nombre, protectora_id FROM protectora";
                                $consultaNombreProtectora = mysqli_query($Sconexion, $nombreProtectora);
                                while($rowProtectora = mysqli_fetch_assoc($consultaNombreProtectora)) {

                                    $selected = $row['institucion'] == $rowProtectora['protectora_id'] ? "selected" : "";
                                    echo "
                                        <option value=".$rowProtectora["protectora_id"]." ".$selected.">".$rowProtectora["nombre"]."</option>
                                    ";
                                }
                            ?>
                        </select>    
                    </div>


                    <div id="duenio">
                        <label>DNI</label><br> 
                        <?php
                            
                            $consultaDni = "SELECT dni FROM personas WHERE persona_id = '".$row['persona_id']."'";
                            $resultadoDni = mysqli_query($Sconexion, $consultaDni); 
                            $rowDni = mysqli_fetch_assoc($resultadoDni)
                        ?>
                        <input value="<?php echo $rowDni['dni']?>" name="persona_id"> 
                        <div class="errorCampo" id="campoDni" name="campoDni">
                            El DNI no está cargado
                        </div>
                    </div>

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
						<label for="activo">Activo:</label>
						<select id="activo" name="activo">
							<option value="<?php echo $row['activo']?>"><?php echo $row['activo'] == 1 ? "Si" : "No"?></option>
							<option value="<?php echo $row['activo'] == 1 ? 0 : 1?>"><?php echo $row['activo'] == 1 ? "No" : "Si"?></option>	
						</select> 
						
					</div>
                    <div>
						<label for="">Observaciones:</label>
						<input value="<?php echo $row['observaciones']?>" name="observaciones"> 
						</label>
					</div>

                    <div>
                        <img src="<?php echo '../../fotos/animales/'.$row['foto'].'' ?>" style="width: 100px">
                        <input type="file" name="foto" accept="image/*">
                    </div>

                    <?php
                        foreach($json as $key=>$value) {
                            echo '
                                <div class="form-group">
                                    <label>'.$key.'</label>
                                    <input id="'.$key.'" class="form-control" type="date" value="'.$value.'" name="'.$key.'" />
                                    <button type="button" id="quitarViejo" onclick="sacar()" class="formboton">Quitar</button>
                                </div>
                            ';
                        }
                    ?>                   
                </div>
                <div class="containerInputs">
                    <div>
                        <input id="nuevo" value="" style="border-radius: 5px;">
                        <button id="agregar" type="button" class="formboton" onclick="">Agregar</button>
                    </div>

                    <button type="submit" name="guardar" class="formboton">Guardar</button>
                </div>
                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="buscarAnimal.php">Volver</a>
        </main>
    </body>
<!-- SCRIPT PARA AGREGAR HISTORIA CLINICA -->
    <script type="text/javascript" src="../../src/inputs.js"></script>
<!-- SCRIPT PARA ELIMINAR HISTORIA CLINICA -->
    <script> 
        function sacar () {
            event.preventDefault();
            event.target.parentElement.remove();
        }  
        const seleccionado = document.getElementById('enProtectora').value;
        if(seleccionado != 0) {
            document.getElementById('duenio').style.display = 'none';
        }
        window.onload = function enProtectora() {
                let seleccion = document.getElementById('enProtectora')
                seleccion.addEventListener("change", function mostrar(e){
                    e.preventDefault();
                    if(e.target.value != 0) {
                        document.getElementById('duenio').style.display = 'none'
                    }else {
                        document.getElementById('duenio').style.display = 'block'
                    }
                })
                }  
    </script>
    
        <?php
            include('../../componentes/footer.php');
            
        ?>
</html>

<?php
    $fotoAnimal = $row['foto'];
    if (isset($_POST['guardar'])) {
        
        $idPersona;
        $institucion = 0;
        function validar($conexion, &$num, &$inst) {

            
            if(empty($_POST['nombre'])) {
                echo '<script>
                        this.document.getElementById("campoNombre").style.display = "block";
                    </script>
                ';
                return false;
            }

            if($_POST["enProtectora"] == 0) {

                if(empty($_POST["persona_id"])){
                    echo '<script>
                            this.document.getElementById("campoDni").style.display = "block";
                        </script>
                    ';
                    return false;
                } else {
                    $verifica = "SELECT persona_id from personas WHERE dni = '".$_POST["persona_id"]."' ;";
                    $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta');
                    if(mysqli_num_rows($resultadoVerifica) > 0) {
                        $fila = mysqli_fetch_array($resultadoVerifica);
                        $num = $fila['persona_id'];
                        
                    } else {
                        echo '<script>
                                this.document.getElementById("campoDni").style.display = "block";
                            </script>
                        ';
                        return false;
                    }   
                }
            }else {
                $inst = $_POST["enProtectora"];
                $verifica = "SELECT id_persona FROM protectora WHERE protectora_id = '$inst'";
                $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta');
                $fila = mysqli_fetch_array($resultadoVerifica);
                $num = $fila['id_persona'];
            }
            return true;
        }

        
        $pasa = validar($Sconexion, $idPersona, $institucion);
        $datos = array_slice($_POST, 7, -1 );
        //var_dump($datos);
        $json = json_encode($datos);
        
        if($pasa) {

            if($_FILES['foto']['name'] == "") {
                $foto = $fotoAnimal;
            } else {
                $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
                $tmpNombre = $_FILES['foto']['tmp_name'];
                $destino = "../../fotos/animales/".$foto;
                move_uploaded_file($tmpNombre, $destino);
            }

            
            $consulta = "UPDATE animal SET 
            persona_id = '$idPersona',
            nombre = '".$_POST["nombre"]."',
            especie = '".$_POST["especie"]."',
            observaciones = '".$_POST['observaciones']."',
            clinica = '$json',
            institucion = '$institucion',
            activo = 1,
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
