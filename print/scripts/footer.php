<?php

$pdf->AddPage();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->SetX(10);
$pdf->Cell(10,5,"Submitted By:",0,0,'L');

$pdf->SetX(100);
$pdf->Cell(10,5,"Evaluated By:",0,0,'L');


$pdf->SetX(190);
$pdf->Cell(10,5,"Recommending Approval:",0,0,'L');

$pdf->SetX(270);
$pdf->Cell(10,5,"Approved:",0,0,'L');


$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$st = $pdo->prepare("SELECT * FROM section s LEFT JOIN users u ON u.id = s.head WHERE s.id = ? LIMIT 1");
$st->execute(array($section));
$section_head = $st->fetch(PDO::FETCH_ASSOC);

$pdf->SetX(10);
$pdf->Cell(10,5,$section_head['fname']." ".$section_head['lname'],0,0,'L');


$pdf->SetX(100);
$pdf->Cell(10,5,"LEONORA A. ANIEL",0,0,'L');


$pdf->SetX(190);
$pdf->Cell(10,5,"Sophia M. Mancao, MD,DPH",0,0,'L');


$pdf->SetX(270);
$pdf->Cell(10,5,"Jaime S. Bernadas, MD, MGM, CESO III",0,0,'L');


$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->SetX(10);
$pdf->Cell(10,5,'Section/ Division Head',0,0,'L');

$pdf->SetX(100);
$pdf->Cell(10,5,"Budget Officer III, Budget Section",0,0,'L');

$pdf->SetX(190);
$pdf->Cell(10,5,"BAC Chairperson",0,0,'L');


$pdf->SetX(270);
$pdf->Cell(10,5,"Director IV",0,0,'L');


?>