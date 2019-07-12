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
                    <td class="tdTituloAcoesGrid nosort">
                        A��es
                    </td>
                    <td class="tdTituloGrid">
                        Descri��o
                    </td>
                </tr>
                <?php foreach($cargos as $cargo) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('alterar/'.$cargo['Cargo']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/cargos/delete/'.$cargo['Cargo']['id'],null,'Tem certeza?',false)?>
						</td>

                        <td class="tdConteudoGrid">
                            <?php echo $html->link($cargo['Cargo']['descricao'],'exibir/'.$cargo['Cargo']['id'])?>
                        </td>

                    </tr>
				<?php } ?>
            </table>
            <?php echo $paginator->first('<< Primeiro'); ?>
            <?php echo $paginator->prev('< Anterior'); ?>
            <?php echo $paginator->numbers(); ?>
            <?php echo $paginator->next('Pr�ximo >'); ?>
            <?php echo $paginator->last('�ltimo >>'); ?>
        </fieldset>
        <br />
    </div>