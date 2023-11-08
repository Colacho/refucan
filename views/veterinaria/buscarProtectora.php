<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerVeterinaria.php');
            include('../../componentes/navBarVeterinaria.php');
        ?>
        <main>
            <div class="container mt-5 position-relative">
              <div class="row">
                <div class="col">
                        <form method="POST">
                            <h2>Buscar Protectoras</h2>
                            <fieldset class="formBusqueda">
                                <legend>Seleccione Criterio de busqueda</legend>
                                <div>
                                    <input type="text" name="nombre" placeholder="Nombre" />
                                </div>
                                <div class="botones">
                                    <button class="btn btn-success mb-2" type="submit" name="buscar">Buscar</button>
                                    <a class="btn btn-danger mb-2" role="button" href="buscar.php">Volver</a>
                                </div>  
                            </fieldset>
                        </form>
                        <?php
                            /*-----------Definirmos variables para que no muestre error de Notice: Undefined index:----------------------------------*/
                            $nombre = "";
                            
                            if(isset($_POST['buscar'])) {
                                $nombre = $_POST['nombre'];
                                
                            }
                            /*---------------------------Primera consulta para contar cantidad de resultados-------------------------------------------------------------------------------*/  
                                                    
                            $consulta = "SELECT * FROM potectora WHERE activo = 1 AND nombre LIKE '%{$nombre}%'";
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

                            $consulta2 = "SELECT * FROM protectora WHERE activo = 1 
                            AND nombre LIKE '%{$nombre}%'
                            LIMIT ".$primerResultadoPagina.",".$registrosXpagina."
                            ";

                            $resultadoLimitado = mysqli_query($Sconexion, $consulta2);

                            /*---------------------------Fin consultas paginacion-------------------------------------------------------------------------------*/
                        ?>
                        <table class="table table-dark" id="table">
                            <thead>
                                <tr>
                                <th scope="col">Logo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Provincia</th>
                                <th scope="col">Municipio</th>
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
                                        <img style="width: 50px" src="<?php echo '../../fotos/protectora/'.$row['foto'].'' ?>">
                                    </td>
                                    <td>
                                        <?php echo $row['nombre']?>
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
                                        <?php echo $row['numero_dire']?>
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
                        echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarPersona.php?page='.($page-1).'">  Prev </a>';   
                    }       
                        
                    for ($i=1; $i<=$cantidadPaginas; $i++) {   
                        if ($i == $page) {   
                        $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark active" role="button" href="buscarPersona.php?page='.$i.'"> '.$i.' </a>';   
                    }               
                    else  {   
                    $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarPersona.php?page='.$i.'"> '.$i.' </a>';     
                    }   
                };     
                    echo $pagLink;   
        
                if($page<$cantidadPaginas){   
                    echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarPersona.php?page='.($page+1).'">  Next </a>';   
                }   

                ?>
            </div>
<!-- ---------------------------Fin botonera paginacion------------------------------------------------------------------------------- -->

                </div>
            </div>
        </div>
        </main>
        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
    <!-- JAVASCRIPT FILES -->
    <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/jquery.sticky.js"></script>
        <script src="../../js/click-scroll.js"></script>
        <script src="../../js/custom.js"></script>
</html>