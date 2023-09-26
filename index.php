<!DOCTYPE html>
<html>
   <?php
    include('./componentes/head.php');
   ?>
    <body class="containergeneral">
        
        <header>
            <div>
                <a href="home.php">
                    <img class="logo" src="../images/logo.png"/>
                </a>
            </div>
            <div>
                <h1>Registro de mascotas</h1>
                
            </div>
        </header>   
        <main>
        <br>
            <br>
            <br>
            <div class="central">
                <div>
                    <img class="logocentral" src="../images/logo.png",>
                </div>
                <br>
                <div >
                    <div>
                        <form action="../src/validar.php" method="POST">
                            <div class="formlogin">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="ingrese usuario">
                            </div>
                            <br>
                            <div class="formlogin">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <br>
                            <div class="formbotones">
                                <button type="submit" value="" name="ingresar" class="formboton">Ingresar</button>
                                <button type="submit" value="" name="noticias" class="formboton">Noticias</button>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </main>
        <?php
            include('./componentes/footer.php');
        ?>
    </body>
</html>