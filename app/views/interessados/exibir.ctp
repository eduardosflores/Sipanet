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
                        <b>Nome:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $interessado['Interessado']['nome'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Tipo:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $interessado['TipoInteressado']['descricao'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>CPF/CNPJ:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $interessado['Interessado']['cpf_cnpj'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Matrícula:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $interessado['Interessado']['matricula'] ?>
                    </td>
                </tr>
            </table>
            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                <tr>
                    <td class="tdTituloGrid">
                        Processo
                    </td>
                    <td class="tdTituloGrid">
                        Natureza
                    </td>
                    <td class="tdTituloGrid">
                        Situação
                    </td>
                    <td class="tdTituloGrid">
                        Data de cadastro
                    </td>
                </tr>
                <?php foreach($processos as $processo) { ?>
                    <tr class="trDisplay">
                        <td class="tdConteudoGrid">
                            <?php echo $processo['Processo']['numero_orgao'] . '-' . $processo['Processo']['numero_processo'] . '/' . $processo['Processo']['numero_ano']; ?>
                        </td>
                        
                        <td class="tdConteudoGrid">
                            <?php echo $processo['Natureza']['descricao']; ?>
                        </td>
                        
                        <td class="tdConteudoGrid">
                            <?php echo $processo['Situacao']['descricao']; ?>
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $protocolo->showDateBr($processo['Processo']['data_cadastro']); ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <table cellpadding="2" cellspacing="0" border="0">
                <tr>
                    <td colspan="2" class="tdBtnVoltar">
                        <br /><br />
                        <table>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/interessados/consultar") ?>'" value="Voltar" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br />
        </fieldset>
        <br />
    </div>