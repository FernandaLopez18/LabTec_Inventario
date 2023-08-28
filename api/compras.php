<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require('lib/fpdf/fpdf.php');

include_once 'api/controllers/controllerCompras.php';
$controller = new controllerCompras();
$id = isset($_REQUEST["id"]) && !empty($_REQUEST["id"]) ? $_REQUEST["id"] : "";
$result = $controller->ListById($id);

function footer($data = [])
{
    $subtotal = $data["subtotal"];
    $total_iva = $data["total_iva"];
    $total = $data["total"];
    $observaciones_compras  = $data["observaciones_compras"];
    $fecha_entrega_compras = $data["fecha_entrega_compras"];
    $y_cell = $data["y_cell"];
    $pdf = $data["pdf"];

    $pdf->SetFont('Arial', '', 11);

    // ? ETIQUETAS PRIMER PARTE
    $pdf->SetXY(135, $y_cell);
    $pdf->Cell(32.4, 10, "SUBTOTAL:", 1, 0, 'C');

    $pdf->SetXY(135, $y_cell + 10);
    $pdf->Cell(32.4, 10, "I.V.A.:", 1, 0, 'C');

    $pdf->SetXY(135, $y_cell + 20);
    $pdf->Cell(32.4, 10, "TOTAL:", 1, 0, 'C');

    // ? VALORES PRIMER PARTE
    $pdf->SetXY(167.5, $y_cell);
    $pdf->Cell(33.6, 10,"$ $subtotal", 1, 0, 'C');

    $pdf->SetXY(167.5, $y_cell + 10);
    $pdf->Cell(33.6, 10,"$ $total_iva", 1, 0, 'C');

    $pdf->SetXY(167.5, $y_cell + 20);
    $pdf->Cell(33.6, 10,"$ $total", 1, 0, 'C');

    // ? ETIQUETAS SEGUNDA PARTE COLOR DE AZUL
    $pdf->SetXY(11, $y_cell + 30);
    $pdf->SetFillColor("0", "32", "96");
    $pdf->Cell(0, 10, "", 1, 0, 'C', true);

    $pdf->SetXY(11, $y_cell + 40);
    $pdf->Cell(46.4, 20, "TIEMPO DE ENTREGA", 1, 0, 'C');

    $pdf->SetXY(135, $y_cell + 40);
    $pdf->Cell(66, 10, utf8_decode("PAQUETERÍA"), 1, 0, 'C');

    // ? VALORES SEGUNDA PARTE
    $pdf->SetXY(57.4, $y_cell + 40);
    $pdf->Cell(77.8, 20,($fecha_entrega_compras), 1, 0, 'C');

    $pdf->SetXY(135, $y_cell + 50);
    $pdf->Cell(66, 10, "", 1, 0, 'C');


    // ? ETIQUETAS TERCER PARTE
    $pdf->SetXY(11, $y_cell + 60);
    $pdf->SetFillColor("30", "78", "121");
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(124.2, 10, "OBSERVACIONES", 1, 0, 'C', true);

    $pdf->SetXY(135, $y_cell + 60);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(66, 10, "AUTORIZO", 1, 0, 'C', true);

    // ? VALORES TERCER PARTE
    $pdf->SetXY(11, $y_cell + 70);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(124.2, 10,utf8_decode($observaciones_compras), 1, 0, 'C', false);

    $pdf->SetXY(135, $y_cell + 70);
    $pdf->Cell(66, 10,"", 1, 0, 'C', false);
}

