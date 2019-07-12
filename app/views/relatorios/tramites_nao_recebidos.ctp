<div class="div_principal">
    <form action="<?php echo $form->url("/relatorios/tramites_nao_recebidos"); ?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para pesquisar os Trâmites efetuados pelo seu setor e ainda não recebidos:</label>
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
                        Órgão de destino:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="OrgaoSelect" id="OrgaoSelect" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
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
                        
                        <?php echo $ajax->observeField('OrgaoSelect', array('url' => '/setores/ajax_list', 'update' => 'BuscaSetorRecebimentoId', 'conditions' => "$('OrgaoSelect').value != ''")); ?>
                   </td>
                </tr>
                
                <!-- Setor -->
                <tr>
                    <td class="tbTituloFrm">
                        Setor de destino:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Busca][setor_recebimento_id]" id="BuscaSetorRecebimentoId" class="comboBox textFieldWidth240">
                            <option value="">Selecione o Órgão</option>
                            <?php
                            foreach($setores as $setor) {
                            ?>
                                <option value="<?php echo $setor['Setor']['id']; ?>" <?php if($setor['Setor']['id'] == $this->data['Busca']['setor_recebimento_id']) echo 'selected="selected"'; ?>>
                                    <?php echo "{$setor['Setor']['sigla']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                   </td>
                </tr>
                
                <!-- Data de movimentação inicial -->
                <tr>
                    <td class="tbTituloFrm">
                        Data do trâmite (início):
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Busca.data_tramite_inicial'); ?>
                   </td>
                </tr>
                
                <!-- Data de movimentação final -->
                <tr>
                    <td class="tbTituloFrm">
                        Data do trâmite (fim):
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Busca.data_tramite_final'); ?>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/relatorios/tramites_nao_recebidos") ?>'" value="Cancelar" />
                    </td>
                </tr>
                
                <?php
                /**
                 * Verifica se a busca já foi efetuada
                 * **/
                if(isset($tramites) && is_array($tramites))
                {
                    /**
                     * Se retornou algum registro, exibe a listagem.
                     * Senão, exibe mensagem.
                     * **/
                    if(count($tramites) > 0)
                    {
                	?>
                        <tr>
                            <td class="lbInfoPagFrm" colspan="2" align="left">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td class="lbInfoPagFrm" colspan="2" align="left">
                                <b>Foram encontrados <?php echo $this->params['paging']['Tramite']['count']; ?> trâmites:</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                                    <tr>
                                        <td class="tdTituloGrid nosort">
                                            Processo
                                        </td>
                                        <td class="tdTituloGrid nosort">
                                            Tramitado por
                                        </td>
                                        <td class="tdTituloGrid nosort">
                                            Data Trâmite
                                        </td>
                                        
                                        <td class="tdTituloGridTramitacaoDestino nosort" style="border-left: 1px solid #fff;">
                                            Órgão de Destino
                                        </td>
                                        <td class="tdTituloGridTramitacaoDestino nosort">
                                            Setor de Destino
                                        </td>
                                        <td class="tdTituloGridTramitacaoDestino nosort">
                                            Recebido
                                        </td>
                                    </tr>
                                    <?php
                                    foreach($tramites as $tramite)
                                    {
                                    ?>
                                        <tr class="trDisplay">
                                            <td class="tdConteudoGrid">
                                                <?php echo $tramite['Processo']['numero_orgao'] . '-' . $tramite['Processo']['numero_processo'] . '/' . $tramite['Processo']['numero_ano'] ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $tramite['ServidorOrigem']['nome'] ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $protocolo->showDateBr($tramite['Tramite']['data_tramite']) ?>
                                            </td>
                                            
                                            <td class="tdConteudoGrid">
                                                <?php echo $tramite['SetorRecebimento']['Orgao']['sigla'] ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $tramite['SetorRecebimento']['sigla'] ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $protocolo->showBooleanField($tramite['Tramite']['flag_recebimento']) ?>
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
                    else
                    {
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


