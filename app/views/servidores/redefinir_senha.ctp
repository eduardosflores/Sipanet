<div class="div_principal">
    <form action="<?php echo $html->url('/servidores/redefinir_senha/' . $servidor['Servidor']['id'])?>" method="post" name="editform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
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
                
				<!-- Nova Senha -->
                <tr>
                    <td class="tbTituloFrm">
                        Nova Senha:
                    </td>
                   <td class="tbFieldFrm" style="color: #ff0000; font-weight: bold; font-size: 14px;">
                        <?php echo $senhaGerada; ?>

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
        <?php echo $form->hidden('Servidor.id', array('value' => $servidor['Servidor']['id'])) ?>
        <?php echo $form->hidden('Servidor.senha', array('value' => $senhaGerada)) ?>
    </form>
</div>
<br />