<div class="div_principal">
	<form action="<?php echo $html->url('/processos/receber/')?>" method="post" name="addform">

		<input type="hidden" name="data[Processo][id]" id="ProcessoId" value="<?php echo $processo['Processo']['id']; ?>" />

        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>

            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            	<tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Confirme o recebimento do Processo:</b>
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
                    <td class="tdTituloExibirDetalhes">
                        <b>Assunto:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['titulo_assunto'] ?>
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
                    <td class="tdTituloExibirDetalhes" colspan="2" style="text-align: left; color: red">
                        <b>Confirme o número de páginas e volumes antes de receber o processo</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
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
                        Visualizar processo após o recebimento:
                    </td>
                   <td class="tbFieldFrm">
                        <input id="ConfiguracaoVisualizarProcesso_" type="hidden" value="0" name="data[Configuracao][visualizar_processo]"/>
                        <input id="ConfiguracaoVisualizarProcesso" class="textField textFieldWidth120" type="checkbox" value="1" name="data[Configuracao][visualizar_processo]"/>
                   </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <input type="submit" id="btnConfirmar" name="btnConfirmar" value="Confirmar" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . $retorno ?>'" value="Cancelar" />
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