<!DOCTYPE html>
<html>
    <?php
        include('../componentes/head.php')
    ?>
    <body>
        <?php
            include('../componentes/header.php');
            include('../componentes/navBar.php');
        ?>
        <main>
            <h1>Carga de Protectoras</h1>
            <form id="formCarga" action="" method="POST">
                <fieldset>
                    <legend>Datos de la Protectora</legend>
                    <div>
                        <label>Nombre</label>
                        <input 
                        id= "inputNombre"
                        type="text" 
                        name="protectora_nombre" 
                        placeholder="Nombre" size="30" 
                        value="<?php if (isset($_POST['protectora_nombre'])) echo $_POST['protectora_nombre'];?>"
                        />
                    </div>
                    <div>
                        <label>Domicilio</label>
                        <input
                        id = "inputDomicilio" 
                        type="text" 
                        name="protectora_domicilio" 
                        placeholder="Domicilio" size="30"
                        value="<?php if (isset($_POST['protectora_domicilio'])) echo $_POST['protectora_domicilio'];?>"
                        />
                    </div>
                        <label>DNI Responsable</label>
                        <input 
                        id="inputDNI" 
                        type="text" 
                        name="persona_id" 
                        placeholder="DNI" 
                        size="30"/>
                    </div>
                    <div>
                        <button type="submit" name="protectora" class="btn btn-dark btn-lg">Cargar</button>
                    </div>
                </fieldset>
                
            </form>
        </main>
    </body>
</html>

<?php
if (isset($_POST['protectora'])) {
    $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
    $estaCargado = false;
    $inNombre;
    $inDomicilio;
    $inDni;
    ////////Verificacion Nombre///////////
    if(!empty($_POST['protectora_nombre'])) {
        $consulta = "SELECT * FROM protectoras";
        $resultado = mysqli_query($con, $consulta) or die('Error de consulta');
        while($row = mysqli_fetch_assoc($resultado)) {
            if($_POST['protectora_nombre'] == $row['protectora_nombre']) {
               
                $estaCargado = true;
                break;
            }
        }
        if($estaCargado) {
            echo "<script type='text/javascript'>alert('Ese nombre ya existe')</script>
                <style>
                    #inputNombre { border: 2px solid red }
                </style>
                ";
        } else {
            $inNombre = $_POST['protectora_nombre'];
            ///////Verificacion domicilio/////////
            if(empty($_POST['protectora_domicilio'])) {
                echo "<script type='text/javascript'>alert('Ingrese el domicilio')</script>
                <style>
                    #inputDomicilio { border: 2px solid red }
                </style>
                ";
            } else {
                $inDomicilio = $_POST['protectora_domicilio'];
                //////Verificacion DNI////////
                if(!empty($_POST['persona_id'])) {
                    $estaCargado = false;
                    $consulta = "SELECT * FROM personas";
                    $resultado = mysqli_query($con, $consulta) or die('Error de consulta');
                    while($row = mysqli_fetch_assoc($resultado)) {
                        if($_POST['persona_id'] == $row['dni_persona']) {
                            $inDni = $row['persona_id'];
                            $estaCargado = true;
                            break;
                        }
                    }
                    if(!$estaCargado) {
                        echo "<script type='text/javascript'>alert('Esa persona no esta cargada')</script>
                        <style>
                            #inputNombre { border: 2px solid red }
                        </style>
                        ";
                    } 
                } else {
                    echo "<script type='text/javascript'>alert('Ingrese un DNI')</script>
                    <style>
                        #inputDNI { border: 2px solid red }
                    </style>
                    ";
                }
            }
        }
    } else {
        echo "<script type='text/javascript'>alert('Ingrese un nombre')</script>
        <style>
            #inputNombre { border: 2px solid red }
        </style>
        ";
    }  

    if(!empty($inNombre) && !empty($inDomicilio) && !empty($inDni)) {
        $sql = "INSERT INTO protectoras (protectora_nombre)
        VALUES(
            '{$inNombre}'  
            
        )";
        $resultado = mysqli_query($con, $sql) or die('Error de consulta');
        header("location:../views/cargar.php");

    } else {
        echo "<script type='text/javascript'>alert('Error en la carga')</script>";
    }


    mysqli_close($con);
} 
?>