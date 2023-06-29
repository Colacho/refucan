<!DOCTYPE html>
<html>
    <?php
        include('../componentes/head.php');
    ?>
    
    <?php
        include('../componentes/header.php');
        include('../componentes/navBar.php');
    ?>
    <body>
    <br>
        <div class="botones">         
            <a class="btn btn-dark btn-lg" role="button" href="buscar.php">Buscar</a>
            <a class="btn btn-dark btn-lg" role="button" href="buscarProtectoras.php">Protectoras</a>
            <a class="btn btn-dark btn-lg" role="button" href="noticias.php">Noticias</a>
            <a class="btn btn-dark btn-lg" role="button" href="cargar.php">
            <img height="50px" src="../images/cargar.png">
            </a>    
        </div>
        <br>
        <footer>
            <?php
                include('../componentes/footer.php');
            ?>
        </footer>
    </body>
</html>