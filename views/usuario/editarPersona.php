<!DOCTYPE html>
<html>
<?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerUsuario.php');
        ?>
        <main>
            <h1>Editar Persona</h1>
            <?php
                
                $consulta = "SELECT * FROM personas WHERE persona_id = $Spersona_id";

                $resultado = mysqli_query($Sconexion, $consulta);     
                   
                $row = mysqli_fetch_assoc($resultado)
            ?>
            <form method="POST">
                <div>
                    
                    <div>
                        <label>Nombre:</label><br>
                        <input value="<?php echo $row['nombre']?>" name="nombre"> 
                    </div>
                    <div class="errorCampo" id="campoNombre" >
                        Ingrese Nombre
                    </div>
                    <div>
                        <label>Apellido:</label><br>
                        <input value="<?php echo $row['apellido']?>" name="apellido"> 
                    </div>
                    <div class="errorCampo" id="campoApellido" >
                        Ingrese apellido
                    </div>
                    <div>
                        <label>DNI:</label><br>
                        <input value="<?php echo $row['dni']?>" name="dni"> 
                        <div class="errorCampo" id="DNIcargado">
                            El DNI ya existe
                        </div>
                        <div class="errorCampo" id="campoDni">
                            Ingrese un DNI
                        </div>
                    </div>
                    <div>
                        <label>Telefono:</label><br>
                        <input value="<?php echo $row['telefono']?>" name="telefono"> 
                    </div>
                    <div class="errorCampo" id="campoTelefono" >
                            Ingrese un teléfono
                    </div>
                    <div>
                        <label for="provincia">Provincia</label>
                        <input name="provinciaAnt" value="<?php echo $row['provincia']?>" readonly>
                        <select id="provincia" name="provincia"></select>
                        
                        <label for="municipio">Municipio</label>
                        <input name="municipioAnt" value="<?php echo $row['municipio']?>" readonly>
                        <select id="municipio" name="municipio"></select>
                        <div class="errorCampo" id="campoMunicipio">
                            Si modifica la provincia seleccione un municipio
                        </div> 
                    </div>
                    <div>
                        <label>Calle:</label><br>
                        <input value="<?php echo $row['calle']?>" name="calle"> 
                    </div>
                    <div class="errorCampo" id="campoCalle">
                        Ingrese una calle
                    </div> 
                    <div>
                        <label>Número:</label><br>
                        <input value="<?php echo $row['numero_dire']?>" name="numero_dire"> 
                    </div>
                    <div class="errorCampo" id="campoNumero_dire">
                        Ingrese un número
                    </div> 
                    
                    <button type="submit" name="guardar" class="formboton">Guardar</button>
                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>
        </main>
    </body>
    <!-- Script localidades -->
    <script src="../../src/localidades.js"></script>
        <?php
            include('../../componentes/footer.php');
        ?>
</html>

<?php
    
    //  Requerido para comprara en la funcion
    $dniAnt = $row['dni'];
    $provinciaAnt = $row['provincia'];
    $municipioAnt = $row['municipio'];
    

    if(isset($_POST['guardar'])){
        
        function validar($conexion, &$prov, &$mun, $dni) {

            if(empty($_POST["nombre"])){
                echo '<script>
                    this.document.getElementById("campoNombre").style.display = "block";
                </script>
                ';
                return false;
            }
            if(empty($_POST["apellido"])){
             echo '<script>
                 this.document.getElementById("campoApellido").style.display = "block";
             </script>
             ';
             return false;
             }
             if(empty($_POST["dni"])){
                 echo '<script>
                     this.document.getElementById("campoDni").style.display = "block";
                 </script>
                 ';
                 return false;
             }
             if (!empty($_POST["dni"])){
                $consultaDni = "SELECT dni FROM personas WHERE dni = '".$_POST['dni']."'";
                $resultadoDni = mysqli_query($conexion, $consultaDni) or die('Error de consulta DNI');
                $rowDni = mysqli_fetch_assoc($resultadoDni);
                if(mysqli_num_rows($resultadoDni) > 0) {
                    if($rowDni['dni'] != $dni) {
                        echo '<script>
                        this.document.getElementById("DNIcargado").style.display = "block";
                        </script>
                        '; 
                    return false;
                    }
                }
            }
            if(empty($_POST["telefono"])){
                echo '<script>
                    this.document.getElementById("campoTelefono").style.display = "block";
                </script>
                ';
                return false;
            }

            if(empty($_POST["calle"])){
                echo '<script>
                    this.document.getElementById("campoCalle").style.display = "block";
                </script>
                ';
                return false;
            }
            if(empty($_POST["numero_dire"])){
                echo '<script>
                    this.document.getElementById("campoNumero_dire").style.display = "block";
                </script>
                ';
                return false;
            }

            if(($_POST["provincia"] == "provincia")){
                
                return true;
            } else {
                $prov = $_POST['provincia'];
                if($_POST["municipio"] == "municipio"){
                    echo '<script>
                        this.document.getElementById("campoMunicipio").style.display = "block";
                    </script>
                    ';
                    return false;
                } else {
                    $mun = $_POST['municipio'];
                    return true;
                }
                
            }
        }
        $pasa = validar($Sconexion, $provinciaAnt, $municipioAnt, $dniAnt);


        if($pasa) {

            $consulta = "UPDATE personas SET 
            nombre = '".$_POST['nombre']."',
            apellido = '".$_POST['apellido']."',
            dni = '".$_POST['dni']."',
            telefono = '".$_POST['telefono']."',
            provincia = '$provinciaAnt',
            municipio = '$municipioAnt',
            calle = '".$_POST['calle']."',
            numero_dire = '".$_POST['numero_dire']."',
            WHERE persona_id = '$Spersona_id';
            ";
            
            $resultado = mysqli_query($Sconexion, $consulta) or die('Error de consulta');

            echo '
            <script>
                window.location.replace("home.php");
            </script>
            '; 
        }

    }
?>