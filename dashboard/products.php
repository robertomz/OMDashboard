<?php require_once "vistas/parte_superior.php" ?>

<?php
    include_once './bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $query = "SELECT * FROM categorias";
    $result = $conexion->prepare($query);
    $result->execute();
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!--INICIO del cont principal-->
<header>
        <h3 class='text-center'>Gestión de Productos/Helados</h3>
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
                    <table id="tablaProductos" class="table table-borderless" style="width:100%" >
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Categoría</th>
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
<div class="modal fade" id="modalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
        <form id="formProductos">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Producto:</label>
                            <input type="text" class="form-control" id="producto">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Precio</label>
                            <input type="text" class="form-control" id="precio">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="" class="col-form-label">Categoria</label>
                            <select class="form-select" aria-label="Default select example" id="categoria">
                                <option selected>Seleccione una Categoria</option>
                                <?php
                                    foreach ($data as $dat) {
                                ?>
                                    <option value="<?php echo $dat['IdCategoria'];?>"><?php echo $dat['Categoria'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
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

<script src="js/products.js" type="text/javascript"></script>

<?php require_once "vistas/parte_inferior.php"?>?>