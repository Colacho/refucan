<?php
include('../../src/session.php');

$saludo = "";

if ($Scargo_id == 3) { 
    $saludo = " $Scargo $Snombre";
    echo '
    <div>
        <a href="home.php"></a>
    </div>
    ';
} else {
    echo '
    <script>
        window.location.replace("../../index_.php");
    </script>
    '; 
}
?>