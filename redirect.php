<?php
    include('./src/session.php');

    if(isset($_SESSION['usuario'])) {
        if($Scargo_id == 1) {
            echo '
            <script>
                window.location.replace("./views/admin/home.php");
            </script>
            '; 
        }
    }
    if(isset($_SESSION['usuario'])) {
        if($Scargo_id == 2) {
            echo '
            <script>
                window.location.replace("./views/veterinaria/home.php");
            </script>
            '; 
        }
    }
    if(isset($_SESSION['usuario'])) {
        if($Scargo_id == 3) {
            echo '
            <script>
                window.location.replace("./views/protectora/home.php");
            </script>
            '; 
        }
    }
    if(isset($_SESSION['usuario'])) {
        if($Scargo_id == 4) {
            echo '
            <script>
                window.location.replace("./views/usuario/home.php");
            </script>
            '; 
        }
    }
    

?>