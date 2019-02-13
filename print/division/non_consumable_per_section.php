<?php

$pdf->SetFont('Arial','B',8);
$pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
$pdf->Row(array('',"\t\t\t\t\t\t\t 2. NON-CONSUMABLE\n\t\t\t\t\t\t\t\t\t\t\t a. PER SECTION",'','','','','','','','','','','','',''));



$st = $pdo->prepare("SELECT * FROM table_e WHERE q1_qty > 0 OR q2_qty > 0 OR q3_qty > 0 OR q4_qty > 0 GROUP BY item ORDER BY item ASC");
$st->execute();
$items = $st->fetchAll(PDO::FETCH_ASSOC);


$total = 0;
$quantity_total = 0;
$over_total = 0;

$q1_qty = 0;
$q2_qty = 0;
$q3_qty = 0;
$q4_qty = 0;
foreach($items as $item):
    $total = 0;
    $quantity_total = 0;
    $q1_qty = 0;
    $q2_qty = 0;
    $q3_qty = 0;
    $q4_qty = 0;

    $item_name = $item['item'];

    $st = $pdo->prepare("SELECT * FROM section WHERE division =$divisionid");
    $st->execute(array($divisionid));
    $sections = $st->fetchAll(PDO::FETCH_ASSOC);
    foreach($sections as $section):
        $st = $pdo->prepare("SELECT q1_qty,q2_qty,q3_qty,q4_qty from table_e WHERE item = ? AND created_by = ? LIMIT 1");
        $st->execute(array($item_name,$section['id']));
        $quantity = $st->fetch(PDO::FETCH_ASSOC);

        $q1_qty += $quantity['q1_qty'];
        $q2_qty += $quantity['q2_qty'];
        $q3_qty += $quantity['q3_qty'];
        $q4_qty += $quantity['q4_qty'];
        $quantity_total = ( $q1_qty + $q2_qty + $q3_qty + $q4_qty );
        $total = ( $q1_qty * $item['q1_amt']) + ( $q2_qty * $item['q2_amt']) + ( $q3_qty * $item['q3_amt']) + ( $q4_qty * $item['q4_amt']);
    endforeach;
    $over_total += $total;
    $q1_qty = $q1_qty > 0 ? number_format($q1_qty) : NULL;
    $q2_qty = $q2_qty > 0 ? number_format($q2_qty) : NULL;
    $q3_qty = $q3_qty > 0 ? number_format($q3_qty) : NULL;
    $q4_qty = $q4_qty > 0 ? number_format($q4_qty) : NULL;

    $item['q1_amt'] = $item['q1_amt'] > 0 ? number_format($item['q1_amt'],2) : NULL;
    $item['q2_amt'] = $item['q2_amt'] > 0 ? number_format($item['q2_amt'],2) : NULL;
    $item['q3_amt'] = $item['q3_amt'] > 0 ? number_format($item['q3_amt'],2) : NULL;
    $item['q4_amt'] = $item['q4_amt'] > 0 ? number_format($item['q4_amt'],2) : NULL;

    $quantity_total = $quantity_total > 0 ? number_format($quantity_total) : NULL;
    $total = $total > 0 ? number_format($total,2) : NULL;
    $pdf->SetFont('Arial','',8);
    $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
    $pdf->Row(array($row_num,"\t\t\t\t\t\t\t\t\t\t\t\t".$item['item'], $quantity_total, $item['unit'], $total, $q1_qty, $item['q1_amt'],$q2_qty,$item['q2_amt'],$q3_qty,$item['q3_amt'],$q4_qty,$item['q4_amt'],'',''));
    $row_num++;
endforeach;

$grand_total += $over_total;
$over_total = $over_total > 0 ? number_format($over_total,2) : NULL;
$pdf->SetFont('Arial','B',8);
$pdf->Row(array("","\t\t\t\t\t\t\t\t\t\t\t\t","","Total",$over_total,"","",'','','','','','','',''));

?>