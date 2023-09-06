<!DOCTYPE html>
<html>
    <?php
        include('../componentes/head.php')
    ?>
    <body>
        <?php
            include('../componentes/header.php');
        ?>
        <main>
            <h1>Carga de Animales</h1>

            <form id="formCarga" action="" method="POST" >
                <div id="containerInputs" class="containerInputs">
                    <div class="form-group">
                        <label for="persona_id">DNI del titular</label>
                        <input type="text" name="persona_id" class="form-control"
                        value="<?php if (isset($_POST['persona_id'])) echo $_POST['persona_id'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoDni" >
                        Ingrese un documento
                    </div>
                    <div class="errorCampo" id="DNIcargado">
                        El DNI no está cargado
                    </div>
                    
                    <div class="form-group">
                        <label for="observaciones">observaciones</label>
                        <input type="text" name="observaciones" id="observaciones" class="form-control"
                        value="<?php if (isset($_POST['observaciones'])) echo $_POST['observaciones'];?>"
                        >
                    </div>
                </div>
                <div class="containerInputs">
                    <div>
                        <input id="nuevo" value="" style="border-radius: 5px;">
                        <button id="agregar" class="formboton" onclick="">Agregar</button>
                    </div>
                    <div>
                        <button type="submit" name="guardar" class="formboton">Guardar</button>
                    </div>

                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
        </main>
        <!-- Script para agregar inputs -->
        <script type="text/javascript" src="../src/inputs.js"></script>
    </body>
</html>

                        
                            
                       
<!--------------------------------------- CONSULTA --------------------------------------->
<?php
    if (isset($_POST['guardar'])) {
        
        $idPersona;
        function validar($conexion, &$num) {
            if(empty($_POST["persona_id"])){
                echo '<script>
                        this.document.getElementById("campoDni").style.display = "block";
                    </script>
                ';
                return false;
            } else {
                $verifica = "SELECT persona_id from personas WHERE dni = '".$_POST["persona_id"]."' ;";
                $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta');
                if(mysqli_num_rows($resultadoVerifica) > 0) {
                    $fila = mysqli_fetch_array($resultadoVerifica);
                    $num = $fila['persona_id'];
                    
                } else {
                    echo '<script>
                        this.document.getElementById("DNIcargado").style.display = "block";
                        </script>
                    ';
                    return false;
                }   
            }
            return true;
        }

        var_dump($_POST);
        
    //     // Crear Objeto JSON
    //     $jsonObject = array(
    //         "quintuple" => $_POST['quintuple'],
    //         "observaciones" => $_POST['observaciones']
            
    //     );

    //     // Convertir el objeto JSON a cadena
    //     $jsonString = json_encode($jsonObject);

    //     var_dump($jsonString);
        
        
    //    $sql = "INSERT INTO animal (nombre, clinica) 
    //    values(
    //     '".$_POST["nombre"]."',
    //      '$jsonString'
       
    //    )";

    //    $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta');
        
    //    echo '
    //         <script>
    //             window.location.replace("../views/cargar.php");
    //         </script>
    //    '; 
    //    mysqli_close($Sconexion);
    }
?>
