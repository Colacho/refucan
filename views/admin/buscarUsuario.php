<!DOCTYPE html>
<html>
    <?php
        include('../../componentes/head2.php')
    ?>

    <?php
        include('../../componentes/headerAdmin.php');
    ?>

    <?php
        include('../../componentes/navBarAdmin.php');
    ?>

    <body>
        <main>
            <div class="container mt-5 position-relative">
              <div class="row">
                <div class="col">
                  <form method="POST">
                          <fieldset class="formBusqueda">
                              <legend>Seleccione Criterio de busqueda</legend>
                              <div>
                                  <input type="text" name="nombre_usuario" placeholder="Nombre" />
                                  <input type="text" name="correo" placeholder="Correo" />
                                  <input type="text" name="cargo" placeholder="Cargo" />
                                  <button class="btn btn-success mb-2" type="submit" name="buscar">Buscar</button>
                                  <a class="btn btn-danger mb-2" href="home.php">Volver</a>
                              </div>
                          </fieldset>
                  </form>
            
            <?php
                /*-----------Definirmos variables para que no muestre error de Notice: Undefined index:----------------------------------*/
                $nombre_usuario = "";
                $correo = "";
                $cargo = "";
                
                if(isset($_POST['buscar'])) {
                    $nombre_usuario = $_POST['nombre_usuario'];
                    $correo = $_POST['correo'];
                    $cargo = $_POST['cargo'];
                }
                /*---------------------------Primera consulta para contar cantidad de resultados-------------------------------------------------------------------------------*/  
                                        
                $consulta = "SELECT usuario_id, usuarios.nombre AS nombre_usuario, correo, cargos.nombre AS cargo
                FROM usuarios JOIN cargos ON usuarios.cargo_id = cargos.cargo_id
                WHERE usuarios.activo = 1 
                AND usuarios.nombre LIKE '%{$nombre_usuario}%'
                AND correo LIKE '%{$correo}%'
                AND cargos.nombre LIKE '%{$cargo}%'
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

                $consulta2 = "SELECT usuario_id, usuarios.nombre AS nombre_usuario, correo, cargos.nombre AS cargo
                FROM usuarios JOIN cargos ON usuarios.cargo_id = cargos.cargo_id
                WHERE usuarios.activo = 1 
                AND usuarios.nombre LIKE '%{$nombre_usuario}%'
                AND correo LIKE '%{$correo}%'
                AND cargos.nombre LIKE '%{$cargo}%'
                LIMIT ".$primerResultadoPagina.",".$registrosXpagina."
                ";

                $resultadoLimitado = mysqli_query($Sconexion, $consulta2);

                /*---------------------------Fin consultas paginacion-------------------------------------------------------------------------------*/
            ?>


            <table class="table table-dark" id="table">
                <thead>
                    <tr>
                    <th scope="col">Nombre Usuario</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Editar</th>
                    
                    </tr>
                </thead>
                <?php   
                    while($row = mysqli_fetch_assoc($resultadoLimitado)) {
                                
                ?>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $row['nombre_usuario']?>
                        </td>
                        <td>
                            <?php echo $row['correo']?>
                        </td>
                        <td>
                            <?php echo $row['cargo']?>
                        </td>
                        
                        <td>
                            <form method="POST" action="editarUsuario.php">
                                <input style="display: none;" name="usuario_id"  value="<?Php echo $row['usuario_id'] ?>" readonly>
                                <button class="btn btn-warning" type="submit" name="editar">Editar</button>
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
                        echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarUsuario.php?page='.($page-1).'">  Prev </a>';   
                    }       
                        
                    for ($i=1; $i<=$cantidadPaginas; $i++) {   
                        if ($i == $page) {   
                        $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark active" role="button" href="buscarUsuario.php?page='.$i.'"> '.$i.' </a>';   
                    }               
                    else  {   
                    $pagLink .= '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarUsuario.php?page='.$i.'"> '.$i.' </a>';     
                    }   
                };     
                    echo $pagLink;   
        
                if($page<$cantidadPaginas){   
                    echo '<a class="btn btn-secondary btn-sm btn-dark" role="button" href="buscarUsuario.php?page='.($page+1).'">  Next </a>';   
                }   

                ?>
            </div>
        </div>
    </div>
<!-- ---------------------------Fin botonera paginacion------------------------------------------------------------------------------- -->

        </main>

          <!-- JAVASCRIPT FILES -->
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/jquery.sticky.js"></script>
        <script src="../../js/click-scroll.js"></script>
        <script src="../../js/custom.js"></script>

        <?php
            include('../../componentes/footer.php');
        ?>
    </body>
</html>

      