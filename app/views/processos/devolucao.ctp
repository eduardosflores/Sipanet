<div class="div_principal">
	<form action="<?php echo $html->url("/processos/devolver/")?>" method="post" name="addform">

		<input type="hidden" name="data[Processo][id]" id="ProcessoId" value="<?php echo $processo['Processo']['id']; ?>" />
        <input type="hidden" name="data[Divisao][id]" id="DivisaoId" value="<?php echo $divisao['Divisao']['id']; ?>" />

        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>

            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            	<tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Confirme a devolução do Processo:</b>
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
                    <td class="tdTituloExibirDetalhes">
                        <b>Servidor:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $session->read('Servidor.nome') ?>
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        <b>Tipo Devolução:</b>
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[HistoricoDevolucao][tipo_devolucao]" class="comboBox textFieldWidth120">
                            <option selected="selected" value="">Selecione</option>
                            <option value="Despacho">Despacho</option>
                            <option value="Paracer">Parecer</option>
                            <option value="Diligência">Diligência</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        <b>Num. Doc.:</b>
                    </td>
                    <td class="tbFieldFrm">
                        <input type="text" name="data[HistoricoDevolucao][num_doc]" size="10" maxlength="10" class="textArea textFieldWidth120"/>
                    </td>
                </tr>

                <tr>
                    <td class="tbTituloFrm">
                        <b>Ano Doc.:</b>
                    </td>
                    <td class="tbFieldFrm">
                        <input type="text" name="data[HistoricoDevolucao][ano_doc]" size="4" maxlength="4" class="textArea textFieldWidth40"/>
                    </td>
                </tr>
          
		<tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <input type="submit" id="btnConfirmar" name="btnConfirmar" value="Confirmar" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'processos/devolucao/' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />