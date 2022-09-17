<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function pdfDerecha($i)
    {
    	$this->fpdf->SetFont('Arial', 'B', 8);
        $this->fpdf->AddPage("P", ['210', '297']);
        $arreY=[0,10,10,52,52,94,94,136,136,178,178,220,220,262,262];
        // CABECERA
        $this->fpdf->SetFont('Helvetica','',12);
        $this->fpdf->SetY($arreY[$i]);
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(100,4,'Lacodigoteca.com',0,1,'C');
        $this->fpdf->SetFont('Helvetica','',8);
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(100,4,'C.I.F.: 01234567A',0,1,'C');
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(100,4,'C/ Arturo Soria, 1',0,1,'C');
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(100,4,'C.P.: 28028 Madrid (Madrid)',0,1,'C');
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(100,4,'999 888 777',0,1,'C');
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(100,4,'alfredo@lacodigoteca.com',0,1,'C');

        // DATOS FACTURA
        $numero_factura= 'Factura Simpl.: F2019-000001';
        $this->fpdf->Ln(5);
        for ($i=0; $i <2 ; $i++) {
            $this->fpdf->Cell(100,4,'',0,0,'C');
            $this->fpdf->Cell(50,4,$numero_factura,0,0,'');
            $this->fpdf->Cell(50,4,$numero_factura,0,1,'');
        }

        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(50,4,'Fecha: 28/10/2019',0,0,'');
        $this->fpdf->Cell(50,4,'Fecha: 28/10/2019',0,1,'');
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(50,4,'Metodo de pago: Tarjeta',0,0,'');
        $this->fpdf->Cell(50,4,'Metodo de pago: Tarjeta',0,1,'');
        $this->fpdf->Output('ticket.pdf','i');
        exit;
    }
    public function pdfIzquierda($i)
    {
    	$this->fpdf->SetFont('Arial', 'B', 8);
        $this->fpdf->AddPage("P", ['210', '297']);
        $arreY=[0,10,10,52,52,94,94,136,136,178,178,220,220,262,262];
        // CABECERA
        $this->fpdf->SetFont('Helvetica','',12);
        $this->fpdf->SetY($arreY[$i]);
        $this->fpdf->Cell(100,4,'Lacodigoteca.com',0,1,'C');
        $this->fpdf->SetFont('Helvetica','',8);
        $this->fpdf->Cell(100,4,'C.I.F.: 01234567A',0,1,'C');
        $this->fpdf->Cell(100,4,'C/ Arturo Soria, 1',0,1,'C');
        $this->fpdf->Cell(100,4,'C.P.: 28028 Madrid (Madrid)',0,1,'C');
        $this->fpdf->Cell(100,4,'999 888 777',0,1,'C');
        $this->fpdf->Cell(100,4,'alfredo@lacodigoteca.com',0,1,'C');

        // DATOS FACTURA
        $this->fpdf->Ln(5);
        $this->fpdf->Cell(50,4,'Factura Simpl.: F2019-000001',0,0,'');
        $this->fpdf->Cell(50,4,'Factura Simpl.: F2019-000001',0,1,'');
        $this->fpdf->Cell(50,4,'Fecha: 28/10/2019',0,0,'');
        $this->fpdf->Cell(50,4,'Fecha: 28/10/2019',0,1,'');
        $this->fpdf->Cell(50,4,'Metodo de pago: Tarjeta',0,0,'');
        $this->fpdf->Cell(50,4,'Metodo de pago: Tarjeta',0,1,'');
        $this->fpdf->Output('ticket.pdf','i');
        exit;
    }

}
