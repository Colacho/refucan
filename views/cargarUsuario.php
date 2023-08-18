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
            <h1>Carga de Usuarios</h1>
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
                <div class="errorCampo" id="CorreoCargado">
                    El Email ya existe
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
                <div class="errorCampo" id="DNIrepetido">
                    El DNI corresponde a otro usuario
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <select id="cargo" name="cargo">
                        <option value="0">Seleccione una opción</option>
                        <option value="1">Administrador</option>
                        <option value="2">Veterinaria</option>
                        <option value="3">Protectora</option>
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
        
        $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
        $idPersona;

        function validar ($conexion ,&$num) {
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
            
            if(!empty($_POST["correo"])){
                
                $verifica = "SELECT correo from usuarios WHERE correo = '".$_POST["correo"]."' ;";
                $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta');
                if(mysqli_num_rows($resultadoVerifica) > 0) {
                    echo '<script>
                        this.document.getElementById("CorreoCargado").style.display = "block";
                    </script>
                    ';
                    return false;  
                }
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
                $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta');
                if(mysqli_num_rows($resultadoVerifica) > 0) {
                    $fila = mysqli_fetch_array($resultadoVerifica);
                    $verifica2 = "SELECT id_persona from usuarios WHERE id_persona = '".$fila["persona_id"]."' ;";
                    $resultadoVerifica2 = mysqli_query($conexion, $verifica2) or die('Error de consulta');
                    if(mysqli_num_rows($resultadoVerifica2) == 0) {
                        
                        $num = $fila['persona_id'];

                    } else {
                        echo '<script>
                        this.document.getElementById("DNIrepetido").style.display = "block";
                        </script>
                        ';
                        return false;
                    }

            } else {
                echo '<script>
                    this.document.getElementById("DNIcargado").style.display = "block";
                </script>
                ';
                return false;
            }
            }
            if($_POST["cargo"] == 0){
                echo '<script>
                    this.document.getElementById("campoCargo").style.display = "block";
                </script>
                ';
                return false;
            }

            return true;
        }   
        $pasa = validar($Sconexion, $idPersona);
        if($pasa) {
            $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT, ['cost'=>10]);

            $sql = "INSERT INTO usuarios (nombre, correo, pass, cargo_id, id_persona)
            VALUES (
                        '".$_POST["nombre"]."',
                        '".$_POST["correo"]."',
                        '".$hash."', 
                        '".$_POST["cargo"]."',
                        '".$idPersona."'
                    );";
             $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta');   
             echo '
                 <script>
                     window.location.replace("../views/cargar.php");
                 </script>
                 '; 
         }  
         mysqli_close($Sconexion);
    }
?>