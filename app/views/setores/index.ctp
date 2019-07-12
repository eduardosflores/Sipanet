
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
                        Órgão
                    </td>
                    <td class="tdTituloGrid">
                        Sigla
                    </td>
                    <td class="tdTituloGrid">
                        Descrição
                    </td>
                    <td class="tdTituloGrid">
                        Ativo
                    </td>
                </tr>
                <?php foreach($setores as $setor) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('alterar/'.$setor['Setor']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/setores/delete/'.$setor['Setor']['id'],null,'Tem certeza?',false)?>
						</td>

                        
						<td class="tdConteudoGrid">
                            <?php echo $setor['Orgao']['descricao']?>
                        </td>
                        
						<td class="tdConteudoGrid">
                            <?php echo $setor['Setor']['sigla'] ?>
                        </td>
						<td class="tdConteudoGrid">
                            <?php echo $html->link($setor['Setor']['descricao'],'exibir/'.$setor['Setor']['id'])?>
                        </td>
						<td class="tdConteudoGrid">
                            <?php echo $protocolo->showBooleanField($setor['Setor']['ativo']) ?>
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