<?php
$input_usuario=$_POST['usuario'];
$input_contraseña=$_POST['password'];

$conexion=mysqli_connect("localhost","root", "", "refucan");

// VERIFICA SI EXISTEN USUARIOS EN LA BASE DE DATOS Y SI NO NOS ENVIA A CREAR UNA PERSONA Y UN USUARIO ADMINISTRADOR
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
    // SI EXISTEN USUSARIOS VERIFICA LOS DATOS DE ACCESO
    $consultaAcceso = "SELECT pass FROM usuarios where correo='$input_usuario'";
    $resultadoAcceso = mysqli_query($conexion, $consultaAcceso);
    $fila = mysqli_fetch_array($resultadoAcceso);

    if($resultadoAcceso->num_rows > 0) {

        if(password_verify($input_contraseña, $fila['pass'])) {
            $consultaAcceso = "SELECT * FROM usuarios where correo='$input_usuario'";
            $resultadoAcceso = mysqli_query($conexion, $consultaAcceso);
            $fila = mysqli_fetch_array($resultadoAcceso);

            session_start();
            $_SESSION['usuario_id'] = $fila['usuario_id'];
            $_SESSION['usuario']=$fila['nombre'];
            $_SESSION['rol'] = $fila['cargo_id'];
            $_SESSION['id_persona'] = $fila['id_persona'];
            $_SESSION['institucion_id'] = $fila['institucion'];
            $_SESSION['institucion'] = " ";

            // IDENTIFICA LA INSTITUCION A LA QUE PERTENECE SI ES VETERINARIO O UNA PROTECTORA
            if($_SESSION['rol'] == 2) {
                $consultaVeterinaria = "SELECT nombre FROM veterinaria
                WHERE veterinaria_id = '{$_SESSION['institucion_id']}'
                ";
                 $resultadoConsultaVeterinaria = mysqli_query($conexion, $consultaVeterinaria);
                 $filaVeterinaria = mysqli_fetch_array($resultadoConsultaVeterinaria);
                 $_SESSION['institucion'] = $filaVeterinaria['nombre'];
            }

            if($_SESSION['rol'] == 3) {
                $consultaProtectora = "SELECT nombre FROM protectora
                WHERE protectora_id = '{$_SESSION['institucion_id']}'
                ";
                 $resultadoConsultaProtectora = mysqli_query($conexion, $consultaProtectora);
                 $filaProtectora = mysqli_fetch_array($resultadoConsultaProtectora);
                 $_SESSION['institucion'] = $filaProtectora['nombre'];
            }
        
            // IDENTIFICA EL NOMBRE DEL CARGO EN LA BASE DE DATOS
            $consultaCargo="SELECT nombre FROM cargos where cargo_id = '".$_SESSION['rol']."'";
            $resultadoCargo=mysqli_query($conexion, $consultaCargo);
            $filaCargo=mysqli_fetch_array($resultadoCargo);
        
            $_SESSION['cargo']=$filaCargo['nombre'];
        
            echo '
                <script>
                    window.location.replace("../redirect.php");
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