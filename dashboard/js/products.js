$(document).ready(function() {
    var ice_id, opcion;
    opcion = 4;
        
    tablaProductos = $('#tablaProductos').DataTable({  
        "ajax":{            
            "url": "bd/productsCrud.php", 
            "method": 'POST',
            "data":{opcion:opcion},
            "dataSrc":""
        },
        "columns":[
            {"data": "Id"},
            {"data": "Producto"},
            {"data": "Precio"},
            {"data": "Categoria"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
        ]
    });     

    var fila;

    $("#btnNuevo").click(function(){
        opcion = 1;         
        ice_id = null;
        $("#formProductos").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Nuevo Producto");
        $('#modalProductos').modal('show');	    
    });

    $("#btnCancelar").click(function(){
        $('#modalProductos').modal('hide');	
    });

    $('#formProductos').submit(function(e){                         
        e.preventDefault();

        producto = $.trim($('#producto').val());
        precio = $.trim($('#precio').val());
        categoria = $.trim($('#categoria').val());

        if ($.trim(producto).length > 0 && $.trim(precio).length > 0) {
            $.ajax({
              url: "bd/productsCrud.php",
              type: "POST",
              datatype:"json",    
              data: {ice_id:ice_id, producto:producto, precio:precio, categoria:categoria, opcion:opcion},    
              success: function(data) {
                if(data == "null"){
                    swal("", "¡Error al Añadir Producto!", "error");
                } else{
                    if (opcion == 1) {
                        swal("", "Producto Creado!", "success");
                    }
                    else {
                        swal("", "Producto Editado!", "success");
                    }
                    $('#modalProductos').modal('hide');	
                }
                tablaProductos.ajax.reload(null, false);
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

        ice_id = parseInt(fila.find('td:eq(0)').text());

        producto = fila.find('td:eq(1)').text();
        precio = fila.find('td:eq(2)').text();
        $("#producto").val(producto);
        $("#precio").val(precio);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Producto");	
        $('#modalProductos').modal('show');		   
    });

    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        ice_id = parseInt($(this).closest('tr').find('td:eq(0)').text());			
        opcion = 3;

        var respuesta = confirm("¿Está seguro de borrar el registro " + ice_id + "?");                
        
        if (respuesta) {            
            $.ajax({
              url: "bd/productsCrud.php",
              type: "POST",
              datatype:"json",    
              data: {opcion:opcion, ice_id:ice_id},    
              success: function() {
                  swal("", "Producto Eliminado!", "success");
                  tablaProductos.row(fila.parents('tr')).remove().draw();         
               }
            });	
        }
     });
});    