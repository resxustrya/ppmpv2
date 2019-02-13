<?php


$st = $pdo->prepare("SELECT * FROM ppmp_code WHERE id <> 1 AND id <> 2 ORDER BY order_by ASC");
//$st = $pdo->prepare("SELECT * FROM ppmp_code WHERE id = 24");
$st->execute();
$codes = $st->fetchAll(PDO::FETCH_ASSOC);

$expense_grand_total = 0;

$q1_qty = 0;
$q2_qty = 0;
$q3_qty = 0;
$q4_qty = 0;


foreach($codes as $code):
    $expense_grand_total = 0;
    
    $code_name = $code['expense_name'];
    $ppcode = $code['id'];
    $id = $code['id'];
    $oneline = $code['oneline'];

    $q1_qty = 0;
    $q2_qty = 0;
    $q3_qty = 0;
    $q4_qty = 0;
    
    try {
        $total = 0;
        $item = null;
        
        $st = $pdo->prepare("SELECT * FROM open_list WHERE ppcode = ? AND created_by = ? LIMIT 1 ");
        $st->execute(array($ppcode,'0000-'.$divisionid));
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
        
    }

    //$pdf->SetFont('Arial','B',8);
    //$pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
    //$pdf->Row(array("",roman($id)."."."\t\t".$code_name,'','','','','','','','','','','','',''));

    
    $st = $pdo->prepare("SELECT s.description as description, s.id as id FROM section s LEFT JOIN open_list ol ON s.id = ol.created_by WHERE ol.division = ? GROUP BY ol.created_by ORDER BY ol.created_by");
    $st->execute(array($divisionid));
    $open_sections = $st->fetchAll(PDO::FETCH_ASSOC);

    foreach($open_sections as $section):
        //$st = $pdo->prepare("SELECT * FROM open_list WHERE ppcode = ? AND division = ? AND created_by = ? AND (q1_qty > 0 OR q2_qty > 0 OR q3_qty > 0 OR q4_qty > 0) GROUP BY item ORDER BY item ASC");
        $st = $pdo->prepare("SELECT * FROM open_list WHERE ppcode = ? AND division = ? AND created_by = ? AND (q1_qty > 0 OR q2_qty > 0 OR q3_qty > 0 OR q4_qty > 0) GROUP BY item ORDER BY item ASC");

        $st->execute(array($ppcode,$divisionid,$section['id']));
        $open_list = $st->fetchAll(PDO::FETCH_ASSOC);

        if(count($open_list) > 0 ) :

            $pdf->SetFont('Arial','BI',8);
            $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
            $pdf->Row(array("","","","","","","",'','','','','','','',''));
            $pdf->Row(array("",strtoupper($section['description']),"","","","","",'','','','','','','',''));
            if($code['id'] == 24){
                $pdf->Row(array("","Venue,Meals and Accommodation","","","","","",'','','','','','','',''));
            }

            foreach($open_list as $list):
                $q1_qty = 0;
                $q2_qty = 0;
                $q3_qty = 0;
                $q4_qty = 0;
                $total = 0;
                $quantity_total = 0;
                //if($list['q1_qty'] > 0 OR $list['q2_qty'] > 0 OR $list['q3_qty'] > 0 OR $list['q4_qty'] > 0 ) :
                if(isset($list['item']) AND isset($list['unit'])):
                    try{
                        $st = $pdo->prepare("SELECT * from open_list WHERE ppcode = ? AND code = ? AND created_by = ? AND item != '' GROUP BY item ORDER BY item ASC LIMIT 1");
                        $st->execute(array($ppcode,$list['code'],$section['id']));
                        $item = $st->fetch(PDO::FETCH_ASSOC);
                        if(count($item) > 0):
                            $q1_qty += $item['q1_qty'];
                            $q2_qty += $item['q2_qty'];
                            $q3_qty += $item['q3_qty'];
                            $q4_qty += $item['q4_qty'];
                            
                            $quantity_total = ( $q1_qty + $q2_qty + $q3_qty + $q4_qty );
                            $total = ( $q1_qty * $item['q1_amt']) + ( $q2_qty * $item['q2_amt']) + ( $q3_qty * $item['q3_amt']) + ( $q4_qty * $item['q4_amt']);
                            $grand_total += $total;
                            $expense_grand_total += $total;

                            $item['q1_amt'] = isset($item['q1_amt']) ? number_format($item['q1_amt'],2) : NULL;
                            $item['q2_amt'] = isset($item['q2_amt']) > 0 ? number_format($item['q2_amt'],2) : NULL;
                            $item['q3_amt'] = isset($item['q3_amt']) > 0 ? number_format($item['q3_amt'],2) : NULL;
                            $item['q4_amt'] = isset($item['q4_amt']) > 0 ? number_format($item['q4_amt'],2) : NULL;

                            $q1_qty = $q1_qty > 0 ? number_format($q1_qty) : NULL;
                            $q2_qty = $q2_qty > 0 ? number_format($q2_qty) : NULL;
                            $q3_qty = $q3_qty > 0 ? number_format($q3_qty) : NULL;
                            $q4_qty = $q4_qty > 0 ? number_format($q4_qty) : NULL;

                            $quantity_total = $quantity_total > 0 ? number_format($quantity_total) : NULL;
                            $total = $total > 0 ? number_format($total,2) : NULL;

                            $pdf->SetFont('Arial','',8);
                            $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                            $pdf->Row(array($row_num,$item['item'], $quantity_total, $item['unit'], $total, $q1_qty, $item['q1_amt'],$q2_qty,$item['q2_amt'],$q3_qty,$item['q3_amt'],$q4_qty,$item['q4_amt'],'',''));

                            $row_num++;
                        endif;    
                    }catch(Exception $ex)
                    {
                        echo $ppcode;
                        exit();
                    }
                    

                    //ITEM SUB ITEM
                    $st = $pdo->prepare("SELECT * FROM sub_item WHERE created_by = ? AND item_code = ? AND ppcode = ? GROUP BY item ORDER BY item ASC");
                    $st->execute(array($section['id'],$item['code'],$ppcode));
                    $sub_items = $st->fetchAll(PDO::FETCH_ASSOC);


                    foreach($sub_items as $subitem):
                        $row_total = 0;
                        $row_total = ($subitem['q1_qty'] * $subitem['q1_amt']) + ($subitem['q2_qty'] * $subitem['q2_amt']) + ($subitem['q3_qty'] * $subitem['q3_amt']) + ($subitem['q4_qty'] * $subitem['q4_amt']);
                        $total_qty = $subitem['q1_qty'] + $subitem['q2_qty'] + $subitem['q3_qty'] + $subitem['q4_qty'];
                        
                        $grand_total += $row_total;
                        $expense_grand_total += $row_total;
                        

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
                        $pdf->Row(array($row_num,$subitem['item'],$total_qty,$subitem['unit'],$row_total,$subitem['q1_qty'],$subitem['q1_amt'],$subitem['q2_qty'],$subitem['q2_amt'],$subitem['q3_qty'],$item['q3_amt'],$subitem['q4_qty'],$subitem['q4_amt'],'',''),0,'R');
                        $row_num++;
                    endforeach;

                endif;
            endforeach;
        endif;
    endforeach;

    // DISPLAY EACH PROGRAM EXPENSE


    $st = $pdo->prepare("SELECT s.id as id , s.description as description  FROM program_name pn LEFT JOIN section s on pn.section = s.id WHERE pn.division = ? AND pn.ppcode = ? GROUP BY pn.section");
    $st->execute(array($divisionid,$ppcode));
    $section_programs = $st->fetchAll(PDO::FETCH_ASSOC);
    
    if(count($section_programs) > 0) {

        foreach($section_programs as $section_result):

            $st = $pdo->prepare("SELECT * FROM program_name WHERE section = ? AND division = ? AND ppcode = ?");
            $st->execute(array($section_result['id'],$divisionid,$ppcode));
            $programs = $st->fetchAll(PDO::FETCH_ASSOC);
            if($programs) {

                $pdf->SetFont('Arial','BIU',8);
                $pdf->SetWidths(array(0,98,16,13,23,15,22,15,22,15,22,15,22,25,20));
                $pdf->Row(array("",$section_result['description'],"","","","","",'','','','','','','',''));
                if($code['id'] == 24){
                    $pdf->SetFont('Arial','BI',8);
                    $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                    $pdf->Row(array("","Venue,Meals and Accommodation","","","","","",'','','','','','','',''));
                }
                
                $label = 'A';

            
                $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                foreach($programs as $program):
                    $program_name = $program['name'];
                    $program_fund = $program['source_fund'];
                    $pdf->SetFont('Arial','B',9);
                    $pdf->Row(array("","$label. $program_name","","","","","",'','','','','','','',''));

                    $st = $pdo->prepare("SELECT * FROM program_training_venue ptv LEFT JOIN training_venue tv ON ptv.venue_id = tv.id WHERE ptv.program_id = ? ORDER BY tv.order ASC");
                    $st->execute(array($program['id']));
                    $venues = $st->fetchAll(PDO::FETCH_ASSOC);
                    foreach($venues as $venue):
                        $venue_name = $venue['venue'];


                        $st = $pdo->prepare("SELECT * FROM program_items WHERE created_by = ? AND program_id =? AND venue_id = ? AND (q1_qty > 0 OR q2_qty > 0 OR q3_qty > 0 OR q4_qty > 0) GROUP BY item ORDER BY item ASC");
                        //$st = $pdo->prepare("SELECT * FROM program_items WHERE created_by = ? AND program_id =? AND venue_id = ? GROUP BY item ORDER BY item ASC");

                        $st->execute(array($section_result['id'],$program['id'],$venue['id']));
                        $program_items = $st->fetchAll(PDO::FETCH_ASSOC);

                        if($program_items) {
                            $pdf->SetFont('Arial','BI',9);
                            $pdf->Row(array("","$venue_name","","","","","",'','','','','','','',''));
                        }

                        $quantity_total = 0;
                        foreach($program_items as $item):
                            $q1_qty = 0;
                            $q2_qty = 0;
                            $q3_qty = 0;
                            $q4_qty = 0;
                            $total = 0;
                            if($item['q1_qty'] > 0 OR $item['q2_qty'] > 0 OR $item['q3_qty'] > 0 OR $item['q4_qty'] > 0 ) :
                                $q1_qty += $item['q1_qty'];
                                $q2_qty += $item['q2_qty'];
                                $q3_qty += $item['q3_qty'];
                                $q4_qty += $item['q4_qty'];
                                
                                $quantity_total = ( $q1_qty + $q2_qty + $q3_qty + $q4_qty );
                                $total = ( $q1_qty * $item['q1_amt']) + ( $q2_qty * $item['q2_amt']) + ( $q3_qty * $item['q3_amt']) + ( $q4_qty * $item['q4_amt']);
                                $expense_grand_total += $total;
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

                                $pdf->SetFont('Arial','',8);
                                $pdf->SetWidths(array(8,90,16,13,23,15,22,15,22,15,22,15,22,25,20));
                                $pdf->Row(array($row_num,$item['item'], $quantity_total, $item['unit'], $total, $q1_qty, $item['q1_amt'],$q2_qty,$item['q2_amt'],$q3_qty,$item['q3_amt'],$q4_qty,$item['q4_amt'],'',$program_fund));

                                $row_num++;
                            endif;
                            
                            //PROGRAM ITEM SUB ITEM
                            $st = $pdo->prepare("SELECT * FROM program_subitem WHERE created_by = ? AND program_id =? AND venue_id = ? AND item_code = ? GROUP BY item ORDER BY item ASC");
                            $st->execute(array($section_result['id'],$program['id'],$venue['id'],$item['code']));
                            $program_sub_items = $st->fetchAll(PDO::FETCH_ASSOC);

                            $row_total = 0;
                            
                            foreach($program_sub_items as $subitem):
                                $row_total = 0;
                                
                                $row_total = ($subitem['q1_qty'] * $subitem['q1_amt']) + ($subitem['q2_qty'] * $subitem['q2_amt']) + ($subitem['q3_qty'] * $subitem['q3_amt']) + ($subitem['q4_qty'] * $subitem['q4_amt']);
                                $total_qty = $subitem['q1_qty'] + $subitem['q2_qty'] + $subitem['q3_qty'] + $subitem['q4_qty'];
                                
                                $expense_grand_total += $row_total;
                                $grand_total += $row_total;

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
                                $pdf->Row(array($row_num,$subitem['item'],$total_qty,$subitem['unit'],$row_total,$subitem['q1_qty'],$subitem['q1_amt'],$subitem['q2_qty'],$subitem['q2_amt'],$subitem['q3_qty'],$item['q3_amt'],$subitem['q4_qty'],$subitem['q4_amt'],'',''),0,'R');
                                $row_num++;
                            endforeach;
                        endforeach;
                    endforeach;
                    $label++;
                    
                    //$expense_grand_total += $program_row_total;
                    //$grand_total += $program_row_total;
                    //$program_row_total = $program_row_total > 0 ? number_format($program_row_total,2) : '';

                endforeach;
            }
        endforeach;
    }
    if($expense_grand_total > 0) {
        //$grand_total += $expense_grand_total;
        $pdf->SetFont('Arial','B',8);
        $expense_grand_total = $expense_grand_total > 0 ? number_format($expense_grand_total,2) : NULL;
        $pdf->Row(array("",$code_name." TOTAL ","","",$expense_grand_total,"","",'','','','','','','',''));
    }
    
endforeach;
?>