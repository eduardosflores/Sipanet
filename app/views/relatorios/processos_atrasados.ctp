<div class="div_principal">
    <form action="<?php echo $form->url("/relatorios/processos_atrasados"); ?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php
if (isset($fieldSetTitle)) {
    echo $fieldSetTitle;
}
?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para pesquisar os processos que estão atrasados de acordo <br />
                            como configurado previamente.:</label>
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
                        <select name="data[Busca][orgao_id]" id="OrgaoSelect" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($orgaos as $orgao) {
                            ?>
                                <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if ($orgao['Orgao']['id'] == $this->data['Busca']['orgao_id'])
                                    echo 'selected="selected"'; ?>>
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
                                    foreach ($setores as $setor) {
                            ?>
                                        <option value="<?php echo $setor['Setor']['id']; ?>" <?php if ($setor['Setor']['id'] == $this->data['Busca']['setor_recebimento_id'])
                                            echo 'selected="selected"'; ?>>
                                        <?php echo "{$setor['Setor']['sigla']}"; ?>
                            </option>
                            <?php
                                    }
                            ?>
                                </select>
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
                                <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/relatorios/processos_atrasados") ?>'" value="Cancelar" />
                            </td>
                        </tr>

                        <tr>

                            <td colspan="2">
                                <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable" style="font: 10px/1.4 sans-serif;">
                                    <tr>
                                        <td class="tdTituloGrid">
                                            Número
                                        </td>
                                        <td class="tdTituloGrid">
                                            Interessado
                                        </td>
                                        <td class="tdTituloGrid">
                                            Vindo do órgão/setor
                                        </td>

                                        <td class="tdTituloGrid">
                                            Recebido por
                                        </td>

                                        <td class="tdTituloGrid">
                                            Tipo do Processo
                                        </td>
                                        <td class="tdTituloGrid">
                                            Na data
                                        </td>
                                        <td class="tdTituloGrid">
                                            Limite (dias úteis)
                                        </td>
                                        <td class="tdTituloGrid">
                                            Dias úteis no setor
                                        </td>
                                        <td class="tdTituloGrid">
                                            Atraso
                                        </td>
                                    </tr>

                            <?php
                                    foreach ($tramites_nao_encaminhados as $tramite_nao_encaminhado) {
                            ?>
                                        <tr class="trDisplay">
                                            <td class="tdConteudoGrid">
                                    <?php echo $tramite_nao_encaminhado[0]['processo'] ?>
                                    </td>
                                    <td class="tdConteudoGrid">
                                    <?php echo $tramite_nao_encaminhado[0]['interessado'] ?>
                                    </td>

                                    <td class="tdConteudoGrid">
                                    <?php echo $tramite_nao_encaminhado[0]['sigla'] ?>
                                    </td>

                                    <td class="tdConteudoGrid">
                                    <?php echo $tramite_nao_encaminhado[0]['nome'] ?>
                                    </td>

                                    <td class="tdConteudoGrid">
                                    <?php echo $tramite_nao_encaminhado[0]['tipo_processo'] ?>
                                    </td>
                                    <td class="tdConteudoGrid">
                                    <?php echo $protocolo->showDateBr($tramite_nao_encaminhado[0]['data_recebimento']) ?>
                                    </td>
                                    <td class="tdConteudoGrid" style="text-align: center;">
                                    <?php echo $tramite_nao_encaminhado[0]['max_dias_na_mesa'] ?>
                                    </td>
                                    <td class="tdConteudoGrid" style="text-align: center;">
                                    <?php
                                        //01/02/2010
                                        $dt1tmp = $protocolo->showDateBr($tramite_nao_encaminhado[0]['data_recebimento']);
                                        $dt2tmp = date('d/m/Y');
                                        $data1 = mktime(0, 0, 0, substr($dt1tmp, 0, 2), substr($dt1tmp, 3, 2), substr($dt1tmp, 6, 4));
                                        $data2 = mktime(0, 0, 0, substr($dt2tmp, 0, 2), substr($dt2tmp, 3, 2), substr($dt2tmp, 6, 4));

                                        $DataInicial = $dt1tmp;
                                        $DataFinal = $dt2tmp;

                                        //CHAMADA DA FUNCAO
                                        $diasUteis = $protocolo->DiasUteis($DataInicial, $DataFinal);

                                        echo $diasUteis;
                                    ?>
                                    </td>
                                    <td class="tdConteudoGrid">
                                    <?php
                                        if (($diasUteis - $tramite_nao_encaminhado[0]['max_dias_na_mesa']) > 0) {
                                            echo $diasUteis - $tramite_nao_encaminhado[0]['max_dias_na_mesa'];
                                        }
                                    ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
            </table>
        </fieldset>
    </form>
</div>
<br />


