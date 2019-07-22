<div class="div_principal">
    <fieldset class="fieldset">
        <legend>    
            <b>| <label class="lbTituloLegend">
                    <?php if (isset($fieldSetTitle)) {
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
                    <b>Tipo do Processo:</b>
                </td>
                <td class="tdConteudoExibirDetalhes">
                    <?php echo $processo ['TipoProcesso']['descricao'] ?>
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
                    <?php echo $protocolo->showDateBr($processo['Processo']['data_cadastro'],true) ?>
                </td>
            </tr>

            <?php
            /**
             * Verifica se o processo já está anexado a outro
             * **/
            if($quantidadeArquivosFTP>0) {                            
            ?>            
            <tr>
                <td colspan="2">
                    <b>Arquivos Adicionados</b>
                </td>
            </tr>


            <?php
            /**
             * Verifica se o processo já está anexado a outro
             * **/
            if($processoComoAnexo) {
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
            elseif($processosAnexados) {
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
                                foreach($processosAnexados as $processoAnexado) {
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
        if(is_array($divisoes) && (count($divisoes) > 0)) {
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
                        foreach($divisoes as $divisao) {
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

        <?php
        if(is_array($historicoDivisoes) && (count($historicoDivisoes) > 0)) {
            ?>
        <tr>
            <td class="lbInfoPagFrm" colspan="2" align="left">
                <b><a onclick="$('historico_divisoes').toggle();">Mostrar/Ocultar</a> Histórico de Distribuição deste processo:</b>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="left">
                <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable" id="historico_divisoes" style="display:none">
                    <tr>
                        <td class="tdTituloGrid nosort">
                            Distribuído em
                        </td>
                        <td class="tdTituloGrid nosort">
                            Para
                        </td>
                    </tr>
                        <?php
                        foreach($historicoDivisoes as $historicoDivisao) {
                            ?>
                    <tr class="trDisplay">
                        <td class="tdConteudoGrid">
                                    <?php echo $protocolo->showDateBr($historicoDivisao['HistoricoDivisao']['data_divisao']) ?>
                        </td>
                        <td class="tdConteudoGrid">
                                    <?php echo $historicoDivisao['Servidor']['nome'] ?>
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
        if(is_array($historicoDevolucoes) && (count($historicoDevolucoes) > 0)) {
            ?>
        <tr>
            <td class="lbInfoPagFrm" colspan="2" align="left">
                <b><a onclick="$('historico_devolucoes').toggle();">Mostrar/Ocultar</a> Histórico de Devoluções deste processo:</b>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="left">
                <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable" id="historico_devolucoes" style="display:none">
                    <tr>
                        <td class="tdTituloGrid nosort">
                            Devolvido em
                        </td>
                        <td class="tdTituloGrid nosort">
                            Por
                        </td>
                        <td class="tdTituloGrid nosort">
                            Tipo Devolução
                        </td>
                        <td class="tdTituloGrid nosort">
                            Número Doc.
                        </td>
                        <td class="tdTituloGrid nosort">
                            Ano Doc.
                        </td>

                    </tr>
                        <?php
                        foreach($historicoDevolucoes as $historicoDevolucao) {
                            ?>
                    <tr class="trDisplay">
                        <td class="tdConteudoGrid">
                                    <?php echo $protocolo->showDateBr($historicoDevolucao['HistoricoDevolucao']['data_devolucao']) ?>
                        </td>
                        <td class="tdConteudoGrid">
                                    <?php echo $historicoDevolucao['Servidor']['nome'] ?>
                        </td>
                        <td class="tdConteudoGrid">
                                    <?php echo $historicoDevolucao['HistoricoDevolucao']['tipo_devolucao'] ?>
                        </td>
                        <td class="tdConteudoGrid">
                                    <?php echo $historicoDevolucao['HistoricoDevolucao']['num_doc'] ?>
                        </td>
                        <td class="tdConteudoGrid">
                                    <?php echo $historicoDevolucao['HistoricoDevolucao']['ano_doc'] ?>
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
        if(is_array($paralisacoes) && (count($paralisacoes) > 0)) {
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
                        <td class="tdTituloGrid nosort">
                            Paralisador por
                        </td>
                        <td class="tdTituloGrid nosort">
                            Liberado em
                        </td>
                    </tr>
                        <?php
                        foreach($paralisacoes as $paralisacao) {
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
                        <td class="tdConteudoGrid">
                                    <?php echo $paralisacao['Servidor']['nome'] ?>
                        </td>
                        <td class="tdConteudoGrid">
                                    <?php echo $protocolo->showDateBr($paralisacao['Paralisacao']['data_liberacao'],true) ?>
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
        if(is_array($arquivamentos) && (count($arquivamentos) > 0)) {
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
                        foreach($arquivamentos as $arquivamento) {
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
        if(is_array($tramites) && (count($tramites) > 0)) {
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


        <div id="fluxo_tramites">
                <?php echo $this->renderElement('../processos/_fluxo_tramites'); ?>
        </div>

        <?php
        }
        else {
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

    <fieldset class="fieldset">
        <legend>
            Imprimir
        </legend>
        <form action="<?php echo $form->url("/processos/consultar/"); ?>" method="post" name="addform">
            <div class="impressao">
                <input type="hidden" name="imprimir" value="true"/>
                <input type="hidden" name="data[Processo][numero_ano]" value="<?php echo $processo['Processo']['numero_ano']?>"/>
                <input type="hidden" name="data[Processo][numero_orgao]" value="<?php echo $processo['Processo']['numero_orgao']?>"/>
                <input type="hidden" name="data[Processo][numero_processo]" value="<?php echo $processo['Processo']['numero_processo']?>"/>
                <label style="font-size:8pt">Internet Explorer: Imprimir somente em "Paisagem"</label><br />
                <input type="submit" value="Versão para impressão"/>
            </div>

        </form>
    </fieldset>

</div>
