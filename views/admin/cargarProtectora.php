<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head2.php')
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
                                <h2>Carga de Protectoras</h2>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de protectora" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                                        >

                                        <div class="errorCampo" id="campoNombre" >
                                            Ingrese Nombre
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">         
                                        <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI Responsable" value="<?php if (isset($_POST['dni'])) echo $_POST['dni'];?>"
                                        >
                                    </div>
                        
                                    <div class="form-group">
                                        <select id="provincia" name="provincia" class="form-control">
                                            <option value="<?php if (isset($_POST['provincia'])) echo $_POST['provincia'];?>" disabled selected>Seleccione una provincia</option>
                                            <option value="provincia1">Provincia 1</option>
                                            <option value="provincia2">Provincia 2</option>
                                            <option value="provincia3">Provincia 3</option>
                                        </select>

                                        <div class="errorCampo" id="campoProvincia">
                                            Selecione una Provincia
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select id="municipio" name="municipio" class="form-control">
                                            <option value="<?php if (isset($_POST['municipio'])) echo $_POST['municipio'];?>" disabled selected>Seleccione un municipio</option>
                                            <option value="provincia1">Localidad 1</option>
                                            <option value="provincia2">Localidad 2</option>
                                            <option value="provincia3">Localidad 3</option>
                                        </select>
                                        <div class="errorCampo" id="campoMunicipio">
                                            Selecione una Localidad
                                        </div> 
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                  
                                        <input type="text" name="calle" id="calle" class="form-control" placeholder="Calle" value="<?php if (isset($_POST['calle'])) echo $_POST['calle'];?>"
                                        >
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">                                    
                                        <input type="text" name="numero_dire" id="numero_dire" class="form-control" placeholder="Numero" value="<?php if (isset($_POST['numero_dire'])) echo $_POST['numero_dire'];?>"
                                        >

                                        <div class="errorCampo" id="campoCalle">
                                            Ingrese una calle
                                        </div> 
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-12">  
                                        <input type="file" name="foto" id="imagen" class="form-control-file custom-file-input" accept="image/*">
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" name="cargarPersona" class="form-control">Agregar Protectora</button>
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
     <!-- Script localidades -->
    <script src="../src/localidades.js"></script>
        <?php
            include('../../componentes/footer.php');
        ?>
</html>

<?php
if (isset($_POST['cargarProtectora'])) {
        
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaActual = date("Y-m-d");
    $idPersona;

   function validar ($conexion, &$num) {
       if(empty($_POST["nombre"])){
           echo '<script>
               this.document.getElementById("campoNombre").style.display = "block";
           </script>
           ';
           return false;
       }
       
        if($_POST["provincia"] == "provincia"){
            echo '<script>
                this.document.getElementById("campoProvincia").style.display = "block";
            </script>
            ';
            return false;
        }
        if($_POST["municipio"] == "municipio"){
            echo '<script>
                this.document.getElementById("campoMunicipio").style.display = "block";
            </script>
            ';
            return false;
        }
        
        if(empty($_POST["calle"])){
            echo '<script>
                this.document.getElementById("campoCalle").style.display = "block";
            </script>
            ';
            return false;
        }
        if(empty($_POST["numero_dire"])){
            echo '<script>
                this.document.getElementById("campoNumero_dire").style.display = "block";
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
    
   $pasa = validar($Sconexion, $idPersona);
   
   if($pasa) {

    if($_FILES['foto']['name'] == "") {
        $foto = "protectoraDefault.png";
    } else {
        $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
        $tmpNombre = $_FILES['foto']['tmp_name'];
        $destino = "../fotos/protectora/".$foto;
        move_uploaded_file($tmpNombre, $destino);
    }

       $sql = "INSERT INTO protectora (nombre, provincia, municipio, calle, numero_dire, id_persona, foto)
       VALUES (
                   '".$_POST["nombre"]."',
                   '".$_POST["provincia"]."',
                   '".$_POST["municipio"]."',
                   '".$_POST["calle"]."',
                   '".$_POST["numero_dire"]."',
                   '".$idPersona."', 
                   '$foto'
               );";
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
