<div class="div_principal">
    <fieldset class="fieldset">
        <legend>
            <b>| <label class="lbTituloLegend">Desanexação de Processo</label> |</b>
        </legend>

        <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
        	<tr>
                <td class="lbInfoPagFrm" colspan="2" align="left">
                    <b>Dados do Processo Principal:</b>
                </td>
            </tr>
            <tr>
                <td class="tdTituloExibirDetalhes">
                    <b>Processo:</b>
                </td>
                <td class="tdConteudoExibirDetalhes">
                    <?php echo $processo['Processo']['numero_orgao'] ?>-<?php echo $processo['Processo']['numero_processo'] ?>/<?php echo $processo['Processo']['numero_ano'] ?>
                </td>
            </tr>
            <tr>
                <td class="tdTituloExibirDetalhes">
                    <b>Interessado:</b>
                </td>
                <td class="tdConteudoExibirDetalhes">
                    <?php echo $processo['Interessado']['nome'] ?>
                </td>
            </tr>
            <tr>
                <td class="tdTituloExibirDetalhes">
                    <b>Natureza:</b>
                </td>
                <td class="tdConteudoExibirDetalhes">
                    <?php echo $processo['Natureza']['descricao'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="left">
                    &nbsp;
                </td>
            </tr>
            
            <?php
            /**
             * Verifica se o processo já está anexado a outro
            * **/
            if($processoComoAnexo)
            {
        	?>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Processo anexado a:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processoComoAnexo['ProcessoPrincipal']['numero_orgao'] ?>-<?php echo $processoComoAnexo['ProcessoPrincipal']['numero_processo'] ?>/<?php echo $processoComoAnexo['ProcessoPrincipal']['numero_ano'] ?>
                    </td>
                </tr>
            <?php
            }
            
            /**
             * Se não for anexo, exibe listagem de processos anexos e formulário para anexar processo
             * **/
            else
            {
                /**
                 * Lista os processos que estão anexados a este processo
                * **/
                if($processosAnexados)
                {
                ?>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                                <tr>
                                    <td class="tdTituloGrid nosort">
                                        Processos Anexados
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Interessado
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Desanexar
                                    </td>
                                    <?php
                                    foreach($processosAnexados as $processoAnexado)
                                    {
                                    ?>
                                        <tr class="trDisplay">
                                            <td class="tdConteudoGrid">
                                                <?php echo $processoAnexado['ProcessoAnexado']['numero_orgao'].'-'.$processoAnexado['ProcessoAnexado']['numero_processo'].'/'.$processoAnexado['ProcessoAnexado']['numero_ano']; ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $processoAnexado['ProcessoAnexado']['Interessado']['nome'] ?>
                                            </td>
                                            <td class="tdConteudoGrid">
                                                <?php echo $html->link('Desanexar', 'desanexacao/' . $processo['Processo']['id'] . '/' . $processoAnexado['ProcessoAnexado']['id']) ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <fieldset class="fieldset">
                            <legend>
                                <b>| <label class="lbTituloLegend">Anexar Processo - Dados do Processo a ser anexado</label> |</b>
                            </legend>
                            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                                <form action="<?php echo $html->url('/processos/confirmar_anexacao/' . $processo['Processo']['id'])?>" method="post" name="addform">
                                    <input type="hidden" name="data[Processo][id]" id="ProcessoId" value="<?php echo $processo['Processo']['id']; ?>" />
                                    
                                    <!-- Órgão -->
                                    <tr>
                                        <td class="tbTituloFrm">
                                            Órgão:
                                        </td>
                                       <td class="tbFieldFrm">
                                            <select name="data[Processo][numero_orgao]" id="ProcessoNumeroOrgao" class="comboBox textFieldWidth240">
                                                <?php
                                                /**
                                                 * TODO: Modificar para utilizar lista gerada automaticamente
                                                 * **/
                                                foreach($orgaos as $orgao) {
                                                ?>
                                                    <option value="<?php echo $orgao['Orgao']['codigo']; ?>" <?php if($orgao['Orgao']['id'] == $session->read('Orgao.id')) { echo "selected=\"selected\""; } ?> >
                                                        <?php echo "{$orgao['Orgao']['codigo']} - {$orgao['Orgao']['sigla']}"; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                       </td>
                                    </tr>
                                    
                                    <!-- Processo Nº -->
                                    <tr>
                                        <td class="tbTituloFrm">
                                            Processo Nº:
                                        </td>
                                       <td class="tbFieldFrm">
                                            <?php echo $form->input('Processo.numero_processo', array('label'=>false,'class'=>'textArea textFieldWidth120', 'value' => ''))?>
                                       </td>
                                    </tr>
                    
                                    <!-- Ano -->
                                    <tr>
                                        <td class="tbTituloFrm">
                                            Ano:
                                        </td>
                                       <td class="tbFieldFrm">
                                            <?php echo $form->input('Processo.numero_ano', array('label'=>false,'class'=>'textArea textFieldWidth40', 'maxlength' => '4', 'value' => date('Y')))?>
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
                                            <input type="submit" id="btnConfirmar" name="btnConfirmar" value="Confirmar" />
                                            <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'processos/anexacao/' ?>'" value="Cancelar" />
                                        </td>
                                    </tr>
                                    
                                </form>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </fieldset>
</div>
<br />