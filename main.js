$(document).ready(function() {
	const inputs = document.querySelectorAll(".input");


	function addcl(){
		let parent = this.parentNode.parentNode;
		parent.classList.add("focus");
	}

	function remcl(){
		let parent = this.parentNode.parentNode;
		if(this.value == ""){
			parent.classList.remove("focus");
		}
	}


	inputs.forEach(input => {
		input.addEventListener("focus", addcl);
		input.addEventListener("blur", remcl);
	});


	$('#LoginForm').submit(function(e){
		e.preventDefault();

		var usuario = $.trim($("#usuario").val());    
		var password = $.trim($("#password").val());    
		
		if ($.trim(usuario).length > 0 && $.trim(password.length > 0)) {
			$.ajax({
				url: "bd/login.php",
				type:"POST",
				datatype: "json",
				data: {usuario:usuario, password:password}, 
				success:function(data) {               
					if(data == "null"){
						swal("", "¡Usuario y/o Contraseña Incorrectos!", "error");
					}else{
						swal("", "¡Conexión Exitosa!", "success")
							window.location.href = "dashboard/index.php";
					}
				}    
			 });
		}
		else {
			swal("", "¡Ingrese su Usuario y/o Contraseña!", "error");
		}
	});
});