<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require('lib/fpdf/fpdf.php');

include_once 'api/controllers/controllerProducto.php';
$controller = new controllerProducto();
$result = $controller->List();


$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image('templates/header_inventory.png', 0, 10, 0, 28);

$pdf->Image('templates/header_info.png', -3, 40, 0, 16);

$pdf->Image('templates/footer_inventory.png', 0, 250, 0, 45);


$y_cell = 56;
$clave_producto = "";
$descripcion = "";
$cantidad = "";
$fecha_caducidad = "";
$observaciones_producto = "";

foreach ($result as $key_data => $value_data) {
      $clave_producto = $value_data["clave_producto"];
      $descripcion = $value_data["descripcion"];
      $cantidad = $value_data["cantidad"];
      $fecha_caducidad = $value_data["fecha_caducidad"]; 
      $observaciones_producto = $value_data["observaciones_producto"];
      //$pdf = $value_data["pdf"];
    
	$pdf->Setfont('Arial', "", 14);
    $pdf->SetXY(9,$y_cell);
      $pdf->Cell(30,10, utf8_decode($clave_producto),1,0,'C');

      $pdf->SetXY(39,$y_cell);
      $pdf->Cell(60,10, utf8_decode($descripcion),1,0,'C');

      $pdf->SetXY(99,$y_cell);
      $pdf->Cell(20,10, utf8_decode($cantidad),1,0,'C');

      $pdf->SetXY(119,$y_cell);
      $pdf->Cell(35,10, utf8_decode($fecha_caducidad),1,0,'C');

      $pdf->SetXY(154,$y_cell);
      $pdf->Cell(45,10, utf8_decode($observaciones_producto),1,0,'C');

    $y_cell += 10;
}



$pdf->Output();