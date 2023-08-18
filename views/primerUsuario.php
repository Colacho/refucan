<!DOCTYPE html>
<html>
    <?php
    $conexion = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
    $cantidadUsuarios = "SELECT COUNT(usuario_id) AS cantidad FROM usuarios";
    $resultadoCantidad = mysqli_query($conexion, $cantidadUsuarios);
    $fila = mysqli_fetch_array($resultadoCantidad);

    if($fila['cantidad'] > 0) {
        echo '
            <script>
                window.location.replace("../views/login.php");
            </script>
        '; 
    }
        include('../componentes/head.php')
    ?>
    <body>
        
        <main>
            <h1>Carga de primer usuario</h1>
            <form id="formulario" method="POST" class="my-form">
                
                <div class="form-group">
                    <label for="nombre">Nombre de usuario</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                    value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                    >
                </div>
                <div class="errorCampo" id="campoNombre" >
                    Ingrese Nombre
                </div>

                <div class="form-group">
                    <label for="correo">Email</label>
                    <input name="correo" id="correo" class="form-control"
                    value="<?php if (isset($_POST['correo'])) echo $_POST['correo'];?>"
                    >
                </div>
                <div class="errorCampo" id="campoCorreo" >
                    Ingrese un email
                </div>

                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="text" name="pass" id="pass" class="form-control"
                    value="<?php if (isset($_POST['pass'])) echo $_POST['pass'];?>"
                    >
                </div>
                <div class="errorCampo" id="campoPass" >
                    Ingrese una contraseña
                </div>

                <div class="form-group">
                    <label for="dni">Documento</label>
                    <input type="text" name="dni" id="dni" class="form-control"
                    value="<?php if (isset($_POST['dni'])) echo $_POST['dni'];?>"
                    >
                </div>
                <div class="errorCampo" id="campoDni" >
                    Ingrese un documento
                </div>
                <div class="errorCampo" id="DNIcargado">
                    El DNI no está cargado
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <select id="cargo" name="cargo" disabled>
                        <option value="1">Administrador</option>
                    </select>
                </div>
                <div class="errorCampo" id="campoCargo" >
                        Seleccione un cargo
                </div>
                <button type="submit" name="cargarUsuario" class="formboton">Agregar Usuario</button>
            </form>
            <a href="../views/home.php"><button class="button">Volver</button></a>
        </main>
    </body>
</html>
<?php
    
    if (isset($_POST['cargarUsuario'])) {
        
        $idPersona;

        function validar ($con, &$num) {
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
            }
            if(empty($_POST["pass"])){
                echo '<script>
                    this.document.getElementById("campoPass").style.display = "block";
                    </script>
                ';
                return false;
            }
            if(empty($_POST["dni"])){
                echo '<script>
                    this.document.getElementById("campoDni").style.display = "block";
                    </script>
                ';
                return false;
            }
            if(!empty($_POST["dni"])){
                
                $verifica = "SELECT persona_id from personas WHERE dni = '".$_POST["dni"]."' ;";
                $resultadoVerifica = mysqli_query($con, $verifica) or die('Error de consulta');
                if(mysqli_num_rows($resultadoVerifica) > 0) {
                $fila = mysqli_fetch_array($resultadoVerifica);
                $num = $fila['persona_id'];
                } else {
                    echo '<script>
                        this.document.getElementById("DNIcargado").style.display = "block";
                    </script>
                    ';
                    return false;
                }
            }
            

            return true;
        }   
        $pasa = validar($conexion, $idPersona);
        if($pasa) {
            $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT, ['cost'=>10]);

            $sql = "INSERT INTO usuarios (nombre, correo, pass, cargo_id, id_persona)
            VALUES (
                        '".$_POST["nombre"]."',
                        '".$_POST["correo"]."',
                        '".$hash."', 
                        '1',
                        '".$idPersona."'
                    );";
             $guardar = mysqli_query($conexion, $sql) or die('Error de consulta');   
             echo '
                 <script>
                     window.location.replace("../views/login.php");
                 </script>
                 '; 
         }  
         mysqli_close($conexion);
    }
?>