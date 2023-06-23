<?php
    session_start();
?>

<!DOCTYPE html>
<html>
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
        
        
        <?php
            include('componentes\header.php');
            include('componentes\navBar.php')
        ?>


        
            
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