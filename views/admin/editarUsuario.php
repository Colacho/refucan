<!DOCTYPE html>
<html>
<?php
        include('../../componentes/head2.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerAdmin.php');
            include('../../componentes/navBarAdmin.php');
        ?>
        <main>
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <!-- Trae los datos a partir del id -->
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    
                                    $consulta = "SELECT usuarios.nombre AS nombre, correo, id_persona, usuarios.usuario_id AS usuario_id,
                                    usuarios.activo AS activo, usuarios.cargo_id AS cargo_id, cargos.nombre AS cargo
                                    FROM usuarios JOIN cargos ON usuarios.cargo_id = cargos.cargo_id
                                    WHERE usuario_id = '".$_POST['usuario_id']."'";
                                    $resultado = mysqli_query($Sconexion, $consulta);     
                                }
                                $row = mysqli_fetch_assoc($resultado);
                                ?>
                            <form method="POST" class="custom-form contact-form bg-white shadow-lg">
                                <h2>Editar Usuario</h2>
                                <div class="row">
                                    <input style="display: none;" name="usuario_id"  value="<?Php echo $row['usuario_id'] ?>" readonly>
                                    <input style="display: none;" name="id_persona"  value="<?Php echo $row['id_persona'] ?>" readonly>
                                    <div class="form-group">
                                        <label>Nombre:</label><br>
                                        <input value="<?php echo $row['nombre']?>" name="nombre" class="form-control"> 
                                    </div>
                                    <div class="errorCampo" id="campoNombre">
                                        Ingrese un nombre de usuario
                                    </div> 
                                    <div class="form-group">
                                        <label>Correo:</label><br>
                                        <input value="<?php echo $row['correo']?>" name="correo" class="form-control"> 
                                        <input style="display: none;" value="<?php echo $row['correo']?>" name="correoAnt"> 
                                    </div>
                                    <div class="errorCampo" id="campoCorreo">
                                        Ingrese un correo valido
                                    </div> 
                                    <div>
                                        <label>Password:</label><br>
                                        <input value="" name="pass" class="form-control"> 
                                    </div>
                                    <div>
                                        <label>Verifica Password:</label><br>
                                        <input value="" name="pass2" class="form-control"> 
                                    </div>
                                    <div class="errorCampo" id="campoPass">
                                        No coincide la contraseña
                                    </div> 

                                    <div class="form-group">
                                    <label for="cargo">Cargo</label>
                                    <select  name="cargo" class="form-select">
                                        <option value="<?php echo $row['cargo_id']?>"><?php echo $row['cargo']?></option>
                                        <?php 
                                            $cargos = "SELECT cargo_id, nombre FROM cargos";
                                            $consultaCargos = mysqli_query($Sconexion, $cargos);
                                            while($row_cargo = mysqli_fetch_assoc($consultaCargos)) {

                                                echo '
                                                <option value="'.$row_cargo['cargo_id'].'"> '.$row_cargo['nombre'].' </option>
                                                ';
                                            }
                                        ?>

                                    </select>
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
                                    <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
 
</html>

<?php
    
    

    if (isset($_POST['guardar'])) {
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaActual = date("Y-m-d");


       function validar ($conexion) {
           if(empty($_POST["nombre"])){
               echo '<script>
                   this.document.getElementById("campoNombre").style.display = "block";
               </script>
               ';
               return false;
           }
           if(empty($_POST["correo"])){
               echo '<script>
                   this.document.getElementById("campoCorreo").style.display = "block";
               </script>
               ';
               return false;
           } else {
                if($_POST["correo"] != $_POST["correoAnt"]){
                    
                    $verifica = "SELECT correo from usuarios WHERE correo = '".$_POST["correo"]."' ;";
                    $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta');
                    if(mysqli_num_rows($resultadoVerifica)>0) {
                        echo '<script>
                            this.document.getElementById("campoCorreo").style.display = "block";
                        </script>
                        ';
                        return false;
                    }
                }
           }


           if(!empty($_POST["pass"])){
                if($_POST["pass"] != $_POST["pass2"]) {

                    echo '<script>
                        this.document.getElementById("campoPass").style.display = "block";
                    </script>
                    ';
                    return false;
                }
           } 
            
           return true;
       }
        
       $pasa = validar($Sconexion);
    
        if($pasa) {
        
            if(!empty($_POST["pass"])) {

                $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT, ['cost'=>10]);
                $sql = "UPDATE usuarios SET 
                nombre = '".$_POST["nombre"]."',
                correo = '".$_POST["correo"]."',
                pass = '".$hash."', 
                activo = '".$_POST["activo"]."',
                cargo_id = '".$_POST["cargo"]."',
                id_persona = '".$_POST["id_persona"]."'
                WHERE usuario_id = '".$_POST['usuario_id']."';
                ";
                $guardar = mysqli_query($Sconexion, $sql) or die('Error de carga');   
                echo '
                    <script>
                        window.location.replace("home.php");
                    </script>
                '; 
            } else {

                $sql = "UPDATE usuarios SET 
                nombre = '".$_POST["nombre"]."',
                correo = '".$_POST["correo"]."',
                activo = '".$_POST["activo"]."',
                cargo_id = '".$_POST["cargo"]."',
                id_persona = '".$_POST["id_persona"]."'
                WHERE usuario_id = '".$_POST['usuario_id']."';
                ";
                
                $guardar = mysqli_query($Sconexion, $sql) or die('Error de carga');   
                echo '
                    <script>
                        window.location.replace("home.php");
                    </script>
                '; 
            } 

        }
        
        

        mysqli_close($Sconexion);
    }
?>