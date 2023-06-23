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
      
      
                        

<!----------------------------------- FIN CARRUSEL ---------------------------------------------->
                <div class="botones">
                    <a class="btn btn-dark btn-lg" role="button" href="index.php">Volver</a>
                </div>
                <div class="tablanoticias">
                    <?php
                            
                            $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
                    
                            $consulta = "SELECT * FROM animales WHERE buscado = 'Si'";
                    
                            $resultado = mysqli_query($con, $consulta);

/*-----------------------------------------------SEGUNDA CONSULTA PARA PAGINACION------------------------------------------*/
                            $cantResultados = @mysqli_num_rows($resultado);
                            $registrosXpagina = 10;
                            if (!isset ($_GET['page']) ) {  
                            $page = 1;  
                            } else {  
                            $page = $_GET['page'];  
                            }  
                            $primerResultadoPagina = ($page-1) * $registrosXpagina;
                            $cantidadPaginas = ceil($cantResultados/$registrosXpagina);

                            $consulta2 = "SELECT * FROM noticias LIMIT ".$primerResultadoPagina.",".$registrosXpagina."
                            ";

                            $resultadoLimitado = mysqli_query($con, $consulta2);
/*---------------------------------------------------FIN SEGUNDA CONSULTA PARA PAGINACION----------------------------------- */
                        ?>
                        <table class="table table-light table-striped">
                            <thead class="table table-dark" >
                                <th >Foto</th>
                                <th >Nombre</th>
                                <th >Datos</th>
                            </thead>
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($resultado)) { 
                                echo '
                                
                                    <tr>
                                        <td >
                                            <img height="50px" src="fotos/'.$row['foto'].'">
                                        </td>
                                        <td>'.$row['nombre'].'</td>
                                        <td>'.$row['buscado_datos'].'</td>
                                    </tr>
                                
                                ';                             
                            } 
                            mysqli_close($con);    
                        ?>
                            </tbody>
                        </table>
<!---------------------------------- Menu de paginacion ---------------------------------->
                    <?php
                        $pagLink= "";
                        if($page>=2){   
                            echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscado.php?page='.($page-1).'">  Prev </a>';   
                        }       
                                
                        for ($i=1; $i<=$cantidadPaginas; $i++) {   
                        if ($i == $page) {   
                            $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark active" role="button" href="buscado.php?page='.$i.'"> '.$i.' </a>';   
                        }               
                        else  {   
                            $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscado.php?page='.$i.'"> '.$i.' </a>';     
                        }   
                        };     
                        echo $pagLink;   
                
                        if($page<$cantidadPaginas){   
                            echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscado.php?page='.($page+1).'">  Next </a>';   
                        }   

                    ?>
                </div>
            
        </main>
            
        <?php
            include('componentes\footer.php');    
        ?>

    </body>

</html>