<!DOCTYPE html>
<html lang="es">
<?php
include('../../componentes/head2.php');
?>

<body>
    <?php
    include('../../componentes/headerAdmin.php');
    ?>

    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a href="../views/admin/home.php" class="navbar-brand mx-auto mx-lg-0">
                <img class="logo" src="../../images/logo.jpg" />
                <span class="brand-text">Refucan</span>
            </a>

            <form action="../../src/logout.php" method="POST">
                <button type="submit" name="logout" class="nav-link custom-btn btn d-lg-none">Log Out</button>
            </form>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">

                        <form action="../../src/logout.php" method="POST">
                            <button type="submit" name="logout" class="nav-link custom-btn btn d-none d-lg-block">Log Out</button>
                        </form>

                    </li>
                </ul>
            </div>
    </nav>
    <main>

        <!-- formulario de contacto diseño mio -->
        <section class="contact-animal section-padding" id="volver">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <form class="custom-form contact-form bg-white shadow-lg" id="formulario" method="POST" class="my-form">
                            <h2>Carga de Especie</h2>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de especie" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre']; ?>">

                                    <div class="errorCampo" id="campoNombre">
                                        Ingrese Especie
                                    </div>
                                    <div class="errorCampo" id="nombreCargado">
                                        Ingrese Especie
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" name="cargarEspecie" class="form-control">Agregar Especie</button>
                                </div>
                                <p></p>
                                <div class="col-12">
                                    <a class="form-control text-center" href="cargar.php">Volver</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php
    include('../../componentes/footer.php')
    ?>
</body>

</html>

<?php
if (isset($_POST['cargarEspecie'])) {
    function validar($conex): bool
    {
        if (empty($_POST["nombre"])) {
            echo '<script>
                this.document.getElementById("campoNombre").style.display = "block";
                </script>
            ';
            return false;
        } else {
            $sql = "SELECT nombre FROM especies WHERE nombre = '" . $_POST['nombre'] . "';";
            $resultadoVerifica = mysqli_query($conex, $sql) or die('Error de consulta');
            if ($resultadoVerifica->num_rows > 0) {
                echo '<script>
                        this.document.getElementById("nombreCargado").style.display = "block";
                    </script>
                    ';
                return false;
            }
        }
        return true;
    }
    if (validar($Sconexion)) {
        $sql = "INSERT INTO `especies` (`nombre`) VALUES ('" . $_POST["nombre"] . "');";
        mysqli_query($Sconexion, $sql) or die(mysqli_error($Sconexion));
        echo '
            <script>
                window.location.replace("home.php");
            </script>';
    }
}
?>