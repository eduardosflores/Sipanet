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
                        Codigo
                    </td>
					<td class="tdTituloGrid">
                        Descrição
                    </td>
					<td class="tdTituloGrid">
                        Sigla
                    </td>
					<td class="tdTituloGrid">
                        Ativo
                    </td>
                    <td class="tdTituloGrid">
                        Tipo
                    </td>
                </tr>
                <?php foreach($orgaos as $orgao) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('alterar/'.$orgao['Orgao']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/orgaos/delete/'.$orgao['Orgao']['id'],null,'Tem certeza?',false)?>
						</td>

                        <td class="tdConteudoGrid">
                            <?php echo $orgao['Orgao']['codigo'] ?>
                        </td>
						<td class="tdConteudoGrid">
                            <?php echo $html->link($orgao['Orgao']['descricao'],'exibir/'.$orgao['Orgao']['id'])?>
                        </td>
						<td class="tdConteudoGrid">
                            <?php echo $orgao['Orgao']['sigla'] ?>
                        </td>
						<td class="tdConteudoGrid">
                            <?php echo $protocolo->showBooleanField($orgao['Orgao']['ativo']); ?>
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $protocolo->showBooleanField($orgao['Orgao']['externo'], array('Externo', 'Interno')); ?>
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