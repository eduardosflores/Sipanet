<tr>
    <td class="tdTituloGrid nosort" style="border-left: 1px solid #fff;">
        Órgão de Origem
    </td>
    <td class="tdTituloGrid nosort">
        Setor de Origem
    </td>
    <td class="tdTituloGrid nosort">
        Tramitado por
    </td>
    <td class="tdTituloGrid nosort">
        Data Trâmite
    </td>
    
    <td class="tdTituloGridTramitacaoDestino nosort" style="border-left: 1px solid #fff;">
        Órgão de Destino
    </td>
    <td class="tdTituloGridTramitacaoDestino nosort">
        Setor de Destino
    </td>
    <td class="tdTituloGridTramitacaoDestino nosort">
        Recebido por
    </td>
    <td class="tdTituloGridTramitacaoDestino nosort">
        Recebido
    </td>
    <td class="tdTituloGridTramitacaoDestino nosort">
        Data Recebimento
    </td>
    <td class="tdTituloGridTramitacaoDestino nosort">
        Ver despacho
    </td>
</tr>
<?php
foreach($tramites as $tramite)
{
?>
    <tr class="trDisplay">
        <td class="tdConteudoGrid" title="<?php echo $tramite['SetorOrigem']['Orgao']['descricao'] ?>">
            <?php echo $tramite['SetorOrigem']['Orgao']['sigla'] ?>
        </td>
        <td class="tdConteudoGrid" title="<?php echo $tramite['SetorOrigem']['descricao'] ?>">
            <?php echo $tramite['SetorOrigem']['sigla'] ?>
        </td>
        <td class="tdConteudoGrid">
            <?php echo $tramite['ServidorOrigem']['nome'] ?>
        </td>
        <td class="tdConteudoGrid">
            <?php echo $protocolo->showDateBr($tramite['Tramite']['data_tramite'],true) ?>
        </td>
        
        <td class="tdConteudoGrid" title="<?php echo $tramite['SetorRecebimento']['Orgao']['descricao'] ?>">
            <?php echo $tramite['SetorRecebimento']['Orgao']['sigla'] ?>
        </td>
        <td class="tdConteudoGrid" title="<?php echo $tramite['SetorRecebimento']['descricao'] ?>">
            <?php echo $tramite['SetorRecebimento']['sigla'] ?>
        </td>
        <td class="tdConteudoGrid">
            <?php echo $tramite['ServidorRecebimento']['nome'] ?>
        </td>
        <td class="tdConteudoGrid">
            <?php echo $protocolo->showBooleanField($tramite['Tramite']['flag_recebimento']) ?>
        </td>
        <td class="tdConteudoGrid">
            <?php echo $protocolo->showDateBr($tramite['Tramite']['data_recebimento'],true) ?>
        </td>
        <td class="tdConteudoGrid">

            <a href="#" onclick="window.open('<?php echo $html->url('consultar_tramite/'.$tramite['Tramite']['id'])?>', 'buscarInteressados', 'status=0,scrollbars=1,width=650, height=400')">Exibir Despacho</a>

            

            <!-- <a href="#" class="linkComAjuda"><?php// echo $html->image('expandir.gif', array('alt'=>'Ver Observações', 'title'=>'Ver Observações',  'border' => 'none')); ?>&nbsp;
                <span><strong>Observações</strong><br /><?php// echo $tramite['Tramite']['observacoes'] ?></span>
            </a> -->
     
        </td>
    </tr>
    
<?php
}
?>