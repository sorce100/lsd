<?php 
require_once("../plugins/bower_components/fpdf/fpdf.php");
// pdf generator for recipt
			$pdf = new FPDF('P','mm','A4');
			$pdf->AddPage();
			// adding logo(width,margin-top,width,length)

			// $pdf->Image("images/logo.jpg",70,5,60,60);
			$pdf->Ln(55);

			$pdf->SetFont('Times','BU',15);
			$pdf->Cell(190,10,"GhIS LSD ANNUAL CONFERENCE 2018",0,1,'C');
			$pdf->Ln(2);

			$pdf->SetFont('Times','BU',13);
			$pdf->Cell(190,10,"REGISTRATION DETAILS",0,1,'C');

			$pdf->Ln(5);
			$pdf->SetFont('Times','',12);
			// for reference number
			$pdf->Cell(50,10,"REFERENCE NUMBER",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,10,"test",1,0);
			// for member type
			$pdf->SetFont('Times','',12);
			$pdf->Cell(10,10,"",0,0);
			$pdf->Cell(30,10,"STATUS",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(60,10,"test",1,1);

			$pdf->Ln(5);
			// for name
			$pdf->SetFont('Times','',12);
			$pdf->Cell(50,10,"NAME",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(140,10,"test"." "."test"." "."test",1,1);
			$pdf->Ln(5);
			// show this form for the accompanying attached
			// if ($applicant_type == "APPLICANT_ACCOMPANYING") {
			// 	$pdf->SetFont('Times','',12);
			// 	$pdf->Cell(50,10,"MEMBER ATTACHED",0,0);
			// 	$pdf->SetFont('Times','B',12);
			// 	$pdf->Cell(140,10,"test",1,1);
			// 	$pdf->Ln(5);
			// }

			// for transport type and region
			$pdf->SetFont('Times','',12);
			$pdf->Cell(50,10,"TRANSPORT",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(50,10,"test",1,0);
			// for region
			$pdf->Cell(10,10,"",0,0);
			$pdf->SetFont('Times','',12);
			$pdf->Cell(40,10,"REGION",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,10,"test",1,1);
			$pdf->Ln(5);
			// for accomodation
			$pdf->SetFont('Times','',12);
			$pdf->Cell(50,10,"ACCOMODATION",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(50,10,"test",1,0);
			// FOR ROOMS
			$pdf->Cell(10,10,"",0,0);
			$pdf->SetFont('Times','',12);
			$pdf->Cell(40,10," ROOM TYPE",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(40,10,"test",1,0);
			$pdf->Ln(10);
			$pdf->SetFont('Courier','B',20);
			$pdf->Cell(190,40,"PLEASE COMPLETE REGISTRATION BY MAKING PAYMENT",0,1,'C');
			// for alerting payment
			$pdf->SetFont('Times','',12);
			// for total amount number
			$pdf->Cell(55,10,"AMOUNT TO PAY (GHC)",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(55,10,"test"." .00",1,1,'C');
			$pdf->Ln(2);
			// for mobie money number
			$pdf->SetFont('Times','',12);
			$pdf->Cell(55,10,"MOBILE MONEY NUMBER",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(55,10,"0557940194",1,1,'C');
			$pdf->Ln(2);
			// RER
			$pdf->SetFont('Times','',12);
			$pdf->Cell(55,10,"REF NUMBER TO USE",0,0);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(55,10,"test",1,1,'C');
			// for notification
			$pdf->SetFont('Courier','I',15);
			$pdf->Cell(190,20,"Confirmation message will be sent your email after payment ",0,1,'C');

			// thank you message

			$pdf->SetFont('Courier','B',18);
			$pdf->Cell(190,25,"THANK YOU FOR REGISTERING, HOPE TO SEE YOU THERE",0,1,'C');
			$pdf->Output();


 ?>