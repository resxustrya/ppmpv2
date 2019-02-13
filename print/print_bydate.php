

<?php

require('dbconn.php');
require('fpdf.php');
require('roman.php');
ini_set('max_execution_time', 0);
ini_set('memory_limit','1000M');
ini_set('max_input_time','300000');
class PDF extends FPDF
{
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data,$border = 0,$txt_align = 'L')
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
           // $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            $a = $txt_align;
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            if($border == 0)
            {
                $this->Rect($x,$y,$w,$h);
            }

            //Print the text
            if($i == count($data)) {
                if($a == 'L'){
                    $this->SetFont('Arial','',5);
                }else {
                    $this->SetFont('Arial','',3);
                }
                
            }
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }
    


    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
            $this->SetFont('Arial','B',8);
            
            
            $this->Cell(8,5,'Item','LTR',0,'C',0);
            $this->Cell(90,5,'Item Description/','LTR',0,'C',0);
            $this->Cell(16,5,'Total','LTR',0,'C',0);
            $this->Cell(13,5,' ','LTR',0,'C',0);
            $this->Cell(23,5,' ','LTR',0,'C',0);
            $this->Cell(74,5,'First Semester','LTRB',0,'C',0);  
            $this->Cell(74,5,'Second Semester','LTRB',0,'C',0);
            $this->Cell(25,5,'Recommended','LTR',0,'C',0);
            $this->Cell(20,5,'SOURCE OF','LTR',0,'C',0);

            $this->Ln();

            $this->Cell(8,5,'No.','LR',0,'C',0);
            $this->Cell(90,5,'General Specification','LR',0,'C',0);
            $this->Cell(16,5,'Qty.','LR',0,'C',0);
            $this->Cell(13,5,'Unit','LR',0,'C',0);
            $this->Cell(23,5,'Total Amount','LR',0,'C',0);
            $this->Cell(37,5,'Q1','LTRB',0,'C',0);
            $this->Cell(37,5,'Q2','LTRB',0,'C',0);
            $this->Cell(37,5,'Q3','LTRB',0,'C',0);
            $this->Cell(37,5,'Q4','LTRB',0,'C',0);
            $this->Cell(25,5,'Procurement','LR',0,'C',0);
            $this->Cell(20,5,'FUND','LR',0,'C',0);

            $this->Ln();


            $this->Cell(8,5,' ','LRB',0,'C',0);
            $this->Cell(90,5,' ','LRB',0,'C',0);
            $this->Cell(16,5,' ','LRB',0,'C',0);
            $this->Cell(13,5,' ','LRB',0,'C',0);
            $this->Cell(23,5,' ','LRB',0,'C',0);
            $this->Cell(15,5,'Qty.','LTRB',0,'C',0);
            $this->Cell(22,5,'Unit Cost','LTRB',0,'C',0);
            $this->Cell(15,5,'Qty.','LTRB',0,'C',0);
            $this->Cell(22,5,'Unit Cost','LTRB',0,'C',0);
            $this->Cell(15,5,'Qty.','LTRB',0,'C',0);
            $this->Cell(22,5,'Unit Cost','LTRB',0,'C',0);
            $this->Cell(15,5,'Qty.','LTRB',0,'C',0);
            $this->Cell(22,5,'Unit Cost','LTRB',0,'C',0);
            $this->Cell(25,5,'Method','LRB',0,'C',0);
            $this->Cell(20,5,'','LRB',0,'C',0);
            $this->Ln();
        }
    }

    function NbLines($w,$txt)
    {
        
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function headsection($funds,$division,$section)
    {
        $this->Image(__DIR__.'/image/doh.png', 40, 20,20,20);
        $this->Image(__DIR__.'/image/ro7.png', 290, 20,20,20);
        $this->SetFont('Arial','B',9);

        $this->SetXY(120,20);
        $this->Cell(90,10,'Department of Health Regional Office VII',0,0,'C');

        $this->SetXY(120,25);
        $this->Cell(90,10,'PROJECT PROCUREMENT MANAGEMENT PLAN',0,0,'C');

        $this->SetXY(120,30);
        $this->Cell(90,10,"CY  2019".$funds,0,0,'C');
        
        $this->Ln();

        $month = date('F j, Y',strtotime(date('Y-m-d')));
        $this->SetFont('Arial','B',9);
        $this->SetXY(10,45);
        $this->Cell(40,10,"Date      : ".$month,0);

        $this->Ln();
        $this->SetFont('Arial','B',9);
        $this->SetXY(10,45);
        $this->Cell(40,20,"Office    : RO VII  $section - $division",0);

    }

}

$section = null;
if(isset($_POST['section'])) {
    $section = $_POST['section'];
}

$divisionid = null;
if(isset($_POST['division'])) {
    $divisionid = $_POST['division'];
}

$ppmp_code = null;
if(isset($_POST['expense'])){
    $ppmp_code = $_POST['expense'];
}
$date_from = null;
if(isset($_POST['from'])){
    $date_from = $_POST['from'];
}

$date_to = null;
if(isset($_POST['to'])){
    $date_to = $_POST['to'];
}

$pdf = new PDF('L','mm','LEGAL');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(15);
$pdf->SetWidths(array(15,50,20,15,25,20,20,20,20,20,20,20,20,25,30));

$roman = 1;
$pdo = conn();
$row_num = 1;

$st = $pdo->prepare("SELECT d.id as division_id, s.description as section, d.description as division, s.source_fund FROM section s LEFT JOIN division d ON d.id = s.division WHERE s.id = ? LIMIT 1");
$st->execute(array($section));
$section_name = $st->fetch(PDO::FETCH_ASSOC);

$grand_total = 0;

$pdf->headsection($section_name['source_fund'],$section_name['section'],$section_name['division']);


include_once 'scripts/thead.php';
include_once 'per_expense_code.php';

$pdf->Output();

?>
