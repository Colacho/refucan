<!DOCTYPE html>
<html>
<?php
include('../../componentes/head2.php')
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
    <!-- Buscar la lista de esecies -->
    <?php 
        $sql = "SELECT e.nombre, COUNT(a.nombre) cant FROM `especies` e LEFT JOIN animal a ON a.especie = e.nombre AND a.activo GROUP BY e.nombre;";
        $resultaso = mysqli_query($Sconexion, $sql);
    ?>
    <main>
        <table class="table">
            <thead>
                <th>Especie</th>
                <th>Cantidad registrados</th>
                <th>Editar</th>
            </thead>
            <tbody>
                <?php   
                    while($row = mysqli_fetch_assoc($resultaso)) {
                ?>
                <tr>
                    <td><?php echo $row["nombre"];?></td>
                    <td><?php echo $row["cant"];?></td>
                    <td><a class="btn btn-secondary btn-sm btn-dark" role="button" href="editarEspecie.php?especie=<?php echo $row["nombre"];?>">Edita</a></td>
                </tr>
                <?php                
                }     
                ?>
            </tbody>
        </table>
        <a class="btn btn-light border-dark btn-lg" role="button" href="buscar.php">Volver</a>
    </main>
    <?php
    include('../../componentes/footer.php');
    ?>
</body>

</html>