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
            <h3>Grupo de Usuário: <?php echo $grupo['GrupoUsuario']['descricao'] ?></h3>
			<input type="button" onclick="javascript:window.location='<?php echo $this->webroot . 'grupos_usuario/cadastrar_permissoes/'.$grupo['GrupoUsuario']['id'] ?>'" value="Permissões" />
			<table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                <tr>
                    <td class="tdTituloAcoesGrid nosort">
                        Ações
                    </td>
                    <td class="tdTituloGrid">
                        Modulo
                    </td>
                </tr>
                <?php foreach($permissoes_grupo as $permissao) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('/alterar_permissoes/'.$permissao['GrupoUsuario']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/grupos_usuario/deletar_permissoes/'.$grupo['GrupoUsuario']['id']. '/' . $permissao['PermissaoGrupo']['id'],null,'Tem certeza?',false)?>
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
                                <td><a href="<?php echo $html->url('/grupos_usuario'); ?>"><img border="0" src="<?php echo $this->webroot; ?>img/back.png" /></a></td>
                                <td><a href="<?php echo $html->url('/grupos_usuario'); ?>">Voltar para listagem de Grupos de Usuário</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br />
    </div>