<div class="div_principal">
<form action="<?php echo $html->url('/situacoes/alterar/'.$this->data['Situacao']['id'])?>" method="post" name="editform">
	    <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formul�rio para alterar uma Situacao:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        Nome:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Situacao.descricao', array('label'=>false,'class'=>'textField textFieldWidth120'))?>

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
                        <input type="submit" id="btnSalvar" name="btnSalvar" value="Salvar informa��es" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'situacoes' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
        <?php echo $form->hidden('Situacao.id'); ?>
	</form>
</div>
<br />

