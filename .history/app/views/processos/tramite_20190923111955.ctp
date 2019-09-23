<div class="div_principal">
    <form   action="<?php echo $html->url('/processos/tramitar/' . $processo['Processo']['id'])?>" 
            method="post" 
            name="addform" 
            id="form_tramite"
            onload="abrirTela()">

        <input type="hidden" name="data[Processo][id]" id="ProcessoId" value="<?php echo $processo['Processo']['id']; ?>" />
        <input type="hidden" name="data[chaveArquivo][valor]" id="chaveArquivo" value="<?php echo $chaveArquivo; ?>" />

        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>

            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            	<tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Confirme Trâmite do Processo:</b>
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
                <tr>
                    <td colspan="2" align="left">
                        Informe o local de destino do processo:
                    </td>
                </tr>
                <!-- Órgão -->
                <tr>
                    <td class="tbTituloFrm">
                        Órgão:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="OrgaoSelect" id="OrgaoSelect" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php
                            /**
                             * TODO: Modificar para utilizar lista gerada automaticamente
                             * **/
                            foreach($orgaos as $orgao) {
                            ?>
                                <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if($orgao['Orgao']['id'] == $session->read('Orgao.id')) { echo "selected=\"selected\""; } ?>>
                                    <?php echo "{$orgao['Orgao']['codigo']} - {$orgao['Orgao']['sigla']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        
                        <?php echo $ajax->observeField('OrgaoSelect', array('url' => '/setores/ajax_list?ativo=true', 'update' => 'TramiteSetorId', 'conditions' => "$('OrgaoSelect').value != ''")); ?>
                   </td>
                </tr>
                
                <!-- Setor -->
                <tr>
                    <td class="tbTituloFrm">
                        Setor:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Tramite][setor_id]" id="TramiteSetorId" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php
                            foreach($setores as $setor) {
                            ?>
                                <option value="<?php echo $setor['Setor']['id']; ?>">
                                    <?php echo "{$setor['Setor']['sigla']}"." - "."{$setor['Setor']['descricao']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                   </td>
                </tr>
                
                <!-- Observações -->
                <tr>
                    <td class="tbTituloFrm">
                        Observações:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->textarea('Tramite.observacoes', array('label'=>false,'class'=>'textArea textFieldWidth240', 'rows' => '5'))?>
                   </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="left">
                        Alterar dados do processo
                    </td>
                </tr>
                
                <!-- Volumes -->
                <tr>
                    <td class="tbTituloFrm">
                        Volumes:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.volumes', array('label'=>false,'class'=>'textArea textFieldWidth40', 'value' => $processo['Processo']['volumes']))?>
                   </td>
                </tr>
                
                <!-- Páginas -->
                <tr>
                    <td class="tbTituloFrm">
                        Páginas:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.paginas', array('label'=>false,'class'=>'textArea textFieldWidth40', 'value' => $processo['Processo']['paginas']))?>
                   </td>
                </tr>
                
                
				<tr>
                    <td  colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                
                <!-- Ativo -->
                <tr>
                    <td class="tbTituloFrm">
                        Visualizar processo após o trâmite:
                    </td>
                   <td class="tbFieldFrm">
                        <input id="ConfiguracaoVisualizarProcesso_" type="hidden" value="0" name="data[Configuracao][visualizar_processo]"/>
                        <input id="ConfiguracaoVisualizarProcesso" class="textField textFieldWidth120" type="checkbox" value="1" name="data[Configuracao][visualizar_processo]"/>
                   </td>
                </tr>


                <tr>
                    <td class="tbTituloFrm">
                        Upload de Arquivos
                    </td>
                   <td class="tbFieldFrm">
                        <input type="file" id="paginas" name="uploadfile" accept="application/pdf" />                            
                   </td>                        
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                     
                    </td>
                   <td class="tbFieldFrm">
                        <input type="button" value="Enviar Arquivo" onclick="upload()" />
                   </td>                        
                </tr>

                <tr>
                    <td align="left" colspan="2">
                        <b>Arquivos adicionados</b>
                    </td>                    
                </tr>
                <tr>
                    <td colspan="2">
                    <table cellpadding="2" cellspacing="0" border="0" class="tbFrm" id="tblUpload">
                            <tbody>
                            </tbody>
                    </table>        
                    </td>        
                </tr>


                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <input type="submit" id="btnConfirmar" name="btnConfirmar" value="Confirmar" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'processos/tramite/' ?>'" value="Cancelar" />
                    </td>
                </tr>

                

                <?php
                if($processosAnexados)
                {
                    /**
                     * Lista os processos que estão anexados a este processo
                    * **/
                    ?>
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            <b>Processos anexados:</b>
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
                                                <?php echo $processoAnexado['ProcessoAnexado']['Natureza']['descricao'] ?>
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
            </table>
        </fieldset>
    </form>
</div>
<br />