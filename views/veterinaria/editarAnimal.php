<!DOCTYPE html>
<html>
<?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerAdmin.php');
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
            <form method="POST">
                <div id="containerInputs" class="containerInputs">
                    <input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>" readonly>

                    <div>
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
                    <?php
                        foreach($json as $key=>$value) {
                            echo '

                            

                                <div class="form-group">
                                    <label>'.$key.'</label>
                                    
                                    <input id="'.$key.'" class="form-control" type="date" value="'.$value.'" name="'.$key.'" />
                                    <button id="quitar"  class="formboton" >Quitar</button>

                                </div>
                            ';
                        }
                    ?>
                 
                    
                    
                </div>
                <div class="containerInputs">
                    <div>
                        <input id="nuevo" value="" style="border-radius: 5px;">
                        <button id="agregar" class="formboton" onclick="">Agregar</button>
                    </div>

                    <button type="submit" name="guardar" class="formboton">Guardar</button>
                </div>
                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="buscarAnimal.php">Volver</a>
        </main>
    </body>
    <script type="text/javascript" src="../../src/inputs.js">
        const f = document.getElementById("quitar")
        console.log(f)
        

    </script>
    
        <?php
            include('../../componentes/footer.php');
            
        ?>
</html>

<?php
    if (isset($_POST['guardar'])) {
        
        $idPersona;
        function validar($conexion, &$num) {

            
            if(empty($_POST['nombre'])) {
                echo '<script>
                        this.document.getElementById("campoNombre").style.display = "block";
                    </script>
                ';
                return false;
            }

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
            return true;
        }

        
        $pasa = validar($Sconexion, $idPersona);
        $datos = array_slice($_POST, 5, -1 );
        
        if($pasa) {
            $json = json_encode($datos);
            
            $consulta = "UPDATE animal SET 
            persona_id = '$idPersona',
            nombre = '".$_POST["nombre"]."',
            especie = '".$_POST["especie"]."',
            observaciones = '".$_POST['observaciones']."',
            clinica = '$json',
            activo = 1
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
<!-- <script>
    const btn_agregar = document.getElementById('crear');
btn_agregar.addEventListener('click', function(e){
    e.preventDefault();
    
    const nuevo = document.getElementById('nuevo').value;

    if(nuevo == "") {
        return;
    } else {

        const container = document.getElementById('containerIn');
    
        const div = document.createElement('div');
        div.setAttribute('class', 'form-group');
    
        const label = document.createElement('label');
        label.setAttribute('for', nuevo);
        label.innerHTML = nuevo;
    
        const input = document.createElement('input');
        input.setAttribute('name', nuevo);
        input.setAttribute('class', 'form-control');
        input.setAttribute('type', 'date');
    
        const btn = document.createElement('button');
        btn.setAttribute('id', 'quitar');
        btn.setAttribute('class', 'formboton');
        btn.setAttribute('style', 'margin: 5px')
        btn.addEventListener('click', eliminar)
        btn.innerHTML = 'Quitar';
    
    
        div.appendChild(label);
        div.appendChild(input);
        div.appendChild(btn);
        
        container.appendChild(div);
    }

    
    //console.log("anda");

});

function eliminar (e) {
    e.preventDefault();
    console.log(e.target.parentElement.remove());
}
</script> -->