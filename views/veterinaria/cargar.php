
<!DOCTYPE html>
<html>

    <?php
        include('../../componentes/head2.php');
        include('../../componentes/navBarVeterinaria.php');
    ?>
   
    <body class="containergeneral">
        
        <?php
            include('../../componentes/headerVeterinaria.php');
            ?>
        <main>
            <h1>Seleccione que desea cargar</h1>
            <div class="botones">         
                <a class="btn btn-dark btn-lg" role="button" href="cargarAnimal.php">Animales</a>
                <a class="btn btn-dark btn-lg" role="button" href="cargarPersona.php">Personas</a>  
                <a class="btn btn-dark btn-lg" role="button" href="cargarUsuario.php">Usuarios</a>  
            
                <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>    
            </div>
        </main>
            
        <?php
            include('../../componentes/footer.php')
            
        ?>

    </body>

    
</html>