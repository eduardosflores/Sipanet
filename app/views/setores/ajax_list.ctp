<?php
header('Content-Type: text/html; charset=iso-8859-1');
if(strlen($orgao) == 0)
{
	echo "<option value=\"\">Selecione o Órgão<option>";
}
else
{
    echo "<option value=\"\">Selecione</option>";
    echo "<option value=\"*\">Todos</option>";
    
	if(isset($setores)) foreach($setores as $setor)
    {
    	echo "<option value=\"{$setor['Setor']['id']}\">{$setor['Setor']['sigla']}</option>";
    }
}
?>