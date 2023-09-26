
<!DOCTYPE html>
<html>

    <?php
        include('../../componentes/head.php')
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
            <?php
                if($Scargo_id == 2) {
                    echo '
                        <a class="btn btn-dark btn-lg" role="button" href="cargarUsuario.php">Usuarios</a>    
                        <a class="btn btn-dark btn-lg" role="button" href="cargarProfesional.php">Profesional</a>    
                    ';
                }
            ?>
                <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>    
            </div>
        </main>
            
        <?php
            include('../../componentes/footer.php')
            
        ?>

    </body>

    
</html>