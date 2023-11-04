<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerAdmin.php');
        ?>

        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="../views/admin/home.php" class="navbar-brand mx-auto mx-lg-0">
                    <img class="logo" src="../../images/logo.jpg"/>
                    <span class="brand-text">Refucan</span>
                </a>



                <form action="../../src/logout.php" method="POST">
                
                    <button type="submit" name="logout" class="nav-link custom-btn btn d-lg-none">Log Out</button>
                </form>
                


                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">

                            <form action="../../src/logout.php" method="POST">
                                <button type="submit" name="logout" class="nav-link custom-btn btn d-none d-lg-block">Log Out</button>
                            </form>
                            
                        </li>
                    </ul>
                <div>
                        
            </div>
        </nav>
        <main>
        
            <!-- formulario de contacto diseño mio -->
            <section class="contact-usuario section-padding" id="volver">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">                           
                            <form class="custom-form contact-form bg-white shadow-lg" id="formulario" method="POST" class="my-form">
                                <h2>Carga de Usuarios</h2>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de Usuario" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                                        >

                                        <div class="errorCampo" id="campoNombre" >
                                            Ingrese Usuario
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <input name="correo" id="correo" class="form-control" placeholder="Correo" value="<?php if (isset($_POST['correo'])) echo $_POST['correo'];?>"
                                        >

                                         <div class="errorCampo" id="campoNombre" >
                                            Ingrese Email
                                        </div>
                                        <div class="errorCampo" id="CorreoCargado">
                                            El Email ya existe
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">         
                                        <input type="text" name="pass" id="pass" class="form-control" placeholder="Contraseña" value="<?php if (isset($_POST['pass'])) echo $_POST['pass'];?>"
                                        >

                                        <div class="errorCampo" id="campoPass" >
                                            Ingrese una contraseña
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI" value="<?php if (isset($_POST['dni'])) echo $_POST['dni'];?>"
                                        >

                                        <div class="errorCampo" id="campoDni" >
                                            Ingrese un documento
                                        </div>
                                        <div class="errorCampo" id="DNIcargado">
                                            El DNI no está cargado
                                        </div>
                                        <div class="errorCampo" id="DNIrepetido">
                                            El DNI corresponde a otro usuario
                                        </div>
                                    </div>
                        
                                    <div class="form-group">
                                        <select id="cargo" name="cargo" class="form-control">
                                            <option value="" disabled selected>Seleccione un Cargo</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Veterinaria</option>
                                            <option value="3">Protectora</option>
                                            <option value="4">Usuario</option>
                                        </select>

                                        <div class="errorCampo" id="campoCargo" >
                                                Seleccione un cargo
                                        </div>
                                        <div class="errorCampo" id="campoInstitucion" >
                                                El dni no corresponde al responsable de la institucion
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" name="cargarUsuario" class="form-control">Agregar Usuario</button>
                                    </div>
                                    <p></p>
                                    <div class="col-12">
                                        <a class="form-control text-center" href="cargar.php">Volver</a>
                                    </div>
                                </div>
                            </form>                            
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
    
    if (isset($_POST['cargarUsuario'])) {
        
        //Extrae el id de la persona en funcion del DNI ingresado
        $idPersona;
        //Verifica que la vincula el responsable de la institucion con la cuenta
        $institucion_id;

        function validar ($conexion, &$num, &$inst) {
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
            if ($_POST["cargo"] == 2) {
                $institucion = "SELECT veterinaria_id FROM veterinaria WHERE id_persona = $num";
                $resultadoInstitucion = mysqli_query($conexion, $institucion) or die('Error de consulta');
                if(mysqli_num_rows($resultadoInstitucion) > 0) {
                    $verificaInstitucion =  mysqli_fetch_array($resultadoInstitucion);
                    $inst = $verificaInstitucion['veterinaria_id'];
                } else {
                    echo '<script>
                    this.document.getElementById("campoInstitucion").style.display = "block";
                    </script>
                    ';
                    return false;
                }
            }
            if ($_POST["cargo"] == 3) {
                $institucion = "SELECT protectora_id FROM protectora WHERE id_persona = $num";
                $resultadoInstitucion = mysqli_query($conexion, $institucion) or die('Error de consulta');
                if(mysqli_num_rows($resultadoInstitucion) > 0) {
                    $verificaInstitucion =  mysqli_fetch_array($resultadoInstitucion);
                    $inst = $verificaInstitucion['protectora_id'];
                } else {
                    echo '<script>
                    this.document.getElementById("campoInstitucion").style.display = "block";
                    </script>
                    ';
                    return false;
                }
            }

            return true;
        }   
        $pasa = validar($Sconexion, $idPersona, $institucion_id);
        var_dump($institucion_id);
        var_dump($idPersona);
        if($pasa) {
            $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT, ['cost'=>10]);

            $sql = "INSERT INTO usuarios (nombre, correo, pass, cargo_id, id_persona, institucion)
            VALUES (
                        '".$_POST["nombre"]."',
                        '".$_POST["correo"]."',
                        '".$hash."', 
                        '".$_POST["cargo"]."',
                        '".$idPersona."',
                        '".$institucion_id."'
                    );";
             $guardar = mysqli_query($Sconexion, $sql) or die(mysqli_error($Sconexion));   
             echo '
                 <script>
                     window.location.replace("home.php");
                 </script>
                 '; 
         }  
         mysqli_close($Sconexion);
    }
?>








<!-- <main>
            <h1>Carga de Usuarios</h1>
            <form id="formulario" method="POST" class="my-form">
                <div class="containerInputs">
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
                    <div class="errorCampo" id="campoInstitucion" >
                            El dni no corresponde al responsable de la institucion
                    </div>
                    <div>
                        <button type="submit" name="cargarUsuario" class="formboton">Agregar Usuario</button>
                    </div>

                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
        </main> -->