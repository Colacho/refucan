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
    <br>
    <br>
    <br>
            <div class="container">
        <div class="row">
            <div class="col-md-4">
            <a href="../views/buscarNoticia.php">
                <img src="../images/imagen1.png" class="imghome" alt="Imagen 1" width="300px" >
            </a>
            <h2>¡Conoce las nuevas Novedades!</h2>
            <h4>Ponete al dia con nuestras noticias de último momento.</h4>
            </div>

            <div class="col-md-4">
            <a href="../views/buscar.php">
                <img src="../images/imagen2.png" class="imghome" alt="Imagen 2" width="300px" >
            </a>
            <h2>¡Busca aquí!</h2>
            <h4>Buscar animales, protectoras, veterinarias, etc.</h4>
            </div>

            <div class="col-md-4">
            <a href="../views/cargar.php">
                <img src="../images/imagen3.png" class="imghome" alt="Imagen 3" width="300px" >
            </a>
            <h2>¡Cargue info aquí!</h2>
            <h4>Cargar nueva información al sistema.</h4>
            </div>
        </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <footer>
            <?php
                include('../componentes/footer.php');
            ?>
        </footer>
    </body>
</html>