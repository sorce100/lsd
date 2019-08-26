<?php 
	include("Classes/ReadDocx.php");
	$docObj = new DocxConversion("aaa.docx");
	//$docObj = new DocxConversion("test.docx");
	//$docObj = new DocxConversion("test.xlsx");
	//$docObj = new DocxConversion("test.pptx");
	echo $docText= $docObj->convertToText();
?>
