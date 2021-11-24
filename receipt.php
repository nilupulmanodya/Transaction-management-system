<?php
require('fpdf.php');
$id='1636314928';
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
}


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$data_array = array(
    array(
        "id" => "1636314928",
        "date"=>"2021-11-08 00:00:00",
        "sub_total"=>"456.00"),
    array(
        "description" => "Best Burger",
        "unit_price" => "4.00",
        "qty" => "6",
        "unit_total"=>"45.00"),
        array(
            "description" => "Best Burger",
            "unit_price" => "4.00",
            "qty" => "6",
            "unit_total"=>"45.00"),
            array(
                "description" => "Best Burger",
                "unit_price" => "4.00",
                "qty" => "6",
                "unit_total"=>"45.00"),array(
                    "description" => "Best Burger",
                    "unit_price" => "4.00",
                    "qty" => "6",
                    "unit_total"=>"45.00"),array(
                        "description" => "Best Burger",
                        "unit_price" => "4.00",
                        "qty" => "6",
                        "unit_total"=>"45.00"),array(
                            "description" => "Best Burger",
                            "unit_price" => "4.00",
                            "qty" => "6",
                            "unit_total"=>"45.00"),array(
                                "description" => "Best Burger",
                                "unit_price" => "4.00",
                                "qty" => "6",
                                "unit_total"=>"45.00"),array(
                                    "description" => "Best Burger",
                                    "unit_price" => "4.00",
                                    "qty" => "6",
                                    "unit_total"=>"45.00"),array(
                                        "description" => "Best Burger",
                                        "unit_price" => "4.00",
                                        "qty" => "6",
                                        "unit_total"=>"45.00"),array(
                                            "description" => "Best Burger",
                                            "unit_price" => "4.00",
                                            "qty" => "6",
                                            "unit_total"=>"45.00"),
    array(
        
        "description" => "Best Burgertest 2 ",
        "unit_price" => "14.00",
        "qty" => "1",
        "unit_total"=>"55.00")
    
    )
;

$pdf->Line(10, 45, 210-10, 45); // 20mm from each edge
//$pdf->Cell(40,36,'Restaurant Chill - Family Restaurant');
$pdf->Text(10,50,'Restaurant Chill - Family Restaurant');
$pdf->Text(10,55,'No.2B, Divulapitiya Rd, Naiwala Jn.');
$pdf->Text(10,60,'Contact Us : 076 650 74 40 / 077 673 40 21');
$pdf->Text(10,65,$data_array[0]['date']);

$pdf->Ln();

$pdf->Line(10, 70, 210-10, 70); // 10mm from each edge

$pdf->SetFont('Arial','B',12);
$pdf->Text(20,75,"Order List");

$pdf->Ln();


///////Table ///////

// Column headings
$header = array('Qty', 'Order', 'Amount(Rs)');
// Data loading

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
    for ($i = 1; $i <= count($data_array)-1; $i++) {
		$pdf->Cell(10 ,6,$i,1,0);
		$pdf->Cell(80 ,6,$data_array[$i]['description'],1,0);
		$pdf->Cell(23 ,6,$data_array[$i]['qty'],1,0,'R');
		$pdf->Cell(30 ,6,$data_array[$i]['unit_price'],1,0,'R');
		$pdf->Cell(45 ,6,$data_array[$i]['unit_total'],1,1,'R');
	}	

$pdf->Cell(118 ,6,'',0,0);
$pdf->Cell(25 ,6,'Subtotal',0,0);
$pdf->Cell(45 ,6,$data_array[0]['sub_total'],1,1,'R');



$pdf->Cell(10 ,35,'We deliver foods to your home 076 650 74 40',0,0,'L');
//data for total
// $data_total = array('1000.00', '1500.00', '500.00');
// $pdf->PrintTotal($data_total);

// Table ending here

$pdf->Output();


?>
