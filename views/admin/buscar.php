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
            <h1>Seleccione que desea buscar</h1>

            <div class="botones">         
                    <a class="btn btn-dark btn-lg" role="button" href="buscarAnimal.php">Animales</a>
                    <a class="btn btn-dark btn-lg" role="button" href="buscarProtectora.php">Protectoras</a>
                    <a class="btn btn-dark btn-lg" role="button" href="buscarNoticia.php">Noticias</a>
                    <a class="btn btn-dark btn-lg" role="button" href="buscarUsuario.php">Usuarios</a>    
                    <a class="btn btn-dark btn-lg" role="button" href="buscarPersona.php">Personas</a>    
                    <a class="btn btn-dark btn-lg" role="button" href="buscarVeterinaria.php">Veterinarias</a>    
                    <a class="btn btn-dark btn-lg" role="button" href="buscarProfesional.php">Profesional</a>    
                    <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>    
            </div>

        </main>
        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
</html>