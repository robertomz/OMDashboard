<!DOCTYPE html>
<html>
<head>
	<title>OM Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- STYLES -->
	<link rel="stylesheet" type="text/css" href="styles.css">

	<!-- POPPINS FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

	<!-- FONT AWESOME -->
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

	<!-- SWEETALERT -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- JQUERY AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

	<img class="wave" src="assets/img/wave.png">

	<div class="container">

		<div class="img">
			<img src="assets/img/cream.svg">
		</div>

		<div class="login-content">
			<form method="POST" id="LoginForm">
				<img src="assets/img/avatar.svg">
				<h2 class="title">Bienvenido</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" class="input" id="usuario" name="usuario">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input type="password" class="input" id="password" name="password">
            	   </div>
            	</div>
            	
            	<button type="submit" class="btn" id="Login">Ingresar</button>
            </form>
        </div>

    </div>
	
    <script type="text/javascript" src="main.js"></script>
</body>
</html>