<!DOCTYPE html>
<html>
<<<<<<< HEAD:views/login.php
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

=======
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
<title>Refucan</title>
</head>
    <?php
        include('componentes\head.php')
    ?>
    
    <body class="containergeneral">
        
        
>>>>>>> e57434955d4a75a9f23c4a6a26a9b3f4868a4765:login.php
        <?php
            include('../componentes/navBar.php');
        ?>
<<<<<<< HEAD:views/login.php
            
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
=======


        
            
        <?php
         
        ?>

<script>
var searchIcon = document.getElementById('search-icon');
var searchBar = document.getElementById('search-bar');
var closeBtn = document.getElementById('close-btn');

searchIcon.addEventListener('click', function() {
  searchBar.style.display = 'flex';
});

closeBtn.addEventListener('click', function() {
  searchBar.style.display = 'none';
});
</script>

</body>  
</html>
>>>>>>> e57434955d4a75a9f23c4a6a26a9b3f4868a4765:login.php