function header_custom($data = []){
// ? DATA ENCABEZADO
    $folio_compra = $data["folio_compra"];
    $nombre_proveedor = $data["nombre_proveedor"];
    $fechas_compras = $data["fecha_compra"];
    $usuarios_responsable = $data["usuario_responsable"];
    $telefono_proveedor = $data["telefono_proveedor"];
    $condiciones_pago  = $data["condicion_pago"];
    $pdf = $data["pdf"];
    
        // ? ENCABEZADO
    // Folio
    $pdf->Setfont('Arial', "", 12);
    $pdf->SetXY(172,29);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(27,7, $folio_compra,0,0,'C', false);
     //Nombre del proveedor
    $pdf->Setfont('Arial', "", 12);
    $pdf->SetXY(11,50);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(124,6, $nombre_proveedor,0,1,'C', false);
    //Fecha compra
    $pdf->Setfont('Arial', "", 12);
    $pdf->SetXY(135,50);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(66,6, $fechas_compras,0,1,'C', false);
    //Responsable de la compra
    $pdf->Setfont('Arial', "", 11);
    $pdf->SetXY(11,65);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(46.5,3, $usuarios_responsable,0,1,'C', false);
    //Contacto
    $pdf->Setfont('Arial', "", 11);
    $pdf->SetXY(57,65);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(78,3, $telefono_proveedor,0,1,'C', false);
    //Condiciones de pago
    $pdf->Setfont('Arial', "", 11);
    $pdf->SetXY(135,65);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(66,3, $condiciones_pago,0,1,'C', false);
    
}

$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image('templates/header_template_compras.png', 0, 0, 0, 100);


$y_cell = 76;


foreach ($result as $key_data => $value_data) {
    $nombre_proveedor = $value_data["nombre_proveedor"];
    $fechas_compras = $value_data["fecha_compra"];
    $usuarios_responsable = $value_data["usuario_responsable"];
    $telefono_proveedor = $value_data["telefono_proveedor"];
    $condiciones_pago  = $value_data["condicion_pago"];
    $folio_compra = $value_data["folio_compra"];
    $fecha_entrega_compras = $value_data["fecha_entrega_compras"];
    $subtotal = $value_data["subtotal"];
    $total_iva = $value_data["total_iva"];
    $total = $value_data["total"];
    $observaciones_compras = $value_data["observaciones_compras"];

    // ? DATA PRODUCTOS
    $cantidad = $value_data["cantidad"];
    $codigo = $value_data["codigo"];
    $concepto = $value_data["concepto"];
    $precio_unitario = $value_data["precio_unitario"];
    $importe = $value_data["importe"];


    $pdf->SetFont('Arial', '', 12);

    

    // ? DATOS DE PRODUCTOS
    $pdf->SetXY(11, $y_cell);
    $pdf->Cell(21, 10, utf8_decode($cantidad), 1, 0, 'C');

    $pdf->SetXY(32, $y_cell);
    $pdf->Cell(25.4, 10, utf8_decode($codigo), 1, 0, 'C');

    $pdf->SetXY(57.4, $y_cell);
    $pdf->Cell(77.8, 10, utf8_decode($concepto), 1, 0, 'C');

    $pdf->SetXY(135, $y_cell);
    $pdf->Cell(32.4, 10, utf8_decode("$$precio_unitario"), 1, 0, 'C');

    $pdf->SetXY(167.5, $y_cell);
    $pdf->Cell(33.6, 10, utf8_decode("$$importe"), 1, 0, 'C');

    $y_cell += 10;
}




$y_cell;
$data_footer = [
    "subtotal" => $subtotal,
    "total_iva" => $total_iva,
    "total" => $total,
    "observaciones_compras" => $observaciones_compras,
    "autorizo" => $usuarios_responsable,
    "fecha_entrega_compras" => $fecha_entrega_compras,
    "y_cell" => $y_cell,
    "pdf" => $pdf
];

footer($data_footer);

$data_header = [
    "folio_compra" => $folio_compra,
    "nombre_proveedor" => $nombre_proveedor,
    "fecha_compra" => $fechas_compras,
    "usuario_responsable" => $usuarios_responsable,
    "telefono_proveedor" => $telefono_proveedor,
    "condicion_pago" => $condiciones_pago,
    "pdf" => $pdf
];
header_custom($data_header);

$pdf->Output();