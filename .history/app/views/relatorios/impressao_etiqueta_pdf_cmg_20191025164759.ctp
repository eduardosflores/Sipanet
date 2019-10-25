<?php
App::import('Vendor', 'pdf', array('file'=>'multicellmax.php'));

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
$pdf=new PDF('P','mm','Letter');           // Cria um arquivo novo tipo carta, na vertical.
$pdf->Open();                           // inicia documento
$pdf->AddPage();                        // adiciona a primeira pagina
$pdf->SetMargins(0,0);           // Define as margens do documento
$pdf->SetAuthor("DTIT - CMG");     // Define o autor
$pdf->SetFont('helvetica','',8);       // Define a fonte


foreach ($processos as $processo){

    if($etiqueta_impressa-1 == 9){
        $etiqueta_impressa = 1;
        $pdf->AddPage();
    }

    $linha = intdiv($etiqueta_impressa-1,3);
    $coluna = ($etiqueta_impressa-1)%3;

    $pdf->SetXY(6+70*$coluna,15+76*$linha);
    $pdf->MultiCell(64,5,"CÂMARA MUNICIPAL DE GUARULHOS",0,'J',false,1);
    $pdf->SetXY(6+70*$coluna,21+76*$linha); 
    $pdf->MultiCell(64,5,"Data: " . date("d/m/Y H:i", strtotime($processo['Processo']['data_cadastro'])),0,'L',false,1);
    $pdf->SetXY(6+70*$coluna,27+76*$linha);
    $pdf->MultiCell(64,5,"Processo nº" . $processo['Processo']['numero_processo'] . '/' . $processo['Processo']['numero_ano'],0,'L',false,1);
    $pdf->SetFont('helvetica','',6);       // Define a fonte
    $pdf->SetXY(6+70*$coluna,33+76*$linha); 
    $pdf->MultiCell(64,3,"Autor: " . $processo['Interessado']['nome'],0,'L',false,2);
    $pdf->SetXY(6+70*$coluna,41+76*$linha); 
    $pdf->MultiCell(64,3,"Assunto: " . $processo['Processo']['assunto'],0,'L',false,12);
    $etiqueta_impressa = $etiqueta_impressa + 1;
}


$pdf->Output();
?>
