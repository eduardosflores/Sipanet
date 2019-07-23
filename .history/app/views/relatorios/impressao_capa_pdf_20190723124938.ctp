<?php
App::import('Vendor', 'pdf', array('file'=>'multicellmax.php'));


// Instancia o FPDF
$pdf=new PDF('P','mm','A4');           // Cria um arquivo novo tipo carta, na vertical.
$pdf->Open();                           // inicia documento
$pdf->AddPage();                        // adiciona a primeira pagina
$pdf->SetMargins(0,0);           // Define as margens do documento
$pdf->SetAuthor("DTIT - CMG");     // Define o autor
$pdf->SetFont('helvetica','',8);       // Define a fonte

$linha = intdiv($etiqueta_impressa-1,3);
$coluna = ($etiqueta_impressa-1)%3;




//Define Cabe�alho

$pdf->Image('img/logo_cmg.jpg',83,10,30,20);

$pdf->SetXY(65,33);
$pdf->SetFont('arial','b',10);       // Define a fonte
$pdf->MultiCell(90,5,"C�MARA MUNICIPAL DE GUARULHOS",0,'l',false,1);

$pdf->SetXY(68,42);
$pdf->SetFont('arial','b',10);       // Define a fonte
$pdf->MultiCell(90,5,"COMPROVANTE DE PROTOCOLO",0,'l',false,1);

$pdf->SetXY(75,49);
$pdf->SetFont('arial','',8);       // Define a fonte
$pdf->MultiCell(90,5,"COMPROVANTE DE PROTOCOLO",0,'l',false,1);


//Define Coluna de T�tulos

$pdf->SetXY(10,80);
$pdf->SetFont('arial','b',10);       // Define a fonte
$pdf->MultiCell(70,5,"N�mero do Processo:",0,'R',false,1);

$pdf->SetXY(10,80);
$pdf->SetFont('arial','b',10);       // Define a fonte
$pdf->MultiCell(70,5,"N�mero do Processo:",0,'R',false,1);



$pdf->Output();
?>
