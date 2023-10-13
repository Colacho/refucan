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
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">                           
                            <form class="custom-form contact-form bg-white shadow-lg" id="formCarga" action="" method="POST" enctype="multipart/form-data">
                                <h2>Carga de Profesionales</h2>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <input type="text" name="persona_id" class="form-control" placeholder="DNI Responsable"
                                        value="<?php if (isset($_POST['persona_id'])) echo $_POST['persona_id'];?>"
                                        >         
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <input type="text" name="matricula" id="matricula" class="form-control"
                                        value="<?php if (isset($_POST['matricula'])) echo $_POST['matricula'];?>"
                                        >
                                    </div>
                        
                                    <div class="form-group">
                                        <select id="provincia" name="provincia" class="form-control">
                                            <option value="<?php if (isset($_POST['provincia'])) echo $_POST['provincia'];?>" disabled selected>Seleccione una provincia</option>
                                            <option value="provincia1">Provincia 1</option>
                                            <option value="provincia2">Provincia 2</option>
                                            <option value="provincia3">Provincia 3</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select id="municipio" name="municipio" class="form-control">
                                            <option value="<?php if (isset($_POST['municipio'])) echo $_POST['municipio'];?>" disabled selected>Seleccione un municipio</option>
                                            <option value="provincia1">Provincia 1</option>
                                            <option value="provincia2">Provincia 2</option>
                                            <option value="provincia3">Provincia 3</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                  
                                        <input type="text" name="calle" id="calle" class="form-control" placeholder="Calle" value="<?php if (isset($_POST['calle'])) echo $_POST['calle'];?>"
                                        >
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <input type="text" name="numero_dire" id="numero_dire" class="form-control" placeholder="Numero" value="<?php if (isset($_POST['numero_dire'])) echo $_POST['numero_dire'];?>"
                                        >
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">  
                                        <input type="file" name="foto" id="imagen" class="form-control-file custom-file-input" accept="image/*">
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" name="cargarPersona" class="form-control">Agregar Protectora</button>
                                    </div>
                                    <p></p>
                                    <div class="col-12">
                                        <a class="form-control text-center" href="home.php">Volver</a>
                                    </div>
                                </div>
                            </form>                            
                        </div>

                    </div>
                </div>
            </section>
        </main>



      <!--  <main>
            <h1>Carga de Profesionales</h1>
            <form id="formulario" method="POST" class="my-form">
                <div class="containerInputs">
                    <div class="form-group">
                        <label for="persona_id">Documento</label>
                        <input type="text" name="persona_id" class="form-control"
                        value="<?php if (isset($_POST['persona_id'])) echo $_POST['persona_id'];?>"
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
                        <label for="matricula">Matricula</label>
                        <input type="text" name="matricula" id="matricula" class="form-control"
                        value="<?php if (isset($_POST['matricula'])) echo $_POST['matricula'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoMatricula" >
                        Ingrese Matricula
                    </div>
                    <div class="errorCampo" id="matriculaCargada" >
                        Esa matricula ya fue cargada
                    </div>
    
                    <div class="form-group">
                        <label for="veterinaria_id">Veterinaria</label>
                        <select name="veterinaria_id">
                            <option value="0">Seleccione una opcion</option>
                            <?php 
                                $veterinarias = "SELECT veterinaria_id, nombre FROM veterinaria";
                                $consultaVeterinaria = mysqli_query($Sconexion, $veterinarias);
                                while($row = mysqli_fetch_assoc($consultaVeterinaria)) {
    
                                    echo '
                                    <option value="'.$row['veterinaria_id'].'"> '.$row['nombre'].' </option>
                                    ';
                                }
                            ?>
    
                        </select>
                       
                    </div>
                    <div class="errorCampo" id="campoVeterinaria" >
                        Ingrese una Veterinaria
                    </div>
                    <div>
                        <button type="submit" name="cargarProfesional" class="formboton">Agregar Profesional</button>
                    </div>
                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
        </main> -->
    </body>
        <?php
            include('../../componentes/footer.php');
        ?>
</html>
<?php
    
    if (isset($_POST['cargarProfesional'])) {
        
        $idPersona;

        function validar ($conexion, &$num) {
            
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
                    $verifica2 = "SELECT persona_id from profesional WHERE persona_id = '".$fila["persona_id"]."' ;";
                    $resultadoVerifica2 = mysqli_query($conexion, $verifica2) or die('Error de consulta id');
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

        if(empty($_POST["matricula"])){
            echo '<script>
                    this.document.getElementById("campoMatricula").style.display = "block";
                </script>
            ';
            return false;
        } else {
            $verifica = "SELECT matricula FROM profesional WHERE matricula = '".$_POST["matricula"]."';";
            $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta matricula');
            if(mysqli_num_rows($resultadoVerifica) > 0) {
                echo '<script>
                    this.document.getElementById("matriculaCargada").style.display = "block";
                </script>
                ';
                return false;
            }
        }

        if(($_POST["veterinaria_id"] == 0 )){
            echo '<script>
                    this.document.getElementById("campoVeterinaria").style.display = "block";
                </script>
            ';
            return false;
        }

        return true;

    }

        $pasa = validar($Sconexion, $idPersona);
        if($pasa) {
            
            $sql = "INSERT INTO profesional (persona_id, veterinaria_id, matricula)
            VALUES (
                        '$idPersona',
                        '".$_POST["veterinaria_id"]."',
                        '".$_POST["matricula"]."'    
                    );";
             $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta guardado');   
             echo '
                 <script>
                     window.location.replace("../views/cargar.php");
                 </script>
                 '; 
         }  
         mysqli_close($Sconexion);
    }
?>