<img src="/sipanet/img/logo_cmg.png" width="104" style="text-align: center;">
<font face="times">The </font><b><font color="#7070D0">FPDF</font></b><font face="times"> logo:</font>
<br><br>


<?php
App::import('Vendor', 'fpdf', array('file'=>'pdf_html.php'));

$pdf=new PDF_HTML();
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
$pdf->WriteHTML('<font face="times">The </font><b><font color="#7070D0">FPDF</font></b><font face="times"> logo:</font>
<br><br>
<img src="img/logo_cmg.jpg" width="104">');
$pdf->Output();
exit;


?>
