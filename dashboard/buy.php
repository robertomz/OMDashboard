<?php require_once "vistas/parte_superior.php"; ?>

<?php
    include_once './bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    include './bd/addCart.php';

    $query = "SELECT C.Categoria, P.Id, P.Producto, P.Precio FROM productos P INNER JOIN categorias C ON P.IdCategoria = C.IdCategoria";
    $result = $conexion->prepare($query);
    $result->execute();
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1> <i class="fa fa-shopping-bag"></i> Realizar Pedido </h1>
<br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body justify-content-center" style="width:100%">
                <div class="table-responsive">
                    <table id="tablaProductos" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th> Categoria </th>
                                <th> Producto </th>
                                <th> Precio </th>
                                <th> Cantidad </th>
                                <th> Acción </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($data as $dat) {
                            ?>
                                <form id="" method="POST" action="buy.php?action=add&id=<?php echo $dat["Id"];?>">
                                    <tr>
                                        <td><?php echo $dat['Categoria'] ?></td>
                                        <td><?php echo $dat['Producto'] ?></td>
                                        <td> 
                                            <input type="number" style='width:85px' value="<?php echo $dat['Precio'] ?>" name="price" class="price form-control" readonly>
                                        </td>
                                        <td>
                                        <div class="btn-cnt">
                                            <div class="button-container">
                                                <button class="cart-qty-minus" type="button" value="-">-</button> 
                                                <input style='width:75px' type="number" name="qty" min="0" class="qty form-control" value="0" readonly/>
                                                <button class="cart-qty-plus" type="button" value="+">+</button>
                                            </div>
                                        </div>
                                        </td>
                                        <td>
                                            <button type="submit" name="add_to_cart" class="btn btn-danger"> Añadir Carrito </button>
                                        </td>
                                        <input type="hidden" name="hidden_category" value="<?php echo $dat["Categoria"]; ?>" />
                                        <input type="hidden" name="hidden_name" value="<?php echo $dat["Producto"]; ?>" />
                                        <input type="hidden" name="hidden_price" value="<?php echo $dat["Precio"]; ?>" />
                                    </tr>
                                </form>
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

<!-- EXTRAS -->
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

    .compra-cart {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1%;
    }
</style>

<script>
    $(document).ready(function() {
        update_amounts();
        $('.qty, .price').on('keyup keypress blur change', function(e) {
            update_amounts();
        });
    });

    function update_amounts(){
        var sum = 0.0;
        $('#tablaProductos > tbody  > tr').each(function() {
            var qty = $(this).find('.qty').val();
            var price = $(this).find('.price').val();

            var amount = (qty*price)
            sum+=amount;
            
            $(this).find('.amount').text(''+amount);
        });
        
        $('.total').text(sum);
    }

    var incrementQty;
    var decrementQty;

    var plusBtn  = $(".cart-qty-plus");
    var minusBtn = $(".cart-qty-minus");

    var incrementQty = plusBtn.click(function() {
        var $n = $(this)
        .parent(".button-container")
        .find(".qty");
        $n.val(Number($n.val())+10);
        update_amounts();
    });

    var decrementQty = minusBtn.click(function() {
        var $n = $(this)
        .parent(".button-container")
        .find(".qty");
        
        var QtyVal = Number($n.val());
        if (QtyVal > 0) {
            $n.val(QtyVal-10);
        }
        update_amounts();
    });
</script>

<?php require_once "vistas/parte_inferior.php"?>