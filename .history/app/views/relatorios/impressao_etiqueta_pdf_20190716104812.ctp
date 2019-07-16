<?php
App::import('Vendor', 'fpdf', array('file'=>'fpdf'.DS.'fpdf.php'));

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
$pdf->SetAuthor("CETIS - UNCISAL");     // Define o autor
$pdf->SetFont('helvetica','',9);       // Define a fonte

// Recebe dados vindos do processo.
$dados = array();
$dados[0] = "Processo Nº: " . $processo['Processo']['numero_orgao'] . '-' . $processo['Processo']['numero_processo'] . '/' . $processo['Processo']['numero_ano']. ' '. $protocolo->showDateBr($processo['Processo']['data_cadastro']);
$dados[1] = substr("Interessado: " . $processo['Interessado']['nome'], 0, 50);
//$dados[2] = "Data de cadastro: " . $protocolo->showDateBr($processo['Processo']['data_cadastro']);
$dados[2] = substr("Natureza: " . $processo['Natureza']['descricao'], 0, 37);
$dados[3] = substr("Assunto: " . $processo['Processo']['assunto'], 0, 37);


/**
 * 
 * Margem superior = altura da etiqueta * (linha da etiqueta - 1)
 * Margem esquerda = {
    Se for a etiqueta esqurda {
        margem superior da etiqueta
    }
    Se for a etiqueta direita {
        margem superior da etiqueta + largura da etiqueta + espaï¿½o horizontal entre etiquetas
    }
 }
 *
 * Todas as magens recebem 10mm a mais para seguranï¿½a e distanciar da borda
 * 
 * Cada uma das linhas escritas recebe 6mm
 * **/

// Cria a etiqueta esquerda
$margem_esquerda_etiqueta = $margem_esquerda_papel + $margem_de_seguranca_lateral;
$margem_superior_etiqueta = $margem_superior_papel + (($linha_impressa - 1) * $altura_etiqueta) + $margem_de_seguranca_superior;

// Escreve os dados
foreach($dados as $chave => $valor)
{
	$pdf->Text($margem_esquerda_etiqueta,$margem_superior_etiqueta + ($altura_linha_escrita * $chave), $valor);
}

// Cria a etiqueta direita
$margem_esquerda_etiqueta = $margem_esquerda_papel + $largura_etiqueta + $margem_entre_etiquetas + $margem_de_seguranca_lateral;

// Escreve os dados
foreach($dados as $chave => $valor)
{
    $pdf->Text($margem_esquerda_etiqueta,$margem_superior_etiqueta + ($altura_linha_escrita * $chave), $valor);
}

$pdf->Output();
?>