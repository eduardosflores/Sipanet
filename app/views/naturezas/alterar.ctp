<div class="div_principal">
<form action="<?php echo $html->url('/naturezas/alterar/'.$this->data['Natureza']['id'])?>" method="post" name="editform">
	    <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para alterar uma Natureza:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        Descrição:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Natureza.descricao', array('label'=>false,'class'=>'textField textFieldWidth240'))?>

                    </td>
                </tr>
                
                <!-- Ativo -->
                <tr>
                    <td class="tbTituloFrm">
                        Ativo:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Natureza.ativo',array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                   </td>
                </tr>
                
				<tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <input type="submit" id="btnSalvar" name="btnSalvar" value="Salvar informações" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'naturezas' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
        <?php echo $form->hidden('Natureza.id'); ?>
	</form>
</div>
<br />

