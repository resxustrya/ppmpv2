<?php

$pdf->SetFont('Arial','B',8);
$pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
$pdf->Row(array("","\t\t\t\t\t\t\t\t\t\t\t\td. EQUIPMENT CONSUMABLE","","","","",'','','','','','','','',''));



$total = 0;
$item_total = 0;
$over_total = 0;

$q1_qty = 0;
$q2_qty = 0;
$q3_qty = 0;
$q4_qty = 0;

$st = $pdo->prepare("SELECT * FROM section WHERE division = ?");
$st->execute(array($divisionid));
$sections = $st->fetchAll(PDO::FETCH_ASSOC);

foreach($sections as $section):
    $st = $pdo->prepare("SELECT * FROM table_d WHERE created_by = ? AND (q1_qty > 0 OR q2_qty > 0 OR q3_qty > 0 OR q4_qty > 0) GROUP BY item ORDER BY item ASC");
    $st->execute(array($section['id']));
    $items = $st->fetchAll(PDO::FETCH_ASSOC);
    if(count($items)> 0){
        $pdf->SetFont('Arial','BI',8);
        $pdf->Row(array("","\t\t\t\t\t\t\t\t\t\t\t\t".strtoupper($section['description']),"","","","","",'','','','','','','',''));
        foreach($items as $item):
            $item_total = 0;
            $q1_qty = 0;
            $q2_qty = 0;
            $q3_qty = 0;
            $q4_qty = 0;

            $q1_qty += $item['q1_qty'];
            $q2_qty += $item['q2_qty'];
            $q3_qty += $item['q3_qty'];
            $q4_qty += $item['q4_qty'];
            $item_total = ( $q1_qty + $q2_qty + $q3_qty + $q4_qty );
            $total = ( $q1_qty * $item['q1_amt']) + ( $q2_qty * $item['q2_amt']) + ( $q3_qty * $item['q3_amt']) + ( $q4_qty * $item['q4_amt']);
            

            $over_total += $total;
            $q1_qty = $q1_qty > 0 ? number_format($q1_qty) : NULL;
            $q2_qty = $q2_qty > 0 ? number_format($q2_qty) : NULL;
            $q3_qty = $q3_qty > 0 ? number_format($q3_qty) : NULL;
            $q4_qty = $q4_qty > 0 ? number_format($q4_qty) : NULL;

            $item['q1_amt'] = $item['q1_amt'] > 0 ? number_format($item['q1_amt'],2) : NULL;
            $item['q2_amt'] = $item['q2_amt'] > 0 ? number_format($item['q2_amt'],2) : NULL;
            $item['q3_amt'] = $item['q3_amt'] > 0 ? number_format($item['q3_amt'],2) : NULL;
            $item['q4_amt'] = $item['q4_amt'] > 0 ? number_format($item['q4_amt'],2) : NULL;

            $over_total += $total;
            $item_total = $item_total > 0 ? number_format($item_total) : NULL;
            $total = $total > 0 ? number_format($total,2) : NULL;
            
            $pdf->SetFont('Arial','',8);
            $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
            $pdf->Row(array($row_num,"\t\t\t\t\t\t\t\t\t\t\t\t".$item['item'], $item_total, $item['unit'], $total, $q1_qty, $item['q1_amt'],$q2_qty,$item['q2_amt'],$q3_qty,$item['q3_amt'],$q4_qty,$item['q4_amt'],'',''));
            $row_num++;
        endforeach;
    }
endforeach;
$grand_total += $over_total;
$over_total = $over_total > 0 ? number_format($over_total,2) : NULL;
$pdf->SetFont('Arial','B',8);
$pdf->Row(array("","\t\t\t\t\t\t\t\t\t\t\t\t","","Total",$over_total,"","",'','','','','','','',''));

?>