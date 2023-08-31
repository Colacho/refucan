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
            <h1>Carga de Animales</h1>

            <form id="formCarga" action="" method="POST" >
                <div class="form-group">
                    <label for="nombre">Nombre de usuario</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                    value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                    >
                </div>
                <div class="form-group">
                    <label for="quintuple">quintuple</label>
                    <input type="text" name="quintuple" id="quintuple" class="form-control"
                    value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                    >
                </div>
                <div class="form-group">
                    <label for="observaciones">observaciones</label>
                    <input type="text" name="observaciones" id="observaciones" class="form-control"
                    value="<?php if (isset($_POST['observaciones'])) echo $_POST['observaciones'];?>"
                    >
                </div>
                <button type="submit" name="guardar" class="formboton">Agregar Usuario</button>
            </form>
        </main>
    </body>
</html>

                        
                            
                       
<!--------------------------------------- CONSULTA --------------------------------------->
<?php
    if (isset($_POST['guardar'])) {
        
        
        // Crear Objeto JSON
        $jsonObject = array(
            "quintuple" => $_POST['quintuple'],
            "observaciones" => $_POST['observaciones']
            
        );

        // Convertir el objeto JSON a cadena
        $jsonString = json_encode($jsonObject);

        var_dump($jsonString);
        
        
       $sql = "INSERT INTO animal (nombre, clinica) 
       values(
        '".$_POST["nombre"]."',
         '$jsonString'
       
       )";

       $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta');
        
       echo '
            <script>
                window.location.replace("../views/cargar.php");
            </script>
       '; 
       mysqli_close($Sconexion);
    }
?>
