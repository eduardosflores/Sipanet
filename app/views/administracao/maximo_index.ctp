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
                        Setor
                    </td>
                    <td class="tdTituloGrid">
                        Tipo de Processo
                    </td>
                    <td class="tdTituloGrid">
                        Máximo de dias úteis permitidos
                    </td>
                </tr>
                <?php foreach($dias_na_mesa as $dia_na_mesa) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('maximo_alterar/'.$dia_na_mesa['DiaNaMesa']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/administracao/maximo_delete/'.$dia_na_mesa['DiaNaMesa']['id'],null,'Tem certeza?',false)?>
						</td>

                        <td class="tdConteudoGrid">
                            <?php echo $dia_na_mesa['Setor']['sigla']?>
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $dia_na_mesa['TipoProcesso']['descricao']?>
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $dia_na_mesa['DiaNaMesa']['max_dias_na_mesa']?>
                        </td>
                        

                    </tr>
				<?php } ?>
            </table>
         
        </fieldset>
        <br />
    </div>