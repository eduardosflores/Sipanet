    <div class="div_principal">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend">
                        <?php if (isset($fieldSetTitle))
                        {
                            echo $fieldSetTitle;
                        }
                        ?>
                    </label> |</b>
            </legend>
            <br />
            <table cellpadding="2" cellspacing="2" border="0" class="tbConteudoExibirDetalhes">
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Número:</b>
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
                    <td class="tdTituloExibirDetalhes">
                        <b>Título do Assunto:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['titulo_assunto'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Assunto:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['assunto'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Situação:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Situacao']['descricao'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Cadastrado por:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Servidor']['nome'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Setor/Órgão:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $setor['Setor']['sigla'] . '/' . $setor['Orgao']['sigla'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Volumes:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['volumes'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Páginas:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['paginas'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Número do documento:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['documento_numero'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Data de cadastro:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $protocolo->showDateBr($processo['Processo']['data_cadastro']) ?>
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
                        <td class="tdTituloExibirDetalhes" style="color: #ff0000">
                            <b>Processo anexado a:</b>
                        </td>
                        <td class="tdConteudoExibirDetalhes" style="color: #ff0000;">
                            <?php echo $processoComoAnexo['ProcessoPrincipal']['numero_orgao'] ?>-<?php echo $processoComoAnexo['ProcessoPrincipal']['numero_processo'] ?>/<?php echo $processoComoAnexo['ProcessoPrincipal']['numero_ano'] ?>
                        </td>
                    </tr>
                <?php
                }
                
                /**
                 * Se não for anexo, exibe listagem de processos anexos
                 * **/
                elseif($processosAnexados)
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
                
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                
                <?php
                if(is_array($divisoes) && (count($divisoes) > 0))
                {
                ?>
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            <b>Processo distribuído aos seguintes Servidores:</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left">
                            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                                <tr>
                                    <td class="tdTituloGrid nosort">
                                        Servidor
                                    </td>
                                </tr>
                                <?php
                                foreach($divisoes as $divisao)
                                {
                                ?>
                                    <tr class="trDisplay">
                                        <td class="tdConteudoGrid">
                                            <?php echo $divisao['Servidor']['nome'] ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                <?php
                }
                ?>
            
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                
                <?php
                if(is_array($paralisacoes) && (count($paralisacoes) > 0))
                {
                ?>
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            <b>Histórico de Paralisações:</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left">
                            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                                <tr>
                                    <td class="tdTituloGrid nosort">
                                        Data
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Setor
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Motivo
                                    </td>
                                </tr>
                                <?php
                                foreach($paralisacoes as $paralisacao)
                                {
                                ?>
                                    <tr class="trDisplay">
                                        <td class="tdConteudoGrid">
                                            <?php echo $protocolo->showDateBr($paralisacao['Paralisacao']['data']) ?>
                                        </td>
                                        <td class="tdConteudoGrid">
                                            <?php echo $paralisacao['Setor']['sigla'] ?>
                                        </td>
                                        <td class="tdConteudoGrid">
                                            <?php echo $paralisacao['Paralisacao']['motivo'] ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                <?php
                }
                ?>
                
                <?php
                if(is_array($arquivamentos) && (count($arquivamentos) > 0))
                {
                ?>
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            <b>Histórico de Arquivamentos:</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left">
                            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                                <tr>
                                    <td class="tdTituloGrid nosort">
                                        Data
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Setor
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Motivo
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Data de Desarquivamento
                                    </td>
                                    <td class="tdTituloGrid nosort">
                                        Motivo de Desarquivamento
                                    </td>
                                </tr>
                                <?php
                                foreach($arquivamentos as $arquivamento)
                                {
                                ?>
                                    <tr class="trDisplay">
                                        <td class="tdConteudoGrid">
                                            <?php echo $protocolo->showDateBr($arquivamento['Arquivamento']['data']) ?>
                                        </td>
                                        <td class="tdConteudoGrid">
                                            <?php echo $arquivamento['Setor']['sigla'] ?>
                                        </td>
                                        <td class="tdConteudoGrid">
                                            <?php echo $arquivamento['Arquivamento']['motivo'] ?>
                                        </td>
                                        <td class="tdConteudoGrid">
                                            <?php echo $protocolo->showDateBr($arquivamento['Arquivamento']['data_desarquivamento']) ?>
                                        </td>
                                        <td class="tdConteudoGrid">
                                            <?php echo $arquivamento['Arquivamento']['motivo_desarquivamento'] ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                <?php
                }
                ?>
            
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                
                <?php
                if(is_array($tramites) && (count($tramites) > 0))
                {
                ?>
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            <b>Tramitação do processo:</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left">
                            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                                <?php echo $this->renderElement('../processos/_tabela_tramites'); ?>
                            </table>
                        </td>
                    </tr>
                <?php
                }
                else
                {
            	?>
                    <tr>
                        <td class="lbInfoPagFrm" colspan="2" align="left">
                            <b>Nenhum trâmite registrado.</b>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>

            <br />
        </fieldset>
        <br />
    </div>