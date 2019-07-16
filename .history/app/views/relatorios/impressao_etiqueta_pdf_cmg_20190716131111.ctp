<?php
App::import('Vendor', 'fpdf', array('file'=>'fpdf'.DS.'fpdf.php'));
App::import('Vendor', 'fpdf', array('file'=>'multicellmax'.DS.'multicellmax.pdf'));

// Definiï¿½ï¿½es de tamanho das etiquetas
$margem_esquerda_papel = (int)$etiqueta['Etiqueta']['margem_esquerda'];
$margem_superior_papel = (int)$etiqueta['Etiqueta']['margem_superior'];
$largura_etiqueta = (int)$etiqueta['Etiqueta']['largura'];
$altura_etiqueta = (int)$etiqueta['Etiqueta']['altura'];
$margem_entre_etiquetas = (int)$etiqueta['Etiqueta']['margem_entre_etiquetas'];
$altura_linha_escrita = (int)$etiqueta['Etiqueta']['altura_texto'];

$margem_de_seguranca_lateral = (int)$etiqueta['Etiqueta']['margem_seguranca_lateral'];
$margem_de_seguranca_superior = (int)$etiqueta['Etiqueta']['margem_seguranca_lateral'];



// Instancia o FPDF
$pdf=new FPDF('P','mm','Letter');           // Cria um arquivo novo tipo carta, na vertical.
$pdf->Open();                           // inicia documento
$pdf->AddPage();                        // adiciona a primeira pagina
$pdf->SetMargins(0,0);           // Define as margens do documento
$pdf->SetAuthor("DTIT - CMG");     // Define o autor
$pdf->SetFont('helvetica','',9);       // Define a fonte

$linha = intdiv($etiqueta_impressa-1,3);
$coluna = ($etiqueta_impressa-1)%3;



$pdf->SetXY(5+68*$coluna,13+70*$linha); 
$pdf->MultiCell(69,1,"Processo nº" . $processo['Processo']['numero_processo'] . '/' . $processo['Processo']['numero_ano'],0,'J',false);
$pdf->SetXY(5+68*$coluna,17+70*$linha); 
$pdf->MultiCell(69,5,"Interessado: " . $processo['Interessado']['nome'],0,'J',false);
$pdf->SetXY(5+68*$coluna,21+70*$linha); 
$pdf->MultiCell(69,5,"Assunto: " . $processo['Processo']['assunto'],0,'J',false);


$pdf->Output();
?>