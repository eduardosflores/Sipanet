<div class="div_principal">
    <fieldset class="fieldset">
        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            <form action="<?php echo $form->url("/relatorios/boletim_de_informacao_de_distribuicao"); ?>" method="post" name="addform">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para pesquisar os processos distribuidos:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>

                <!-- Orgao -->
                <tr>
                    <td class="tbTituloFrm">
                        Órgao:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $orgao?>
                    </td>
                </tr>
                <!--Servidor-->
                <tr>
                    <td class="tbTituloFrm">
                        Servidor:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Busca][servidor_id]" id="BuscaServidorId" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php foreach ($servidores as $servidor) { ?>
                            <option value="<?php echo $servidor['Servidor']['id']?>"><?php echo $servidor['Servidor']['nome']?></option>
                            <?php } ?>

                        </select>
                    </td>
                </tr>

                <!-- Data de movimentação inicial -->
                <tr>
                    <td class="tbTituloFrm">
                        Data da distribuição (início):
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Busca.data_inicial'); ?>
                    </td>
                </tr>

                <!-- Data de movimentação final -->
                <tr>
                    <td class="tbTituloFrm">
                        Data da distribuição (fim):
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Busca.data_final'); ?>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/") ?>'" value="Cancelar" />
                    </td>
                </tr>

            </form>

<?php
    /**
     * Verifica se a busca já foi efetuada
     * **/
if(isset($divisoes) && is_array($divisoes))
{
        /**
             * Se retornou algum registro, exibe a listagem.
             * Senão, exibe mensagem.
             * **/
    if(count($divisoes) > 0)
    {
        ?>
            <form action="<?php echo $form->url("/relatorios/boletim_de_distribuicao_pdf/" . $url); ?>" method="post" name="addform" target="_blank">

                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Foram encontrados <?php echo count($divisoes) ?> processos distribuidos:</b>
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
                                    Assunto
                                </td>
                                <td class="tdTituloGrid nosort">
                                    Servidor
                                </td>
                                <td class="tdTituloGrid nosort">
                                    Data Distribuição
                                </td>
                                <td class="tdTituloGridTramitacaoDestino nosort">
                                    Selecione
                                </td>
                            </tr>
                            <?php
                            foreach($divisoes as $divisao)
                            {
                                ?>
                            <tr class="trDisplay">
                                <td class="tdConteudoGrid">
                                    <?php echo $divisao['Processo']['numero_orgao'] . '-' . $divisao['Processo']['numero_processo'] . '/' . $divisao['Processo']['numero_ano'] ?>
                                </td>

                                <td class="tdConteudoGrid">
                                    <?php echo $divisao['Processo']['titulo_assunto'] ?>
                                </td>

                                <td class="tdConteudoGrid">
                                    <?php echo $divisao['Servidor']['nome'] ?>
                                </td>
                                <td class="tdConteudoGrid">
                                    <?php echo $protocolo->showDateBr($divisao['HistoricoDivisao']['data_divisao']) ?>
                                </td>

                                <td class="tdConteudoGrid">
                                    <input type="checkbox" class="checkboxes" name="data[Busca][HistoricoDivisoes][<?php echo $divisao['HistoricoDivisao']['id']; ?>]" value="<?php echo $divisao['HistoricoDivisao']['id']; ?>" />
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>

                        <input type="submit" value="Imprimir Boletim de Distribuição" />

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


