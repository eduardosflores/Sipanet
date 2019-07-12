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
                        Descrição
                    </td>
                </tr>
                <?php foreach($modulos as $modulo) { ?>
                    <tr class="trDisplay">
                        <td class="tdConteudoGrid">
                            <?php echo $html->link($modulo['Modulo']['descricao'],'exibir/'.$modulo['Modulo']['id'])?>
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