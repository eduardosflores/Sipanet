<div class="div_principal">

    <fieldset class="fieldset">

        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        <form action="<?php echo $html->url("/administracao/maximo_alterar/" ) . $this->data['DiaNaMesa']['id'] ?>" method="post" name="editform">
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>

                <!-- Orgao -->
                <tr>
                    <td class="tbTituloFrm">
                        �rg�o:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $setores[0]['Orgao']['descricao']?>
                    </td>
                </tr>

                <!-- Setor -->
                <tr>
                    <td class="tbTituloFrm">
                        Setor:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[DiaNaMesa][setor_id]" id="DiaNaMesaSetorId" class="comboBox textFieldWidth240">
                            <?php
                            foreach($setores as $setor) {
                                ?>
                            <option value="<?php echo $setor['Setor']['id']; ?>" <?php if($setor['Setor']['id'] == $dia_na_mesa['Setor']['id']) echo 'selected="selected"'; ?>>
                                <?php echo "{$setor['Setor']['sigla']}"; ?>
                            </option>
                            <?php
                        }
                        ?>
                        </select>
                    </td>
                </tr>

                 <!-- Tipo de Processo -->
	        <tr id="tipo_de_processo">
                    <td class="tbTituloFrm">
                        Tipo de processo:
                    </td>
                    <td class="tbFieldFrm">
                   	<select name="data[DiaNaMesa][tipo_processo_id]" id="DiaNaMesaTipoProcessoId" class="comboBox textFieldWidth240">
                             <?php echo $protocolo->optionsTag($tipos_processo, true); ?>
                        </select>
                        <script language="JavaScript" type="text/javascript">
                            $('DiaNaMesaTipoProcessoId').value = <?php echo ($this->data['DiaNaMesa']['tipo_processo_id'] != '') ? $this->data['DiaNaMesa']['tipo_processo_id'] : $processo['Processo']['tipo_processo_id']; ?>
                        </script>
                    </td>
                </tr>

                <!-- Maximo de dias -->
	        <tr id="tipo_de_processo">
                    <td class="tbTituloFrm">
                        M�ximo de dias:
                    </td>
                    <td class="tbFieldFrm">
                   	<input type="text" name="data[DiaNaMesa][max_dias_na_mesa]" class="textField textFieldWidth40" value="<?php echo $this->data['DiaNaMesa']['max_dias_na_mesa']?>" />
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
                        <input type="submit" id="btnSalvar" name="btnSalvar" value="Salvar informa��es" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $html->url('/administracao/maximo_index') ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
            <?php echo $form->hidden('DiaNaMesa.id'); ?>
        </form>

<?php
/*if(isset($dias_na_mesa))
{
    ?>
    <?php echo $this->renderElement('../servidores/_tabela_servidores'); ?>

    <?php echo $paginator->options(array('url' => $url)); ?>
    <?php echo $paginator->first('<< Primeiro'); ?>
    <?php echo $paginator->prev('< Anterior'); ?>
    <?php echo $paginator->numbers(); ?>
    <?php echo $paginator->next('Pr�ximo >'); ?>
    <?php echo $paginator->last('�ltimo >>'); ?>
    <?php
}*/
?>
    </fieldset>

    <br />
</div>