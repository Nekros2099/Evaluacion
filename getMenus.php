<?php
	include('conn.php');
		$queryM = "SELECT * FROM menus WHERE idmenus='$_POST[id]'";
		$resultadoM = mysqli_query($conn, $queryM) or die('error'.mysqli_error($conn));
		$rowM = $resultadoM->fetch_assoc();
		$html= "<h3>$rowM[mn_descrip]</h3>";
		echo $html;
?>