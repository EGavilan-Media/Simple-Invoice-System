<?php
	require('vendor/fpdf/fpdf.php');

	$connect = mysqli_connect('localhost','root','');
	mysqli_select_db($connect,'egm_simple_invoice');

	class PDF extends FPDF {
		function Header(){

			$connect = mysqli_connect('localhost','root','');
			mysqli_select_db($connect,'egm_simple_invoice');

			$sql_order="SELECT order_id,
                      order_receiver_name,
                      order_receiver_address,
                      order_total_before_tax,
                      order_total_tax,
                      order_total_after_tax,
                      order_created_at
                      FROM tbl_orders WHERE order_id = '".$_GET["order_id"]."'";
					  
			$query_invoice = mysqli_query($connect, $sql_order);
			$row = mysqli_fetch_array($query_invoice);

			$this->SetFont('Arial','B',30);

			$this->Cell(12);

			$this->Image('images/egavilanmedia.jpg',10,10,100);

			$this->SetTextColor(7, 56, 99);

			$this->SetY(15);
			$this->SetFont('Arial', 'B', 30);
			$this->Ln(30);
			$this->SetX(65);

			$this->Ln(1);

			$this->SetFont('Arial','B',14);

			$this->Cell(125	,5,'Billing to',0,0);
			$this->Cell(60	,5,'INVOICE',0,1);
			$this->SetFont('Arial','',12);

			$this->Cell(30	,5,'Customer: ',0,0);
			$this->Cell(95	,5,$row['order_receiver_name'],0,0);
			$this->Cell(25	,5,'Date:',0,0);
			$this->Cell(34	,5,$row['order_created_at'],0,1);

			$this->Cell(30	,5,'Address:',0,0);
			$this->Cell(95	,5,$row['order_receiver_address'],0,0);
			$this->Cell(25	,5,'Invoice #:',0,0);
			$this->Cell(34	,5,$row['order_id'],0,1);

			$this->Ln(2);

			$this->SetFont('Arial','B',12);
			$this->SetFillColor(7, 56, 99);
			$this->SetDrawColor(0,0,0);
			$this->SetFont('Arial', '', 12);
			$this->SetTextColor(255,255,255);
			$this->Cell(55,10,'PRODUCT',1,0,'',true);
			$this->Cell(15,10,'QTY',1,0,'',true);
			$this->Cell(30,10,'PRICE',1,0,'',true);
			$this->Cell(30,10,'TAX',1,0,'',true);
			$this->Cell(30,10,'SUBTOTAL',1,0,'',true);
			$this->Cell(30,10,'TOTAL',1,1,'',true);
		}
		function Footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
		}
	}

	$pdf = new PDF('P','mm','A4');

	$pdf->AliasNbPages('{pages}');

	$pdf->SetAutoPageBreak(true,15);
	$pdf->AddPage();

	$pdf->SetFont('Arial','',10);
	$pdf->SetDrawColor(0,0,0);

	$sql_item="SELECT item_name,
                      order_item_quantity,
                      order_item_price,
                      order_item_tax_amount,
                      order_item_subtotal_amount,
                      order_item_final_amount
                      FROM invoice_order_item WHERE order_id = '".$_GET["order_id"]."'";

	$query_item = mysqli_query($connect, $sql_item);		

	while($data = mysqli_fetch_array($query_item)){

		$cellWidth = 55;
		$cellHeight = 5;

		if($pdf->GetStringWidth($data[0]) < $cellWidth){
			$line = 1;
		}else{

			$textLength = strlen($data[0]);
			$errMargin = 10;
			$startChar = 0;
			$maxChar = 0;
			$textArray = array();
			$tmpString = "";

			while($startChar < $textLength){
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString = substr($data[0],$startChar,$maxChar);
				}
				$startChar = $startChar+$maxChar;
				array_push($textArray,$tmpString);
				$maxChar = 0;
				$tmpString = '';
			}
			$line = count($textArray);
		}
		$xPos = $pdf->GetX();
		$yPos = $pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$data[0],1);

		$pdf->SetXY($xPos + $cellWidth , $yPos);
		
		$pdf->Cell(15,($line * $cellHeight),$data[1],1,0);
		$pdf->Cell(30,($line * $cellHeight),$data[2],1,0);
		$pdf->Cell(30,($line * $cellHeight),$data[3],1,0);
		$pdf->Cell(30,($line * $cellHeight),$data[4],1,0);
		$pdf->Cell(30,($line * $cellHeight),$data[5],1,1);
	}

	$connect = mysqli_connect('localhost','root','');
	mysqli_select_db($connect,'egm_simple_invoice');

	$sql_order="SELECT order_total_before_tax,
			  order_total_tax,
			  order_total_after_tax,
			  order_note
			  FROM tbl_orders WHERE order_id = '".$_GET["order_id"]."'";

	$query_invoice = mysqli_query($connect, $sql_order);
	$row = mysqli_fetch_array($query_invoice);

	$pdf->SetFont('Arial','B',11);
	$pdf->SetTextColor(7, 56, 99);

	$pdf->Cell(130,5,'',1,0);
	$pdf->Cell(30,5,'Sub Total',1,0);
	$pdf->Cell(30,5,number_format($row['order_total_before_tax'],2),1,1);

	$pdf->Cell(130,5,'',1,0);
	$pdf->Cell(30,5,'Tax Total',1,0);
	$pdf->Cell(30,5,number_format($row['order_total_tax'],2),1,1);

	$pdf->Cell(130,5,'',1,0);
	$pdf->Cell(30,5,'Grand Total',1,0);
	$pdf->Cell(30,5,number_format($row['order_total_after_tax'],2),1,1);

	$pdf->Ln(10);

	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(190	,5,'Note:',0,1);
	$pdf->SetFont('Arial','',12);

	$cellWidth = 190;
	$cellHeight = 5;

	$pdf->MultiCell($cellWidth,$cellHeight,$row['order_note'],0);

	if(isset($_GET["output"])){
		$pdf->Output('D','Invoice.pdf');
	}else{
		$pdf->Output('I','Invoice.pdf');
	}
?>