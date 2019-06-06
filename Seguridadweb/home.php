<html>
    <head>
        <title> :: Matricula :: </title>
		<meta charset="UTF-8">
    </head>
<body>    
    <?php
       session_start();
       //comprobación de usuario autenticado
       
       include ("includes/autenticado.php");
    ?>
    <br><br>
    <center>
		<img src="logo1.png" width= 280 height= 60>
		<br><br>
		<h1> Carrera de Computación </H1>
		<HR> <BR>
		<a href = '/'> Cálculo de Varias Variables </a><br>
		<a href = '/'> Electrónica Básica </a><br>
		<a href = '/'> Lenguajes de Programación </a><br>
		<a href = '/'> Proyectos de Software</a><br>
		<a href = '/'> Ofimática y Utilitarios</a><br>
		<a href = '/'> Comunicación Técnica</a><br>
		<a href = '/'> Computación y Sociedad </a>	
        <br><br><br><br>
        <p style='font-size:16.0pt'><a href = 'matricula.php'> MATRICULA DE ASIGNATURAS </a> </p>	
    </center>
</body>		
</html>