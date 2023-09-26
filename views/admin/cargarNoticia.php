<!DOCTYPE html>
<html>
    
    <?php

        include('../../componentes/head.php')
    ?>
    <body>
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
                window.location.replace("../views/cargar.php");
            </script>
            '; 
        }
        
    }
?>
