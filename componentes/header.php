<?php

include('../src/session.php');

if(isset($Snombre)) { 
    
    $saludo = "Bienvenido $Scargo $Snombre";

 echo'
 
 <header>
 <div>
     <a href="home.php">
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

    
   echo '
    <script>
        window.location.replace("../views/login.php");
    </script>
   '; 
}

?>

        