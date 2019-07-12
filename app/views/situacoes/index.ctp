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
            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                <tr>
                    <td class="tdTituloGrid">
                        Nome
                    </td>
                </tr>
                <?php foreach($situacoes as $situacao) { ?>
                    <tr class="trDisplay">
                        <td class="tdConteudoGrid">
                            <?php echo $html->link($situacao['Situacao']['descricao'],'exibir/'.$situacao['Situacao']['id'])?>
                        </td>

                    </tr>
				<?php } ?>
            </table>
            
            <?php echo $paginator->prev('<< Anterior'); ?>
            <?php echo $paginator->numbers(); ?>
            <?php echo $paginator->next('Próximo >>'); ?>
        </fieldset>
        <br />
    </div>