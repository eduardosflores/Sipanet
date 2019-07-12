<div class="div_principal">
	<form action="<?php echo $html->url('/processos/dividir/'.$processo['Processo']['id'])?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>

            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Selecione os Servidores que terão acesso ao Processo:</label>
						<br /><br />
						<label class="lbInfoPagFrm">Processo: <?php echo $processo['Processo']['numero_orgao'] ?>-<?php echo $processo['Processo']['numero_processo'] ?>/<?php echo $processo['Processo']['numero_ano'] ?></label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Servidores:</b>
                    </td>
                </tr>
				<!-- Servidores -->
				<tr>
                    <td class="tbFieldFrm" colspan="2">
                        <?php
					    foreach($servidores as $servidor)
					    {
					   		$checked = (array_search($servidor['Servidor']['id'], $servidor_ids) === false ? '' : 'checked=checked');
							?>
							<input type="checkbox" name="data[Divisao][servidor_id][]" value="<?php echo $servidor['Servidor']['id']; ?>" id="DivisaoServidorId<?php echo $servidor['Servidor']['id']; ?>" <?php echo $checked; ?> />
							<label for="DivisaoServidorId<?php echo $servidor['Servidor']['id']; ?>"><?php echo $servidor['Servidor']['nome'] . ' - ' . $servidor[0]['quantidade'] . ' processo(s)'; ?></label>
							<br />
							<?php
						}
						?>

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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'processos/divisao' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />