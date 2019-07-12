<div class="div_principal">
    <form action="<?php echo $html->url('/processos/desanexar/' . $processoPrincipal['Processo']['id'] . '/' . $processoAnexo['Processo']['id'])?>" method="post" name="addform">
        <input type="hidden" name="data[ProcessoPrincipal][id]" id="ProcessoPrincipalId" value="<?php echo $processoPrincipal['Processo']['id']; ?>" />
        <input type="hidden" name="data[ProcessoAnexo][id]" id="ProcessoAnexoId" value="<?php echo $processoAnexo['Processo']['id']; ?>" />
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend">Desanexar Processos</label> |</b>
            </legend>
    
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            	<tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Dados do Processo Principal:</b>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Processo:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processoPrincipal['Processo']['numero_orgao'] ?>-<?php echo $processoPrincipal['Processo']['numero_processo'] ?>/<?php echo $processoPrincipal['Processo']['numero_ano'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Interessado:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processoPrincipal['Interessado']['nome'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Natureza:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processoPrincipal['Natureza']['descricao'] ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Dados do Processo Anexo:</b>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Processo:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processoAnexo['Processo']['numero_orgao'] ?>-<?php echo $processoAnexo['Processo']['numero_processo'] ?>/<?php echo $processoAnexo['Processo']['numero_ano'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Interessado:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processoAnexo['Interessado']['nome'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Natureza:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processoAnexo['Natureza']['descricao'] ?>
                    </td>
                </tr>
                
                <tr>
                    <td  colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <input type="submit" id="btnConfirmar" name="btnConfirmar" value="Confirmar" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'processos/anexacao/' ?>'" value="Cancelar" />
                    </td>
                </tr>
                
            </table>
        </fieldset>
    </form>
</div>
<br />