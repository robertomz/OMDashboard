<?php
    require "fpdf/fpdf.php";
    
    class myPDF extends FPDF {
        function header() {
            /* $this->Image('img/logo-pdf.png',10,3,25); */
            $this->setFont('Helvetica','B',14);
            $this->Cell(276,5,utf8_decode('HELADERÍA S.A'),0,0,'C');
            $this->Ln();
            $this->setFont('Helvetica','B',12);
            $this->Cell(276,10,utf8_decode('REPORTE DE COMPRAS'),0,0,'C');
            $this->Ln();
            $this->setFont('Helvetica','',12);
            $this->Cell(276,10,utf8_decode('Historial de Compras'),0,0,'C');
            $this->Ln(20);
        }
        function footer() {
            $this->SetY(-15);
            $this->SetFont('Helvetica','I',8);
            $this->Cell(0,10,utf8_decode('Página '.$this->PageNo()),0,0,'C');
        }
        function headerTable() {
            $this->SetFont('Helvetica','B',13);
            $this->Cell(45,10,utf8_decode('Fecha'),1,0,'C');
            $this->Cell(50,10,utf8_decode('Comprador'),1,0,'C');
            $this->Cell(60,10,utf8_decode('Sucursal'),1,0,'C');
            $this->Cell(30,10,utf8_decode('RTN'),1,0,'C');
            $this->Cell(25,10,utf8_decode('Subtotal'),1,0,'C');
            $this->Cell(25,10,utf8_decode('ISV'),1,0,'C');
            $this->Cell(25,10,utf8_decode('Total'),1,0,'C');
            $this->Ln();
        }
        function viewTable() {
            include_once './bd/conexion.php';
            $objeto = new Conexion();
            $conexion = $objeto->Conectar();
            
            $query = "SELECT * FROM compras WHERE IdEstado = '4'";
            $result = $conexion->prepare($query);
            $result->execute();
            
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            
            $this->SetFont('Helvetica','',12);
            foreach ($data as $dat) {
                $this->Cell(45,10,utf8_decode($dat['Fecha']),1,0,'C');
                $this->Cell(50,10,utf8_decode($dat['Comprador']),1,0,'L');
                $this->Cell(60,10,utf8_decode($dat['Sucursal']),1,0,'L');
                $this->Cell(30,10,utf8_decode($dat['RTN']),1,0,'L');
                $this->Cell(25,10,utf8_decode($dat['Subtotal']),1,0,'L');
                $this->Cell(25,10,utf8_decode($dat['ISV']),1,0,'L');
                $this->Cell(25,10,utf8_decode($dat['Total']),1,0,'L');
                $this->Ln();
            }
        }
    }

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','Letter',0);

    $pdf->SetFont('Helvetica','',12);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->OutPut();
?>