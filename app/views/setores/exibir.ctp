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
                    <!-- Orgao -->
					<td class="tdTituloExibirDetalhes">
                        <b>Órgão:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $setor['Orgao']['descricao'] ?>
                    </td>
				</tr>
				<tr>
					<!-- Descricao -->
					<td class="tdTituloExibirDetalhes">
                        <b>Descrição:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $setor['Setor']['descricao'] ?>
                    </td>
				</tr>
				<tr>	
					<!-- Sigla -->
					<td class="tdTituloExibirDetalhes">
                        <b>Sigla:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $setor['Setor']['sigla'] ?>
                    </td>
				</tr>
				<tr>	
					<!-- Ativo -->
					<td class="tdTituloExibirDetalhes">
                        <b>Ativo:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $protocolo->showBooleanField($setor['Setor']['ativo']); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="tdBtnVoltar">
                        <br /><br />
                        <table>
                            <tr>
                                <td><a href="<?php echo $html->url('/setores'); ?>"><img border="0" src="<?php echo $this->webroot; ?>img/back.png" /></a></td>
                                <td><a href="<?php echo $html->url('/setores'); ?>">Voltar para listagem de Setores</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br />
        </fieldset>
        <br />
    </div>