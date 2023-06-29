<!DOCTYPE html>
<html>
   <?php
    include('../componentes/head.php');
   ?>
    <body class="containergeneral">
        
        <header>
            <div>
                <a href="home.php">
                    <img class="logo" src="../images/logo2.jpeg"/>
                </a>
            </div>
            <div>
                <h1>Bienvenidos a RefuCan</h1>
                <h3>Red de refugios para animales</h3>
            </div>
        </header>

        <?php
            include('../componentes/navBar.php');
        ?>
            
        <main>
            <div class="central">
                <div>
                    <img class="logocentral imgcentral" src="../images/logo2.jpeg"/>
                </div>
                <div >
                    <div>
                        <form action="../src/validar.php" method="POST">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="ingrese usuario">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="botones">
                                <button type="submit" value="" name="ingresar" class="btn btn-dark btn-lg">Ingresar</button>
                                <a class="btn btn-dark btn-lg" href="noticias.php">Noticias</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include('../componentes/footer.php');
        ?>
    </body>
</html>
