<div class="div_principal">
<form action="<?php echo $html->url('/tipos_interessado/cadastrar')?>" method="post" name="editform">
	    <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formul�rio para cadastrar um Tipo de Interessado:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        Descri��o:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('TipoInteressado.descricao', array('label'=>false,'class'=>'textField textFieldWidth240'))?>

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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'tipos_interessado' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>

	</form>
</div>
<br />
