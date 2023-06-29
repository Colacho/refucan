<?php
$input_usuario=$_POST['usuario'];
$input_contraseña=$_POST['password'];

$conexion=mysqli_connect("localhost","root","","refucan");
$consulta="SELECT*FROM usuarios where email='$input_usuario' and pass='$input_contraseña'";
$resultado=mysqli_query($conexion,$consulta);
$filas=mysqli_fetch_array($resultado);

if($resultado->num_rows > 0){
    
    session_start();
    $_SESSION['usuario']=$filas['nombre'];
    $rol = $filas['cargo_id'];

    $consulta2="SELECT rol FROM cargo where cargo_id='$rol'";
    $resultado2=mysqli_query($conexion,$consulta2);
    $filas2=mysqli_fetch_array($resultado2);

    $_SESSION['cargo']=$filas2['rol'];

    header("location:../views/home.php");

}else
{ 
    header("location:../index.php");
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>