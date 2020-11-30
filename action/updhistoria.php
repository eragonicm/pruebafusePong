<?php
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (
			!empty($_POST['mod_nombre'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$id=$_POST['mod_id'];
		$prioridad = $_POST["mod_prioridad"];
		$usuario = $_POST["mod_usuario"];
		$description = $_POST["mod_descripcion"];
		$proyecto = $_POST["mod_proyecto"];

		$sql="UPDATE historia_usuario SET nombre=\"$nombre\",prioridad=\"$prioridad\",id_usuario=\"$usuario\",descripcion=\"$description\",id_proyecto=\"$proyecto\" WHERE id=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La historia ha sido actualizada satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>