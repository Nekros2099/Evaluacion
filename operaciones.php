<?php
	include('conn.php');
	if(!empty($_POST)){
		if ($_POST['action']=="addmenu") {
			$sql = mysqli_query($conn,"SELECT * FROM menus WHERE mn_name = '$_POST[nombre]'") or die('error'.mysqli_error($conn));
			if (mysqli_num_rows($qry)>0) {
				header("location: ../../index.php?alert=2");
			}else{
				$campos="mn_name,mn_descrip,mn_depen";
				$dependencia=(!empty($_POST['menp'])) ? "'$_POST[menp]'" : "NULL";
				$valores="'$_POST[nombre]','$_POST[desrip]',$dependencia";
				$qry = mysqli_query($conn,"INSERT INTO menus($campos) VALUES($valores)") or die('error'.mysqli_error($conn));
				if ($qry) {
					header("location: index.php?alert=1");
				}else{
					header("location: index.php?alert=3");
				}
			}
		}elseif ($_POST['action']=="editmenu") {
			$dependencia=(!empty($_POST['menp'])) ? "'$_POST[menp]'" : "NULL";
			$qry = mysqli_query($conn,"UPDATE menus SET mn_name='$_POST[nombre]',mn_descrip='$_POST[desrip]',mn_depen=$dependencia WHERE idmenus='$_POST[idmen]'") or die('error'.mysqli_error($conn));
			if ($qry) {
				header("location: index.php?alert=1");
			}else{
				header("location: index.php?alert=4");
			}
		}
	}elseif(!empty($_GET)){
		if ($_GET['Action']=="del") {
			$qry = mysqli_query($conn,"DELETE FROM menus WHERE idmenus='$_GET[id]'") or die('error'.mysqli_error($conn));
			if ($qry) {
				header("location: index.php?alert=5");
			}else{
				header("location: index.php?alert=6");
			}
		}
	}
?>