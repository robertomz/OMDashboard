$(document).ready(function() {
    var user_id, opcion;
    opcion = 3;
        
    tablaUsuarios = $('#tablaUsuarios').DataTable({  
        "ajax":{            
            "url": "bd/usersCrud.php", 
            "method": 'POST',
            "data":{opcion:opcion},
            "dataSrc":""
        },
        "columns":[
            {"data": "id"},
            {"data": "Identidad"},
            {"data": "usuario"},
            {"data": "Nombres"},
            {"data": "Apellidos"},
            {"data": "Direccion"},
            {"data": "Correo"},
            {"data": "Telefono"},
            {"data": "Sucursal"},
            {"data": "Rol"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
        ]
    });     

    var fila;

    $("#btnNuevo").click(function(){
        opcion = 1;         
        user_id = null;
        $("#formUsuarios").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Nuevo Usuario");
        $('#modalUsuarios').modal('show');	    
    });

    $("#btnCancelar").click(function(){
        $('#modalUsuarios').modal('hide');	
    });

    $('#formUsuarios').submit(function(e){                         
        e.preventDefault();

        identidad = $.trim($('#identidad').val());    
        nombre = $.trim($('#nombre').val());
        apellido = $.trim($('#apellido').val());    
        direccion = $.trim($('#direccion').val());    
        correo = $.trim($('#correo').val());    
        telefono = $.trim($('#telefono').val());    
        sucursal = $.trim($('#sucursal').val());    
        rol = $.trim($('#rol').val());    
        usuario = $.trim($('#usuario').val());    
        password = $.trim($('#password').val());

        if ($.trim(identidad).length > 0 && $.trim(nombre).length > 0 && $.trim(apellido).length > 0 && $.trim(direccion).length > 0 && $.trim(correo).length > 0 && $.trim(telefono).length > 0 && $.trim(sucursal).length > 0 && $.trim(rol).length > 0 && $.trim(usuario).length > 0 && $.trim(password.length > 0)) {
            $.ajax({
              url: "bd/usersCrud.php",
              type: "POST",
              datatype:"json",    
              data: {user_id:user_id, identidad:identidad, nombre:nombre, apellido:apellido, direccion:direccion, correo:correo, telefono:telefono, sucursal:sucursal, rol:rol, usuario:usuario, password, opcion:opcion},    
              success: function(data) {
                if(data == "null"){
                    swal("", "¡Error al Crear Usuario!", "error");
                } else{
                    swal("", "¡Usuario Creado!", "success");
                    $('#modalUsuarios').modal('hide');	
                }
                tablaUsuarios.ajax.reload(null, false);
               }
            });
        }		
        else {
			swal("", "¡Llene todos los Campos!", "error");
		}						     			
    });

    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        user_id = parseInt($(this).closest('tr').find('td:eq(0)').text());
        identidad = parseInt($(this).closest('tr').find('td:eq(1)').text());			
        opcion = 2;
        var respuesta = confirm("¿Está seguro de borrar el registro " + user_id + "?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/usersCrud.php",
              type: "POST",
              datatype:"json",    
              data: {opcion:opcion, user_id:user_id, identidad:identidad},    
              success: function() {
                  swal("", "¡Usuario Eliminado!", "success");
                  tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
});    