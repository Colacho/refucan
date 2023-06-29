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
            <h1>Seleccione que desea buscar</h1>

            <div class="botones">         
                    <a class="btn btn-dark btn-lg" role="button" href="buscarAnimal.php">Animales</a>
                    <a class="btn btn-dark btn-lg" role="button" href="buscarProtectora.php">Protectoras</a>
                    <a class="btn btn-dark btn-lg" role="button" href="buscarNoticia.php">Noticias</a>
                    <a class="btn btn-dark btn-lg" role="button" href="buscarUsuario.php">Usuarios</a>    
                    <a class="btn btn-dark btn-lg" role="button" href="buscarPersona.php">Personas</a>    
                    <a class="btn btn-dark btn-lg" role="button" href="buscarVeterinaria.php">Veterinarias</a>    
            </div>

        </main>
    </body>
</html>