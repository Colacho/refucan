<!DOCTYPE html>
<html>
<?php
        include('../../componentes/head2.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerAdmin.php');
            include('../../componentes/navBarAdmin.php');
        ?>
        <main>
            <section class="contact-protectora section-padding" id="volver">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <!-- Trae los datos a partir del id -->
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    
                                    $consulta = "SELECT * FROM noticias WHERE noticia_id = '".$_POST['noticia_id']."'";
                                    
                                    $resultado = mysqli_query($Sconexion, $consulta);     
                                }
                                $row = mysqli_fetch_assoc($resultado)
                                ?>
                            <form method="POST" class="custom-form contact-form bg-white shadow-lg" enctype="multipart/form-data">
                                <h2>Editar Persona</h2>
                                <div class="row">
                                    <input style="display: none;" name="noticia_id"  value="<?Php echo $row['noticia_id'] ?>" readonly>
                                    <div>
                                        <label>Titulo:</label><br>
                                        <input value="<?php echo $row['titulo']?>" class="form-control" name="titulo"> 
                                    </div>
                                    <div>
                                        <label>Cuerpo:</label><br>
                                        <input value="<?php echo $row['cuerpo']?>" class="form-control" name="cuerpo"> 
                                    </div>
                                    <div>
                                        <label>Foto:</label><br>
                                        <img src="<?php echo '../../fotos/noticias/'.$row['foto'].'' ?>">
                                        <input type="file" name="foto" value="<?Php echo $row['foto'] ?>" class="form-control-file" accept="image/*">
                                    </div>
                                    
                                    <div>
                                        <label for="activo">Activo:</label>
                                        <select id="activo" name="activo" class="form-select">
                                            <option value="<?php echo $row['activo']?>"><?php echo $row['activo'] == 1 ? "Si" : "No"?></option>
                                            <option value="<?php echo $row['activo'] == 1 ? 0 : 1?>"><?php echo $row['activo'] == 1 ? "No" : "Si"?></option>	
                                        </select> 
                                        </label>
                                    </div>
                                    <button type="submit" name="guardar" class="form-control">Guardar</button>
                                    <a class="btn btn-light border-dark btn-lg" role="button" href="home.php">Volver</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
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