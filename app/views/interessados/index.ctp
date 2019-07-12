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
                        Ações
                    </td>
                    <td class="tdTituloGrid">
                        Nome
                    </td>
                    <td class="tdTituloGrid">
                        CPF/CNPJ
                    </td>
                    <td class="tdTituloGrid">
                        Tipo
                    </td>
                </tr>
                <?php foreach($interessados as $interessado) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('alterar/'.$interessado['Interessado']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/interessados/delete/'.$interessado['Interessado']['id'],null,'Tem certeza?',false)?>
						</td>

                        <td class="tdConteudoGrid">
                            <?php echo $html->link($interessado['Interessado']['nome'],'exibir/'.$interessado['Interessado']['id'])?>
                        </td>
						
						<td class="tdConteudoGrid">
							<?php echo $interessado['Interessado']['cpf_cnpj']; ?>
						</td>
						
						<td class="tdConteudoGrid">
							<?php echo $interessado['TipoInteressado']['descricao']; ?>
						</td>
                    </tr>
				<?php } ?>
            </table>
            
            <?php echo $paginator->first('<< Primeiro'); ?>
            <?php echo $paginator->prev('< Anterior'); ?>
            <?php echo $paginator->numbers(); ?>
            <?php echo $paginator->next('Próximo >'); ?>
            <?php echo $paginator->last('Último >>'); ?>
        </fieldset>
        <br />
    </div>