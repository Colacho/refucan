<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerVeterinaria.php');
        ?>
        <main>
            <h1>Buscar Animal</h1>
            <form method="POST">
                <fieldset class="formBusqueda">
                    <legend>Seleccione Criterio de busqueda</legend>
                    <div>
                        <input type="text" name="nombreAnimal" placeholder="Nombre Animal" />
                        <input type="text" name="nombrePersona" placeholder="Nombre Persona" />
                        <input type="text" name="apellido" placeholder="Apellido" />
                        <input type="text" name="dni" placeholder="DNI" />
                    </div>
                    <div class="botones">
                        <button class="btn btn-dark btn-lg" type="submit" name="buscar">Buscar</button>
                    </div>  
                </fieldset>
            </form>
    <?php

/*----------------Primera consulta para contar cantidad de resultados-------------------*/  

    
    /*-----------Definirmos variables para que no muestre error de Notice: Undefined index:----------------------------------*/
        $nombreAnimal = "";
        $nombrePersona = "";
        $apellido = "";
        $dni = "";
        if(isset($_POST['buscar'])) {
            $nombreAnimal = $_POST['nombreAnimal'];
            $nombrePersona = $_POST['nombrePersona'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
        }
                  
        $consulta = "SELECT personas.nombre AS nombrePersona, apellido, dni, telefono, animal_id, animal.nombre AS nombre, especie 
        FROM animal 
        JOIN personas ON animal.persona_id = personas.persona_id
        WHERE animal.activo = 1 
        AND animal.nombre LIKE '%{$nombreAnimal}%'
        AND personas.nombre LIKE '%{$nombrePersona}%'
        AND apellido LIKE '%{$apellido}%'
        AND dni LIKE '%{$dni}%'
        
        ";
        $resultado = mysqli_query($Sconexion, $consulta);
        
        /*---------------------------Segunda consulta para la paginacion---------------------------*/
        $cantResultados = @mysqli_num_rows($resultado);
        $registrosXpagina = 5; /* Cantidad de registros por cada pagina */
        if (!isset ($_GET['page']) ) {  
        $page = 1;  
        } else {  
        $page = $_GET['page'];  
        }  
        $primerResultadoPagina = ($page-1) * $registrosXpagina;
        $cantidadPaginas = ceil($cantResultados/$registrosXpagina);

        $consulta2 = "SELECT personas.nombre AS nombrePersona, apellido, dni, telefono, animal_id, animal.nombre AS nombre, especie 
        FROM animal 
        JOIN personas ON animal.persona_id = personas.persona_id
        WHERE animal.activo = 1 
        AND animal.nombre LIKE '%{$nombreAnimal}%'
        AND personas.nombre LIKE '%{$nombrePersona}%'
        AND apellido LIKE '%{$apellido}%'
        AND dni LIKE '%{$dni}%'

        LIMIT ".$primerResultadoPagina.",".$registrosXpagina."
        ";

        $resultadoLimitado = mysqli_query($Sconexion, $consulta2);
 /*---------------------------Fin consultas paginacion-------------------*/


    ?>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre Persona</th>
            <th scope="col">Apellido</th>
            <th scope="col">DNI</th>
            <th scope="col">Telefono</th>
            <th scope="col">Nombre Animal</th>
            <th scope="col">Ver/Editar</th>
            
            </tr>
        </thead>
    <?php   
        while($row = mysqli_fetch_assoc($resultadoLimitado)) {     

    ?>
        <tbody>
            <tr>
                <td>
                    <?php echo $row['nombrePersona']?>
                </td>
                <td>
                    <?php echo $row['apellido']?>
                </td>
                <td>
                    <?php echo $row['dni']?>
                </td>
                <td>
                    <?php echo $row['telefono']?>
                </td>
                <td>
                    <?php echo $row['nombre']?>
                </td>
                
                <td>
                    <form method="POST" action="editarAnimal.php">
                        <input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>" readonly>
                        <button type="submit" name="editar">Editar</button>
                    </form>
                </td>
            </tr>
        </tbody>
        <?php                
            }     
        ?>
    </table>  
            
            

            
<!-- ---------------------------Botonera paginacion------------------------------------------------------------------------------- -->
            <div>
                <?php
                    $pagLink= "";
                    if($page>=2){   
                        echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarAnimal.php?page='.($page-1).'">  Prev </a>';   
                    }       
                        
                    for ($i=1; $i<=$cantidadPaginas; $i++) {   
                        if ($i == $page) {   
                        $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark active" role="button" href="buscarAnimal.php?page='.$i.'"> '.$i.' </a>';   
                    }               
                    else  {   
                    $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarAnimal.php?page='.$i.'"> '.$i.' </a>';     
                    }   
                };     
                    echo $pagLink;   
        
                if($page<$cantidadPaginas){   
                    echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarAnimal.php?page='.($page+1).'">  Next </a>';   
                }   

                ?>
            </div>
            <a class="btn btn-light border-dark btn-lg" role="button" href="buscar.php">Volver</a>
        </main>
        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
</html>