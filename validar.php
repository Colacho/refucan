<?php
$usuario=$_POST['usuario'];
$contraseña=$_POST['password'];

session_start();
$_SESSION['usuario']=$usuario;

$conexion=mysqli_connect("localhost","root","","refucan");

$consulta="SELECT*FROM usuarios where usuario='$usuario' and pass='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_fetch_array($resultado);
$cargo = $filas['cargo_id'];
$_SESSION['cargo']=$cargo; 
if($cargo==1){ //administrador
    
    header("location:index.php");

}else
if($cargo==2){ //cliente
    
    header("location:index.php");
}
else{
    header("location:notLogged.php");
}
mysqli_free_result($resultado);
mysqli_close($conexion);

?>