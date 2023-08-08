<!DOCTYPE html>
<html>
    <?php
        include('../componentes/head.php')
    ?>
    <body>
        <?php
            include('../componentes/header.php');
            include('../componentes/navBar.php');

/*---------------------------Primera consulta para contar cantidad de resultados-------------------------------------------------------------------------------*/                       
            $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
            $consulta = "SELECT noticia_id, titulo, cuerpo, foto, noticias.created_at, nombre  FROM noticias
            JOIN usuarios ON noticias.usuarios_usuario_id = usuarios.usuario_id
            WHERE noticias.activo = 1
            ";
            $resultado = mysqli_query($con, $consulta);
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

            $consulta2 = "SELECT noticia_id, titulo, cuerpo, foto, noticias.created_at AS fecha, nombre AS usuario  FROM noticias
            JOIN usuarios ON noticias.usuarios_usuario_id = usuarios.usuario_id
            WHERE noticias.activo = 1 LIMIT ".$primerResultadoPagina.",".$registrosXpagina."
            ";

            $resultadoLimitado = mysqli_query($con, $consulta2);
/*---------------------------Fin consultas paginacion-------------------------------------------------------------------------------*/
        ?>
        <main>
            <h1>Buscar Noticia</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <?php   
                    while($row = mysqli_fetch_assoc($resultadoLimitado)) {          
                ?>
                <tbody>
                    <tr>
                        <input style="display: none;" name="noticia_id"  value="<?Php echo $row['noticia_id'] ?>">
                        <td rowspan="">
                            <img  src="<?php echo '../fotos/noticias/'.$row['foto'].'' ?>">
                        </td>
                        <td>
                            <?php echo $row['titulo']?>
                        </td>
                        <td>
                            <?php echo $row['cuerpo']?>
                        </td>
                        <td>
                            <?php echo $row['usuario']?>
                        </td>
                        <td>
                            <?php echo $row['fecha']?>
                        </td>
                        <td>
                            <form method="POST" action="editarNoticia.php">
                                <input style="display: none;" name="noticia_id"  value="<?Php echo $row['noticia_id'] ?>" readonly>
                                <button type="submit" name="editar">Editar</button>
                            </form>
                        </td>
                    </tr>
                    
                </tbody>
                <?php                
                    }     
                ?>
            </table>
<!-- ---------------------------Botonera Paginacion------------------------------------------------------------------------------- -->
            <div>
                <?php
                    $pagLink= "";
                    if($page>=2){   
                        echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarNoticia.php?page='.($page-1).'">  Prev </a>';   
                    }       
                        
                    for ($i=1; $i<=$cantidadPaginas; $i++) {   
                        if ($i == $page) {   
                        $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark active" role="button" href="buscarNoticia.php?page='.$i.'"> '.$i.' </a>';   
                    }               
                    else  {   
                    $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarNoticia.php?page='.$i.'"> '.$i.' </a>';     
                    }   
                };     
                    echo $pagLink;   
        
                if($page<$cantidadPaginas){   
                    echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarNoticia.php?page='.($page+1).'">  Next </a>';   
                }   

                ?>
            </div>
<!-- ---------------------------Fin botonera paginacion------------------------------------------------------------------------------- -->
        </main>
    </body>
</html>