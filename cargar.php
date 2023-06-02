<?php

session_start();
$session = $_SESSION['usuario']; 
$cargo = $_SESSION['cargo'];
if($session == null) {
    $error = include('componentes\error.php');
    session_destroy();
    echo $error;
    exit();

}

?>

<!DOCTYPE html>
<html>

    <?php
        include('componentes\head.php')
    ?>
   
    <body class="containergeneral">
        
        <?php
            include('componentes\header.php');
            include('componentes\navBar.php');
            ?>
        <main>
            
            <div class="central">
                <h1 class="titulo-carga">Seleccione que desea Cargar</h1>
                
                <div class="accordion" id="accordionExample">
                    
                    <?php
                    if($cargo == 1) {
                        include('componentes\cargarAnimal.php');
                        include('componentes\cargarProtectora.php');
                        include('componentes\cargarUsuario.php');
                        
                    } else {
                        
                        include('componentes\cargarAnimal.php');
                        include('componentes\cargarProtectora.php');
                    }
                    
                    
                    ?>

                </div>
                <div class="botones">
                    <a type="button" class="btn btn-dark btn-lg" href="index.php">Volver al inicio</a>
                </div>
            </div> 
        </main>
            
        <?php
            include('componentes\footer.php')
            
        ?>

    </body>

    
</html>