<div class="div_principal">
    <form action="<?php echo $form->url("/relatorios/processos_lentos"); ?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Especifique a quantidade de dias ou deixe em branco para processar pela quantidade padrão do sistema (5 dias).</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                
                <!-- Dias -->
                <tr>
                    <td class="tbTituloFrm">
                        Dias:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Busca.dias', array('label'=>false,'class'=>'textArea textFieldWidth40', 'maxlength' => '3'))?>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/relatorios/processos_lentos") ?>'" value="Cancelar" />
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
                                <b>Foram encontrados <?php echo $this->params['paging']['Tramite']['count']; ?> processos:</b>
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
                                            Data do último trâmite
                                        </td>
                                        <td class="tdTituloGrid nosort">
                                            Encaminhado para o setor
                                        </td>
                                        <td class="tdTituloGrid nosort">
                                            Dias parado
                                        </td>
                                        <td class="tdTituloGrid nosort">
                                            Detalhes
                                        </td>
                                    </tr>
                                    <?php
                                    foreach($tramites as $tramite)
                                    {
                                    ?>
                                        <tr class="trDisplay">
                                            <td class="tdConteudoGrid">
                                                <?php echo $tramite['Processo']['numero_orgao'].'-'.$tramite['Processo']['numero_processo'].'/'.$tramite['Processo']['numero_ano']; ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $tramite['Processo']['Interessado']['nome'] ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $protocolo->showDateBr($tramite['Tramite']['data_tramite']) ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $tramite['SetorRecebimento']['sigla'] ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo diasEntreDatas(substr($tramite['Tramite']['data_tramite'], 0, 10), date('Y-m-d')) ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $html->link('Ver detalhes', '/processos/consultar/' . $tramite['Processo']['id']); ?>
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


