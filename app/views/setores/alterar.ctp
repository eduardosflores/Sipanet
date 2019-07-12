<div class="div_principal">
    <form action="<?php echo $html->url('/setores/alterar/'.$this->data['Setor']['id'])?>" method="post" name="editform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para alterar um Setor:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
				<!-- Orgao -->
				<tr>
                    <td class="tbTituloFrm">
                        Órgão:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $this->data['Orgao']['descricao']; ?>
                   </td>
                </tr>
				<!-- Descricao -->				
				<tr>
                    <td class="tbTituloFrm">
                        Descrição:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Setor.descricao', array('label'=>false,'class'=>'textField textFieldWidth240'))?>
                   </td>
                </tr>
				<!-- Sigla -->
				<tr>
                    <td class="tbTituloFrm">
                        Sigla:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Setor.sigla', array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                   </td>
                </tr>
				<!-- Ativo -->
				<tr>
                    <td class="tbTituloFrm">
                        Ativo:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Setor.ativo',array('label'=>false,'class'=>'textField textFieldWidth120'))?>
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
                        <input type="submit" id="btnSalvar" name="btnSalvar" value="Salvar informações" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'setores' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
		<?php echo $form->hidden('Setor.id'); ?>
    </form>
</div>
<br />