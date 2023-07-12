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
            <h1>Carga de Personas</h1>
            <form action="" method="POST" class="my-form">
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <textarea name="apellido" id="apellido" class="form-control" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="dni">Documento</label>
                    <input type="text" name="dni" id="dni" class="form-control">
                </div>
                <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" class="form-control">
            </div>
            <div class="form-group">
                <label for="provincia">Provincia</label>
                <select id="provincia">
                    <option value="provincia">Seleccione una provincia</option>
                </select>
                <span></span>
                
                <label for="municipio">Municipio</label>
                <select id="municipio">
                    <option value="municipio">Seleccione una localidad</option>
                </select>
                <span></span>
                
                
            </div>
            <button type="submit" name="cargarPersona" class="formboton">Agregar Noticia</button>
        </form>
    </main>
</body>
<script src="../src/script.js"></script>
</html>