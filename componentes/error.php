<!DOCTYPE html>
<html>

    <?php
        error_reporting(0);
        include('componentes\head.php');
        include('componentes\header.php')
    ?>
    
    <body class="containergeneral"> 
        <main>
            <div class="central">
                <div>
                <img class="logocentral imgcentral" src="images/logo2.jpeg"/>
                <h1>Error de acceso</h1>
                </div>
                <div class="botones">         
                    <a class="btn btn-warning btn-lg" role="button" href="index.php">Volver</a>   
                </div>
            </div>
        </main>
            
        <?php
            include('componentes\footer.php')
        ?>

    </body>

</html>