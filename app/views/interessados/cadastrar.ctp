<div class="div_principal">
    <form action="<?php echo $html->url('/interessados/cadastrar')?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para cadastrar um novo Interessado:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>

				<!-- Nome -->
				<tr>
                    <td class="tbTituloFrm">
                        Interessado:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Interessado.nome', array('label'=>false,'class'=>'textField textFieldWidth240'))?>
                   </td>
                </tr>
                <!-- Tipo -->
				<tr>
                    <td class="tbTituloFrm">
                        Tipo:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Interessado][tipo_interessado_id]" id="InteressadoTipoInteressadoId" class="comboBox textFieldWidth240">
							<?php echo $protocolo->optionsTag($tipos, true, $this->data['Interessado']['tipo_interessado_id']); ?>
						</select>
                   </td>
                </tr>
				<!-- CPF/CNPJ -->
				<tr>
                    <td class="tbTituloFrm">
                        CPF/CNPJ:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Interessado.cpf_cnpj', array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                   </td>
                </tr>
				<!-- Matricula -->
				<tr>
                    <td class="tbTituloFrm">
                        Matrícula:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Interessado.matricula', array('label'=>false,'class'=>'textField textFieldWidth120'))?>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'interessados' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />


