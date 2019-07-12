<form action="<?php echo $html->url('/servidores/cadastrar_setor/'.$servidor['Servidor']['id'])?>" method="post" name="addform">
    <input type="hidden" name="data[SetorServidor][servidor_id]" value="<?php echo $servidor['Servidor']['id']; ?>" />
    <fieldset class="fieldset">
        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
		
        <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            <tr>
                <td colspan="2" align="left">
                    <br /><label class="lbInfoPagFrm">Selecione o novo setor associado ao servidor:</label>
					<br /><br />
					<label class="lbInfoPagFrm">Servidor: <?php echo $servidor['Servidor']['nome'] ?></label>
                    <br />
                    <label class="lbInfoPagFrm">Setor Principal: <?php echo $servidor['Setor']['sigla'] ?></label>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="left">
                    &nbsp;
                </td>
            </tr>
			<!-- Setor -->
			<tr>
                <td class="tbTituloFrm">
                    Setor:
                </td>
                <td class="tbFieldFrm">
                    <select name="data[SetorServidor][setor_id]" id="SetorServidorSetorId" class="comboBox textFieldWidth240">
                        <option value="">Selecione</option>
                        <?php
                        foreach($setores as $setor) {
                        ?>
                            <option value="<?php echo $setor['Setor']['id']; ?>">
                                <?php echo "{$setor['Setor']['sigla']}"; ?>
                            </option>
                        <?php
                        }
                        ?>
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
                    <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'servidores' ?>'" value="Cancelar" />
                </td>
            </tr>
        </table>
    </fieldset>
</form>
<br />