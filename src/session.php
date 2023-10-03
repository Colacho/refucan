<?php
    session_start();
    if(isset($_SESSION['usuario'])) { 
        $Snombre = $_SESSION['usuario'];
        $Scargo_id = $_SESSION['rol']; 
        $Scargo = $_SESSION['cargo'];   
        $Susuario_id = $_SESSION['usuario_id'];
        $Spersona_id = $_SESSION['id_persona'];
        //$Sinstitucion = $_SESSION['institucion'];
        $Sinstitucion_id = $_SESSION['institucion_id'];
        
        $Sconexion = mysqli_connect("localhost","root","","refucan") or die('Error de consulta');    
    }
   
?>
