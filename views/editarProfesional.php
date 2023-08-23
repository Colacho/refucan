<!DOCTYPE html>
<html>
<?php
        include('../componentes/head.php')
    ?>
    <body>
        <?php
            include('../componentes/header.php');
            include('../componentes/navBar.php');
            ?>
        <main>
            <h1>Editar Profesional</h1>
            <!-- Trae los datos a partir del id -->
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    $consulta = "SELECT personas.persona_id AS persona_id, personas.nombre AS nombre_persona, apellido, 
                    veterinaria.nombre AS nombre_vete, profesional_id, profesional.veterinaria_id AS veterinaria_id, 
                    profesional.matricula AS matricula, profesional.activo AS activo_p
                    FROM personas
                    JOIN profesional ON personas.persona_id = profesional.persona_id
                    JOIN veterinaria ON profesional.veterinaria_id = veterinaria.veterinaria_id 
                    WHERE profesional.profesional_id = '".$_POST['id']."'
                    ";
                    
                    $resultado = mysqli_query($Sconexion, $consulta);     
                }
                $row = mysqli_fetch_assoc($resultado)
               
            ?>
            <form method="POST">
                <div>
                    <input style="display: none;" name="profesional_id"  value="<?Php echo $row['profesional_id'] ?>" readonly>
                    <h3><?Php echo $row['nombre_persona']." ".$row['apellido'] ?></h3>
                    <div>
                        <label>Matricula:</label><br>
                        <input style="display: none;" value="<?php echo $row['matricula']?>" name="matriculaAnt"> 
                        <input value="<?php echo $row['matricula']?>" name="matricula"> 
                        
                    </div>
                    
                    <div class="form-group">
                    <label for="veterinaria_id">Veterinaria</label>
                    <select  name="veterinaria_id">
                        <option value="<?php echo $row['veterinaria_id']?>"><?php echo $row['nombre_vete']?></option>
                        <?php 
                            $veterinarias = "SELECT veterinaria_id, nombre FROM veterinaria";
                            $consultaVeterinaria = mysqli_query($Sconexion, $veterinarias);
                            while($row_vete = mysqli_fetch_assoc($consultaVeterinaria)) {

                                echo '
                                <option value="'.$row_vete['veterinaria_id'].'"> '.$row_vete['nombre'].' </option>
                                ';
                            }
                        ?>

                    </select>
                </div>
                <div class="errorCampo" id="campoVeterinaria" >
                    Ingrese una Veterinaria
                </div>

                    <div>
						<label for="activo_p">Activo:</label>
						<select  name="activo_p">
							<option value="<?php echo $row['activo_p']?>"><?php echo $row['activo_p'] == 1 ? "Si" : "No"?></option>
							<option value="<?php echo $row['activo_p'] == 1 ? 0 : 1?>"><?php echo $row['activo_p'] == 1 ? "No" : "Si"?></option>	
						</select> 
						</label>
					</div>
                    <button type="submit" name="guardar" class="formboton">Guardar</button>
                </div>
            </form>
            <form method="POST" action="editarPersona.php">
            <input style="display: none;" name="persona_id"  value="<?Php echo $row['persona_id'] ?>" readonly>
                <button type="submit" name="datos_personales" class="formboton">Datos Personales</button>

            </form>

            <a href="../views/buscarProfesional.php"><button class="button">Volver</button></a>
        </main>
    </body>
</html>

<?php
    
    if(isset($_POST['datos_personales'])) {

        echo '
        <script>
            window.location.replace("../views/editarPersona.php");
        </script>
        '; 

    }
   
    
    if(isset($_POST['guardar'])){
        
        
        // Verifica si esta vacio el campo guarda los datos anteriores
        if (empty($_POST['matricula'])){
            $guardaMatricula = $_POST['matriculaAnt'];
        }  else {
            $guardaMatricula = $_POST['matricula'];
        }
        
        var_dump($guardaMatricula);
        

        $consulta = "UPDATE profesional SET 
        matricula = '$guardaMatricula',
        veterinaria_id = '".$_POST['veterinaria_id']."',
        activo = '".$_POST['activo_p']."'
        WHERE profesional_id = '".$_POST['profesional_id']."';
        ";
        
        $resultado = mysqli_query($Sconexion, $consulta) or die('Error de consulta guardar');

        echo '
        <script>
            window.location.replace("../views/buscar.php");
        </script>
        '; 
                
    }
               
?>