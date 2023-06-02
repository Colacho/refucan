<!DOCTYPE html>
<html>

    <?php
        include('componentes\head.php')
    ?>
    
    <body class="containergeneral">
        
        <?php
            include('componentes\header.php');
            include('componentes\navBar.php')
        ?>
            
        <main >
            <div class="central">
                <div>
                <img class="logocentral imgcentral" src="images/logo2.jpeg"/>
                </div>
                <h1>Usuario o contraseña incorrecto</h1>
                <div >
                    <div>
                        <form action="validar.php" method="POST">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="ingrese usuario">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            
                            <div class="botones" >
                                <button type="submit" value="" name="ingresar" class="btn btn-dark btn-lg">Ingresar</button>
                                <a class="btn btn-dark btn-lg" href="noticias.php">Noticias</a>
                            </div>
                        </form>
                
                
            
                    </div>
                </div>
            </div>
        </main>
            
        <?php
            include('componentes\footer.php')
        ?>

    </body>

</html>