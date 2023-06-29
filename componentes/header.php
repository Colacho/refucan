<?php

include('../src/session.php');

if(isset($_SESSION['usuario'])) { 
    
    $saludo = "Bienvenido $cargo $nombre";

 echo'
 
 <header>
 <div>
     <a href="index.php">
         <img class="logo" src="../images/logo.png"/>
     </a>
 </div>
 <div>
    <form action="../src/logout.php" method="POST">
        <medium>'.$saludo.'</medium>
        <button type="submit" name="logout" class="btn btn-light btn-lg">Log Out</button>
    </form>
    </div>
</header>
 ';
}else {
    header("location: login.php");
}

?>

        