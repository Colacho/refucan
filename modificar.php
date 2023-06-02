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
    <main class="mainModificar">

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//------------ Fecha para la actualizacion de vacunas
				date_default_timezone_set('America/Argentina/Buenos_Aires');
				$fechaActual = date("Y-m-d");
				$id = $_POST['animal_id'];
				
				$con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
				$consulta = "SELECT * FROM animales 
							JOIN historia_clinica
							WHERE animal_id = clinica_id AND animal_id = '$id'
							";
							$resultado = mysqli_query($con, $consulta);
							mysqli_close($con);	
						}
			while($row = mysqli_fetch_assoc($resultado)) {  

		?>
		<form method="POST" enctype="multipart/form-data">
			<legend>Datos a modificar</legend>
			<div class="editarField" >
<!----------------------------------- DATOS DEL ANIMAL ------------------------------------------------------------------------>
				<div class="editarCampos">
					<input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>">
					<div>
						<label>Nombre: </label><br>
						<input value="<?php echo $row['nombre']?>" name="nombre">  	
					</div>
					<div>
						<label for="sexo">Sexo: </label><br>
						<select id="sexo" name="sexo">
							<option value="<?php echo $row['sexo']?>"><?php echo $row['sexo']?></option>
							<option value="<?php echo $row['sexo'] == "macho" ? "hembra" : "macho"?>"><?php echo $row['sexo'] == "macho" ? "hembra" : "macho"?></option>	
						</select>
					</div>
					
					<div>
						<label>Raza: </label><br>
						<input value="<?php echo $row['raza']?>" name="raza">
					</div>
					<div>
						<label for="porte">Porte: </label><br>
						<select id="porte" name="porte">
							<option value="<?php echo $row['porte']?>" selected><?php echo $row['porte']?></option>
							<option value="pequeño" style="display:<?php echo $row['porte'] == "pequeño" ? "none" : "" ?>">pequeño</option>
							<option value="mediano" style="display:<?php echo $row['porte'] == "mediano" ? "none" : "" ?>">mediano</option>
							<option value="grande" style="display:<?php echo $row['porte'] == "grande" ? "none" : "" ?>">grande</option>
						</select>
					</div>
					<div>
						<label for="manto">Manto:</label><br>
						<select id="manto" name="manto">
							<option value="<?php echo $row['manto']?>" selected><?php echo $row['manto']?></option>
							<option value="blanco" style="display:<?php echo $row['manto'] == "blanco" ? "none" : "" ?>">blanco</option>
							<option value="negro" style="display:<?php echo $row['manto'] == "negro" ? "none" : "" ?>">negro</option>
							<option value="marron" style="display:<?php echo $row['manto'] == "marron" ? "none" : "" ?>">marron</option>
							<option value="gris" style="display:<?php echo $row['manto'] == "gris" ? "none" : "" ?>">gris</option>
							<option value="dorado" style="display:<?php echo $row['manto'] == "dorado" ? "none" : "" ?>">dorado</option>
							<option value="cobrizo" style="display:<?php echo $row['manto'] == "cobrizo" ? "none" : "" ?>">cobrizo</option>
						</select>
					</div>
					<div>
						<label>Rasgos:</label><br>
						<textarea cols="40" rows="5" name="rasgos"><?php echo $row['rasgos']?></textarea>
					</div>
					<div>
						<Label>Foto:</Label><br>
						<?php
							$fotoVieja = $row['foto'];
						?>
						<input type="file" name="foto">
					</div>			
					<div>
						<label>Nombre Dueño:</label><br>
						<input value="<?php echo $row['nombre_persona']?>" name="nombre_persona"> 
					</div>
					<div>
						<label>Apellido Dueño:</label><br>
						<input value="<?php echo $row['apellido_persona']?>" name="apellido_persona">
					</div>
					<div>
						<label>DNI</label><br>
						<input value="<?php echo $row['dni']?>" name="dni">
					</div>                       
					<div>
						<label>Domicilio</label><br>
						<input value="<?php echo $row['domicilio_persona']?>" name="domicilio_persona">
					</div>
					<div>
						<label>Telefono</label><br>
						<input value="<?php echo $row['telefono_persona']?>" name="telefono_persona">
					</div>
				</div>
<!--------------------------------- DATOS HISTORIA CLINICA ----------------------------------------->
				<div class="editarCampos">                        
					<div>
						<?php
							$parvovirus = $row['parvovirus'] == "0000-00-00" ? "No" : $row['parvovirus']; 
						?>
						<label>Parvovirus:</label>
						<label for="parvovirus">
							<select id="parvovirus" name="parvovirus">
								<option value="<?php echo $row['parvovirus'] ?>"><?php echo $parvovirus ?></option>
								<option value="<?php echo $fechaActual ?>"><?php echo $fechaActual ?></option> 
			
							</select> 
						</label>
					</div>
					<div>
						<?php
							$antirrabica = $row['antirrabica'] == "0000-00-00" ? "No" : $row['antirrabica']; 
						?>
						<label>Antirrabica</label><br>
						<label for="antirrabica">
							<select id="antirrabica" name="antirrabica">
								<option value="<?php echo $row['antirrabica'] ?>"><?php echo $antirrabica ?></option>
								<option value="<?php echo $fechaActual ?>"><?php echo $fechaActual ?></option> 
							</select> 
						</label>
					</div>
					<div>
						<?php
							$hepatitis = $row['hepatitis'] == "0000-00-00" ? "No" : $row['hepatitis']; 
						?>
						<label>Hepatitis:</label><br>
						<label for="hepatitis">
							<select id="hepatitis" name="hepatitis">
								<option value="<?php echo $row['hepatitis'] ?>"><?php echo $hepatitis ?></option>
								<option value="<?php echo $fechaActual ?>"><?php echo $fechaActual ?></option> 
							</select> 
						</label>
					</div>
					<div>
						<?php
							$moquillo = $row['moquillo'] == "0000-00-00" ? "No" : $row['moquillo']; 
						?>
						<label>Moquillo</label><br>
						<label for="moquillo">
							<select id="moquillo" name="moquillo">
								<option value="<?php echo $row['moquillo'] ?>"><?php echo $moquillo ?></option>
								<option value="<?php echo $fechaActual ?>"><?php echo $fechaActual ?></option> 
							</select> 
						</label>
					</div>
					<div>
						<?php
							$leptospirosis = $row['leptospirosis'] == "0000-00-00" ? "No" : $row['leptospirosis']; 
						?>
						<label>Leptospirosis</label><br>
						<label for="leptospirosis">
							<select id="leptospirosis" name="leptospirosis">
								<option value="<?php echo $row['leptospirosis'] ?>"><?php echo $leptospirosis ?></option>
								<option value="<?php echo $fechaActual ?>"><?php echo $fechaActual ?></option> 
							</select> 
						</label>
					</div>
					<div>
						<?php
							$castrado = $row['castrado'] == "0000-00-00" ? "No" : $row['castrado']; 
						?>
						<label>Castrado:</label><br>
						<label for="castrado">
							<select id="castrado" name="castrado">
								<option value="<?php echo $row['castrado'] ?>"><?php echo $castrado ?></option>
								<option value="<?php echo $fechaActual ?>"><?php echo $fechaActual ?></option> 
							</select> 
						</label>
					</div>
					<div>
						<?php
							$vivo = $row['vivo'] == "0000-00-00" ? "No" : $row['vivo']; 
						?>
						<label>Vivo</label><br>
						<label for="vivo">
						<select id="vivo" name="vivo">
							<option value="<?php echo $row['vivo']?>"><?php echo $row['vivo']?></option>
							<option value="<?php echo $row['vivo'] == "Si" ? "No" : "Si"?>"><?php echo $row['vivo'] == "Si" ? "No" : "Si"?></option>	
						</select> 
						</label>
					</div>
					<div>
						<label>Buscado:</label>
						<label for="buscado">
						<select id="buscado" name="buscado">
							<option value="<?php echo $row['buscado']?>"><?php echo $row['buscado']?></option>
							<option value="<?php echo $row['buscado'] == "Si" ? "No" : "Si"?>"><?php echo $row['buscado'] == "Si" ? "No" : "Si"?></option>	
						</select> 
						</label>
					</div>
					<div>
						<label>Datos de busqueda:</label><br>
						<textarea cols="40" rows="5" name="buscado_datos"><?php echo $row['buscado_datos']?></textarea>
					</div>
<!------------------------------------- Mapea la base de datos en busca de protectoras ------------------------------------------------->
					<div>
						<label>Protectora:</label><br>
						<label for="protectora">Seleccione protectora:</label>
							<select name="protectora" id="protectora">
								<option value="<?php echo $row['protectora']?>"><?php echo $row['protectora']?></option>    
								<?php
									$con2 = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
									$consulta2 = "SELECT * FROM protectoras";
									$resultado2 = mysqli_query($con2, $consulta2);
									while($row = mysqli_fetch_assoc($resultado2)) { 
										echo '
										<option value="'.$row['protectora_nombre'].'"> '.$row['protectora_nombre'].' </option>
										';
									}
								?>
							</select>
					</div>
<!------------------------------------ FIN Mapea la base de datos en busca de protectoras ------------------------------------------------->
				</div>
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

<!--------------------------------------- CONSULTA --------------------------------------->
<?php
if(isset($_POST['modificar'])) {

	if($_FILES['foto']['name'] == "") {
		$foto = $fotoVieja;
	} else {
		$foto = $_POST['nombre'].$_FILES['foto']['name'];
		$tmpNombre = $_FILES['foto']['tmp_name'];
		$destino = "fotos/".$foto;
		move_uploaded_file($tmpNombre, $destino);
	}

    $con = mysqli_connect('localhost', 'root', '', 'refucan') or die('Error al conectarse');
    $sql3 = "UPDATE animales SET 
    nombre = '".$_POST['nombre']."', 
    sexo = '".$_POST["sexo"]."', 
    raza = '".$_POST["raza"]."', 
    porte = '".$_POST["porte"]."', 
    manto = '".$_POST["manto"]."', 
    rasgos = '".$_POST["rasgos"]."',
    foto = '$foto',
    protectora = '".$_POST["protectora"]."',
    nombre_persona = '".$_POST["nombre_persona"]."',
    apellido_persona = '".$_POST["apellido_persona"]."',
    dni = '".$_POST["dni"]."',
    domicilio_persona = '".$_POST["domicilio_persona"]."',
    telefono_persona = '".$_POST["telefono_persona"]."',
	buscado = '".$_POST["buscado"]."',
	buscado_datos = '".$_POST["buscado_datos"]."'
	WHERE animal_id = '$id'";

    $resultado = mysqli_query($con, $sql3) or die('Error de consulta');

	$sql4 = "UPDATE historia_clinica SET
	parvovirus = '".$_POST['parvovirus']."',
	antirrabica = '".$_POST['antirrabica']."',
	hepatitis = '".$_POST['hepatitis']."',
	moquillo = '".$_POST['moquillo']."',
	leptospirosis = '".$_POST['leptospirosis']."',
	castrado = '".$_POST['castrado']."',
	vivo = '".$_POST['vivo']."'
	WHERE clinica_id = '$id'";

	$resultado = mysqli_query($con, $sql4) or die('Error de consulta');

    mysqli_close($con);
	
	header("location:index.php");
}
?>