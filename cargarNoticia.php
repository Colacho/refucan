<!DOCTYPE html>
<html>

    <?php
        include('componentes\head.php')
    ?>
    
    <body class="containergeneral">
        
        <?php
            include('componentes\header.php');
            include('componentes\navBar.php')
        ?>

        <main>
            <div class="central">
                <form action="cargarnoticia.php" method="POST">
                    <fieldset>
                        <legend>Nueva Noticia</legend>
                        <textarea cols="40" rows="5" name="texto"></textarea><br>
                        <div class="botones">
                            <button type="submit" name="carga" class="btn btn-dark btn-lg">Cargar</button>
                            <a class="btn btn-dark btn-lg" role="button" href="noticias.php">Volver</a>
                        </div>
                    </fieldset>
                </form>
            </div> 
        </main>
        <?php
            if (isset($_POST['carga'])) {
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $fechaActual = date("Y-m-d H:i");
                $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
                $sql = "INSERT INTO noticias
                VALUES(
                null,
                '$fechaActual',
                '".$_POST["texto"]."'
                )";
        
        
                $resultado = mysqli_query($con, $sql) or die('Error de consulta');
        
                mysqli_close($con);
            }
        ?>
       
       <?php
            include('componentes\footer.php')
        ?>

    </body>

</html>
