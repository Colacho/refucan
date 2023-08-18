<?php
$input_usuario=$_POST['usuario'];
$input_contraseña=$_POST['password'];

$conexion=mysqli_connect("localhost","refucan","colacho","refucan");

$consultaCantidadUsuarios="SELECT * FROM usuarios";
$resultadoCantidad=mysqli_query($conexion, $consultaCantidadUsuarios);
$fila=mysqli_fetch_array($resultadoCantidad);


if($resultadoCantidad->num_rows == 0){
    
    echo '
    <script>
        window.location.replace("../views/primeraPersona.php");
    </script>
    '; 
} else {
    
    $consultaAcceso = "SELECT pass FROM usuarios where correo='$input_usuario'";
    $resultadoAcceso = mysqli_query($conexion, $consultaAcceso);
    $fila = mysqli_fetch_array($resultadoAcceso);

    if($resultadoAcceso->num_rows > 0) {

        if(password_verify($input_contraseña, $fila['pass'])) {
            $consultaAcceso = "SELECT * FROM usuarios where correo='$input_usuario'";
            $resultadoAcceso = mysqli_query($conexion, $consultaAcceso);
            $fila = mysqli_fetch_array($resultadoAcceso);

            session_start();
            $_SESSION['usuario']=$fila['nombre'];
            $_SESSION['rol'] = $fila['cargo_id'];
            $_SESSION['usuario_id'] = $fila['usuario_id'];
        
            $consultaCargo="SELECT nombre FROM cargos where cargo_id = '".$_SESSION['rol']."'";
            $resultadoCargo=mysqli_query($conexion, $consultaCargo);
            $filaCargo=mysqli_fetch_array($resultadoCargo);
        
            $_SESSION['cargo']=$filaCargo['nombre'];
        
            echo '
                <script>
                    window.location.replace("../views/home.php");
                </script>
                '; 
    
            }else
            { 
                echo '
                    <script>
                        alert("Usuario o contraseña incorrecta");
                        window.location.replace("../index.php");
                    </script>
                    '; 
            }

    } else{
        echo '
        <script>
            alert("Usuario inexistente");
            window.location.replace("../index.php");
        </script>
        ';
    }

    }


mysqli_free_result($resultadoCantidad);
mysqli_close($conexion);
?>