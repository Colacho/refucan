<!DOCTYPE html>
<html>
    
    <?php

        include('../../componentes/head2.php');
    ?>

    <body>
        <?php
            include('../../componentes/headerAdmin.php');
            include('../../componentes/navBarAdmin.php');
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
            <section class="contact-noticia section-padding" id="volver">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto"> 

                            <form class="custom-form contact-form bg-white shadow-lg" id="formCarga" action="" method="POST" enctype="multipart/form-data">                     
                                <h2>Carga de Noticias</h2>

                                <div class="row">


                                    <div class="col-12">
                                        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ingrese el Titulo"
                                        value="<?php if (isset($_POST['titulo'])) echo $_POST['titulo'];?>"
                                        >
                                    </div>
                                    <div class="errorCampo" id="campoTitulo">
                                        Ingrese un titulo
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" rows="5" id="cuerpo" name="cuerpo" placeholder="Cuerpo de la noticia" value="<?php if (isset($_POST['observaciones'])) echo $_POST['observaciones'];?>"></textarea>
                                    </div>
                                    <div class="errorCampo" id="campoCuerpo">
                                        Ingrese la noticia
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-12">  
                                        <input type="file" name="foto" id="imagen" class="form-control-file custom-file-input">
                                        <p></p>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" name="cargarNoticia" class="form-control">Agregar Noticia</button>
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

        <!-- Script para agregar inputs -->
        <script type="text/javascript" src="../../src/inputs.js"></script>
        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
</html>

<?php
    if (isset($_POST['cargarNoticia'])) {
        
        function validar() {
            if(empty($_POST["titulo"])){
                echo '<script>
                    this.document.getElementById("campoTitulo").style.display = "block";
                    </script>
                ';
                return false;
            }
            if(empty($_POST["cuerpo"])){
                echo '<script>
                    this.document.getElementById("campoCuerpo").style.display = "block";
                    </script>
                ';
                return false;
            }
            return true;
        }

        $pasa = validar();
        if($pasa) {

            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechaActual = date("Y-m-d");
            
            
            if($_FILES['foto']['name'] == "") {
                $foto = "noticiaDefault.png";
            } else {
                $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
                $tmpNombre = $_FILES['foto']['tmp_name'];
                $destino = "../fotos/noticias/".$foto;
                move_uploaded_file($tmpNombre, $destino);
            }
    
            $sql = "INSERT INTO noticias (titulo, cuerpo, foto, usuarios_usuario_id)
            VALUES ('".$_POST["titulo"]."','".$_POST["cuerpo"]."', '$foto', '$Susuario_id');";
    
            $resultado = mysqli_query($Sconexion, $sql) or die('Error de consulta');
            mysqli_close($Sconexion);
            echo '
            <script>
                window.location.replace("home.php");
            </script>
            '; 
        }
        
    }
?>









 <!--       <body>
            <?php
                include('../../componentes/headerAdmin.php');
                
            ?>
            <main>
            
                <form action="" method="POST" enctype="multipart/form-data" class="my-form">
                    <h1>Crear noticia</h1>
                    <div class="containerInputs">
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" name="titulo" id="titulo" class="form-control"
                            value="<?php if (isset($_POST['titulo'])) echo $_POST['titulo'];?>"
                            >
                        </div>
                        <div class="errorCampo" id="campoTitulo">
                            Ingrese un titulo
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cuerpo">Cuerpo:</label>
                            <textarea name="cuerpo" id="cuerpo" class="form-control"
                            value="<?php if (isset($_POST['cuerpo'])) echo $_POST['cuerpo'];?>"
                            ></textarea>
                        </div>
                        <div class="errorCampo" id="campoCuerpo">
                            Ingrese la noticia
                        </div>
        
                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="file" name="foto" id="imagen" class="form-control-file" accept="image/*">
                        </div>
        
                        <button type="submit" name="cargarNoticia" class="formboton">Agregar Noticia</button>

                    </div>
                </form>
                <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
            
                <?php
                    include('../../componentes/footer.php');
                ?>
            </main>
        </body>  -->