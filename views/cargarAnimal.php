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

            <form id="formCarga" action="" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Datos del Animal</legend>
            
                    <div>
                        <label>Nombre:</label>
                        <input type="text" name="nombre" size="30" require/><br>
                    </div>
                    <div>
                    <label for="sexo">Sexo:</label>
                        <select id="sexo" name="sexo">
                            <option value="macho">Macho</option>
                            <option value="hembra">Hembra</option>
                        </select>
                    </div>
                    
                    <div>
                        <label>Raza :</label><input type="text" name="raza" placeholder="Raza" size="33"/>
                    </div>
                    <div>
                        <label for="porte">Porte:</label>
                        <select id="porte" name="porte">
                            <option value="pequeño">Pequeño</option>
                            <option value="mediano">Mediano</option>
                            <option value="grande">Grande</option>
                        </select>
                    </div>
                    <div>
                        <label for="manto">Manto:</label>
                        <select id="manto" name="manto">
                            <option value="blanco">Blanco</option>
                            <option value="negro">Negro</option>
                            <option value="marron">Marron</option>
                            <option value="gris">Gris</option>
                            <option value="dorado">Dorado</option>
                            <option value="cobrizo">Cobrizo</option>
                        </select>
                    </div>
                    <div>
                        <label>Rasgo Particular:</label><br>
                        <textarea cols="40" rows="5" name="rasgos"></textarea>
                    </div>
                    <div>
                        <label>Cargar Foto del Animal:</label><br>
                        <input type="file" name="foto">
                    </div>
            <!-- ------------------------------------------------ Mapea la base de datos en busca de protectoras --------------------------------------------- -->
                    <div>
                        <label for="protectora_id">Seleccione protectora:</label>
                        <select name="protectora_id" id="protectora_id">    
                            <?php
                                $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
                                $consultaprotectora = "SELECT * FROM protectoras";
                                $resultado = mysqli_query($con, $consultaprotectora);
                                while($row = mysqli_fetch_assoc($resultado)) { 
                                    echo '
                                    <option value="'.$row['protectora_id'].'"> '.$row['protectora_nombre'].' </option>
                                    ';
                                }
                                mysqli_close($con);
                            ?>
                        </select>
                    </div>
            <!-- -------------------------------------------------Fin de mapeo en busca de protectoras---------------------------------------------------------- -->
                    <div>
                        <div>
                            <label>DNI dueño</label>
                            <input type="text" name="dni" size="30" require/><br>
                        </div>
                    </div>           
                    <div>
                        <button type="submit" name="formperro" class="btn btn-dark btn-lg">Cargar</button>
                    </div>           
                </fieldset>
            </form>
        </main>
    </body>
</html>

                        
                            
                       
<!--------------------------------------- CONSULTA --------------------------------------->
<?php
    if (isset($_POST['formperro'])) {
        
        $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaActual = date("Y-m-d");
        
        
        if($_FILES['foto']['name'] == "") {
            $foto = "perroDefault.jpg";
        } else {
            $foto = $_POST['nombre'].$_FILES['foto']['name'];
            $tmpNombre = $_FILES['foto']['tmp_name'];
            $destino = "fotos/".$foto;
            move_uploaded_file($tmpNombre, $destino);
        }

    

        $sql = "INSERT INTO animales
        VALUES(
        null,
        '".$_POST["nombre"]."', 
        '".$_POST["sexo"]."', 
        '".$_POST["raza"]."', 
        '".$_POST["porte"]."', 
        '".$_POST["manto"]."', 
        '".$_POST["rasgos"]."',
        '$foto',
        '".$_POST["protectora_id"]."',
        '".$_POST["persona_id"]."',
        'No',
        '',
        '.$fecha_actual.',
        0000-00-00    
        )";

        $resultado = mysqli_query($con, $sql) or die('Error de consulta');
        
        
        $sql2 = "INSERT INTO historia_clinica
        VALUES(
        0000-00-00, 
        0000-00-00, 
        0000-00-00, 
        0000-00-00, 
        0000-00-00,
        0000-00-00,
        0000-00-00,
        'Si'
        
        )";

        $resultado = mysqli_query($con, $sql2) or die('Error de consulta');

        mysqli_close($con);
        header("location:index.php");
    }
?>
