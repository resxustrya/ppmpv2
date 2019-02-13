<?php
 
    $st = $pdo->prepare("SELECT * FROM ppmp_code WHERE id <> 1 AND id <> 2 ORDER BY order_by ASC");
    //$st = $pdo->prepare("SELECT * FROM ppmp_code WHERE id = 4");
    $st->execute();
    $codes = $st->fetchAll(PDO::FETCH_ASSOC);
    $code_name = null;
    $ppcode = null;
    $row_amount = null;
    
    $expense_total = 0;
    $openlist_total = 0 ;

    foreach($codes as $code):
        $code_name = $code['expense_name'];
        $ppcode = $code['id'];
        $id = $code['id'];
        $oneline = $code['oneline'];
        
        $expense_total = 0;
        $openlist_total = 0 ;
        
        $q1_qty = 0;
        $q2_qty = 0;
        $q3_qty = 0;
        $q4_qty = 0;
        
        
        try {
            $total = 0;
            $item = null;
            $query = "SELECT * FROM open_list WHERE ppcode = $ppcode AND created_by = '0000-".$divisionid."' LIMIT 1 ";
            $st = $pdo->prepare($query);
            //$st->execute(array($ppcode,'0000-'.$divisionid));
            $st->execute();
            $item = $st->fetch(PDO::FETCH_ASSOC);
            
            
            if(empty($item)){
                $st = $pdo->prepare("SELECT expense_name as item FROM ppmp_code WHERE id = ?  LIMIT 1 ");
                $st->execute(array($ppcode));
                $item = $st->fetch(PDO::FETCH_ASSOC);
    
                $pdf->SetFont('Arial','B',8);
                $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                $pdf->Row(array('',roman($id)."\t\t".$item['item'], '', '', '', '','','','','','','','','',''));
                
                
            } else {
                
                $q1_qty += isset($item['q1_qty']) ? $item['q1_qty'] : 0;
                $q2_qty += isset($item['q2_qty']) ? $item['q2_qty'] : 0;
                $q3_qty += isset($item['q3_qty']) ? $item['q3_qty'] : 0;
                $q4_qty += isset($item['q4_qty']) ? $item['q4_qty'] : 0;
    
    
                $quantity_total = ( $q1_qty + $q2_qty + $q3_qty + $q4_qty );
                $total = ( $q1_qty * $item['q1_amt']) + ( $q2_qty * $item['q2_amt']) + ( $q3_qty * $item['q3_amt']) + ( $q4_qty * $item['q4_amt']);
                $grand_total += $total;
                
                
                $item['q1_amt'] = $item['q1_amt'] > 0 ? number_format($item['q1_amt'],2) : NULL;
                $item['q2_amt'] = $item['q2_amt'] > 0 ? number_format($item['q2_amt'],2) : NULL;
                $item['q3_amt'] = $item['q3_amt'] > 0 ? number_format($item['q3_amt'],2) : NULL;
                $item['q4_amt'] = $item['q4_amt'] > 0 ? number_format($item['q4_amt'],2) : NULL;
                
                $q1_qty = $q1_qty > 0 ? number_format($q1_qty) : NULL;
                $q2_qty = $q2_qty > 0 ? number_format($q2_qty) : NULL;
                $q3_qty = $q3_qty > 0 ? number_format($q3_qty) : NULL;
                $q4_qty = $q4_qty > 0 ? number_format($q4_qty) : NULL;
                
                
                $quantity_total = $quantity_total > 0 ? number_format($quantity_total) : NULL;
                $total = $total > 0 ? number_format($total,2) : NULL;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                $pdf->Row(array('',roman($id)."\t\t".$item['item'], $quantity_total, $item['unit'], $total, $q1_qty, $item['q1_amt'],$q2_qty,$item['q2_amt'],$q3_qty,$item['q3_amt'],$q4_qty,$item['q4_amt'],'',''));
                
            }
        }catch (Exception $ex) {
           // echo $query;
            //exit();
        }
       
        
        //$pdf->SetFont('Arial','B',8);
        //$pdf->Row(array("",roman($id)."."."\t\t".$code_name,'','','','','','','','','','','','',''));
       
        $st = $pdo->prepare("SELECT * FROM open_list WHERE ppcode = ? AND created_by = ? GROUP BY item ORDER BY item ASC");
        $st->execute(array($ppcode,$section));
        $items = $st->fetchAll(PDO::FETCH_ASSOC);
        
        
        $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
        $row_total = 0;
        $total_qty = 0;
        
        foreach($items as $item):
            $row_total = 0;
            
            $row_total = ($item['q1_qty'] * $item['q1_amt']) + ($item['q2_qty'] * $item['q2_amt']) + ($item['q3_qty'] * $item['q3_amt']) + ($item['q4_qty'] * $item['q4_amt']);
            $total_qty = $item['q1_qty'] + $item['q2_qty'] + $item['q3_qty'] + $item['q4_qty'];
            
            $openlist_total += $row_total;

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

            

            if($item['q1_qty'] != null || $item['q2_qty'] || $item['q3_qty'] != null || $item['q4_qty'] != null) {
                $pdf->SetFont('Arial','',8);
                $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                $pdf->Row(array($row_num,$item['item'],$total_qty,$item['unit'],$row_total,$item['q1_qty'],$item['q1_amt'],$item['q2_qty'],$item['q2_amt'],$item['q3_qty'],$item['q3_amt'],$item['q4_qty'],$item['q4_amt'],'',''));
                $row_num++;
            }
            

            //ITEM SUB ITEM
            $st = $pdo->prepare("SELECT * FROM sub_item WHERE created_by = ? AND item_code = ? AND ppcode = ? GROUP BY item ORDER BY item ASC");
            $st->execute(array($section,$item['code'],$ppcode));
            $sub_items = $st->fetchAll(PDO::FETCH_ASSOC);


            foreach($sub_items as $subitem):
                $row_total = 0;
                $row_total = ($subitem['q1_qty'] * $subitem['q1_amt']) + ($subitem['q2_qty'] * $subitem['q2_amt']) + ($subitem['q3_qty'] * $subitem['q3_amt']) + ($subitem['q4_qty'] * $subitem['q4_amt']);
                $total_qty = $subitem['q1_qty'] + $subitem['q2_qty'] + $subitem['q3_qty'] + $subitem['q4_qty'];
                
                $program_total += $row_total;
                $row_total = $row_total > 0 ? number_format($row_total,2) : NULL;
                $total_qty = $total_qty > 0 ? number_format($total_qty) : NULL;
        
                $subitem['q1_qty'] = $subitem['q1_qty'] > 0 ? number_format($subitem['q1_qty']) : NULL;
                $subitem['q2_qty'] = $subitem['q2_qty'] > 0 ? number_format($subitem['q2_qty']) : NULL;
                $subitem['q3_qty'] = $subitem['q3_qty'] > 0 ? number_format($subitem['q3_qty']) : NULL;
                $subitem['q4_qty'] = $subitem['q4_qty'] > 0 ? number_format($subitem['q4_qty']) : NULL;
        
                $subitem['q1_amt'] = $subitem['q1_amt'] > 0 ? number_format($subitem['q1_amt'],2) : NULL;
                $subitem['q2_amt'] = $subitem['q2_amt'] > 0 ? number_format($subitem['q2_amt'],2) : NULL;
                $subitem['q3_amt'] = $subitem['q3_amt'] > 0 ? number_format($subitem['q3_amt'],2) : NULL;
                $subitem['q4_amt'] = $subitem['q4_amt'] > 0 ? number_format($subitem['q4_amt'],2) : NULL;
        
                
                $pdf->SetFont('Arial','',7);
                $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                $pdf->Row(array($row_num,$subitem['item'],$total_qty,$subitem['unit'],$row_total,$subitem['q1_qty'],$subitem['q1_amt'],$subitem['q2_qty'],$subitem['q2_amt'],$subitem['q3_qty'],$subitem['q3_amt'],$subitem['q4_qty'],$subitem['q4_amt'],'',''),0,'R');
                $row_num++;
            endforeach;                
        endforeach;
        if($openlist_total > 0) {
            $expense_total += $openlist_total;
            //$openlist_total = number_format($openlist_total,2);
            //$pdf->SetFont('Arial','B',9);
            //$pdf->Row(array("","\t\t\t\t\t\t\t\t\t\t\t\t","","Total",$openlist_total,"","",'','','','','','','',''));
        }
        
        // DISPLAY EACH PROGRAM EXPENSE

        
        $program_total = 0;
        $st = $pdo->prepare("SELECT * FROM program_name WHERE section = ? AND division = ? AND ppcode = ?");
        $st->execute(array($section,$divisionid,$code['id']));
        $programs = $st->fetchAll(PDO::FETCH_ASSOC);
        if($programs) {

            $label = 'A';
            $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
            
            
            foreach($programs as $program):
            
                $program_name = $program['name'];
            
                $program_total = 0;
            
                $pdf->SetFont('Arial','B',9);
                $pdf->Row(array("","$label. $program_name","","","","","",'','','','','','','',''));
                
                $st = $pdo->prepare("SELECT * FROM program_training_venue ptv LEFT JOIN training_venue tv ON ptv.venue_id = tv.id WHERE ptv.program_id = ? ORDER BY tv.order ASC");
                $st->execute(array($program['id']));
                $venues = $st->fetchAll(PDO::FETCH_ASSOC);
                foreach($venues as $venue):
                    $venue_name = $venue['venue'];
                    
                    $pdf->SetFont('Arial','BI',8);
                    $pdf->Row(array("","$venue_name","","","","","",'','','','','','','',''));
                    $st = $pdo->prepare("SELECT * FROM program_items WHERE created_by = ? AND program_id =? AND venue_id = ? GROUP BY item ORDER BY item ASC");
                    $st->execute(array($section,$program['id'],$venue['id']));
                    $program_items = $st->fetchAll(PDO::FETCH_ASSOC);
                    
                    $row_total = 0;
                    $total_qty = 0;
                    foreach($program_items as $item):
                        $row_total = 0;
                        
                        $row_total = ($item['q1_qty'] * $item['q1_amt']) + ($item['q2_qty'] * $item['q2_amt']) + ($item['q3_qty'] * $item['q3_amt']) + ($item['q4_qty'] * $item['q4_amt']);
                        $total_qty = $item['q1_qty'] + $item['q2_qty'] + $item['q3_qty'] + $item['q4_qty'];
                        
                        $program_total += $row_total;
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
                        $pdf->Row(array($row_num,$item['item'],$total_qty,$item['unit'],$row_total,$item['q1_qty'],$item['q1_amt'],$item['q2_qty'],$item['q2_amt'],$item['q3_qty'],$item['q3_amt'],$item['q4_qty'],$item['q4_amt'],'',''));
                        $row_num++;


                        //PROGRAM ITEM SUB ITEM
                        $st = $pdo->prepare("SELECT * FROM program_subitem WHERE created_by = ? AND program_id =? AND venue_id = ? AND item_code = ? GROUP BY item ORDER BY item ASC");
                        $st->execute(array($section,$program['id'],$venue['id'],$item['code']));
                        $program_sub_items = $st->fetchAll(PDO::FETCH_ASSOC);


                        foreach($program_sub_items as $subitem):
                            $row_total = 0;
                            
                            $row_total = ($subitem['q1_qty'] * $subitem['q1_amt']) + ($subitem['q2_qty'] * $subitem['q2_amt']) + ($subitem['q3_qty'] * $subitem['q3_amt']) + ($subitem['q4_qty'] * $subitem['q4_amt']);
                            $total_qty = $subitem['q1_qty'] + $subitem['q2_qty'] + $subitem['q3_qty'] + $subitem['q4_qty'];
                            
                            $program_total += $row_total;
                            $row_total = $row_total > 0 ? number_format($row_total,2) : NULL;
                            $total_qty = $total_qty > 0 ? number_format($total_qty) : NULL;
                    
                            $subitem['q1_qty'] = $subitem['q1_qty'] > 0 ? number_format($subitem['q1_qty']) : NULL;
                            $subitem['q2_qty'] = $subitem['q2_qty'] > 0 ? number_format($subitem['q2_qty']) : NULL;
                            $subitem['q3_qty'] = $subitem['q3_qty'] > 0 ? number_format($subitem['q3_qty']) : NULL;
                            $subitem['q4_qty'] = $subitem['q4_qty'] > 0 ? number_format($subitem['q4_qty']) : NULL;
                    
                            $subitem['q1_amt'] = $subitem['q1_amt'] > 0 ? number_format($subitem['q1_amt'],2) : NULL;
                            $subitem['q2_amt'] = $subitem['q2_amt'] > 0 ? number_format($subitem['q2_amt'],2) : NULL;
                            $subitem['q3_amt'] = $subitem['q3_amt'] > 0 ? number_format($subitem['q3_amt'],2) : NULL;
                            $subitem['q4_amt'] = $subitem['q4_amt'] > 0 ? number_format($subitem['q4_amt'],2) : NULL;
                    
                            
                            $pdf->SetFont('Arial','',7);
                            $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                            $pdf->Row(array($row_num,$subitem['item'],$total_qty,$subitem['unit'],$row_total,$subitem['q1_qty'],$subitem['q1_amt'],$subitem['q2_qty'],$subitem['q2_amt'],$subitem['q3_qty'],$subitem['q3_amt'],$subitem['q4_qty'],$subitem['q4_amt'],'',''),0,'R');
                            $row_num++;
                        endforeach;
                    endforeach;
                endforeach;

                if($program_total > 0) {
                    $expense_total += $program_total;
                    $program_total = number_format($program_total,2);
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Row(array("","\t\t\t\t\t\t\t\t\t\t\t\t","","Total",$program_total,"","",'','','','','','','',''));
                }
                $label++;
            endforeach;
        }
        
        if($expense_total > 0) {
            $grand_total += $expense_total;
            $pdf->SetFont('Arial','B',9);
            $expense_total = $expense_total > 0 ? number_format($expense_total,2) : NULL;
            $pdf->Row(array("",$code_name." TOTAL ","","",$expense_total,"","",'','','','','','','',''));
        }
    endforeach;
   
?>