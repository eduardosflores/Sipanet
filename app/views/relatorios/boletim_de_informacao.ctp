<div class="div_principal">
    <fieldset class="fieldset">
        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            <form action="<?php echo $form->url("/relatorios/boletim_de_informacao"); ?>" method="post" name="addform">
            <tr>
                <td colspan="2" align="left">
                    <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para pesquisar os processos tramitados:</label>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="left">
                    &nbsp;
                </td>
            </tr>
            
            <!-- Órgão Envio -->
            <tr>
                <td class="tbTituloFrm">
                    Órgão de Envio:
                </td>
                <td class="tbFieldFrm">
                    <?php echo $session->read('Orgao.sigla'); ?>
               </td>
            </tr>
            
            <!-- Setor de Envio -->
            <tr>
                <td class="tbTituloFrm">
                    Setor de Envio:
                </td>
               <td class="tbFieldFrm">
                    <input type="hidden" name="data[Busca][setor_origem_id]" id="BuscaSetorOrigemId" value="<?php echo $session->read('Setor.id'); ?>" />
                    <?php echo $session->read('Setor.sigla'). " - ".$session->read('Setor.descricao') ?>
               </td>
            </tr>
            
            <!-- Órgão Recebimento -->
            <tr>
                <td class="tbTituloFrm">
                    Órgão de Recebimento:
                </td>
                <td class="tbFieldFrm">
                    <select name="data[Busca][orgao_recebimento_id]" id="OrgaoRecebimentoSelect" class="comboBox textFieldWidth240">
                        <option value="">Selecione</option>
                        <?php
                        foreach($orgaos as $orgao) {
                        ?>
                            <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if($orgao['Orgao']['id'] == $this->data['Busca']['orgao_recebimento_id']) echo 'selected="selected"'; ?>>
                                <?php echo "{$orgao['Orgao']['codigo']} - {$orgao['Orgao']['sigla']}"; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    
                    <?php echo $ajax->observeField('OrgaoRecebimentoSelect', array('url' => '/setores/ajax_list?tipo=orgao_recebimento_id', 'update' => 'BuscaSetorRecebimentoId', 'conditions' => "$('OrgaoRecebimentoSelect').value != ''")); ?>
               </td>
            </tr>
            
            <!-- Setor de Envio -->
            <tr>
                <td class="tbTituloFrm">
                    Setor de Recebimento:
                </td>
               <td class="tbFieldFrm">
                    <select name="data[Busca][setor_recebimento_id]" id="BuscaSetorRecebimentoId" class="comboBox textFieldWidth240">
                        <option value="">Selecione o Órgão</option>
                        <?php
                        foreach($setoresRecebimento as $setor) {
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
                    <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/relatorios/tramites") ?>'" value="Cancelar" />
                </td>
            </tr>
            
            </form>
            
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
                    <form action="<?php echo $form->url("/relatorios/boletim_de_informacao_pdf/" . $url); ?>" method="post" name="addform" target="_blank">
                    
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            <b>Foram encontrados <?php echo count($tramites) ?> processos tramitados:</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                                <tr>
                                    <td class="tdTituloGrid nosort">
                                        Processo
                                    </td>
                                    <td class="tdTituloGrid nosort" style="border-left: 1px solid #fff;">
                                        Órgão de Origem
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Setor de Origem
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
                                        Selecione
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
                                            <?php echo $tramite['SetorOrigem']['Orgao']['sigla'] ?>
                                        </td>
                                        <td class="tdConteudoGrid">
                                            <?php echo $tramite['SetorOrigem']['sigla'] ?>
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
                                            <input type="checkbox" class="checkboxes" name="data[Busca][Tramites][<?php echo $tramite['Tramite']['id']; ?>]" value="<?php echo $tramite['Tramite']['id']; ?>" />
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                            
                            <input type="submit" value="Imprimir Boletim de Informação" />
                            
                        </td>
                    </tr>
                    
                    </form>
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
</div>
<br />


