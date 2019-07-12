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
            <h3>Servidor: <?php echo $servidor['Servidor']['nome'] ?></h3>
            <h4>Setor principal: <?php echo $servidor['Setor']['descricao'] ?></h4>
			<input type="button" onclick="javascript:window.location='<?php echo $this->webroot . 'servidores/cadastrar_setor/'.$servidor['Servidor']['id'] ?>'" value="Associar outro Setor" />
			<table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                <tr>
                    <td class="tdTituloAcoesGrid nosort">
                        Ações
                    </td>
                    <td class="tdTituloGrid">
                        Setor
                    </td>
                    <td class="tdTituloGrid">
                        Órgão
                    </td>
                </tr>
                <?php foreach($setores_servidor as $setor) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/servidores/deletar_setor/'.$servidor['Servidor']['id']. '/' . $setor['SetorServidor']['id'],null,'Tem certeza?',false)?>
						</td>

						<td class="tdConteudoGrid">
                            <?php echo $setor['Setor']['descricao'] ?>
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $setor['Setor']['Orgao']['sigla'] ?>
                        </td>
                    </tr>
				<?php } ?>
				<tr>
                    <td colspan="3" class="tdBtnVoltar">
                        <br /><br />
                        <table>
                            <tr>
                                <td><a href="<?php echo $html->url('/servidores'); ?>"><img border="0" src="<?php echo $this->webroot; ?>img/back.png" /></a></td>
                                <td><a href="<?php echo $html->url('/servidores'); ?>">Voltar para listagem de Servidores</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br />
    </div>