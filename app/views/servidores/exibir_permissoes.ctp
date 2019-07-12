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
			<input type="button" onclick="javascript:window.location='<?php echo $this->webroot . 'servidores/cadastrar_permissoes/'.$servidor['Servidor']['id'] ?>'" value="Permissões" />
			<table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                <tr>
                    <td class="tdTituloAcoesGrid nosort">
                        Ações
                    </td>
                    <td class="tdTituloGrid">
                        Modulo
                    </td>
                </tr>
                <?php foreach($permissoes_servidor as $permissao) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('/alterar_permissoes/'.$permissao['Servidor']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/servidores/deletar_permissoes/'.$servidor['Servidor']['id']. '/' . $permissao['PermissaoServidor']['id'],null,'Tem certeza?',false)?>
						</td>

						<td class="tdConteudoGrid">
                            <?php echo $permissao['Modulo']['descricao'] ?>
                        </td>
                    </tr>
				<?php } ?>
				<tr>
                    <td colspan="2" class="tdBtnVoltar">
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