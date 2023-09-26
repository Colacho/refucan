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
            <h1>Editar Persona</h1>
            <!-- Trae los datos a partir del id -->
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                   
                    $consulta = "SELECT * FROM personas WHERE persona_id = '".$_POST['id_persona']."'";

                    $resultado = mysqli_query($Sconexion, $consulta);     
                }
                $row = mysqli_fetch_assoc($resultado)
            ?>
                <div>
                    
                    <div>
                        <label>Nombre:</label><br>
                        <input value="<?php echo $row['nombre']?>" readonly>
                    </div>
                    <div>
                        <label>Apellido:</label><br>
                        <input value="<?php echo $row['apellido']?>" readonly> 
                    </div>
                    <div>
                        <label>DNI:</label><br>
                        <input value="<?php echo $row['dni']?>" readonly> 
                    </div>
                    <div>
                        <label>Telefono:</label><br>
                        <input value="<?php echo $row['telefono']?>" readonly> 
                    </div>
                    <div>
                        <label for="provincia">Provincia</label>
                        <input value="<?php echo $row['provincia']?>" readonly>
                        
                        
                        <label for="municipio">Municipio</label>
                        <input value="<?php echo $row['municipio']?>" readonly>
                        
                    </div>
                    <div>
                        <label>Calle:</label><br>
                        <input value="<?php echo $row['calle']?>" readonly> 
                    </div>
                    <div>
                        <label>Número:</label><br>
                        <input value="<?php echo $row['numero_dire']?>" readonly> 
                    </div>   
                </div>
            
            <a href="buscarProtectora.php"><button class="button">Volver</button></a>
        </main>
    </body>
</html>
