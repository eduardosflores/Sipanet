<?php
App::import('Vendor', 'pChart', array('file'=>'pchart'.DS.'carregar_libs.php'));

$path = $this->_paths();
$path = $path[0];
$path = explode(DS, $path);
array_pop($path);
array_pop($path); 

$path = implode(DS, $path);
$path .= DS . "vendors" . DS . "pchart" . DS;

// Cria os dados do grбfico 
$DataSet = new pData;

foreach($situacoes as $situacao)
{
    $DataSet->AddPoint(array($quantidades[$situacao['Situacao']['id']]), $situacao['Situacao']['id']);
}

// Marca todas as sйries como graphable
$DataSet->AddAllSeries();  
// Informa qual das sйries й a abscisa
$DataSet->SetAbsciseLabelSerie();

// Legenda
foreach($situacoes as $situacao)
{
    $DataSet->SetSerieName("{$situacao['Situacao']['descricao']} - {$quantidades[$situacao['Situacao']['id']]}",$situacao['Situacao']['id']);
}


//die();
// Largura x Altura
$grafico = new pChart(700,500);
$grafico->setFontProperties($path . "Fonts/tahoma.ttf",8);
// Pontos onde o grбfico serб desenhado
$grafico->setGraphArea(50,100,680,450);
// Retвngulo de fundo
// X1, Y1, X2, Y2 (pontos), raio, R, G, B (cor)
$grafico->drawFilledRoundedRectangle(7,7,693,493,10,240,240,240);
// Borda do retвngulo de fundo
$grafico->drawRoundedRectangle(5,5,695,495,10,230,230,230);
// Cor da бrea do grбfico.
// Ъltimo parвmetro desenha linhas a 24 graus
$grafico->drawGraphArea(255,255,255,TRUE);

// Desenha a grade dos valores
$grafico->drawGrid(4,TRUE,230,230,230,50);

if(array_sum($quantidades) != 0)
{
    // void drawScale(&$Data,&$DataDescription,$ScaleMode,$R,$G,$B,$DrawTicks=TRUE,$Angle=0,$Decimals=1,$WithMargin=FALSE,$SkipLabels=1)
    // Desenha tanto o eixo quanto os dados
    // $DrawTicks desenha os valores nos eixos
    $grafico->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,0,TRUE, 1);
}

// Draw the 0 line
$grafico->setFontProperties($path . "Fonts/tahoma.ttf",6);
$grafico->drawTreshold(0,143,55,72,TRUE,TRUE);

// Draw the bar graph
$grafico->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);

// Desenha a legenda
$grafico->setFontProperties($path . "Fonts/tahoma.ttf",8);
$grafico->drawLegend(10,30,$DataSet->GetDataDescription(),255,255,255);

// Desenha o tнtulo  
$grafico->setFontProperties($path . "Fonts/tahoma.ttf",10);
$grafico->drawTitle(50,22,"Grбfico - Processos por Confirmaзгo",50,50,50,585);

// Exibe  
$grafico->Stroke();
?>