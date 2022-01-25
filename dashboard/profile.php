<?php require_once "vistas/parte_superior.php"?>

<div class="container">
    <header>
        <h3 class='text-center'>Editar Perfil</h3>
    </header>  

    <br><div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form id="formPerfil">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label> Identidad </label>
                            <input type="text" class="form-control" id="identidad" required="" value="<?php echo $id; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label> Nombres </label>
                            <input type="text" class="form-control" id="nombres" required="" value="<?php echo $fname; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label> Apellidos </label>
                            <input type="text" class="form-control" id="apellidos" required="" value="<?php echo $lname; ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label> Dirección </label>
                            <input type="text" class="form-control" id="direccion" required="" value="<?php echo $direccion; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label> Correo </label>
                            <input type="email" class="form-control" id="correo" required="" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label> Teléfono </label>
                            <input type="number" class="form-control" id="telefono" required="" value="<?php echo $telefono; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label> Usuario </label>
                            <input type="text" class="form-control" id="usuario" required="" value="<?php echo $_SESSION['s_usuario'] ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label> Contraseña </label>
                            <input id="password" class="form-control" type="password" required="" value="<?php echo $password; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label> Confirmar Contraseña </label>
                            <input id="confirmPassword" class="form-control" type="password" required="" value="<?php echo $password; ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="btnGuardar"> Editar </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/profile.js" type="text/javascript"></script>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>