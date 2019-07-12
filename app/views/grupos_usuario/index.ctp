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
                        Descrição
                    </td>
                </tr>
                <?php foreach($grupos_usuario as $grupo_usuario) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('alterar/'.$grupo_usuario['GrupoUsuario']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/grupos_usuario/delete/'.$grupo_usuario['GrupoUsuario']['id'],null,'Tem certeza?',false)?>&nbsp;
                            <?php echo $html->link($html->image('permissao.jpeg', array('alt'=>'Permissoes', 'border' => 'none')),'/grupos_usuario/exibir_permissoes/'.$grupo_usuario['GrupoUsuario']['id'],null,null,false)?>
						</td>

                        <td class="tdConteudoGrid">
                            <?php echo $html->link($grupo_usuario['GrupoUsuario']['descricao'],'exibir/'.$grupo_usuario['GrupoUsuario']['id'])?>
                        </td>

                    </tr>
				<?php } ?>
            </table>
        </fieldset>
        <br />
    </div>