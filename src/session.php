<?php
    session_start();
    if(isset($_SESSION['usuario'])) { 
        $nombre = $_SESSION['usuario'];
        $cargo_id = $_SESSION['rol']; 
        $cargo = $_SESSION['cargo'];   
        $persona_id = $_SESSION['persona_id'];    
    }
    else {
        $nombre = "Invitado";
    }
?>
