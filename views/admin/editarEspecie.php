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
        <h1>Editar Especie</h1>
        <!-- Trae los datos a partir del id -->
        <?php
        $consulta = "SELECT * FROM personas WHERE persona_id = '" . $_GET['especie'] . "'";
        $row = mysqli_fetch_assoc(mysqli_query($Sconexion, $consulta))
        ?>
        <form method="POST">
            <div>
                <div>
                    <label>Nombre:</label><br>
                    <input value="<?php echo $_GET['especie'] ?>" name="nombre">
                </div>
                <div class="errorCampo" id="campoNombre">
                    Ingrese Nombre
                </div>
                <div class="errorCampo" id="errordetipo">
                    Tipo de dato incorrecto
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
if (isset($_POST['guardar'])) {

    function validar()
    {
        if (empty($_POST["nombre"])) {
            echo '<script>
                    this.document.getElementById("campoNombre").style.display = "block";
                </script>
                ';
            return false;
        }
        if (gettype($_POST["nombre"]) != "string") {
            echo '<script>
                        this.document.getElementById("errordetipo").style.display = "block";
                    </script>
                    ';
            return false;
        }
        return true;
    }
    if (validar()) {
        $sql = "UPDATE especies SET nombre = '".$_POST['nombre']."' WHERE especies.nombre = '".$_GET['especie']."';";
        $resultado = mysqli_query($Sconexion, $sql) or die('Error de consulta');

        echo '
            <script>
                window.location.replace("buscarEspecie.php");
            </script>
        ';
    }
}
?>