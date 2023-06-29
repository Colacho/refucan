<?php

include('../src/session.php');

if(isset($_SESSION['usuario'])) { 
    
<<<<<<< HEAD
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
=======
}else {
    $saludo = "";
    $visible = "none";
}
?>
<header>
    <div>
        <a href="index.php">
            <img class="logo" src="images/logo.png"/>
        </a>
    </div>
    <div>
        <h1>Bienvenidos a RefuCan</h1>
        <h3>Red de refugios para animales</h3>
    </div>
    <div>
        <form action="logout.php" method="POST">
            <medium><?php echo $saludo; ?></medium>
            <button <?php echo 'style="display: '.$visible.';"' ?> type="submit" name="logout" class="btn btn-light btn-lg">Log Out</button>
        </form>
>>>>>>> e57434955d4a75a9f23c4a6a26a9b3f4868a4765
    </div>
</header>
 ';
}else {
    header("location: login.php");
}

?>

        