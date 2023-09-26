<!DOCTYPE html>
<html>
<?php
        include('../../componentes/head.php')
    ?>
    <body>
        <?php
            include('../../componentes/headerUsuario.php');
        ?>
        <main >
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
                <div id="containerInputs" class="containerInputs">
                    <input style="display: none;" name="animal_id"  value="<?Php echo $row['animal_id'] ?>" readonly>

                    <div>
                        <label>Nombre:</label><br>
                        <input value="<?php echo $row['nombre']?>" name="nombre"> 
                    </div>
                    <div class="errorCampo" id="campoNombre" >
                        Complete el campo
                    </div>
                    <div class="form-group">
                        <label for="especie">Seleccione especie</label>
                        <select id="especie" name="especie" class="form-select">
                            <option value="<?php echo $row['especie']?>" selected><?php echo $row['especie']?></option>
                            <option value="Canino">Canino</option>
                            <option value="Felino">Felino</option>
                            <option value="Equino">Equino</option>
                            <option value="Bovino">Bovino</option>
                        </select>
                    </div>
                    <div>
						<label for="activo">Activo:</label>
						<select id="activo" name="activo">
							<option value="<?php echo $row['activo']?>"><?php echo $row['activo'] == 1 ? "Si" : "No"?></option>
							<option value="<?php echo $row['activo'] == 1 ? 0 : 1?>"><?php echo $row['activo'] == 1 ? "No" : "Si"?></option>	
						</select> 
						
					</div>
                    <div>
						<label for="">Observaciones:</label>
						<input value="<?php echo $row['observaciones']?>" name="observaciones"> 
						</label>
					</div>
                    
                 
                </div>
                
            </form>
            <a class="btn btn-light border-dark btn-lg" role="button" href="buscarAnimal.php">Volver</a>
        </main>
    </body>
    <script type="text/javascript" src="../../src/inputs.js">
        const f = document.getElementById("quitar")
        console.log(f)
        

    </script>
    
        <?php
            include('../../componentes/footer.php');
            
        ?>
</html>

<?php
    if (isset($_POST['guardar'])) {
        
       
        function validar() {

            
            if(empty($_POST['nombre'])) {
                echo '<script>
                        this.document.getElementById("campoNombre").style.display = "block";
                    </script>
                ';
                return false;
            }

            return true;
        }

        
        $pasa = validar();
        
        
        if($pasa) {
             
            $consulta = "UPDATE animal SET 
            nombre = '".$_POST["nombre"]."',
            especie = '".$_POST["especie"]."',
            observaciones = '".$_POST['observaciones']."',
            WHERE animal_id = '".$_POST["animal_id"]."';
            ";
                
            
            $resultado = mysqli_query($Sconexion, $consulta) or die(mysqli_error($Sconexion));
    
            echo '
            <script>
                window.location.replace("buscar.php");
            </script>
            '; 

        } 
        mysqli_close($Sconexion);
    } 

?>
<!-- <script>
    const btn_agregar = document.getElementById('crear');
btn_agregar.addEventListener('click', function(e){
    e.preventDefault();
    
    const nuevo = document.getElementById('nuevo').value;

    if(nuevo == "") {
        return;
    } else {

        const container = document.getElementById('containerIn');
    
        const div = document.createElement('div');
        div.setAttribute('class', 'form-group');
    
        const label = document.createElement('label');
        label.setAttribute('for', nuevo);
        label.innerHTML = nuevo;
    
        const input = document.createElement('input');
        input.setAttribute('name', nuevo);
        input.setAttribute('class', 'form-control');
        input.setAttribute('type', 'date');
    
        const btn = document.createElement('button');
        btn.setAttribute('id', 'quitar');
        btn.setAttribute('class', 'formboton');
        btn.setAttribute('style', 'margin: 5px')
        btn.addEventListener('click', eliminar)
        btn.innerHTML = 'Quitar';
    
    
        div.appendChild(label);
        div.appendChild(input);
        div.appendChild(btn);
        
        container.appendChild(div);
    }

    
    //console.log("anda");

});

function eliminar (e) {
    e.preventDefault();
    console.log(e.target.parentElement.remove());
}
</script> -->