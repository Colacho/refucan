<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerUsuario.php');
        ?>
        <main>
            <h1>Buscar Profesionales</h1>

            <form method="POST">
                <fieldset class="formBusqueda">
                    <legend>Seleccione Criterio de busqueda</legend>
                    <div>
                        <input type="text" name="apellido" placeholder="Apellido" />
                        <input type="text" name="matricula" placeholder="Matricula" />
                        <input type="text" name="veterinaria" placeholder="Veterinaria" />
                    </div>
                    <div class="botones">
                        <button class="btn btn-dark btn-lg" type="submit" name="buscar">Buscar</button>
                    </div>  
                </fieldset>
            </form>
            
            <?php
                /*-----------Definirmos variables para que no muestre error de Notice: Undefined index:----------------------------------*/
                $apellido = "";
                $matricula = "";
                $veterinaria = "";
                
                if(isset($_POST['buscar'])) {
                    $apellido = $_POST['apellido'];
                    $matricula = $_POST['matricula'];
                    $veterinaria = $_POST['veterinaria'];
                }
                /*---------------------------Primera consulta para contar cantidad de resultados-------------------------------------------------------------------------------*/  
                                        
                $consulta = "SELECT personas.nombre AS nombre_persona, apellido, matricula,
                profesional.profesional_id AS id, 
                veterinaria.nombre AS nombre_vete, veterinaria.provincia AS provincia, 
                veterinaria.municipio AS municipio, veterinaria.calle AS calle, 
                veterinaria.numero_dire AS numero, veterinaria.telefono AS telefono
                FROM personas
                JOIN profesional ON personas.persona_id = profesional.persona_id
                JOIN veterinaria ON profesional.veterinaria_id = veterinaria.veterinaria_id 
                WHERE profesional.activo = 1 
                AND apellido LIKE '%{$apellido}%'
                AND matricula LIKE '%{$matricula}%'
                AND veterinaria.nombre LIKE '%{$veterinaria}%'
                ";
                $resultado = mysqli_query($Sconexion, $consulta);

                /*---------------------------Segunda consulta para la paginacion-------------------------------------------------------------------------------*/
                $cantResultados = @mysqli_num_rows($resultado);
                $registrosXpagina = 2; /* Cantidad de registros por cada pagina */
                if (!isset ($_GET['page']) ) {  
                $page = 1;  
                } else {  
                $page = $_GET['page'];  
                }  
                $primerResultadoPagina = ($page-1) * $registrosXpagina;
                $cantidadPaginas = ceil($cantResultados/$registrosXpagina);

                $consulta2 = "SELECT personas.nombre AS nombre_persona, apellido, matricula,
                profesional.profesional_id AS id, profesional.veterinaria_id AS veteId, 
                veterinaria.nombre AS nombre_vete, veterinaria.provincia AS provincia, 
                veterinaria.municipio AS municipio, veterinaria.calle AS calle,
                veterinaria.numero_dire AS numero, veterinaria.telefono AS telefono
                FROM personas 
                JOIN profesional ON personas.persona_id = profesional.persona_id
                JOIN veterinaria ON profesional.veterinaria_id = veterinaria.veterinaria_id 
                WHERE profesional.activo = 1 
                AND apellido LIKE '%{$apellido}%'
                AND matricula LIKE '%{$matricula}%'
                AND veterinaria.nombre LIKE '%{$veterinaria}%'
                LIMIT ".$primerResultadoPagina.",".$registrosXpagina."
                ";

                $resultadoLimitado = mysqli_query($Sconexion, $consulta2);

                /*---------------------------Fin consultas paginacion-------------------------------------------------------------------------------*/
            ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Matricula</th>
                        <th scope="col">Veterinaria</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">Localidad</th>
                        <th scope="col">Calle</th>
                        <th scope="col">Numero</th>
                        <th scope="col">Telefono</th>
                    </tr>
                </thead>
                <?php   
                    while($row = mysqli_fetch_assoc($resultadoLimitado)) {         
                    
                ?>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $row['nombre_persona']?>
                        </td>
                        <td>
                            <?php echo $row['apellido']?>
                        </td>
                        <td>
                            <?php echo $row['matricula']?>
                        </td>
                        <td>
                            <?php echo $row['nombre_vete']?>
                        </td>
                        <td>
                            <?php echo $row['provincia']?>
                        </td>
                        <td>
                            <?php echo $row['municipio']?>
                        </td>
                        <td>
                            <?php echo $row['calle']?>
                        </td>
                        <td>
                            <?php echo $row['numero']?>
                        </td>
                        <td>
                            <?php echo $row['telefono']?>
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
                        echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarProfesional.php?page='.($page-1).'">  Prev </a>';   
                    }       
                        
                    for ($i=1; $i<=$cantidadPaginas; $i++) {   
                        if ($i == $page) {   
                        $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark active" role="button" href="buscarProfesional.php?page='.$i.'"> '.$i.' </a>';   
                    }               
                    else  {   
                    $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarProfesional.php?page='.$i.'"> '.$i.' </a>';     
                    }   
                };     
                    echo $pagLink;   
        
                if($page<$cantidadPaginas){   
                    echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarProfesional.php?page='.($page+1).'">  Next </a>';   
                }   

                ?>
            </div>
<!-- ---------------------------Fin botonera paginacion------------------------------------------------------------------------------- -->
        <a class="btn btn-light border-dark btn-lg" role="button" href="buscar.php">Volver</a>
        </main>

        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
</html>
