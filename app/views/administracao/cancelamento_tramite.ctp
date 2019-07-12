<div class="div_principal">
	<form action="<?php echo $html->url('/administracao/cancelar_tramite/' . $processo['Processo']['id'])?>" method="post" name="addform">

		<input type="hidden" name="data[Processo][id]" id="ProcessoId" value="<?php echo $processo['Processo']['id']; ?>" />
        <input type="hidden" name="data[Tramite][id]" id="TramiteId" value="<?php echo $tramite['Tramite']['id']; ?>" />

        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>

            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            	<tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Confirme Trâmite do Processo:</b>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Processo:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['numero_orgao'] ?>-<?php echo $processo['Processo']['numero_processo'] ?>/<?php echo $processo['Processo']['numero_ano'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Interessado:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Interessado']['nome'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Natureza:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Natureza']['descricao'] ?>
                    </td>
                </tr>
                <tr>
                    <td  colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Detalhes do trâmite:</b>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Encaminhado por:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $tramite['ServidorOrigem']['nome'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Para o Órgão/Setor:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $tramite['SetorRecebimento']['Orgao']['sigla'] . '/' . $tramite['SetorRecebimento']['sigla'] ?>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'processos/cancelamento_tramite/' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />