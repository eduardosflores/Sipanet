<div class="div_principal">

    <fieldset class="fieldset">

        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        <form action="<?php echo $html->url("/servidores/consultar")?>" method="post" name="addform">
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
                        <select name="data[Servidor][orgao_id]" id="ServidorOrgaoId" class="comboBox textFieldWidth240">
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
                        <?php echo $ajax->observeField('ServidorOrgaoId', array('url' => '/setores/ajax_list', 'update' => 'ServidorSetorId', 'conditions' => "$('ServidorOrgaoId').value != ''")); ?>
                    </td>
                </tr>

                <!-- Setor -->
                <tr>
                    <td class="tbTituloFrm">
                        Setor:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Servidor][setor_id]" id="ServidorSetorId" class="comboBox textFieldWidth240">
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

                <!-- Grupo de Usuario -->
                <tr>
                    <td class="tbTituloFrm">
                        Grupo de Usuário:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Servidor][grupo_usuario_id]" id="ServidorGrupoUsuarioId" class="comboBox textFieldWidth240">
                            <option value="">Todos</option>
                            <?php foreach($grupos_usuario as $grupo_usuario) { ?>

                            <option value="<?php echo $grupo_usuario['GrupoUsuario']['id']; ?>" <?php if($grupo_usuario['GrupoUsuario']['id'] == $this->data['Busca']['grupo_usuario_id']) echo 'selected="selected"'; ?>>
                                <?php echo "{$grupo_usuario['GrupoUsuario']['descricao']}"; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <!-- Nome -->
                <tr>
                    <td class="tbTituloFrm">
                        Nome:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.nome', array('label'=>false,'class'=>'textArea textFieldWidth240'))?>
                    </td>
                </tr>

                <!-- CPF -->
                <tr>
                    <td class="tbTituloFrm">
                        CPF:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.cpf', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
                    </td>
                </tr>

                <!-- Matrícula -->
                <tr>
                    <td class="tbTituloFrm">
                        Matrícula:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.matricula', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
                    </td>
                </tr>

                <!-- Login -->
                <tr>
                    <td class="tbTituloFrm">
                        Login:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.login', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
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
                        <input type="submit" id="btnContinuar" name="btnContinuar" value="Continuar" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/servidores/consultar") ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </form>

<?php
if(isset($servidores))
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
}
?>
    </fieldset>
    <br />
</div>