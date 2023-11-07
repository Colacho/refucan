<!DOCTYPE html>
<html>

    <?php
        include('../../componentes/head2.php');
    ?>

    <?php
        include('../../componentes/headerVeterinaria.php');
        include('../../componentes/navBarVeterinaria.php');
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
                              <input type="text" name="nombreAnimal" placeholder="Nombre Animal" />
                              <input type="text" name="nombrePersona" placeholder="Nombre Persona" />
                              <input type="text" name="apellido" placeholder="Apellido" />
                              <input type="text" name="dni" placeholder="DNI" />
                              <input type="text" name="protectora" placeholder="Protectora" />
                              <button class="btn btn-success mb-2" type="submit" name="buscar">Buscar</button>
                              <a class="btn btn-danger mb-2" href="home.php">Volver</a>
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
                  $protectora = "";
                  if(isset($_POST['buscar'])) {
                      $nombreAnimal = $_POST['nombreAnimal'];
                      $nombrePersona = $_POST['nombrePersona'];
                      $apellido = $_POST['apellido'];
                      $dni = $_POST['dni'];
                      $protectora = $_POST['protectora'];
                  }
                            
                  $consulta = "SELECT personas.nombre AS nombrePersona, apellido, dni, personas.telefono AS telefono, animal_id, animal.nombre AS nombre, especie, 
                  institucion, protectora.nombre AS nombre_institucion, protectora.telefono AS tel_prot, animal.foto AS foto  
                  FROM personas 
                  JOIN animal ON personas.persona_id = animal.persona_id
                  JOIN protectora ON animal.institucion = protectora.protectora_id
                  WHERE animal.activo = 1 
                  AND animal.nombre LIKE '%{$nombreAnimal}%'
                  AND personas.nombre LIKE '%{$nombrePersona}%'
                  AND apellido LIKE '%{$apellido}%'
                  AND dni LIKE '%{$dni}%'
                  AND protectora.nombre LIKE '%{$protectora}%'
                  
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

                  $consulta2 = "SELECT personas.nombre AS nombrePersona, apellido, dni, personas.telefono AS telefono, animal_id, animal.nombre AS nombre, especie, 
                  institucion, protectora.nombre AS nombre_institucion, protectora.telefono AS tel_prot, animal.foto AS foto  
                  FROM personas 
                  JOIN animal ON personas.persona_id = animal.persona_id
                  JOIN protectora ON animal.institucion = protectora.protectora_id
                  WHERE animal.activo = 1 
                  AND animal.nombre LIKE '%{$nombreAnimal}%'
                  AND personas.nombre LIKE '%{$nombrePersona}%'
                  AND apellido LIKE '%{$apellido}%'
                  AND dni LIKE '%{$dni}%'
                  AND protectora.nombre LIKE '%{$protectora}%'

                  LIMIT ".$primerResultadoPagina.",".$registrosXpagina."
                  ";

                  $resultadoLimitado = mysqli_query($Sconexion, $consulta2);
           /*---------------------------Fin consultas paginacion-------------------*/


          ?>


              <table class="table table-dark" id="table">

              <thead>
                  <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre Animal</th>
                    <th scope="col">Nombre Persona</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Protectora</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Editar</th>
                  </tr>
              </thead>

                  <?php   
                    while($row = mysqli_fetch_assoc($resultadoLimitado)) {     
                  ?>

                <tbody>
                    <tr>
                        <td>
                              <img src="<?php echo '../../fotos/animales/'.$row['foto'].'' ?>" style="width: 40px">
                        </td>
                        <td>
                            <?php echo $row['nombre']?>
                        </td>
                        <td>
                            <?php echo $row['institucion'] == 0 ? $row['nombrePersona'] : '-'?>
                        </td>
                        <td>
                        <?php echo $row['institucion'] == 0 ? $row['apellido'] : '-'?>
                        </td>
                        <td>
                        <?php echo $row['institucion'] == 0 ? $row['dni'] : '-'?>
                        </td>
                        <td>
                        <?php echo $row['institucion'] == 0 ? '-' : $row['nombre_institucion']?>
                        </td>
                        <td>
                        <?php echo $row['institucion'] == 0 ? $row['telefono'] : $row['tel_prot']?>
                        </td>
                        
                        <td>
                            <form method="POST" action="editarAnimal.php">
                                <input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>" readonly>
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
        </div>
      </div>
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