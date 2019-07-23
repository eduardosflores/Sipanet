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




//Define Cabeçalho

$pdf->Image('img/logo_cmg.jpg',93,10,30,20);

$pdf->SetXY(75,33);
$pdf->SetFont('arial','b',10);       // Define a fonte
$pdf->MultiCell(90,5,"CÂMARA MUNICIPAL DE GUARULHOS",0,'l',false,1);

$pdf->SetXY(78,42);
$pdf->SetFont('arial','b',10);       // Define a fonte
$pdf->MultiCell(90,5,"COMPROVANTE DE PROTOCOLO",0,'l',false,1);

$pdf->SetXY(85,49);
$pdf->SetFont('arial','',8);       // Define a fonte
$pdf->MultiCell(90,5,"COMPROVANTE DE PROTOCOLO",0,'l',false,1);


//Define Coluna de Títulos

$pdf->SetFont('arial','b',10);       // Define a fonte

$pdf->SetXY(10,80);
$pdf->MultiCell(75,5,"Número do Processo:",0,'R',false,1);

$pdf->SetXY(10,95);
$pdf->MultiCell(75,5,"Data de Entrada:",0,'R',false,1);

$pdf->SetXY(10,110);
$pdf->MultiCell(75,5,"Unidade de Origem:",0,'R',false,1);

$pdf->SetXY(10,125);
$pdf->MultiCell(75,5,"Tipo de Processo:",0,'R',false,1);

$pdf->SetXY(10,140);
$pdf->MultiCell(75,5,"Autor:",0,'R',false,1);

$pdf->SetXY(10,155);
$pdf->MultiCell(75,5,"CPF/CNPJ:",0,'R',false,1);

$pdf->SetXY(10,170);
$pdf->MultiCell(75,5,"Descrição:",0,'R',false,1);

//Define Coluna de Valores
$pdf->SetFont('arial','',10);       // Define a fonte

$pdf->SetXY(90,80);
$pdf->MultiCell(75,5, $processo['Processo']['numero_processo'].'/'.$processo['Processo']['numero_ano'],0,'L',false,1);

$pdf->SetXY(90,95);
$pdf->MultiCell(75,5, $protocolo->showDateBr($processo['Processo']['data_cadastro'],true),0,'L',false,1);

$pdf->SetXY(90,110);
$pdf->MultiCell(75,5, $setor['Setor']['sigla'].'-'.$setor['Setor']['descricao'],0,'L',false,1);

$pdf->SetXY(90,125);
$pdf->MultiCell(75,5, $processo['Natureza']['descricao'] ,0,'L',false,1);

$pdf->SetXY(90,140);
$pdf->MultiCell(75,5, $processo['Interessado']['nome'] ,0,'L',false,1);

$pdf->SetXY(90,155);
$pdf->MultiCell(75,5, $processo['Processo']['titulo_assunto'] ,0,'L',false,1);

$pdf->SetXY(90,170);
$pdf->MultiCell(75,5, $processo['Processo']['titulo_assunto'] ,0,'L',false,1);

$pdf->Output();
?>
