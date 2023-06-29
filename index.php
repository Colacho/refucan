<?php
<<<<<<< HEAD
    header("location: views/login.php");
?>
=======
session_start();
$session = $_SESSION['usuario']; 
if($session == null) {
    header("location:login.php");
    session_destroy();
    echo $error;
    exit();

}


?>

<!DOCTYPE html>
<html>
    <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style2.css">
<title>Bootstrap</title>
</head>


    <?php
        include('componentes\head.php')
    ?>
    
    <body class="containergeneral">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
        
        <?php
            include('componentes\header.php');
            include('componentes\navBar.php')
        ?>
            
        <main>
            <div class="central">
                <div>
                    <img class="logocentral" src="images/logo2.jpeg"/>
                </div>
                <div class="botones">         
                    <a class="btn btn-dark btn-lg" role="button" href="buscar.php">Buscar</a>
                    <a class="btn btn-dark btn-lg" role="button" href="buscarProtectoras.php">Protectoras</a>
                    <a class="btn btn-dark btn-lg" role="button" href="noticias.php">Noticias</a>
                    <a class="btn btn-dark btn-lg" role="button" href="cargar.php">Cargar</a>    
                </div>
            </div>
        </main>
            
        <?php
            include('componentes\footer.php')
        ?>

    </body>

</html>
>>>>>>> e57434955d4a75a9f23c4a6a26a9b3f4868a4765
