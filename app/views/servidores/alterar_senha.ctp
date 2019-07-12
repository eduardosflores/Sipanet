<div class="div_principal">
    <form action="<?php echo $html->url('/servidores/alterar_senha/')?>" method="post" name="editform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Informe sua senha antiga e a nova senha para efetuar a troca:</label>
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
                        Nome:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $servidor['Servidor']['nome']; ?>
                   </td>
                </tr>
                
				<!-- Senha Atual -->
				<tr>
                    <td class="tbTituloFrm">
                        Senha Atual:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.senha_atual', array('label'=>false,'class'=>'textField textFieldWidth120', 'type' => "password"))?>
                   </td>
                </tr>
                
                <!-- Nova Senha -->
                <tr>
                    <td class="tbTituloFrm">
                        Nova Senha:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.nova_senha', array('label'=>false,'class'=>'textField textFieldWidth120', 'type' => "password"))?>
                   </td>
                </tr>
                
                <!-- Confirmação da Senha -->
                <tr>
                    <td class="tbTituloFrm">
                        Confirmação da Senha:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.nova_senha_confirmacao', array('label'=>false,'class'=>'textField textFieldWidth120', 'type' => "password"))?>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'servidores' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
		<?php echo $form->hidden('Servidor.id'); ?>
    </form>
</div>
<br />