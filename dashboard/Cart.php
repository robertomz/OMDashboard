<?php require_once "vistas/parte_superior.php"?>
<?php include "./bd/addCart.php"?>


<div class="container">
    <h1> <i class="fa fa-shopping-cart"></i> Carrito </h1>

    <br><div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead>
                            <tr>
                                <th> Categoria </th>
                                <th> Producto </th>
                                <th> Cantidad </th>
                                <th> Precio </th>
                                <th> Total </th>
                                <th> Acción </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                               if(!empty($_SESSION["shopping_cart"])) {
                                $total = 0;
                                $isv = 0;
                                $totalC = 0;
                                
                                foreach($_SESSION["shopping_cart"] as $keys => $values) {          
                            ?>
                            <tr>
                                <td><?php echo $values["item_category"]; ?></td>
                                <td><?php echo $values["item_name"]; ?></td>
                                <td><?php echo $values["item_quantity"]; ?></td>
                                <td> Lps. <?php echo number_format($values["item_price"],2); ?></td>
                                <td> Lps. <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                                <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger"> Eliminar </span></a></td>
                            </tr>
                            <?php
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                }

                                $isv = $total * 0.15;
                                $totalC = $total + $isv;
                            ?>
                            <tr>
                                
                                <td colspan="2"> </td>
                                <td colspan="3">
                                    <div class="btn-cnt">
                                        <div class="button-container"> 
                                            Subtotal: <input id="subtotal" type="text" class="form-control" value="<?php echo number_format($total, 2); ?>"  style='width:120px' readonly>
                                        </div>
                                        <br>
                                        <div class="button-container"> 
                                            ISV 15%: <input id="isv" type="text" class="form-control" value="<?php echo number_format($isv, 2); ?>"  style='width:120px' readonly>
                                        </div>
                                        <br>
                                        <div class="button-container"> 
                                            Total: <input id="total" type="text" class="form-control" value="<?php echo number_format($totalC, 2); ?>"  style='width:120px' readonly>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                <?php
                                    if ($totalC >= 10000) {
                                ?>
                                    <a href="checkout.php" id="buy"><button type="submit" name="buy" class="btn btn-primary"> Finalizar Compra </button></a>
                                <?php
                                    }
                                ?>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .button-container {
        display: flex;
        align-items: center;
        list-style: none;
    }

    .button-container input {
        padding: 5px;
        margin: auto;
    }
</style>

<?php require_once "vistas/parte_inferior.php"?>