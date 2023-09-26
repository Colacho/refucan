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
            <h1>Carga de Profesionales</h1>
            <form id="formulario" method="POST" class="my-form">
                <div class="containerInputs">
                    <div class="form-group">
                        <label for="persona_id">Documento</label>
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
                    <div class="errorCampo" id="DNIrepetido">
                        El DNI corresponde a otro usuario
                    </div>
                    
                    <div class="form-group">
                        <label for="matricula">Matricula</label>
                        <input type="text" name="matricula" id="matricula" class="form-control"
                        value="<?php if (isset($_POST['matricula'])) echo $_POST['matricula'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoMatricula" >
                        Ingrese Matricula
                    </div>
                    <div class="errorCampo" id="matriculaCargada" >
                        Esa matricula ya fue cargada
                    </div>
    
                    <div class="form-group">
                        <label for="veterinaria_id">Veterinaria</label>
                        <select name="veterinaria_id">
                            <option value="0">Seleccione una opcion</option>
                            <?php 
                                $veterinarias = "SELECT veterinaria_id, nombre FROM veterinaria";
                                $consultaVeterinaria = mysqli_query($Sconexion, $veterinarias);
                                while($row = mysqli_fetch_assoc($consultaVeterinaria)) {
    
                                    echo '
                                    <option value="'.$row['veterinaria_id'].'"> '.$row['nombre'].' </option>
                                    ';
                                }
                            ?>
    
                        </select>
                       
                    </div>
                    <div class="errorCampo" id="campoVeterinaria" >
                        Ingrese una Veterinaria
                    </div>
                    <div>
                        <button type="submit" name="cargarProfesional" class="formboton">Agregar Profesional</button>
                    </div>
                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
        </main>
    </body>
        <?php
            include('../../componentes/footer.php');
        ?>
</html>
<?php
    
    if (isset($_POST['cargarProfesional'])) {
        
        $idPersona;

        function validar ($conexion, &$num) {
            
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
                    $verifica2 = "SELECT persona_id from profesional WHERE persona_id = '".$fila["persona_id"]."' ;";
                    $resultadoVerifica2 = mysqli_query($conexion, $verifica2) or die('Error de consulta id');
                    if(mysqli_num_rows($resultadoVerifica2) == 0) {
                        
                        $num = $fila['persona_id'];
    
                    } else {
                        echo '<script>
                        this.document.getElementById("DNIrepetido").style.display = "block";
                        </script>
                        ';
                        return false;
                    }
                } else {
                    echo '<script>
                        this.document.getElementById("DNIcargado").style.display = "block";
                    </script>
                    ';
                    return false;
                }   
        }

        if(empty($_POST["matricula"])){
            echo '<script>
                    this.document.getElementById("campoMatricula").style.display = "block";
                </script>
            ';
            return false;
        } else {
            $verifica = "SELECT matricula FROM profesional WHERE matricula = '".$_POST["matricula"]."';";
            $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta matricula');
            if(mysqli_num_rows($resultadoVerifica) > 0) {
                echo '<script>
                    this.document.getElementById("matriculaCargada").style.display = "block";
                </script>
                ';
                return false;
            }
        }

        if(($_POST["veterinaria_id"] == 0 )){
            echo '<script>
                    this.document.getElementById("campoVeterinaria").style.display = "block";
                </script>
            ';
            return false;
        }

        return true;

    }

        $pasa = validar($Sconexion, $idPersona);
        if($pasa) {
            
            $sql = "INSERT INTO profesional (persona_id, veterinaria_id, matricula)
            VALUES (
                        '$idPersona',
                        '".$_POST["veterinaria_id"]."',
                        '".$_POST["matricula"]."'    
                    );";
             $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta guardado');   
             echo '
                 <script>
                     window.location.replace("../views/cargar.php");
                 </script>
                 '; 
         }  
         mysqli_close($Sconexion);
    }
?>