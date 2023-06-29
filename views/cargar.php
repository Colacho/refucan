
<!DOCTYPE html>
<html>

    <?php
        include('../componentes/head.php')
    ?>
   
    <body class="containergeneral">
        
        <?php
            include('../componentes/header.php');
            include('../componentes/navBar.php');
            ?>
        <main>
            
            <div class="central">
                <h1 class="titulo-carga">Seleccione que desea Cargar <?php echo $cargo ?></h1>
                <div>
                    <a class="btn btn-dark btn-lg" role="button" href="cargarAnimal.php">
                        <img height="50px" src="../images/cargar.png">
                    </a> 
                    <a class="btn btn-dark btn-lg" role="button" href="cargarProtectora.php">
                        <img height="50px" src="../images/protectora.png">
                    </a> 

                </div>
                <div>

                    <a class="btn btn-dark btn-lg" role="button" href="cargarPersona.php">
                        <img height="50px" src="../images/personas.png">
                    </a> 
                    <a class="btn btn-dark btn-lg" role="button" href="cargarUsuario.php">
                        <img height="50px" src="../images/usuario.png">
                    </a> 
                </div>
                <div>
                    <a class="btn btn-dark btn-lg" role="button" href="cargarNoticia.php">Noticia</a> 
                    <a class="btn btn-dark btn-lg" role="button" href="cargarVeterinaria.php">Veterinaria</a> 
                </div>
                
                <div class="botones">
                    <a type="button" class="btn btn-dark btn-lg" href="home.php">Volver al inicio</a>
                </div>
            </div> 
        </main>
            
        <?php
            include('..componentes/footer.php')
            
        ?>

    </body>

    
</html>