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
<!--                     <td class="tdTituloGrid">
                        �rg�o
                    </td>
 -->                    <td class="tdTituloGrid">
                        N� Processo
                    </td>
                    <td class="tdTituloGrid">
                        Ano
                    </td>
                    <td class="tdTituloGrid">
                        Interessado
                    </td>
                    <td class="tdTituloGrid">
                        Natureza
                    </td>
                    <td class="tdTituloGrid">
                        Data de In�cio
                    </td>
                </tr>
                <?php foreach($processos as $processo) { ?>
                    <tr class="trDisplay">
                       <!--  <td class="tdConteudoGrid">
                            <?php echo $html->link($processo['Processo']['numero_orgao'],'consultar/'.$processo['Processo']['id'])?>
                        </td> -->

						<td class="tdConteudoGrid">
							<?php echo $html->link($processo['Processo']['numero_processo'], 'consultar/'.$processo['Processo']['id'])?>
						</td>

						<td class="tdConteudoGrid">
							<?php echo $html->link($processo['Processo']['numero_ano'], 'consultar/'.$processo['Processo']['id'])?>
						</td>
						<td class="tdConteudoGrid">
							<?php echo $html->link($processo['Interessado']['nome'], 'consultar/'.$processo['Processo']['id'])?>
						</td>
						<td class="tdConteudoGrid">
							<?php echo $html->link($processo['Natureza']['descricao'], 'consultar/'.$processo['Processo']['id'])?>
						</td>
						<td class="tdConteudoGrid">
							<?php echo $html->link($protocolo->showDateBr($processo['Processo']['data_cadastro']), 'consultar/'.$processo['Processo']['id'])?>
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