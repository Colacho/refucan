<!DOCTYPE html>
<html>
    <?php
        include('../componentes/head.php');
    ?>
    
    <?php
        include('../componentes/header.php');
    ?>
    <body>
    
        <div class="container">
            
            <div >
                <a href="../views/buscarNoticia.php">
                    <img src="../images/noticias.png" class="imghome" alt="Imagen 1">
                </a>
                <h2>¡Conoce las Novedades!</h2>
                <h4>Ponete al dia con nuestras noticias de último momento.</h4>
            </div>

            <div>
                <a href="../views/buscar.php">
                    <img src="../images/buscar.png" class="imghome" alt="Imagen 2" >
                </a>
                <h2>¡Busca aquí!</h2>
                <h4>Buscar animales, protectoras, veterinarias, etc.</h4>
            </div>

            <div>
                <a href="../views/cargar.php">
                    <img src="../images/cargar.png" class="imghome" alt="Imagen 3" >
                </a>
                <h2>¡Cargue info aquí!</h2>
                <h4>Cargar nueva información al sistema.</h4>
            </div>
        
        </div>
       

        <?php
            include('../componentes/footer.php');
        ?>
        
    </body>
</html>