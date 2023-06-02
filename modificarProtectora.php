<?php

session_start();
$session = $_SESSION['usuario']; 

if($session == null) {
    $error = include('componentes\error.php');
    session_destroy();
    echo $error;
    exit();

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

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				date_default_timezone_set('America/Argentina/Buenos_Aires');
				$fechaActual = date("Y-m-d");
				$id = $_POST['protectora_id'];
				
				$con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
				$consulta = "SELECT * FROM protectoras
							WHERE protectora_id = '$id'
							";
							$resultado = mysqli_query($con, $consulta);
							mysqli_close($con);	
						}
			while($row = mysqli_fetch_assoc($resultado)) {  

		?>
		<form method="POST" enctype="multipart/form-data">
			<legend>Datos a modificar</legend>
			<div class="editarField" >
				<!-- DATOS DE LA PROTECTORA -->
				<div class="editarCampos">
					<input style="display: none;" name="protectora_id"  value="<?Php echo $row['protectora_id'] ?>">
					<div>
						<label>Nombre: </label><br>
						<input value="<?php echo $row['protectora_nombre']?>" name="protectora_nombre">  	
					</div>		
					<div>
						<label>Responsable Nombre: </label><br>
						<input value="<?php echo $row['responsable_nombre']?>" name="responsable_nombre">  	
					</div>		
					<div>
						<label>Responsable Apellido: </label><br>
						<input value="<?php echo $row['responsable_apellido']?>" name="responsable_apellido">  	
					</div>		
					<div>
						<label>Responsable DNI: </label><br>
						<input value="<?php echo $row['responsable_dni']?>" name="responsable_dni">  	
					</div>		
					<div>
						<label>Responsable Telefono: </label><br>
						<input value="<?php echo $row['telefono']?>" name="telefono">  	
					</div>			
					<div>
						<label for="activo">Activo:</label><br>
						<select id="activo" name="activo">
                            <option value="<?php echo $row['activo']?>"><?php echo $row['activo']?></option>
							<option value="<?php echo $row['activo'] == "Si" ? "No" : "Si"?>"><?php echo $row['activo'] == "Si" ? "No" : "Si"?></option>
						</select>
					</div>
					
				<div class="botones">
					<button type="submit" class="btn btn-dark btn-lg" name="modificar">Modificar</button>
					<a type="button" class="btn btn-dark btn-lg" href="index.php">Volver</a>
				</div>                 
		</form>


		<?php
			}
		?>
	</main>
	<?php
        include('componentes\footer.php')
    ?>
</body>
</html>       


<?php
if(isset($_POST['modificar'])) {


    $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
    $sql3 = "UPDATE protectoras SET 
    protectora_nombre = '".$_POST['protectora_nombre']."', 
    responsable_nombre = '".$_POST["responsable_nombre"]."', 
    responsable_apellido = '".$_POST["responsable_apellido"]."', 
    responsable_dni = '".$_POST["responsable_dni"]."', 
    telefono = '".$_POST["telefono"]."', 
    activo = '".$_POST["activo"]."'
    WHERE protectora_id = '$id'
    ";

    $resultado = mysqli_query($con, $sql3) or die('Error de consulta');


    mysqli_close($con);
	header("location:index.php");	
}
?>