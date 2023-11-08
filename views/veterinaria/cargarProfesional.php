<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerVeterinaria.php');
            include('../../componentes/navBarVeterinaria.php');
        ?>
        <main>
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <form id="formulario" method="POST" class="custom-form contact-form bg-white shadow-lg">
                                <h1>Carga de Profesionales</h1>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="persona_id">Documento</label>
                                        <input type="text" name="persona_id" class="form-control"
                                        value="<?php if (isset($_POST['persona_id'])) echo $_POST['persona_id'];?>"
                                        >
                                    </div>
                                    <div class="errorCampo" id="campoDni" class="form-control">
                                        Ingrese un documento
                                    </div>
                                    <div class="errorCampo" id="DNIcargado" >
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
                    
                                        <button type="submit" name="cargarProfesional" class="form-control">Agregar Profesional</button>
                                        <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
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
            } else if(!is_numeric($_POST['persona_id'])){
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
        } else if(!is_numeric($_POST['matricula'])){
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


        return true;

    }

        $pasa = validar($Sconexion, $idPersona);
        
        if($pasa) {
            
            $sql = "INSERT INTO profesional (persona_id, veterinaria_id, matricula)
            VALUES (
                        '$idPersona',
                        '".$Sinstitucion_id."',
                        '".$_POST["matricula"]."'    
                    );";
             $guardar = mysqli_query($Sconexion, $sql) or die(mysqli_error($Sconexion));   
             echo '
                 <script>
                     window.location.replace("home.php");
                 </script>
                 '; 
         }  
         mysqli_close($Sconexion);
    }
?>