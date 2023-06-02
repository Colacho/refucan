<div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" style="color:#adb5bd; background-color: #212529;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Carga de Protectoras
        </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <form id="formCarga" action="" method="POST">
                <fieldset>
                    <legend>Datos de la Protectora</legend>
                    <div>
                        <label>Nombre</label>
                        <input type="text" name="protectora_nombre" placeholder="Nombre" size="30"/>
                    </div>
                    <div>
                        <label>Responsable Nombre</label>
                        <input type="text" name="responsable_nombre" placeholder="Nombre responsable" size="30"/>
                    </div>
                    <div>
                        <label>Responsable Apellido</label>
                        <input type="text" name="responsable_apellido" placeholder="Apellido responsable" size="30"/>
                    </div>
                    <div>
                        <label>DNI Responsable</label>
                        <input type="text" name="responsable_dni" placeholder="DNI" size="30"/>
                    </div>
                    <div>
                        <label>Telefono</label>
                        <input type="text" name="telefono" placeholder="Telefono" size="30"/>
                    </div>
                    <div>
                        <button type="submit" name="protectora" class="btn btn-dark btn-lg" >Cargar</button>
                    </div>
                </fieldset>
                
            </form>
        </div>
    </div>
</div>
<!--------------------------------------- CONSULTA --------------------------------------->
<?php
if (isset($_POST['protectora'])) {
    $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
    $sql = "INSERT INTO protectoras
    VALUES(
        null,
        '".$_POST["protectora_nombre"]."', 
        '".$_POST["responsable_nombre"]."', 
        '".$_POST["responsable_apellido"]."', 
        '".$_POST["responsable_dni"]."', 
        '".$_POST["telefono"]."',
        'Si'   
        )";
        $resultado = mysqli_query($con, $sql) or die('Error de consulta');
    mysqli_close($con);
    header("location:index.php");
}
?>
