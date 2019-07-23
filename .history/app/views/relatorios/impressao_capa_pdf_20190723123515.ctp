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


$pdf->Image('img/logo_cmg.jpg',83,10,30,20);
$pdf->SetXY(72,30);
$pdf->MultiCell(64,5,"CÂMARA MUNICIPAL DE GUARULHOS",0,'J',false,1);
$pdf->SetXY(5+70*$coluna,21+76*$linha); 
$pdf->MultiCell(64,5,"Data: " . date("d/m/Y H:i", strtotime($processo['Processo']['data_cadastro'])),0,'L',false,1);
$pdf->SetXY(5+70*$coluna,27+76*$linha);
$pdf->MultiCell(64,5,"Processo nº" . $processo['Processo']['numero_processo'] . '/' . $processo['Processo']['numero_ano'],0,'L',false,1);
$pdf->SetFont('helvetica','',6);       // Define a fonte
$pdf->SetXY(5+70*$coluna,33+76*$linha); 
$pdf->MultiCell(64,3,"Autor: " . $processo['Interessado']['nome'],0,'L',false,2);
$pdf->SetXY(5+70*$coluna,41+76*$linha); 
$pdf->MultiCell(64,3,"Assunto: " . $processo['Processo']['assunto'],0,'L',false,12);


$pdf->Output();
?>
