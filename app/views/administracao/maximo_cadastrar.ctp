<div class="div_principal">

    <fieldset class="fieldset">

        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        <form action="<?php echo $html->url("/administracao/maximo_cadastrar/")?>" method="post" name="addform">
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>

                <!-- Orgao -->
                <tr>
                    <td class="tbTituloFrm">
                        Órgão:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Servidor][orgao_id]" id="DiaNaMesaOrgaoId" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php
                            foreach($orgaos as $orgao) {
                                ?>
                            <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if($orgao['Orgao']['id'] == $this->data['Servidor']['orgao_id']) { echo "selected=\"selected\""; } ?> >
                                <?php echo "{$orgao['Orgao']['codigo']}"; ?> - <?php echo "{$orgao['Orgao']['sigla']}"; ?>
                            </option>
                            <?php
                        }
                        ?>
                        </select>
                        <?php echo $ajax->observeField('DiaNaMesaOrgaoId', array('url' => '/setores/ajax_list', 'update' => 'DiaNaMesaSetorId', 'conditions' => "$('DiaNaMesaOrgaoId').value != ''")); ?>
                    </td>
                </tr>

                <!-- Setor -->
                <tr>
                    <td class="tbTituloFrm">
                        Setor:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[DiaNaMesa][setor_id]" id="DiaNaMesaSetorId" class="comboBox textFieldWidth240">
                            <option value="">Todos</option>
                            <?php
                            foreach($setores as $setor) {
                                ?>
                            <option value="<?php echo $setor['Setor']['id']; ?>" <?php if($setor['Setor']['id'] == $this->data['Busca']['setor_id']) echo 'selected="selected"'; ?>>
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
                        Máximo de dias:
                    </td>
                    <td class="tbFieldFrm">
                   	<input type="text" name="data[DiaNaMesa][max_dias_na_mesa]" class="textField textFieldWidth40" />
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $html->url('/administracao/maximo_listar') ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
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
    <?php echo $paginator->next('Próximo >'); ?>
    <?php echo $paginator->last('Último >>'); ?>
    <?php
}*/
?>
    </fieldset>
    <br />
</div>