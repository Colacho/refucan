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
                            <!-- Trae los datos a partir del id -->
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    
                                    $consulta = "SELECT personas.persona_id AS persona_id, personas.nombre AS nombre_persona, apellido, 
                                    veterinaria.nombre AS nombre_vete, profesional_id, profesional.veterinaria_id AS veterinaria_id, 
                                    profesional.matricula AS matricula, profesional.activo AS activo
                                    FROM personas
                                    JOIN profesional ON personas.persona_id = profesional.persona_id
                                    JOIN veterinaria ON profesional.veterinaria_id = veterinaria.veterinaria_id 
                                    WHERE profesional.profesional_id = '".$_POST['id']."'
                                    ";
                                    
                                    $resultado = mysqli_query($Sconexion, $consulta);     
                                }
                                $row = mysqli_fetch_assoc($resultado)
                                
                            ?>
                            <div class="custom-form contact-form bg-white shadow-lg"> 
                            <form method="POST">
                                <h2>Editar Profesional</h2>
                                <div class="row">
                                    <input style="display: none;" name="profesional_id"  value="<?Php echo $row['profesional_id'] ?>" readonly>
                                    <h3><?Php echo $row['nombre_persona']." ".$row['apellido'] ?></h3>
                                    <div>
                                        <label>Matricula:</label><br>
                                        <input value="<?php echo $row['matricula']?>" name="matricula" class="form-control">                      
                                    </div>
                                    <div class="errorCampo" id="campoMatricula">
                                            Ingrese una matricula
                                    </div>
                                    <div class="errorCampo" id="errordetipo" >
                                        Tipo de dato incorrecto
                                    </div>
                                    
                                    <div class="errorCampo" id="campoVeterinaria" >
                                        Ingrese una Veterinaria
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
                                </div>
                            </form>
                            <div class="row">
                                <form method="POST" action="editarPersona.php" >
                                    <input style="display: none;" name="persona_id"  value="<?Php echo $row['persona_id'] ?>" readonly>
                                    <button type="submit" name="datos_personales" class="form-control">Datos Personales</button>
                                </form>
                                <p></p>
                                <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
        <?php
            include('../../componentes/footer.php');
        ?>
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
            
        function validar () {

            if(empty($_POST["matricula"])){
                echo '<script>
                    this.document.getElementById("campoMatricula").style.display = "block";
                </script>
                ';
                return false;
            } else if(!is_numeric($_POST['matricula'])){
                echo '<script>
                    this.document.getElementById("campoMatricula").style.display = "block";
                </script>
                ';
                return false;
            }

            return true;
        }
        
        $pasa = validar();

        if($pasa) {

            $consulta = "UPDATE profesional SET 
            matricula = '".$_POST['matricula']."',
            activo = '".$_POST['activo']."'
            WHERE profesional_id = '".$_POST['profesional_id']."';
            ";
            
            $resultado = mysqli_query($Sconexion, $consulta) or die('Error de consulta guardar');
    
            echo '
            <script>
                window.location.replace("buscar.php");
            </script>
            '; 
        }

                
    }
               
?>