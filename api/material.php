<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require('lib/fpdf/fpdf.php');

include_once 'api/controllers/controllerPedido.php';
$controller = new controllerPedido();
$id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
$result = $controller->ListById($id);

function footer($data =[])
{
        $fecha_entrega_pedido = $data["fecha_entrega_pedido"];
        $paqueteria = $data["paqueteria"];
        $autorizo = $data["autorizo"];
        $y_cell = $data["y_cell"];
        $pdf = $data["pdf"];

    //PIE DE PAGINA
        $pdf->Setfont('Arial', "", 12);
        $pdf->SetXY(3,$y_cell);
        $pdf->SetFillColor("0", "32", "96");
        $pdf->Cell(203,7, "OBSERVACIONES",1,0,'C', true);
    //FECHA ENTREGA
        $pdf->Setfont('Arial', "", 12);
        $pdf->SetXY(3,$y_cell+7);
        $pdf->Cell(57,12, "FECHA DE ENTREGA:",1,0,'C');

        $pdf->Setfont('Arial', "", 12);
        $pdf->SetXY(60,$y_cell+7);
        $pdf->Cell(35,12, utf8_decode($fecha_entrega_pedido),1,0,'C');
    //PAQUETERIA
        $pdf->SetXY(95,$y_cell +7);
        $pdf->Cell(111,6, "PAQUETERIA:",1,0,'C');

        $pdf->Setfont('Arial', "", 12);
        $pdf->SetXY(95,$y_cell+ 13);
        $pdf->Cell(111,6, utf8_decode($paqueteria),1,0,'C');
    //AUTORIZA

        $pdf->SetXY(3,$y_cell + 19);
        $pdf->Cell(92,10, "AUTORIZO:",1,0,'C');

        $pdf->Setfont('Arial', "", 12);
        $pdf->SetXY(95,$y_cell+ 19);
        $pdf->Cell(111,10, utf8_decode($autorizo),1,0,'C');
}

function header_custom($data = []){
    $folio_pedido = $data["folio_pedido"];
    $sucursal = $data["sucursal"];
    $responsable = $data["responsable"];
    $fecha = $data["fecha"];
    $pdf = $data["pdf"];
    // Folio
    $pdf->Setfont('Arial', "", 14);
    $pdf->SetXY(172,41);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(27,7, $folio_pedido,0,0,'C', false);
    
    // Sucursal
    $pdf->Setfont('Arial', "", 14);
    $pdf->SetXY(3,68);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(92,7, $sucursal,0,1,'C', false);
    
    // Responsable
    $pdf->Setfont('Arial', "", 14);
    $pdf->SetXY(95,68);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(55,7, $responsable,0,1,'C', false);
    
    // Fecha
    $pdf->Setfont('Arial', "", 14);
    $pdf->SetXY(150,68);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(56,7, $fecha,0,1,'C', false);
    
}

$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image('templates/header_template.png', 2, 0, 0, 91);

$y_cell = 89;
$folio_pedido = "";
$sucursal = "";
$usuario_pedido = "";
$fecha_entrega_pedido = "";
$observaciones_pedido = "";
foreach($result as $key_data => $value_data){
    $producto_fk = $value_data["producto_fk"];
    $pruebas = $value_data["pruebas"];
    $existencia = $value_data["existencia"];
    $cantidad_requerida = $value_data["cantidad_requerida"];
    $urgencia = $value_data["urgencia"];
    $surtido = $value_data["surtido"];
    $folio_pedido = $value_data["folio_pedido"];
    $sucursal = $value_data["sucursal"];
    $responsable = $value_data["usuario_pedido"];
    $fecha_pedido = $value_data["fecha_pedido"];
    $fecha_entrega_pedido = $value_data["fecha_entrega_pedido"];
    $observaciones_pedido = $value_data["observaciones_pedido"];
    

    //Producto
    $pdf->Setfont('Arial', "", 12);
    $pdf->SetXY(3,$y_cell);
    $pdf->Cell(57,10, utf8_decode($producto_fk),1,0,'C');

    //pruebas realizadas
    $pdf->SetXY(60,$y_cell);
    $pdf->Cell(35,10, utf8_decode($pruebas),1,0,'C');

    //Existencia
    $pdf->SetXY(95,$y_cell);
    $pdf->Cell(26,10, utf8_decode($existencia),1,0,'C');

    //Cantidad requerida
    $pdf->SetXY(121,$y_cell);
    $pdf->Cell(29,10,utf8_decode($cantidad_requerida),1,0,'C');

    //urgencia
    $pdf->SetXY(150,$y_cell);
    $pdf->Cell(25,10, utf8_decode($urgencia),1,0,'C');

    //surtido
    $pdf->SetXY(175,$y_cell);
    $pdf->Cell(31,10,utf8_decode($surtido),1,0,'C');

    $y_cell += 10;
}

$y_cell;
$data_footer=[
    "fecha_entrega_pedido" => $fecha_entrega_pedido,
    "paqueteria" => "dhl",
    "observaciones"=> $observaciones_pedido,
    "autorizo" => $responsable,
    "y_cell" =>$y_cell,
    "pdf" => $pdf
];
footer($data_footer);

$data_header = [
    "folio_pedido" => $folio_pedido,
    "sucursal" => $sucursal,
    "responsable" => $responsable,
    "fecha" => $fecha_pedido,
    "pdf" => $pdf
];
header_custom($data_header);

$pdf->Output();