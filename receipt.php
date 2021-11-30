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
}

function Load_Data($food_id){
    
                include('config/constants.php');
//Display Foods that are Active
                $sql = "SELECT * FROM tbl_order WHERE id=$food_id";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);
                $ds = array();
                $data_array=[];

                //CHeck whether the foods are availalable or not
                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $order_date = $row['order_date'];
                        $price = $row['price'];
                        $food = $row['food'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        
                        $ds = array(
                            "id" => $id,
                            "date"=> $order_date,
                            "sub_total"=> $total,
                            "description" => $food,
                            "qty" => $qty,
                            "unit_price" =>$price ,
                            "unit_total"=>$price*$qty
                        );array_push($data_array,$ds);

                    }
                    
                    //print_r($data_array);
                }
                                              
                
                else
                {
                    //Food not Available
                    return "<div class='error'>Food not found.</div>";
                }
                return $data_array;
          


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

// Data loading from db using ID
$fd_id =$_GET['id'];
$data_array = Load_Data($fd_id);

$pdf->Text(10,65,$data_array[0]['date']);

$pdf->Ln();

$pdf->Line(10, 70, 210-10, 70); // 10mm from each edge

$pdf->SetFont('Arial','B',12);
$pdf->Text(20,75,"Order List");

$pdf->Ln();


///////Table ///////

// Column headings
$header = array('Qty', 'Order', 'Amount(Rs)');

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
    for ($i = 0; $i <= count($data_array)-1; $i++) {
		$pdf->Cell(10 ,6,$i+1,1,0);
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
