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
            <br />
            <table cellpadding="2" cellspacing="2" border="0" class="tbConteudoExibirDetalhes">
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Número:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['numero_orgao'] ?>-<?php echo $processo['Processo']['numero_processo'] ?>/<?php echo $processo['Processo']['numero_ano'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Interessado:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Interessado']['nome'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Natureza:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Natureza']['descricao'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Título do Assunto:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['titulo_assunto'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Assunto:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['assunto'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Situação:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Situacao']['descricao'] ?>
                    </td>
                </tr>

                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Cadastrado por:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Servidor']['nome'] ?>
                    </td>
                </tr>
                
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Volumes:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['volumes'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloExibirDetalhes">
                        <b>Páginas:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $processo['Processo']['paginas'] ?>
                    </td>
                </tr>
                
				<?php
				/**
				 * Verifica se o processo está anexado a outro.
				 * Se estiver, mostra o processo. Se não estiver, exibe link para anexar.
				 * **/
				if($processoComoAnexo)
				{
				?>
					<tr>
	                    <td class="tdTituloExibirDetalhes">
	                        <b>Processo anexado a:</b>
	                    </td>
	                    <td class="tdConteudoExibirDetalhes">
	                    	<a href="<?php echo $html->url('exibir/' . $processoComoAnexo['ProcessoPrincipal']['id']); ?>">
	                        	<?php echo $processoComoAnexo['ProcessoPrincipal']['numero_orgao'] ?>-<?php echo $processoComoAnexo['ProcessoPrincipal']['numero_processo'] ?>/<?php echo $processoComoAnexo['ProcessoPrincipal']['numero_ano'] ?>
                        	</a>
                        	/ <a href="<?php echo $html->url('desanexar/' . $processo['Processo']['id']); ?>">Desanexar</a>
	                    </td>
	                </tr>
				<?php
				}
				else
				{
				?>
					<!-- Anexar a outro processo -->
	                <tr>
	                    <td colspan="2" class="tdBtnVoltar">
	                        <br /><br />
	                        <table>
	                            <tr>
	                                <td>&nbsp;</td>
	                                <td><a href="<?php echo $html->url('/processos/anexar/' . $processo['Processo']['id']); ?>">Anexar a outro processo</a></td>
	                            </tr>
	                        </table>
	                    </td>
	                </tr>
				<?php
				}
				?>

				<?php
				/**
				 * Lista os processos que estão anexados a este processo
				* **/
				if($processosAnexados)
				{
				?>
				 	<tr>
	                    <td colspan="2">
	                        <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
	                        	<tr>
				                    <td class="tdTituloGrid nosort">
				                        Processos Anexados
				                    </td>
				                    <td class="tdTituloGrid nosort">
				                        Interessado
				                    </td>
				                    <?php
				                    foreach($processosAnexados as $processoAnexado)
				                    {
				                    ?>
				                    	<tr class="trDisplay">
					                        <td class="tdConteudoGrid">
					                            <?php echo $html->link($processoAnexado['ProcessoAnexado']['numero_orgao'].'-'.$processoAnexado['ProcessoAnexado']['numero_processo'].'/'.$processoAnexado['ProcessoAnexado']['numero_ano'],'exibir/'.$processoAnexado['ProcessoAnexado']['id'])?>
					                        </td>
					                        <td class="tdConteudoGrid">
					                            <?php echo $html->link($processoAnexado['ProcessoAnexado']['Interessado']['nome'],'exibir/'.$processoAnexado['ProcessoAnexado']['id'])?>
					                        </td>
				                        </tr>
				                    <?php
				                    }
				                    ?>
				                </tr>
			                </table>
	                    </td>
	                </tr>
				<?php
				}
				?>
                 
                <?php
                /**
                 * Lista as divisões do processo
                * **/
                if($divisoes)
                {
                ?>
                    <tr>
                        <td colspan="2">
                            Processo distribuido entre os seguintes servidores:
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <ul>
                                <?php
                                foreach($divisoes as $divisao)
                                {
                                ?>
                                    <li><?php echo $divisao['Servidor']['nome']; ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>
                <?php
                }
                ?>
                
				<!-- Voltar -->
                <tr>
                    <td colspan="2" class="tdBtnVoltar">
                        <br /><br />
                        <table>
                            <tr>
                                <td><a href="<?php echo $html->url('/processos'); ?>"><img border="0" src="<?php echo $this->webroot; ?>img/back.png" /></a></td>
                                <td><a href="<?php echo $html->url('/processos'); ?>">Voltar para listagem de Processos</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <br />
        </fieldset>
        <br />
    </div>