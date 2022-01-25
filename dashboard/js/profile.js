$(document).ready(function() {
    var user_id, opcion;
    opcion = 1;

    $('#formPerfil').submit(function(e){                         
        e.preventDefault();

        identidad = $.trim($('#identidad').val());
        nombres = $.trim($('#nombres').val());
        apellidos = $.trim($('#apellidos').val());
        direccion = $.trim($('#direccion').val());
        correo = $.trim($('#correo').val());
        telefono = $.trim($('#telefono').val());

        usuario = $.trim($('#usuario').val());
        password = $.trim($('#password').val());
        confirmPassword = $.trim($('#confirmPassword').val());

        if (password != confirmPassword) {
            swal("", "¡Las Contraseñas no Coinciden!", "error");
        }
        else {
            $.ajax({
                url: "bd/profileEdit.php",
                type: "POST",
                datatype:"json",    
                data: {identidad:identidad, nombres:nombres, apellidos:apellidos, direccion:direccion, correo:correo, telefono:telefono, usuario:usuario, password:password, opcion:opcion},    
                success: function(data) {
                  if(data == "null"){
                      swal("", "¡Error el Editar Perfil!", "error");
                  } else{
                      if (opcion == 1) {
                          swal("", "Perfil Editado!", "success");
                      }
                  }
                  formPerfil.ajax.reload(null, false);
                }
            });		
        }

        			     			
    });
});    