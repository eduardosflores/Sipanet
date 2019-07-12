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
                        <b>Descrição:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $natureza['Natureza']['descricao'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Ativo:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $protocolo->showBooleanField($natureza['Natureza']['ativo']) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="tdBtnVoltar">
                        <br /><br />
                        <table>
                            <tr>
                                <td><a href="<?php echo $html->url('/naturezas'); ?>"><img border="0" src="<?php echo $this->webroot; ?>img/back.png" /></a></td>
                                <td><a href="<?php echo $html->url('/naturezas'); ?>">Voltar para listagem de Naturezas</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br />
        </fieldset>
        <br />
    </div>