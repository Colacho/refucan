<?php
    session_start();
    if(isset($_SESSION['usuario'])) { 
        $Snombre = $_SESSION['usuario'];
        $Scargo_id = $_SESSION['rol']; 
        $Scargo = $_SESSION['cargo'];   
        $Susuario_id = $_SESSION['usuario_id'];
        $Sconexion = mysqli_connect("localhost","root","","refucan") or die('Error de consulta');    
    }
   
?>
