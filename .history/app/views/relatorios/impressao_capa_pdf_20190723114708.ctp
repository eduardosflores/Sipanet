<?php
App::import('Vendor', 'PDF_HTML', array('file'=>'pdf_html.php'));

$pdf=new PDF_HTML();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->WriteHTML('<font face="times">The </font><b><font color="#7070D0">FPDF</font></b><font face="times"> logo:</font>
<br><br>
<img src="logo.png" width="104">');
$pdf->Output();
exit;


?>
