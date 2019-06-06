<html>
	<head>
		<title> Registro de usuario </title>
		<meta charset="UTF-8">
	</head>
<body>
<?php
	if (isset($_POST['registro'])){
        include ("includes/abrirbd.php");
        $sql = "SELECT * FROM usuarios Where user ='{$_POST['user']}'";
        $resultado = mysqli_query($link, $sql);
        if (mysqli_num_rows ($resultado) != 0){
             echo "<Center> <font color= red>";
			 echo "<BR><BR><BR>Usuario ya existente <BR><BR>";
             echo "<A href= '{$_SERVER['PHP_SELF']}'> Volver a registro </A>";
             echo "</Center></font>"; 
	   } else {
	   	    $user = $_POST['user'];
	   	    $password = $_POST['passwd'];
	   	    $nombre = $_POST['nombre'];
	   	    $apellidos = $_POST['apellidos'];
	   	    $salt = time();
	   	    $hash2= hash("sha256", $password.$salt, false);
			/*completar código utilizar el salt para guardar contraseña*/
			
           	$sql = "INSERT INTO usuarios (user, password, salt, nombres, apellidos, permisos) VALUES ('$user','$hash2','$salt','$nombre','$apellidos','null')";
            $resultado = mysqli_query ($link, $sql);
            if (!$resultado) {
				echo "</Center></font>"; 
				echo ("<BR><BR><BR>Datos erróneos".mysqli_error($link)."<BR><BR>");
				echo "<A href= '{$_SERVER['PHP_SELF']}'> Volver a registro </A>";
				echo "</Center></font>"; 
		    } else {
				echo "<BR><BR><BR><CENTER>";
				echo "Usuario Registrado <BR><BR>";
				echo "<A href= 'login.php'> Volver a login </A>";
				echo "</CENTER>";
			}
       }
	   mysqli_close($link);
	} else {
?>
		<br><br><br>
		<center>
			<img src="logo1.png" width= 280 height= 60>
			<br>
			<h2> REGISTRO DE UN NUEVO USUARIO </h2>
			<br>
			<form action= '<?php "{$_SERVER['PHP_SELF']}" ?>' method = post>
				<table bgcolor = 'lightgrey'> 
					<tr>
						<td width= 100> Usuario: </td> 
						<td> <input type = text name ='user'></td>
					</tr>
					<tr>
						<td width= 100> Password: </td> 
						<td> <input type = password name ='passwd'></td>
					</tr>
					<tr>
						<td width= 100> Nombre: </td> 
						<td> <input type = text name = 'nombre'></td>
					</tr>
					<tr>
						<td width= 100> Apellidos: </td> 
						<td> <input type = text name = 'apellidos'></td>
					</tr>
				</table><br>
				<input type=submit name = 'registro' value = "REGISTRO">
			</form>
			<br><br><A href= 'login.php'> Volver a login </A>
		</center>
<?php
	}
?>
</body>
</html>