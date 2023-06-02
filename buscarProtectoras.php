<?php

session_start();
$session = $_SESSION['usuario'];
$cargo = $_SESSION['cargo'];
if($session == null) {
    $error = include('componentes\error.php');
    session_destroy();
    echo $error;
    exit();

}
$autorizado = "";
if ($cargo != 1) {
    $autorizado = "none";
}

?>
<!DOCTYPE html>
<html>

    <?php
        include('componentes\head.php')
    ?>
    
    <body class="containergeneral">
           
    <?php
        include('componentes\header.php');
        include('componentes\navBar.php')
    ?>
    <main class="mainBusqueda">
        
            <form action="buscar.php" method="POST">
                <fieldset class="formBusqueda">
                    <legend>Seleccione Criterio de busqueda</legend>
                    <div>
                        <input class="inputBuscar" type="text" name="nombre" placeholder="Protectora" />
                        <input class="inputBuscar" type="text" name="apellido" placeholder="Apellido" />
                        <input class="inputBuscar" type="text" name="dni" placeholder="DNI" />
                        
                    </div>
                    <div class="botones">
                        <button class="btn btn-dark btn-lg" type="submit" name="buscar">Buscar</button>
                        <a type="button" class="btn btn-dark btn-lg" href="index.php">Volver</a>
                    </div>  
                </fieldset>
            </form>
        
        <div class="tablaBuscar">
            <!-- CONECCION -->
            <?php
                
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $fechaActual = date("Y-m-d");
            
                    $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
                        
                    $consulta = "SELECT * FROM protectoras
                    WHERE protectora_nombre LIKE '%{$_POST['nombre']}%' 
                    AND responsable_apellido LIKE '%{$_POST['apellido']}%' 
                    AND responsable_dni LIKE '%{$_POST['dni']}%'    
                    AND activo = 'Si'
                    ";
                    $resultado = mysqli_query($con, $consulta);
/*---------------------------Segunda consulta para la paginacion-------------------------------------------------------------------------------*/
                   
                    $cantResultados = @mysqli_num_rows($resultado);
                    $registrosXpagina = 4;
                    if (!isset ($_GET['page']) ) {  
                    $page = 1;  
                    } else {  
                    $page = $_GET['page'];  
                    }  
                    $primerResultadoPagina = ($page-1) * $registrosXpagina;
                    $cantidadPaginas = ceil($cantResultados/$registrosXpagina);

                    
                    $consulta2 = "SELECT * FROM protectoras
                    WHERE protectora_nombre LIKE '%{$_POST['nombre']}%' 
                    AND responsable_apellido LIKE '%{$_POST['apellido']}%' 
                    AND responsable_dni LIKE '%{$_POST['dni']}%'    
                    AND activo = 'Si' LIMIT ".$primerResultadoPagina.",".$registrosXpagina."
                    ";

                    $resultadoLimitado = mysqli_query($con, $consulta2);


/*------------------------------Fin segunda consulta para paginacion--------------------------------------------------------------------------------*/
                    mysqli_close($con);
                   
            ?>
            <!-- TABLA     -->
            
            <table class="table table-light table-striped table-lg">
                    <thead class="table table-dark">
                        <td>Nombre</td>
                        <td>Responsable</td>
                        <td>DNI</td>
                        <td>Telefono</td>
                        <td <?php echo 'style="display: '.$autorizado.';"' ?>>Editar</td>      
                </thead>
                <?php   
                    while($row = mysqli_fetch_assoc($resultadoLimitado)) {          
                ?>
<!--------------------------------- FORMULARIO PARA EDICION ------------------------------>            
                <tbody >
                    <form method="POST" action="modificarProtectora.php">
                        <tr>
                            <tr>
                                <input style="display: none;" name="protectora_id"  value="<?Php echo $row['protectora_id'] ?>">
                                
                                <td >
                                    <?php echo $row['protectora_nombre']?>     
                                </td>
                                <td>
                                    <?php echo $row['responsable_apellido'] ?>
                                </td>
                                <td>
                                    <?php echo $row['responsable_dni'] ?>
                                </td>
                                <td>
                                    <?php echo $row['telefono'] ?>
                                </td>
                                
                                <td <?php echo 'style="display: '.$autorizado.';"' ?> rowspan="2">
                                    <button type="submit" class="btn btn-dark btn-md" value="editar" name="editar">Editar</button>
                                </td>        
                            </tr>
                            
                        </tr>
                    </form>
                </tbody>
                <?php                
            }     
            
            ?>
            </table>
<!--------------------------------- FIN FORMULARIO PARA EDICION ------------------------------>     
<!---------------------------------- Menu de paginacion ---------------------------------->
        <?php
            $pagLink= "";
            if($page>=2){   
                echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscar.php?page='.($page-1).'">  Prev </a>';   
            }       
                       
            for ($i=1; $i<=$cantidadPaginas; $i++) {   
              if ($i == $page) {   
                  $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark active" role="button" href="buscar.php?page='.$i.'"> '.$i.' </a>';   
              }               
              else  {   
                  $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscar.php?page='.$i.'"> '.$i.' </a>';     
              }   
            };     
            echo $pagLink;   
      
            if($page<$cantidadPaginas){   
                echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscar.php?page='.($page+1).'">  Next </a>';   
            }   

        ?>

        </div>
    </main>


    

    <?php
        include('componentes\footer.php')
    ?>

    </body>

</html>