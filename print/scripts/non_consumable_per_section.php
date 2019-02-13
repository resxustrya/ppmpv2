<?php

    $pdf->SetFont('Arial','B',8);

    $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
    $pdf->Row(array('',"\t\t\t\t\t\t\t 2. NON-CONSUMABLE\n\t\t\t\t\t\t\t\t\t\t\t a. PER SECTION",'','','','','','','','','','','','','')); 
    

    $pdf->SetFont('Arial','',8);
    $st = $pdo->prepare("SELECT * FROM table_e WHERE created_by = ? OR created_by = '8888' GROUP BY item ORDER BY item ASC");
    $st->execute(array($section));
    $items = $st->fetchAll(PDO::FETCH_ASSOC);
    
    $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
    $table_e_total = 0;
    $row_total = 0;
    $total_qty = 0;
    foreach($items as $item):
        $row_total = 0;

        $row_total = ($item['q1_qty'] * $item['q1_amt']) + ($item['q2_qty'] * $item['q2_amt']) + ($item['q3_qty'] * $item['q3_amt']) + ($item['q4_qty'] * $item['q4_amt']);
        $total_qty = $item['q1_qty'] + $item['q2_qty'] + $item['q3_qty'] + $item['q4_qty'];
        // table E total
        $table_e_total += $row_total;
        $row_total = $row_total > 0 ? number_format($row_total,2) : NULL;
        $total_qty = $total_qty > 0 ? number_format($total_qty) : NULL;

        $item['q1_qty'] = $item['q1_qty'] > 0 ? number_format($item['q1_qty']) : NULL;
        $item['q2_qty'] = $item['q2_qty'] > 0 ? number_format($item['q2_qty']) : NULL;
        $item['q3_qty'] = $item['q3_qty'] > 0 ? number_format($item['q3_qty']) : NULL;
        $item['q4_qty'] = $item['q4_qty'] > 0 ? number_format($item['q4_qty']) : NULL;

        $item['q1_amt'] = $item['q1_amt'] > 0 ? number_format($item['q1_amt'],2) : NULL;
        $item['q2_amt'] = $item['q2_amt'] > 0 ? number_format($item['q2_amt'],2) : NULL;
        $item['q3_amt'] = $item['q3_amt'] > 0 ? number_format($item['q3_amt'],2) : NULL;
        $item['q4_amt'] = $item['q4_amt'] > 0 ? number_format($item['q4_amt'],2) : NULL;


        $pdf->SetFont('Arial','',8);
        $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
        $pdf->Row(array($row_num,"\t\t\t\t\t\t\t\t\t\t\t\t".$item['item'],$total_qty,$item['unit'],$row_total,$item['q1_qty'],$item['q1_amt'],$item['q2_qty'],$item['q2_amt'],$item['q3_qty'],$item['q3_amt'],$item['q4_qty'],$item['q4_amt'],'',''));
        $row_num++;
    endforeach;
    $grand_total += $table_e_total;
    $table_e_total = $table_e_total > 0 ? number_format($table_e_total,2) : 0;
    $pdf->SetFont('Arial','B',9);
    $pdf->Row(array("","\t\t\t\t\t\t\t\t\t\t\t\t","","Total",$table_e_total,"","",'','','','','','','',''));
?>