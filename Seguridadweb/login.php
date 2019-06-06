<html>
	<head>
		<title> SEGURIDAD WEB | Autentificación </title>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php
		session_start();
		if (isset($_POST['registro'])) {
			header("Location: registro.php");
		}
		if (isset($_POST['login'])) {

		    include ("includes/abrirbd.php");
		    if (! $link) {
		    	echo ('conexión incorrecta');
		    }else{
                echo ('conexión correcta');
		    }
			
			$sql = "SELECT * FROM usuarios WHERE user ='{$_POST['user']}'";
			$resultado = mysqli_query($link, $sql);
			if (mysqli_num_rows($resultado) == 1) {
				$usuario = mysqli_fetch_assoc($resultado);
				/*completar código, comprobar el password de entrada con el de la BD*/
				/*$passd = $_POST['passwd'];*/

				$hash2 = hash("sha256", $_POST['passwd'].$usuario['salt'], false);

				if ($usuario ['password'] == $hash2 && $_SESSION['CAPTCHA']==$_POST['valor']){ 
					$_SESSION['autenticado'] = 'correcto';
					$_SESSION['user'] = $usuario['user'];
					header("Location:home.php");
				} else {
					$_SESSION['autenticado'] = 'incorrecto';
					header("Location: NoAuth.php");
				}
			} /*else {
				$_SESSION['autenticado'] = 'incorrecto';
				header("Location: NoAuth.php");
			}*/

			mysqli_close($link);
		} else {
			?>
			<br><br><br>
		<center>
			<img src="logo1.png" width= 280 height= 60>
			<br><br><br>
			<form action= '<?php "{$_SERVER['PHP_SELF']}" ?>' method = post>
				<input type=submit name = 'registro' value = "REGISTRAR USUARIO"> <br><br><br>
				<table bgcolor = 'lightgrey'> 
					<tr>
						<td width= 100> Usuario: </td> 
						<td> <input type = text name ='user'></td>
					</tr>
					<tr>
						<td width= 100> Password: </td> 
						<td><input type = password name ='passwd'autocomplete="off"></td>
					</tr>
				</table><br>
				<img src= captcha.php>
				<input type= text name= 'valor'> <br><br><br>
				<input type=submit name = 'login' value = "LOGIN"><br><br><br>
			</form>
			<?php
		}
		?>
	</center>
</body>
</html>