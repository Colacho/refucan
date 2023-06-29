<?php
    session_start();
    if(isset($_SESSION['usuario'])) { 
        $nombre = $_SESSION['usuario']; 
        $cargo = $_SESSION['cargo'];       
    }
    else {
        $nombre = "Invitado";
    }
?>
