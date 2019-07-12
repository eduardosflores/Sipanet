<div class="div_principal">
<form action="<?php echo $html->url('/grupos_usuario/alterar/'.$this->data['GrupoUsuario']['id'])?>" method="post" name="editform">
	    <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para alterar um Grupo de Usuario:</label>
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
                        <?php echo $form->input('GrupoUsuario.descricao', array('label'=>false,'class'=>'textField textFieldWidth240'))?>

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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'grupos_usuario' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
        <?php echo $form->hidden('GrupoUsuario.id'); ?>
	</form>
</div>
<br />

