<div class="div_principal">
    <form action="<?php echo $form->url("/relatorios/processos"); ?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para pesquisar o Processo:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>

                <!-- Órgão -->
                <tr>
                    <td class="tbTituloFrm">
                        Órgão:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Busca][orgao_id]" id="BuscaOrgaoId" class="comboBox textFieldWidth240">
                            <option value="">TODOS</option>
                            <?php
                            foreach($orgaos as $orgao) {
                                ?>
                            <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if($orgao['Orgao']['id'] == $this->data['Busca']['orgao_id']) echo 'selected="selected"'; ?>>
                                    <?php echo "{$orgao['Orgao']['codigo']} - {$orgao['Orgao']['sigla']}"; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>

                        <?php echo $ajax->observeField('BuscaOrgaoId', array('url' => '/setores/ajax_list', 'update' => 'BuscaSetorId', 'conditions' => "$('BuscaOrgaoId').value != ''")); ?>
                    </td>
                </tr>

                <!-- Setor -->
                <tr>
                    <td class="tbTituloFrm">
                        Setor:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Busca][setor_id]" id="BuscaSetorId" class="comboBox textFieldWidth240">
                            <option value="">TODOS</option>
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


                <!--    
                   <r>
                       <td class="tbTituloFrm">
                           Servidor:
                       </td>
                      <td class="tbFieldFrm">
                <?php echo $form->input('Busca.servidor_id', array('label'=>false,'class'=>'textArea textFieldWidth40', 'maxlength' => '4'))?>
                      </td>
                   </tr>
                -->
                <!-- Ano -->
                <tr>
                    <td class="tbTituloFrm">
                        Ano do Processo:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Busca.numero_ano', array('label'=>false,'class'=>'textArea textFieldWidth40', 'maxlength' => '4'))?>
                    </td>
                </tr>

                <!-- Natureza -->
                <tr>
                    <td class="tbTituloFrm">
                        Natureza:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Busca][natureza_id]" id="BuscaNaturezaId" class="comboBox textFieldWidth240">
                            <option value="">
                                Selecione
                            </option>
                            <?php
                            foreach($naturezas as $natureza) {
                                ?>
                            <option value="<?php echo $natureza['Natureza']['id']; ?>" <?php if($this->data['Busca']['natureza_id'] == $natureza['Natureza']['id']) echo 'selected="selected"'; ?>>
                                    <?php echo "{$natureza['Natureza']['descricao']}"; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <!-- Situação -->
                <tr>
                    <td class="tbTituloFrm">
                        Situação:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Busca][situacao_id]" id="BuscaSituacaoId" class="comboBox textFieldWidth240">
                            <option value="">
                                Selecione
                            </option>
                            <?php
                            foreach($situacoes as $situacao) {
                                ?>
                            <option value="<?php echo $situacao['Situacao']['id']; ?>" <?php if($this->data['Busca']['situacao_id'] == $situacao['Situacao']['id']) echo 'selected="selected"'; ?>>
                                    <?php echo "{$situacao['Situacao']['descricao']}"; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <!-- Assunto -->
                <tr>
                    <td class="tbTituloFrm">
                        Título do Assunto:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Busca.titulo_assunto', array('label'=>false,'class'=>'textArea textFieldWidth240'))?>
                    </td>
                </tr>

                <!-- Interessado -->
                <tr>
                    <td class="tbTituloFrm">
                        Interessado:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Busca.interessado', array('label'=>false,'class'=>'textArea textFieldWidth240'))?>
                    </td>
                </tr>

                <!-- Número do documento -->
                <tr>
                    <td class="tbTituloFrm">
                        Número do documento:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Busca.documento_numero', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
                    </td>
                </tr>

                <!-- Data de cadastro inicial -->
                <tr>
                    <td class="tbTituloFrm">
                        Data de cadastro (início):
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Busca.data_cadastro_inicial'); ?>
                    </td>
                </tr>

                <!-- Data de cadastro final -->
                <tr>
                    <td class="tbTituloFrm">
                        Data de cadastro (fim):
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Busca.data_cadastro_final'); ?>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/relatorios/processos") ?>'" value="Cancelar" />
                    </td>
                </tr>

                <?php
                /**
                 * Verifica se a busca já foi efetuada
                 * **/
                if(isset($processos) && is_array($processos)) {
                /**
                 * Se retornou algum registro, exibe a listagem.
                 * Senão, exibe mensagem.
                 * **/
                    if(count($processos) > 0) {
                        ?>
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Foram encontrados <?php echo $this->params['paging']['Processo']['count']; ?> processos:</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                            <tr>
                                <td class="tdTituloGrid nosort">
                                    Número
                                </td>
                                <td class="tdTituloGrid nosort">
                                    Interessado
                                </td>
                                <td class="tdTituloGrid nosort">
                                    Natureza
                                </td>
                                <td class="tdTituloGrid nosort">
                                    Situação
                                </td>
                                <td class="tdTituloGrid nosort">
                                    Título do Assunto
                                </td>
                                <td class="tdTituloGrid nosort">
                                    Detalhes
                                </td>
                            </tr>
        <?php
        foreach($processos as $processo) {
                                        ?>
                            <tr class="trDisplay">
                                <td class="tdConteudoGrid">
                                        <?php echo $processo['Processo']['numero_orgao'].'-'.$processo['Processo']['numero_processo'].'/'.$processo['Processo']['numero_ano']; ?>
                                </td>
                                <td class="tdConteudoGrid">
                                                <?php echo $processo['Interessado']['nome'] ?>
                                </td>
                                <td class="tdConteudoGrid">
                                                <?php echo $processo['Natureza']['descricao'] ?>
                                </td>
                                <td class="tdConteudoGrid">
                                                <?php echo $processo['Situacao']['descricao'] ?>
                                </td>
                                <td class="tdConteudoGrid">
                                                <?php echo $processo['Processo']['titulo_assunto'] ?>
                                </td>
                                <td class="tdConteudoGrid">
                                                <?php echo $html->link('Ver detalhes', '/processos/consultar/' . $processo['Processo']['id']); ?>
                                </td>
                            </tr>
                                            <?php
        }
        ?>
                        </table>

                                    <?php echo $paginator->options(array('url' => $url)); ?>
        <?php echo $paginator->first('<< Primeiro'); ?>
        <?php echo $paginator->prev('< Anterior'); ?>
                                <?php echo $paginator->numbers(); ?>
                                <?php echo $paginator->next('Próximo >'); ?>
                                <?php echo $paginator->last('Último >>'); ?>
                    </td>
                </tr>
                            <?php
    }
    else {
                        ?>
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Nenhum processo encontrado.</b>
                    </td>
                </tr>
    <?php
    }
    ?>

                <?php
                }
                ?>


            </table>
        </fieldset>
    </form>
</div>
<br />


