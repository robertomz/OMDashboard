<form method="POST">
    <div class="form-row">
         <div class="form-group col-md-4">
            <label> Estado del Pedido </label>
            <select name="estado" id="estado" class="form-select">
                <?php 
                    foreach ($data3 as $dat3) {                                
                ?>
                    <option value="<?php echo $dat3["IdEstado"]; ?>"><?php echo $dat3["Estado"]; ?></option>
                <?php
                    }
                ?>
            </select>
            <br>
            <input type="hidden"id="aNoFactura" name="aNoFactura" value="<?php echo $No; ?>">
            <button type="submit" class="btn btn-danger" name="ChangeStatus"> Actualizar Estado </button>
        </div>
    </div>
</form>