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
            <h1>Carga de Protectoras</h1>
            <form id="formCarga" action="" method="POST" enctype="multipart/form-data">
                <div class="containerInputs">
                    <div class="form-group">
                        <label for="nombre">Nombre de Protectora</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                        value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoNombre" >
                        Ingrese Nombre
                    </div>
    
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <select id="provincia" name="provincia">
                            <option value="<?php if (isset($_POST['provincia'])) echo $_POST['provincia'];?>">Seleccione una provincia</option>
                        </select>
                        <div class="errorCampo" id="campoProvincia">
                            Selecione una Provincia
                        </div>
                        
                        <label for="municipio">Municipio</label>
                        <select id="municipio" name="municipio">
                            <option value="<?php if (isset($_POST['municipio'])) echo $_POST['municipio'];?>">Seleccione una localidad</option>
                        </select>
                        <div class="errorCampo" id="campoMunicipio">
                            Selecione una Localidad
                        </div> 
                    </div>
    
                    <div class="form-group">
                        <label for="calle">Calle</label>
                        <input type="text" name="calle" id="calle" class="form-control"
                        value="<?php if (isset($_POST['calle'])) echo $_POST['calle'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoCalle">
                        Ingrese una calle
                    </div> 
    
                    <div class="form-group">
                        <label for="numero_dire">Número</label>
                        <input type="text" name="numero_dire" id="numero_dire" class="form-control"
                        value="<?php if (isset($_POST['numero_dire'])) echo $_POST['numero_dire'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoNumero_dire">
                        Ingrese un número
                    </div>
    
                    <div class="form-group">
                        <label for="dni">Documento del responsable</label>
                        <input type="text" name="dni" id="dni" class="form-control"
                        value="<?php if (isset($_POST['dni'])) echo $_POST['dni'];?>"
                        >
                    </div>
                    <div class="errorCampo" id="campoDni" >
                        Ingrese un documento
                    </div>
                    <div class="errorCampo" id="DNIcargado">
                        El DNI no está cargado
                    </div>
    
                    <div class="form-group">
                        <label for="imagen">Logo:</label>
                        <input type="file" name="foto" id="imagen" class="form-control-file" accept="image/*">
                    </div>
                    <div>
                        <button type="submit" name="cargarProtectora" class="formboton">Agregar Protectora</button>
                    </div>

                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="cargar.php">Volver</a>
            
        </main>
    </body>
     <!-- Script localidades -->
    <script src="../src/localidades.js"></script>
</html>

<?php
if (isset($_POST['cargarProtectora'])) {
        
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaActual = date("Y-m-d");
    $idPersona;

   function validar ($conexion, &$num) {
       if(empty($_POST["nombre"])){
           echo '<script>
               this.document.getElementById("campoNombre").style.display = "block";
           </script>
           ';
           return false;
       }
       
        if($_POST["provincia"] == "provincia"){
            echo '<script>
                this.document.getElementById("campoProvincia").style.display = "block";
            </script>
            ';
            return false;
        }
        if($_POST["municipio"] == "municipio"){
            echo '<script>
                this.document.getElementById("campoMunicipio").style.display = "block";
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
        if(empty($_POST["dni"])){
            echo '<script>
                    this.document.getElementById("campoDni").style.display = "block";
                </script>
            ';
            return false;
        }
        if(!empty($_POST["dni"])){
             
            $verifica = "SELECT persona_id from personas WHERE dni = '".$_POST["dni"]."' ;";
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
   
   if($pasa) {

    if($_FILES['foto']['name'] == "") {
        $foto = "protectoraDefault.png";
    } else {
        $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
        $tmpNombre = $_FILES['foto']['tmp_name'];
        $destino = "../fotos/protectora/".$foto;
        move_uploaded_file($tmpNombre, $destino);
    }

       $sql = "INSERT INTO protectora (nombre, provincia, municipio, calle, numero_dire, id_persona, foto)
       VALUES (
                   '".$_POST["nombre"]."',
                   '".$_POST["provincia"]."',
                   '".$_POST["municipio"]."',
                   '".$_POST["calle"]."',
                   '".$_POST["numero_dire"]."',
                   '".$idPersona."', 
                   '$foto'
               );";
        $guardar = mysqli_query($Sconexion, $sql) or die('Error de consulta');   
        echo '
            <script>
                window.location.replace("../views/cargar.php");
            </script>
            '; 
    }  
    mysqli_close($Sconexion);
}
?>