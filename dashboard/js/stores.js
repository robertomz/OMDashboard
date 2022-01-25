$(document).ready(function() {
    var store_id, opcion;
    opcion = 4;
        
    tablaSucursales = $('#tablaSucursales').DataTable({  
        "ajax":{            
            "url": "bd/storesCrud.php", 
            "method": 'POST',
            "data":{opcion:opcion},
            "dataSrc":""
        },
        "columns":[
            {"data": "IdSucursal"},
            {"data": "Sucursal"},
            {"data": "Ubicacion"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
        ]
    });     

    var fila;

    $("#btnNuevo").click(function(){
        opcion = 1;         
        store_id = null;
        $("#formSucursales").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Nueva Sucursal");
        $('#modalSucursales').modal('show');	    
    });

    $("#btnCancelar").click(function(){
        $('#modalSucursales').modal('hide');	
    });

    $('#formSucursales').submit(function(e){                         
        e.preventDefault();

        sucursal = $.trim($('#sucursal').val());
        ubicacion = $.trim($('#ubicacion').val());

        if ($.trim(sucursal).length > 0 && $.trim(ubicacion).length > 0) {
            $.ajax({
              url: "bd/storesCrud.php",
              type: "POST",
              datatype:"json",    
              data: {store_id:store_id, sucursal:sucursal, ubicacion:ubicacion, opcion:opcion},    
              success: function(data) {
                if(data == "null"){
                    swal("", "¡Error al Añadir Sucursal!", "error");
                } else{
                    if (opcion == 1) {
                        swal("", "Sucursal Creada!", "success");
                    }
                    else {
                        swal("", "Sucursal Editada!", "success");
                    }
                    $('#modalSucursales').modal('hide');	
                }
                tablaSucursales.ajax.reload(null, false);
               }
            });
        }		
        else {
			swal("", "¡Llene todos los Campos!", "error");
		}						     			
    });
  
    $(document).on("click", ".btnEditar", function(){		        
        opcion = 2;
        fila = $(this).closest("tr");	

        store_id = parseInt(fila.find('td:eq(0)').text());

        sucursal = fila.find('td:eq(1)').text();
        ubicacion = fila.find('td:eq(2)').text();
        $("#sucursal").val(sucursal);
        $("#ubicacion").val(ubicacion);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Sucursal");	
        $('#modalSucursales').modal('show');		   
    });

    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        store_id = parseInt($(this).closest('tr').find('td:eq(0)').text());			
        opcion = 3;

        var respuesta = confirm("¿Está seguro de borrar el registro " + store_id + "?");                
        
        if (respuesta) {            
            $.ajax({
              url: "bd/storesCrud.php",
              type: "POST",
              datatype:"json",    
              data: {opcion:opcion, store_id:store_id},    
              success: function() {
                  swal("", "Sucursal Eliminada!", "success");
                  tablaSucursales.row(fila.parents('tr')).remove().draw();         
               }
            });	
        }
     });
});    