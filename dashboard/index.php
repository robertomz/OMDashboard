<?php require_once "vistas/parte_superior.php"?>

<?php
    include_once './bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $query = "SELECT c.NoFactura, c.Comprador, c.Total, DC.IdProducto, DC.Producto ,SUM(DC.Cantidad) AS CantidadSum FROM compras C INNER JOIN detallescompra DC ON C.NoFactura = DC.NoFactura WHERE C.IdEstado = 4 GROUP BY DC.IdProducto ORDER BY CantidadSum";
    $result = $conexion->prepare($query);
    $result->execute();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);    
?>

<!--INICIO del cont principal-->
<div class="container">
    <h1> Bienvenido <?php echo $fname, ' ', $lname;?> </h1>
<?php
    if ($_SESSION['tipo'] == 1) {
?>
    <div class="container-fluid">
        <div class="card">
            <div id="columnchart_material" class="card-body" style="width: 90%; height: 500px;">
            </div>
        </div>
    </div>
<?php
    }
?>
</div>

<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Producto', 'Cantidad Vendida'],

            <?php
                foreach ($data as $dat) {
                    echo "['".$dat['Producto']."','".  $dat['CantidadSum']."'],";
                }
            ?>

        ]);

        var options = {
            chart: {
            title: 'Ventas Totales de Productos',
            subtitle: 'Comparativa de Ventas Totales por cada Producto',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>