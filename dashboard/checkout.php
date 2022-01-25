<?php include 'vistas/parte_superior.php'; ?>

<?php 
    include ("bd/addCart.php");
    include ("bd/saveCheck.php");
?>

<body>
<br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row g-5">
                    
                    <!-- DETALLES DE PRODUCTOS A COMPRAR -->
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary"> Tu Compra </span>
                        </h4>
                        <ul class="list-group mb-3">
                            <?php
                                if(!empty($_SESSION["shopping_cart"])) {
                                    $total = 0;
                                    $isv = 0;
                                    $totalC = 0;
                                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                                    {
							?>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?php echo $values["item_name"]; ?></h6>
                                    <small class="text-muted"> <?php echo $values["item_category"]; ?> | Cantidad: <?php echo $values["item_quantity"]; ?></small>
                                </div>
                                <span class="text-muted">L. <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></span>
                            </li>
                            <?php
									$total = $total + ($values["item_quantity"] * $values["item_price"]);
								}

                                $isv = $total * 0.15;
                                $totalC = $total + $isv;
							?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal (HNL)</span>
                                <strong>L. <?php echo number_format($total, 2); ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>ISV 15% (HNL)</span>
                                <strong>L. <?php echo number_format($isv, 2); ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (HNL)</span>
                                <strong>L. <?php echo number_format($totalC, 2); ?></strong>
                            </li>
                            <?php
								}
							?>
                        </ul>
                    </div>
                    
                    <!-- DATOS PERSONALES -->
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3"> Compra </h4>
                        <form method="POST">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <label class="form-label"> Identidad </label>
                                    <input type="text" class="form-control" id="identidad" name="identidad"  required="" value="<?php echo $id; ?>" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label class="form-label"> Pedido por </label>
                                    <input type="text" class="form-control" id="name" name="name" required="" value="<?php echo $fname, ' ', $lname; ?>" readonly>
                                </div>
                                <div class="col-4">
                                    <label class="form-label"> RTN </label>
                                    <input type="text" class="form-control" id="rtn" name="rtn" required="">
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label"> Sucursal </label>
                                    <input type="text" class="form-control" id="sucursal" name="sucursal" required="" value="<?php echo $store, ' ', $ubicacion; ?>" readonly>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="email" name="email" required="" value="<?php echo $email; ?>" readonly>
                                </div>

                                <div class="col-12">
                                    <label class="form-label"> Nombre Factura </label>
                                    <input type="text" class="form-control" id="buyName" name="buyName" required="">
                                </div>
                                <div class="col-12">
                                    <label class="form-label"> Nota </label>
                                    <textarea type="text" class="form-control" id="nota" name="nota" required=""> </textarea>
                                </div>
                            </div>

                            <hr class="my-4">
                            <input type="hidden" name="hidden_subtotal" value="<?php echo number_format($total, 2); ?>" />
                            <input type="hidden" name="hidden_isv" value="<?php echo number_format($isv, 2); ?>" />
                            <input type="hidden" name="hidden_total" value="<?php echo number_format($totalC, 2); ?>" />
                            <button class="w-100 btn btn-primary btn-lg" type="submit" name="buy"> Realizar Pedido </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FINAL ETIQUETA BODY -->
<?php include 'vistas/parte_inferior.php'; ?>