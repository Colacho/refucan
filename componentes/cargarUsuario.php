<div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" style="color:#adb5bd; background-color: #212529;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Carga de Usuarios
        </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <form id="formCarga" action="" method="POST">
                <fieldset>
                    <legend>Datos del Usuario</legend>
                    <div>
                        <label>Nombre</label>
                        <input type="text" name="nombre" placeholder="Nombre" size="30"/>
                    </div>
                    <div>
                        <label>Nombre de Usuario</label>
                        <input type="text" name="usuario" placeholder="Usuario" size="30"/>
                    </div>
                    <div>
                        <label>Contraseña</label>
                        <input type="text" name="pass" placeholder="Contraseña" size="30"/>
                    </div>
                    <div>
                        <label>Nivel</label>
                        <select id="cargo_id" name="cargo_id">
                            <option value="1">Administrador</option>
                            <option value="2">Protectora</option>               
                        </select>
                    </div>
                    
                    <div>
                        <button type="submit" name="formUsuario" class="btn btn-dark btn-lg" >Cargar</button>
                    </div>
                </fieldset>
                
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['formUsuario'])) {
    $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
    $sql = "INSERT INTO usuarios
    VALUES(
        null,
        '".$_POST["nombre"]."', 
        '".$_POST["usuario"]."', 
        '".$_POST["pass"]."', 
        '".$_POST["cargo_id"]."'
        
        )";
        $resultado = mysqli_query($con, $sql) or die('Error de consulta');
    mysqli_close($con);
    header("location:index.php");
}
?>