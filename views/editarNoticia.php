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
            <h1>Editar Persona</h1>
            <!-- Trae los datos a partir del id -->
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                   
                    $consulta = "SELECT * FROM noticias WHERE noticia_id = '".$_POST['noticia_id']."'";

                    $resultado = mysqli_query($Sconexion, $consulta);     
                }
                $row = mysqli_fetch_assoc($resultado)
            ?>
            <form method="POST" enctype="multipart/form-data">
                <div>
                    <input style="display: none;" name="noticia_id"  value="<?Php echo $row['noticia_id'] ?>" readonly>
                    <div>
                        <label>Titulo:</label><br>
                        <input value="<?php echo $row['titulo']?>" name="titulo"> 
                    </div>
                    <div>
                        <label>Cuerpo:</label><br>
                        <input value="<?php echo $row['cuerpo']?>" name="cuerpo"> 
                    </div>
                    <div>
                        <label>Foto:</label><br>
                        <img src="<?php echo '../fotos/noticias/'.$row['foto'].'' ?>">
                        <input type="file" name="foto" value="<?Php echo $row['foto'] ?>" class="form-control-file" accept="image/*">
                    </div>
                    
                    <div>
						<label for="activo">Activo:</label>
						<select id="activo" name="activo">
							<option value="<?php echo $row['activo']?>"><?php echo $row['activo'] == 1 ? "Si" : "No"?></option>
							<option value="<?php echo $row['activo'] == 1 ? 0 : 1?>"><?php echo $row['activo'] == 1 ? "No" : "Si"?></option>	
						</select> 
						</label>
					</div>
                    <button type="submit" name="guardar" class="formboton">Guardar</button>
                </div>
            </form>
            <a href="../views/home.php"><button class="button">Volver</button></a>
        </main>
    </body>
</html>

<?php

    $tituloAnt = $row['titulo'];
    $cuerpoAnt = $row['cuerpo'];
    $fotoNoticia = $row['foto'];
    
    if(isset($_POST['guardar'])){
        

        if(empty($_FILES['foto']['name'])) {

            $foto = $fotoNoticia;
        } else {
            
            $foto = $Snombre.$Susuario_id.$_FILES['foto']['name'];
            $tmpNombre = $_FILES['foto']['tmp_name'];
            $destino = "../fotos/noticias/".$foto;
            move_uploaded_file($tmpNombre, $destino);
        }
        
        if(empty($_POST['titulo'])) {
            $guardaTitulo = $tituloAnt;
        } else {
            $guardaTitulo = $_POST['titulo'];
        }
        if(empty($_POST['cuerpo'])) {
            $guardaCuerpo = $cuerpoAnt;
        } else {
            $guardaCuerpo = $_POST['cuerpo'];
        }
    
        $consulta = "UPDATE noticias SET 
        titulo = '$guardaTitulo',
        cuerpo = '$guardaCuerpo',
        foto = '$foto',
        activo = '".$_POST['activo']."'
        WHERE noticia_id = '".$_POST['noticia_id']."';
        ";
        
        $resultado = mysqli_query($Sconexion, $consulta) or die('Error de consulta');

        echo '
        <script>
            window.location.replace("../views/buscar.php");
        </script>
        '; 
        
    }
?>