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
            <section class="contact-animal section-padding" id="volver">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">                           
                            <form class="custom-form contact-form bg-white shadow-lg" id="formCarga" action="" method="POST">
                                <h2>Carga de Animales</h2>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <input type="text" name="persona_id" class="form-control" placeholder="DNI del titular"
                                        value="<?php if (isset($_POST['persona_id'])) echo $_POST['persona_id'];?>"
                                        >                              
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <h7 class="text-center">es una protectora?</h7>
                                        <br>
                                        <select name="enProtectora">
                                            <option value="1">No</option>
                                            <option value="2">Si</option>
                                        </select>    
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                  
                                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del animal" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                                        >
                                    </div>

                                    <div class="form-group">
                                    <select id="especie" name="especie" class="form-control">
                                    <option value="<?php if (isset($_POST['especie'])) echo $_POST['especie']; else echo " ";?>">
                                    <?php if (isset($_POST['especie'])) echo $_POST['especie']; else echo "Seleccione especie";?>
                                        </option>
                                            <option value="Canino">Canino</option>
                                            <option value="Felino">Felino</option>
                                            <option value="Equino">Equino</option>
                                            <option value="Bovino">Bovino</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" rows="5" id="message" name="message" placeholder="Mensaje"><?php if (isset($_POST['observaciones'])) echo $_POST['observaciones'];?></textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" name="guardar" class="form-control">Agregar Animal</button>
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

        <!-- Script para agregar inputs -->
        <script type="text/javascript" src="../../src/inputs.js"></script>
        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
</html>

                        
                            
                       
<!--------------------------------------- CONSULTA --------------------------------------->
<?php
    if (isset($_POST['guardar'])) {
        
        $idPersona;
        $institucion = 0;



        function validar($conexion, &$num, &$inst) {

            if($_POST['especie'] == " ") {
                echo '<script>
                        this.document.getElementById("campoEspecie").style.display = "block";
                    </script>
                ';
                return false;
            }
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
                    if($_POST['enProtectora'] == 2) {
                        $protectora = "SELECT protectora_id FROM protectora WHERE id_persona = $num";
                        $resultadoProtectora = mysqli_query($conexion, $protectora) or die('Error de consulta');
                        if(mysqli_num_rows($resultadoProtectora) > 0) {
                            $protectoraId = mysqli_fetch_array($resultadoProtectora);
                            $inst = $protectoraId['protectora_id'];
                        } else {
                            echo '<script>
                                this.document.getElementById("campoProtectora").style.display = "block";
                            </script>
                            ';
                        }
                    }
                
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

        $pasa = validar($Sconexion, $idPersona, $institucion);
        $datos = array_slice($_POST, 5, -1 );
        
        if($pasa) {
            $json = json_encode($datos);
            
          
           $sql = "INSERT INTO animal (persona_id, nombre, especie, observaciones, clinica, institucion, activo) 
           values(
            '$idPersona',
            '".$_POST["nombre"]."',
            '".$_POST["especie"]."',
            '".$_POST["observaciones"]."',
             '$json',
             '$institucion',
             1
           
           )";
    
           $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta');
            
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
            <h1>Carga de Animales</h1>

            <form id="formCarga" action="" method="POST" >
                <div id="containerInputs" class="containerInputs">
                    
                    <div class="form-group">
                        <label for="persona_id">DNI del titular</label>
                        <input type="text" name="persona_id" class="form-control"
                        value="<?php if (isset($_POST['persona_id'])) echo $_POST['persona_id'];?>"
                        >
                        <label>en protectora?</label>
                        <select name="enProtectora">
                            <option value="1">No</option>
                            <option value="2">Si</option>
                        </select>
                    </div>
                    <div class="errorCampo" id="campoDni" >
                        Ingrese un documento
                    </div>
                    <div class="errorCampo" id="DNIcargado">
                        El DNI no está cargado
                    </div>
                    <div class="errorCampo" id="campoProtectora" >
                        El DNI no corresponde al responsable de la protectora
                    </div>

                    <div class="form-group">
                        <label for="especie">Seleccione especie</label>
                        <select id="especie" name="especie" class="form-select">
                            <option value="<?php if (isset($_POST['especie'])) echo $_POST['especie']; else echo " ";?>">
                            <?php if (isset($_POST['especie'])) echo $_POST['especie']; else echo "Seleccione una opción";?>
                        </option>
                            <option value="Canino">Canino</option>
                            <option value="Felino">Felino</option>
                            <option value="Equino">Equino</option>
                            <option value="Bovino">Bovino</option>
                        </select>
                    </div>
                    <div class="errorCampo" id="campoEspecie" >
                        Seleccione una opción
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre del animal</label>
                        <input type="text" name="nombre" class="form-control"
                        value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoNombre" >
                        Complete el campo
                    </div>

                    
                    <div class="form-group">
                        <label for="observaciones">observaciones</label>
                        <input type="text" name="observaciones" id="observaciones" class="form-control"
                        value="<?php if (isset($_POST['observaciones'])) echo $_POST['observaciones'];?>"
                        >
                    </div>
                </div>
                <div class="containerInputs">
                    <div>
                        <input id="nuevo" value="" style="border-radius: 5px;">
                        <button id="agregar" class="formboton" onclick="">Agregar</button>
                    </div>

                    <div>
                        <button type="submit" name="guardar" class="formboton">Guardar</button>
                    </div>

                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
        </main>  -->