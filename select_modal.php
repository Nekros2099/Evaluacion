<?php
	include('conn.php');
	
	$id = $_GET['id'];
	$my_modal = $_GET['my_modal'];
	
	if ($my_modal=="modmenu"){
		$qry=mysqli_query($conn, "SELECT * FROM menus WHERE idmenus = '$id'") or die('error'.mysqli_error($conn));
		$data  = mysqli_fetch_assoc($qry);
		$menupadre=(empty($data['mn_depen'])) ? "" : $data['mn_depen'];
		if ($_GET['Action']=="add"){
			$titulo="Nuevo";
			$icon = "fa-solid fa-plus";
			$action="addmenu";
		}else{
			$titulo="Editar";
			$icon = "fa-solid fa-pencil";
			$action="editmenu";
		}
		echo "	<div class='modal-header bg-primary'>
					<h5 class='modal-title' id='newuser'><i class='$icon'></i> $titulo Menu</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<form action='operaciones.php' method='POST'>
					<input type='hidden' name='idmen' id='idmen' value='$id'>
					<div class='modal-body'>
							<div class='form-group'>
								<label for='tipus'>Menu Padre</label>
								<select class='custom-select' name='menp' id='menp' style='width:100%;'>
									<option value=''>Selecciona una opcion</option>";
									$sql = mysqli_query($conn,"SELECT * FROM menus WHERE mn_depen IS NULL") or die('error'.mysqli_error($conn));
									while($datac = mysqli_fetch_assoc($sql)){
										if($datac['idmenus']==$menupadre){
											echo "<option value='$datac[idmenus]' selected>$datac[mn_name]</option>";
										}else{
											echo "<option value='$datac[idmenus]'>$datac[mn_name]</option>";
										}
									}
		echo "					</select>
							</div>
							<div class='form-group'>
								<label for='nombre'>Nombre</label>
								<input type='text' class='form-control' id='nombre' name='nombre' value='$data[mn_name]' maxlength='45' autocomplete='off' required>
								<input type='hidden' name='id' name='id' value='$id'>
							</div>
							<div class='form-group'>
								<label for='desrip'>Descripcion</label>
								<textarea class='form-control' name='desrip' id='desrip' maxlength='45' autocomplete='off' required>$data[mn_descrip]</textarea>
							</div>
					</div>
					<div class='modal-footer'>
							<button class='btn btn-success' type='Submit' value='$action' name='action'><i class='fa-solid fa-check'></i> Guardar</button>
							<button type='button' class='btn btn-danger' data-dismiss='modal'><i class='fa-solid fa-xmark'></i> Cancelar</button>
					</div>
				</form>";
	}
?>