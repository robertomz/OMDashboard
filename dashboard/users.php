<?php require_once "vistas/parte_superior.php" ?>

<?php
    include_once './bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $query = "SELECT * FROM sucursales";
    $result = $conexion->prepare($query);
    $result->execute();
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    $query1 = "SELECT * FROM roles";
    $result1 = $conexion->prepare($query1);
    $result1->execute();
    $data1 = $result1->fetchAll(PDO::FETCH_ASSOC);
?>

<!--INICIO del cont principal-->
    <header>
        <h3 class='text-center'>Gestión de Usuarios</h3>
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
                <table id="tablaUsuarios" class="table table-borderless" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Identidad</th>
                            <th>Usuario</th>
                            <th>Nombre</th>                                
                            <th>Apellido</th>  
                            <th>Direccion</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Sucursal</th>
                            <th>Rol</th>
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
<div class="modal fade" id="modalUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
        <form id="formUsuarios">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Identidad:</label>
                            <input type="text" class="form-control" id="identidad">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Direccion</label>
                            <input type="text" class="form-control" id="direccion">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Correo</label>
                            <input type="email" class="form-control" id="correo">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Sucursal</label>
                            <select class="form-select" aria-label="Default select example" id="sucursal">
                                <option selected>Seleccione una Sucursal</option>
                                <?php
                                    foreach ($data as $dat) {
                                ?>
                                    <option value="<?php echo $dat['IdSucursal'];?>"><?php echo $dat['Sucursal']." ".$dat["Ubicacion"]; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Rol</label>
                            <select class="form-select" aria-label="Default select example" id="rol">
                                <option selected>Seleccione un Rol</option>
                                <?php
                                    foreach ($data1 as $dat1) {
                                ?>
                                    <option value="<?php echo $dat1['IdRol'];?>"><?php echo $dat1['Rol'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
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

<script src="js/users.js" type="text/javascript"></script>

<?php require_once "vistas/parte_inferior.php"?>