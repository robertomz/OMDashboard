<?php
require "fpdf/fpdf.php";

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Helvetica','B',14);

$pdf->Cell(130,5,utf8_decode('HELADERÍA S.A'),0,0);
$pdf->Cell(60,5,utf8_decode('Datos Generales'),0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Helvetica','',12);

/* $pdf->Image('img/logo-pdf.png',31,15,25); */
$pdf->Cell(59	,5,'',0,1);//end of line

if (isset($_GET['PDF'])) {
    include_once './bd/conexion.php';
    
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $number = $_GET['NoFacturaPDF'];

    $query = "SELECT * FROM compras WHERE NoFactura = '$number'";
    $result = $conexion->prepare($query);
    $result->execute();
            
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $dat) {
        $pdf->Cell(130	,5,'',0,0);
        $pdf->Cell(25	,5,utf8_decode('Fecha/Hora'),0,0);
        $pdf->Cell(34	,5,utf8_decode($dat['Fecha']),0,1);//end of line

        $pdf->Cell(130	,5,'',0,0);
        $pdf->Cell(25	,5,utf8_decode('Factura #'),0,0);
        $pdf->Cell(34	,5,utf8_decode($dat['NoFactura']),0,1);//end of line

        $pdf->Cell(130	,5,'',0,0);
        $pdf->Cell(25	,5,utf8_decode('ID Cliente'),0,0);
        $pdf->Cell(34	,5,utf8_decode($dat['Identidad']),0,1);//end of line

        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line
        
        $pdf->SetFont('Helvetica','B',12);
        //billing address
        $pdf->Cell(100	,5,utf8_decode('Compra hecha por: '),0,1);//end of line

        $pdf->SetFont('Helvetica','',12);
        //add dummy cell at beginning of each line for indentation
        $pdf->Cell(10	,5,'',0,0);
        $pdf->Cell(90	,5,utf8_decode($dat['Comprador']),0,1);

        $pdf->Cell(10	,5,'',0,0);
        $pdf->Cell(90	,5,utf8_decode($dat['Sucursal']),0,1);

        $pdf->Cell(10	,5,'',0,0);
        $pdf->Cell(90	,5,utf8_decode($dat['RTN']),0,1);

        $pdf->Cell(10	,5,'',0,0);
        $pdf->Cell(90	,5,utf8_decode($dat['Nota']),0,1);
    }
        //make a dummy empty cell as a vertical spacer
        $pdf->Cell(189	,10,'',0,1);//end of line

        //invoice contents
        $pdf->SetFont('Helvetica','B',12);

    
        $pdf->Cell(40,10,utf8_decode('Categoria'),1,0,'C');
        $pdf->Cell(55,10,utf8_decode('Producto'),1,0,'C');
        $pdf->Cell(30,10,utf8_decode('Precio'),1,0,'C');
        $pdf->Cell(30,10,utf8_decode('Cantidad'),1,0,'C');
        $pdf->Cell(40,10,utf8_decode('Monto'),1,0,'C');
        $pdf->Ln();

        $pdf->SetFont('Helvetica','',12);

        /* DETALLES COMPRA */
        $query1 = "SELECT * FROM detallescompra WHERE NoFactura = '$number' ORDER BY Categoria DESC";
        $result1 = $conexion->prepare($query1);
        $result1->execute();
                
        $data1= $result1->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data1 as $dat1) {
            $pdf->Cell(40,10,utf8_decode($dat1['Categoria']),1,0,'C');
            $pdf->Cell(55,10,utf8_decode($dat1['Producto']),1,0,'C');
            $pdf->Cell(4,10,'L.',1,0);
            $pdf->Cell(26,10,utf8_decode($dat1['Precio']),1,0,'C');
            $pdf->Cell(30,10,utf8_decode($dat1['Cantidad']),1,0,'C');
            $pdf->Cell(4,10,'L.',1,0);
            $pdf->Cell(36,10,utf8_decode($dat1['Total']),1,0,'C');
            $pdf->Ln();
        }
    $pdf->Ln();
    
    $pdf->SetFont('Helvetica','B',14);
    $pdf->Cell(130,5,utf8_decode(''),0,0);
    $pdf->Cell(60,5,utf8_decode('Datos Compra'),0,1);//end of line
    
    $pdf->Ln();
    $pdf->SetFont('Helvetica','',12);
    foreach ($data as $dat) {
        $pdf->Cell(130	,10,'',0,0);
        $pdf->Cell(25	,10,'Subtotal',0,0);
        $pdf->Cell(4	,10,'L.',1,0);
        $pdf->Cell(36	,10,utf8_decode($dat['Subtotal']),1,1,'R');//end of line

        $pdf->Cell(130	,10,'',0,0);
        $pdf->Cell(25	,10,'Taxable',0,0);
        $pdf->Cell(4	,10,'L.',1,0);
        $pdf->Cell(36	,10,utf8_decode($dat['ISV']),1,1,'R');//end of line

        $pdf->Cell(130	,10,'',0,0);
        $pdf->Cell(25	,10,'Total',0,0);
        $pdf->Cell(4	,10,'L.',1,0);
        $pdf->Cell(36	,10,utf8_decode($dat['Total']),1,1,'R');//end of line
    }
}
    $pdf->Output();
?>