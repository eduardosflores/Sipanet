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
                        <b>Descri��o:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $cargo['Cargo']['descricao'] ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="tdBtnVoltar">
                        <br /><br />
                        <table>
                            <tr>
                                <td><a href="<?php echo $html->url('/cargos'); ?>"><img border="0" src="<?php echo $this->webroot; ?>img/back.png" /></a></td>
                                <td><a href="<?php echo $html->url('/cargos'); ?>">Voltar para listagem de Cargos</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br />
        </fieldset>
        <br />
    </div>