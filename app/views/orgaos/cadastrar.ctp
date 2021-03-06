<div class="div_principal">
    <form action="<?php echo $html->url('/orgaos/cadastrar')?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para cadastrar um novo Orgao:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <!-- Codigo -->
				<tr>
                    <td class="tbTituloFrm">
                        Codigo:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Orgao.codigo', array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                   </td>
                </tr>
				<!-- Descricao -->
				<tr>
                    <td class="tbTituloFrm">
                        Descrição:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Orgao.descricao', array('label'=>false,'class'=>'textField textFieldWidth240'))?>
                   </td>
                </tr>
				<!-- Sigla -->
				<tr>
                    <td class="tbTituloFrm">
                        Sigla:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Orgao.sigla', array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                   </td>
                </tr>
				<!-- Ativo -->
				<tr>
                    <td class="tbTituloFrm">
                        Ativo:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Orgao.ativo', array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                   </td>
                </tr>
                <!-- Externo -->
                <tr>
                    <td class="tbTituloFrm">
                        Tipo:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Orgao][externo]" id="OrgaoExterno" class="comboBox textFieldWidth120">
                            <option value="0" selected="selected">Interno</option>
                            <option value="1">Externo</option>
                        </select>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'orgaos' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />