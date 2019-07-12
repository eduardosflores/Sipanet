
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
            
            <?php echo $this->renderElement('../servidores/_tabela_servidores'); ?>
            
            <?php echo $paginator->first('<< Primeiro'); ?>
            <?php echo $paginator->prev('< Anterior'); ?>
            <?php echo $paginator->numbers(); ?>
            <?php echo $paginator->next('Próximo >'); ?>
            <?php echo $paginator->last('Último >>'); ?>
        </fieldset>
        <br />
    </div>