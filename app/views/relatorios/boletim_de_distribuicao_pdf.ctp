<?php
App::import('Vendor', 'fpdf', array('file'=>'fpdf'.DS.'fpdf.php'));

class Boletim extends FPDF
{
    public $servidor_nome = null;

    public $data_inicial = null;
    public $data_final = null;

    public $data_geracao = null;

    public $total_de_processos = null;

    function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 5, 'Boletim de Distribuição', 0, 1, 'C');
        $this->Ln();

        $this->titulo('Servidor: ');
        $this->texto($this->servidor_nome);

        $this->Line(10, $this->GetY(), 200, $this->GetY());

        $this->titulo('Data do BI: ');
        $this->texto($this->data_geracao);

        $this->titulo('Período: ');
        $this->texto($this->data_inicial . ' até ' . $this->data_final);

        $this->titulo('Total de processos: ');
        $this->texto($this->total_de_processos);

        $this->Line(10, $this->GetY(), 200, $this->GetY());
    }

    public function serrilhado($y=null)
    {
        if($y == null)
        {
            $y = $this->GetY();
        }

        $this->SetLineWidth(0.1);

        $i = 10;
        while($i < 200)
        {
            $this->Line($i, $y, $i + 2, $y);
            $i += 4;
        }
    }

    public function titulo($texto)
    {
        $this->SetFont('Arial','B',10);
        $this->Cell(35, 5, $texto, 0, 0);
    }

    public function texto($texto)
    {
        $this->SetFont('Arial',null,10);
        $this->Cell(0, 5, $texto, 0, 1);
    }

    public function assinaturas()
    {
        $this->SetY($this->GetY() + 15);

        $this->SetLineWidth(0.2);

        // Linha de envio
        $this->Line(10, $this->GetY(), 95, $this->GetY());

        // Linha de recebimento
        $this->Line(115, $this->GetY(), 200, $this->GetY());

        $this->SetFont('Arial',null,10);

        // Assinatura envio
        $this->SetX(35);
        $this->Cell(0, 5, 'Assinatura de Envio', 0, 0);

        // Assinatura de recebimento
        $this->SetX(135);
        $this->Cell(0, 5, 'Assinatura de Recebimento', 0, 0);
    }
}

// Instancia o FPDF
$pdf=new Boletim('P','mm','A4');
$pdf->SetAuthor("CETIS - UNCISAL");

$pdf->servidor_nome = $servidor['Servidor']['nome'];
$pdf->data_inicial = $protocolo->showDateBr($data_inicial);
$pdf->data_final = $protocolo->showDateBr($data_final);
$pdf->data_geracao = date('d/m/Y') . ' às ' . date('H:i:s');
$pdf->total_de_processos = count($divisoes);

$pdf->Open();

$processos_na_pagina = 0;
$total = count($tramites);
$processos_percorridos = 0;
$pdf->AddPage();

foreach($divisoes as $divisao)
{
    $processos_na_pagina++;
    $processos_percorridos++;

    $pdf->titulo('Processo: ');
    $pdf->texto($divisao['Processo']['numero_orgao'] . '-' . $divisao['Processo']['numero_processo'] . '/' . $divisao['Processo']['numero_ano']);

    $pdf->titulo('Assunto: ');
    $pdf->texto($divisao['Processo']['titulo_assunto']);

    $pdf->titulo('Interessado: ');
    $pdf->texto($divisao['Processo']['Interessado']['nome']);

    $pdf->titulo('Data da divisão: ');
    $pdf->texto($protocolo->showDateBr($divisao['HistoricoDivisao']['data_divisao']));

    $pdf->serrilhado();

    if($processos_na_pagina == 10)
    {
        if($processos_percorridos != $total)
        {
            $processos_na_pagina = 0;
            $pdf->AddPage();
        }
    }
    if($processos_percorridos == $total)
    {
        $pdf->assinaturas();
    }
}
$pdf->assinaturas();

$pdf->Output();
?>