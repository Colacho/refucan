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
            <h1>Carga de Veterinaria</h1>
            <form id="formCarga" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="nombre">Nombre de la veterinaria</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                    value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>"
                    >
                </div>
                <div class="errorCampo" id="campoNombre" >
                    Ingrese Nombre
                </div>
                <div class="errorCampo" id="nombreExiste" >
                    El nombre ya esta cargado
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
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control"
                    value="<?php if (isset($_POST['telefono'])) echo $_POST['telefono'];?>"
                    >
                </div>
                <div class="errorCampo" id="campoTelefono">
                    Ingrese un número
                </div>

                <div class="form-group">
                    <label for="imagen">Logo:</label>
                    <input type="file" name="foto" id="imagen" class="form-control-file" accept="image/*">
                </div>

                <button type="submit" name="cargarProtectora" class="formboton">Agregar Veterinaria</button>
            </form>
            <a href="../views/home.php"><button class="button">Volver</button></a>
        </main>
    </body>
     <!-- Script localidades -->
    <script src="../src/localidades.js"></script>
</html>

<?php
if (isset($_POST['cargarProtectora'])) {
        
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaActual = date("Y-m-d");

   function validar ($conexion) {
       if(empty($_POST["nombre"])){
           echo '<script>
               this.document.getElementById("campoNombre").style.display = "block";
           </script>
           ';
           return false;
       } 
       if(!empty($_POST["nombre"])){
                  
        $verifica = "SELECT nombre from veterinaria WHERE nombre = '".$_POST["nombre"]."' ;";
        $resultadoVerifica = mysqli_query($conexion, $verifica) or die('Error de consulta');
        if(mysqli_num_rows($resultadoVerifica)>0) {
            echo '<script>
                this.document.getElementById("nombreExiste").style.display = "block";
            </script>
            ';
            return false;
        }
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
        if(empty($_POST["telefono"])){
            echo '<script>
                this.document.getElementById("campoTelefono").style.display = "block";
            </script>
            '; 
            return false;
        }
         
       return true;
   }
    
   $pasa = validar($Sconexion);
   
   if($pasa) {

    if($_FILES['foto']['name'] == "") {
        $foto = "veterinariaDefault.png";
    } else {
        $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
        $tmpNombre = $_FILES['foto']['tmp_name'];
        $destino = "../fotos/veterinaria/".$foto;
        move_uploaded_file($tmpNombre, $destino);
    }

       $sql = "INSERT INTO veterinaria (nombre, provincia, municipio, calle, numero_dire, telefono, foto)
       VALUES (
                   '".$_POST["nombre"]."',
                   '".$_POST["provincia"]."',
                   '".$_POST["municipio"]."',
                   '".$_POST["calle"]."',
                   '".$_POST["numero_dire"]."',
                   '".$_POST["telefono"]."',
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