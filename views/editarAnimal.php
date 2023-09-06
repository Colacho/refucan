<!DOCTYPE html>
<html>
<?php
        include('../componentes/head.php')
    ?>
    <body>
        <?php
            include('../componentes/header.php');
        ?>
        <main>
            <h1>Editar Persona</h1>
            <!-- Trae los datos a partir del id -->
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                   
                    
                    $consulta = "SELECT * FROM animal WHERE animal_id = '".$_POST['animal_id']."'";

                    $resultado = mysqli_query($Sconexion, $consulta);     
                }
                $row = mysqli_fetch_assoc($resultado);
                $json = json_decode($row['clinica']);
                
            ?>
            <form method="POST">
                <div>
                    <input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>" readonly>
                    <div>
                        <label>Nombre:</label><br>
                        <input value="<?php echo $row['nombre']?>" name="nombre"> 
                    </div>
                    <?php
                        foreach($json as $key=>$value) {
                            echo '
                                <div>
                                    <label>'.$key.'</label>
                                    <input value="'.$value.'" name="'.$key.'">
                                </div>
                            ';
                        }
                    ?>
                    <div>
						<label for="activo">Activo:</label>
						<select id="activo" name="activo">
							<option value="<?php echo $row['activo']?>"><?php echo $row['activo'] == 1 ? "Si" : "No"?></option>
							<option value="<?php echo $row['activo'] == 1 ? 0 : 1?>"><?php echo $row['activo'] == 1 ? "No" : "Si"?></option>	
						</select> 
						</label>
					</div>
                    <button type="submit" name="guardar" class="formboton">Guardar</button>
                </div>
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="buscarAnimal.php">Volver</a>
        </main>
    </body>
    <!-- Script localidades -->
    <script src="../src/localidades.js"></script>
</html>

<?php
    
    $nombreAnt = $row['nombre'];
    $json = json_decode($row['clinica']);
    var_dump($json);


//     if(isset($_POST['guardar'])){
        
//         function validar(&$prov, &$mun) {
//             if(($_POST["provincia"] == "provincia")){
                
//                 return true;
//             } else {
//                 $prov = $_POST['provincia'];
//                 if($_POST["municipio"] == "municipio"){
//                     echo '<script>
//                         this.document.getElementById("campoMunicipio").style.display = "block";
//                     </script>
//                     ';
//                     return false;
//                 } else {
//                     $mun = $_POST['municipio'];
//                     return true;
//                 }
                
//             }
//         }
//         $pasa = validar($provinciaAnt, $municipioAnt);

//         $consultaDni = "SELECT dni FROM personas WHERE dni = '".$_POST['dni']."'";
//         $resultadoDni = mysqli_query($Sconexion, $consultaDni) or die('Error de consulta DNI');
//         $rowDni = mysqli_fetch_assoc($resultadoDni);
//         if(mysqli_num_rows($resultadoDni) > 0) {
//             if($rowDni['dni'] != $dniAnt) {
//                 $pasa = false;
//                 echo '<script>
//                 this.document.getElementById("DNIcargado").style.display = "block";
//                 </script>
//                 '; 
//             }
//         }

// // Verifica si esta vacio el campo guarda los datos anteriores
//         if (empty($_POST['dni'])){
//         $guardaDni = $dniAnt;
//         }  else {
//         $guardaDni = $_POST['dni'];
//         }
//         if(empty($_POST['nombre'])) {
//             $guardaNombre = $nombreAnt;
//         } else {
//             $guardaNombre = $_POST['nombre'];
//         }
//         if(empty($_POST['apellido'])) {
//             $guardaApellido = $apellidoAnt;
//         } else {
//             $guardaApellido = $_POST['apellido'];
//         }
//         if(empty($_POST['telefono'])) {
//             $guardaTelefono = $telefonoAnt;
//         } else {
//             $guardaTelefono = $_POST['telefono'];
//         }
//         if(empty($_POST['calle'])) {
//             $guardaCalle = $calleAnt;
//         } else {
//             $guardaCalle = $_POST['calle'];
//         }
//         if(empty($_POST['numero_dire'])) {
//             $guardaNumero_dire = $numero_direAnt;
//         } else {
//             $guardaNumero_dire = $_POST['numero_dire'];
//         }

//         if($pasa) {

//             $consulta = "UPDATE personas SET 
//             nombre = '$guardaNombre',
//             apellido = '$guardaApellido',
//             dni = '$guardaDni',
//             telefono = '$guardaTelefono',
//             provincia = '$provinciaAnt',
//             municipio = '$municipioAnt',
//             calle = '$guardaCalle',
//             numero_dire = '$guardaNumero_dire',
//             activo = '".$_POST['activo']."'
//             WHERE persona_id = '".$_POST['persona_id']."';
//             ";
            
//             $resultado = mysqli_query($Sconexion, $consulta) or die('Error de consulta');

//             echo '
//             <script>
//                 window.location.replace("../views/buscar.php");
//             </script>
//             '; 
//         }

//     }
?>