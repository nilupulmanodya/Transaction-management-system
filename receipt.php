<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',91,18,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'RESTAURANT CHILL - NAIWALA',0,0,'C');
    // Line break
    $this->Ln(20);
}

function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// print total
function PrintTotal($data_total)
{
    // Column widths
    $this->Ln();
    $this->Cell(35,7,'5'+strval($data_total[1]),0,0,'R');
    $w = array(35, 95, 40);
    // Header
    for($i=0;$i<count($data_total);$i++)
        $this->Cell($w[$i],7,+'total'+$data_total[$i],0,0,'R');
    $this->Ln();
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,number_format($row[0]),0,0,'C');
        $this->Cell($w[1],6,$row[1],0,0,'L');
        $this->Cell($w[2],6,number_format($row[2]),0,0,'R');
        $this->Ln();
    }
    // Closing line
    //$this->Cell(array_sum($w),0,'','T');
}




}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);


$pdf->Line(10, 45, 210-10, 45); // 20mm from each edge
//$pdf->Cell(40,36,'Restaurant Chill - Family Restaurant');
$pdf->Text(10,50,'Restaurant Chill - Family Restaurant');
$pdf->Text(10,55,'No.2B, Divulapitiya Rd, Naiwala Jn.');
$pdf->Text(10,60,'Contact Us : 076 650 74 40 / 077 673 40 21');
$pdf->Text(10,65,'Date : Oct 31, 2021');

$pdf->Ln();

$pdf->Line(10, 70, 210-10, 70); // 10mm from each edge

$pdf->SetFont('Arial','B',12);
$pdf->Text(20,75,"Order List");

$pdf->Ln();


///////Table ///////

// Column headings
$header = array('Qty', 'Order', 'Amount(Rs)');
// Data loading
$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',14);
// $pdf->ImprovedTable($header,$data);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

/*Heading Of the table*/
$pdf->Cell(10 ,6,'Sl',1,0,'C');
$pdf->Cell(80 ,6,'Description',1,0,'C');
$pdf->Cell(23 ,6,'Qty',1,0,'C');
$pdf->Cell(30 ,6,'Unit Price',1,0,'C');

$pdf->Cell(45 ,6,'Total',1,1,'C');/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','',10);
    for ($i = 1; $i <= 10; $i++) {
		$pdf->Cell(10 ,6,$i,1,0);
		$pdf->Cell(80 ,6,'HP Laptop',1,0);
		$pdf->Cell(23 ,6,'1',1,0,'R');
		$pdf->Cell(30 ,6,'15000.00',1,0,'R');
		$pdf->Cell(45 ,6,'15100.00',1,1,'R');
	}	

$pdf->Cell(118 ,6,'',0,0);
$pdf->Cell(25 ,6,'Subtotal',0,0);
$pdf->Cell(45 ,6,'151000.00',1,1,'R');


$pdf->Line(10, 80+6*14, 210-10, 80+6*14);

$pdf->Cell(10 ,35,'We deliver foods to your home 076 650 74 40',0,0,'L');
//data for total
// $data_total = array('1000.00', '1500.00', '500.00');
// $pdf->PrintTotal($data_total);

// Table ending here

$pdf->Output();
?>