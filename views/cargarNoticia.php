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
        <br>
        <br> 
        <form action="" method="POST" enctype="multipart/form-data" class="my-form">
            <h1>Crear noticia</h1>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="cuerpo">Cuerpo:</label>
                <textarea name="cuerpo" id="cuerpo" class="form-control" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" name="foto" id="imagen" class="form-control-file" accept="image/*">
            </div>
            
            <button type="submit" name="cargarNoticia" class="formboton">Agregar Noticia</button>
        </form>
        <br>
        <br>
    <?php
            include('../componentes/footer.php');
        ?>
    </body>
</html>

<?php
    if (isset($_POST['cargarNoticia'])) {
        
        $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaActual = date("Y-m-d");
        
        
        if($_FILES['foto']['name'] == "") {
            $foto = "noticiaDefault.jpg";
        } else {
            $foto = $nombre.$persona_id.$_FILES['foto']['name'];
            $tmpNombre = $_FILES['foto']['tmp_name'];
            $destino = "../fotos/noticias/".$foto;
            move_uploaded_file($tmpNombre, $destino);
        }

        $sql = "INSERT INTO noticias (titulo, cuerpo, foto, usuarios_usuario_id)
        VALUES ('".$_POST["titulo"]."','".$_POST["cuerpo"]."', '$foto', '$persona_id');";

        $resultado = mysqli_query($con, $sql) or die('Error de consulta');
        mysqli_close($con);
        header("location:home.php");
    }
?>
