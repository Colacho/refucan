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
    
    <!-- Buscar la lista de esecies -->
    <?php 
        $sql = "SELECT e.nombre, COUNT(a.nombre) cant FROM `especies` e LEFT JOIN animal a ON a.especie = e.nombre AND a.activo GROUP BY e.nombre;";
        $resultaso = mysqli_query($Sconexion, $sql);
    ?>
    <main>
    <div class="container mt-5 position-relative">
        <div class="row">
            <div class="col">
                <a class="btn btn-danger mb-2" role="button" href="home.php">Volver</a>
                <table class="table table-dark" id="table">
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
                            <td><a class="btn btn-warning" role="button" href="editarEspecie.php?especie=<?php echo $row["nombre"];?>">Editar</a></td>
                        </tr>
                        <?php                
                        }     
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </main>
    <?php
    include('../../componentes/footer.php');
    ?>
</body>

</html>