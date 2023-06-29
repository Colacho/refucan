<?php
session_start();


?>
<!DOCTYPE html>
<html>
    <?php
        include('componentes\head.php')
    ?>
    
    <body>
        <div>
        <?php

            include('componentes\navBar.php')
        ?>
        </div>
            <div class="central">
<!----------------------------- INICIO CARRUSEL --------------------------------------->
            
                <!------------------Consulta la base de datos con valor buscado ----------------->
                    <?php 
                     $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
                    
                     $consulta = "SELECT * FROM animales WHERE buscado = 'Si' LIMIT 5";
             
                     $resultado = mysqli_query($con, $consulta);
                    
          
                    ?>
              
                </div>
            </div>
<!-------------------------------- FIN CARRUSEL -------------------------------------------->

                <div class="tablanoticias">
                    <?php       
                            $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
                    
                            $consulta = "SELECT * FROM noticias ORDER BY fecha DESC";
                    
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
                          <table class="container">
                         <tr>
                         <th>Fecha</th>
                          <th>Noticia</th>
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($resultadoLimitado)) { 
                                echo '
                                <tr>
                                <div class="content">
                                    <td class="cell">'.$row['fecha'].'</td>
                                    <td class="cell">'.$row['texto'].'</td>
                                
                                </tr> ';
                                
                            } 
                            mysqli_close($con);
                            ?>
                         </table>
<!---------------------------------- Menu de paginacion ---------------------------------->
                        <?php
                            $pagLink= "";
                            if($page>=2){   
                                echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="noticias.php?page='.($page-1).'">  Prev </a>';   
                            }       
                                    
                            for ($i=1; $i<=$cantidadPaginas; $i++) {   
                            if ($i == $page) {   
                                $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark active" role="button" href="noticias.php?page='.$i.'"> '.$i.' </a>';   
                            }               
                            else  {   
                                $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="noticias.php?page='.$i.'"> '.$i.' </a>';     
                            }   
                            };     
                            echo $pagLink;   
                    
                            if($page<$cantidadPaginas){   
                                echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="noticias.php?page='.($page+1).'">  Next </a>';   
                            }   

                        ?>
                </div>
                <br>
<br>
<br>
        </main>
            
        <?php
            include('componentes\footer.php');    
        ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>

</html>