<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
    <header>
        <h3 class='text-center'>Gestión de Sucursales</h3>
    </header>    
      
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-info" data-toggle="modal"><i class="material-icons">library_add</i></button>    
            </div>    
        </div>    
    </div>    
    <br>  

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaSucursales" class="table table-borderless" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Sucursal</th>
                            <th>Ubicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>                           
                    </tbody>        
                </table>               
            </div>
            </div>
        </div>  
    </div>   
<!--FIN del cont principal-->

<!--Modal para CRUD-->
<div class="modal fade" id="modalSucursales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
        <form id="formSucursales">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Sucursal:</label>
                            <input type="text" class="form-control" id="sucursal">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion">
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="btnCancelar" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script src="js/stores.js" type="text/javascript"></script>

<?php require_once "vistas/parte_inferior.php"?>