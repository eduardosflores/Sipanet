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
                    <!-- Setor -->
					<td class="tdTituloExibirDetalhes">
                        <b>Setor:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $servidor['Setor']['sigla'] .' - '. $servidor['Setor']['descricao'] ?>
                    </td>
				</tr>
                <tr>
                    <!-- Grupo de Usuario -->
					<td class="tdTituloExibirDetalhes">
                        <b>Grupo de Usuário:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $servidor['GrupoUsuario']['descricao'] ?>
                    </td>
				</tr>
				<tr>
                    <!-- Cargo -->
					<td class="tdTituloExibirDetalhes">
                        <b>Cargo:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $servidor['Cargo']['descricao'] ?>
                    </td>
				</tr>
                <tr>
                    <!-- CPF -->
					<td class="tdTituloExibirDetalhes">
                        <b>CPF:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $servidor['Servidor']['cpf'] ?>
                    </td>
				</tr>
                <tr>
                    <!-- Matricula -->
					<td class="tdTituloExibirDetalhes">
                        <b>Matrícula:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $servidor['Servidor']['matricula'] ?>
                    </td>
				</tr>
				                <tr>
                    <!-- Login -->
					<td class="tdTituloExibirDetalhes">
                        <b>Login:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $servidor['Servidor']['login'] ?>
                    </td>
				</tr>
				<tr>
                    <!-- Ativo -->
					<td class="tdTituloExibirDetalhes">
                        <b>Ativo:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $protocolo->showBooleanField($servidor['Servidor']['ativo']) ?>
                    </td>
				</tr>
                <tr>
                    <!-- Data cadastro -->
					<td class="tdTituloExibirDetalhes">
                        <b>Data Cadastro:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $protocolo->showDateBr($servidor['Servidor']['data_cadastro']) ?>
                    </td>
				</tr>
				<tr>
					<!-- Data Permissao Inicio -->
					<td class="tdTituloExibirDetalhes">
                        <b>Data início permissão:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $protocolo->showDateBr($servidor['Servidor']['data_permissao_inicio']) ?>
                    </td>
				</tr>
				<tr>
					<!-- Data Permissao Fim -->
					<td class="tdTituloExibirDetalhes">
                        <b>Data fim permissão:</b>
                    </td>
                    <td class="tdConteudoExibirDetalhes">
                        <?php echo $protocolo->showDateBr($servidor['Servidor']['data_permissao_fim']) ?>
                    </td>
				</tr>
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
            <br />
        </fieldset>
        <br />
    </div>