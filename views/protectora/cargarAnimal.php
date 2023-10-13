<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerProtectora.php');
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
                        <label for="especie">Seleccione especie</label>
                        <select id="especie" name="especie" class="form-select">
                            <option value="<?php if (isset($_POST['especie'])) echo $_POST['especie']; else echo " ";?>">
                            <?php if (isset($_POST['especie'])) echo $_POST['especie']; else echo "Seleccione una opción";?>
                        </option>
                            <option value="Canino">Canino</option>
                            <option value="Felino">Felino</option>
                            <option value="Equino">Equino</option>
                            <option value="Bovino">Bovino</option>
                        </select>
                    </div>
                    <div class="errorCampo" id="campoEspecie" >
                        Seleccione una opción
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre del animal</label>
                        <input type="text" name="nombre" class="form-control"
                        value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoNombre" >
                        Complete el campo
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
        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
</html>

                        
                            
                       
<!--------------------------------------- CONSULTA --------------------------------------->
<?php
    if (isset($_POST['guardar'])) {
        
        $idPersona;
        function validar($conexion, &$num) {

            if($_POST['especie'] == " ") {
                echo '<script>
                        this.document.getElementById("campoEspecie").style.display = "block";
                    </script>
                ';
                return false;
            }
            if(empty($_POST['nombre'])) {
                echo '<script>
                        this.document.getElementById("campoNombre").style.display = "block";
                    </script>
                ';
                return false;
            }

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

        $pasa = validar($Sconexion, $idPersona);
        $datos = array_slice($_POST, 3, -1 );
        
        
        $json = json_encode($datos);
        
        //var_dump($idPersona);

    //     // Crear Objeto JSON
        // $jsonObject = array(
        //     "quintuple" => $_POST['quintuple'],
        //     "observaciones" => $_POST['observaciones']
            
        // );

    //     // Convertir el objeto JSON a cadena
    //     $jsonString = json_encode($jsonObject);
      
       $sql = "INSERT INTO animal (persona_id, nombre, especie, clinica, activo) 
       values(
        '$idPersona',
        '".$_POST["nombre"]."',
        '".$_POST["especie"]."',
         '$json',
         1
       
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
