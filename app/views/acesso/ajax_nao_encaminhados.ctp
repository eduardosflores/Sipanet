<?php
if (count($tramites_nao_encaminhados) == 0) {
?>
    <table cellpadding="2" cellspacing="2" border="0" class="tbConteudoExibirDetalhes">
        <tr>
            <td class="lbInfoPagFrm" align="left">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td class="lbInfoPagFrm" align="left">
                <b>Nenhum processo está no seu setor. (informação válida apenas para processos recebidos em 2012)</b>
            </td>
        </tr>
    </table>
<?php
} else {
?>
    <table cellpadding="2" cellspacing="2" border="0" class="tbConteudoExibirDetalhes">
        <tr>
            <td class="lbInfoPagFrm" colspan="2" align="left">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td class="lbInfoPagFrm" colspan="2" align="left">
                <b>Processos parados no seu setor (informação válida apenas para processos recebidos em 2012).</b>
                <!--<b><?php echo $totalDeTramitesNaoEncaminhados; ?> processos foram recebidos e ainda não foram encaminhados:</b>-->
            </td>
        </tr>
    </table>

    <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable" style="font: 10px/1.4 sans-serif;">
        <tr>
            <td class="tdTituloGrid">
                Número
            </td>
            <td class="tdTituloGrid">
                Interessado
            </td>
            <td class="tdTituloGrid">
                Vindo do órgão/setor
            </td>

            <td class="tdTituloGrid">
                Recebido por
            </td>

            <td class="tdTituloGrid">
                Tipo do Processo
            </td>
            <td class="tdTituloGrid">
                Na data
            </td>
            <td class="tdTituloGrid">
                Limite (dias úteis)
            </td>
            <td class="tdTituloGrid">
                Dias úteis no setor
            </td>
        </tr>

    <?php
    foreach ($tramites_nao_encaminhados as $tramite_nao_encaminhado) {
    ?>
        <tr class="trDisplay">
            <td class="tdConteudoGrid">
            <?php echo $tramite_nao_encaminhado[0]['processo'] ?>
        </td>
        <td class="tdConteudoGrid">
            <?php echo $tramite_nao_encaminhado[0]['interessado'] ?>
        </td>

        <td class="tdConteudoGrid">
            <?php echo $tramite_nao_encaminhado[0]['sigla'] ?>
        </td>

        <td class="tdConteudoGrid">
            <?php echo $tramite_nao_encaminhado[0]['nome'] ?>
        </td>

        <td class="tdConteudoGrid">
            <?php echo $tramite_nao_encaminhado[0]['tipo_processo'] ?>
        </td>
        <td class="tdConteudoGrid">
            <?php echo $protocolo->showDateBr($tramite_nao_encaminhado[0]['data_recebimento'],true) ?>
        </td>
        <td class="tdConteudoGrid" style="text-align: center;">
            <?php echo $tramite_nao_encaminhado[0]['max_dias_na_mesa'] ?>
        </td>
        <td class="tdConteudoGrid" style="text-align: center;">
            <?php
            //01/02/2010
            $dt1tmp = $protocolo->showDateBr($tramite_nao_encaminhado[0]['data_recebimento']);
            $dt2tmp = date('d/m/Y');
            $data1 = mktime(0, 0, 0, substr($dt1tmp, 0, 2), substr($dt1tmp, 3, 2), substr($dt1tmp, 6, 4));
            $data2 = mktime(0, 0, 0, substr($dt2tmp, 0, 2), substr($dt2tmp, 3, 2), substr($dt2tmp, 6, 4));

            $DataInicial = $dt1tmp;
            $DataFinal = $dt2tmp;

            //CHAMADA DA FUNCAO
            $diasUteis = $protocolo->DiasUteis($DataInicial, $DataFinal);

            echo $diasUteis;
            

            ?>
        </td>
    </tr>
    <?php
        }
    ?>
    </table>
<?php
    }
?>
<br />
