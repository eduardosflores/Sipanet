<div class="div_principal">
    <form action="<?php echo $html->url('/servidores/alterar/'.$this->data['Servidor']['id'])?>" method="post" name="editform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para alterar um Servidor:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
				<!-- Setor -->
				<tr>
                    <td class="tbTituloFrm">
                        Setor:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Servidor][setor_id]" id="ServidorSetorId" class="comboBox textFieldWidth240">
							<?php echo $protocolo->optionsTag($setores, true, $this->data['Servidor']['setor_id']);?>
						</select>
                   </td>
                </tr>
				<!-- Grupo de Usuario -->
				<tr>
                    <td class="tbTituloFrm">
                        Grupo de Usuário:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Servidor][grupo_usuario_id]" id="ServidorGrupoUsuarioId" class="comboBox textFieldWidth120">
							<?php echo $protocolo->optionsTag($grupos_usuario, true, $this->data['Servidor']['grupo_usuario_id']);?>
						</select>
                   </td>
                </tr>
				<!-- Cargo -->
				<tr>
                    <td class="tbTituloFrm">
                        Cargo:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Servidor][cargo_id]" id="ServidorCargoId" class="comboBox textFieldWidth120">
							<?php echo $protocolo->optionsTag($cargos, true, $this->data['Servidor']['cargo_id']);?>
						</select>
                   </td>
                </tr>
				<!-- Nome -->				
				<tr>
                    <td class="tbTituloFrm">
                        Nome:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.nome', array('label'=>false,'class'=>'textField textFieldWidth240'))?>
                   </td>
                </tr>
				<!-- CPF -->
				<tr>
                    <td class="tbTituloFrm">
                        CPF:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.cpf', array('label'=>false,'class'=>'textField textFieldWidth120', 'onkeypress'=>"formatField(this,'###.###.###-##');"))?>
                   </td>
                </tr>
				<!-- Matricula -->
				<tr>
                    <td class="tbTituloFrm">
                        Matrícula:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.matricula',array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                   </td>
                </tr>
				
				<!-- Ativo -->
				<tr>
                    <td class="tbTituloFrm">
                        Ativo:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.ativo',array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                    </td>
                </tr>
				<!-- Data Inicio Permisao-->
				<tr>
                    <td class="tbTituloFrm">
                        Data início Permissão:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Servidor.data_permissao_inicio', array('value'=> $protocolo->showDateBr(isset($this->data['Servidor']['data_permissao_inicio']) ? $this->data['Servidor']['data_permissao_inicio'] : '') )); ?>
                   </td>
                </tr>
				<!-- Data Inicio Permisao-->
				<tr>
                    <td class="tbTituloFrm">
                        Data fim Permissão:
                    </td>
                    
                    <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Servidor.data_permissao_fim', array('value'=> $protocolo->showDateBr(isset($this->data['Servidor']['data_permissao_fim']) ? $this->data['Servidor']['data_permissao_fim'] : '') )) ?>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td  colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <input type="submit" id="btnSalvar" name="btnSalvar" value="Salvar informações" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'servidores' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
		<?php echo $form->hidden('Servidor.id'); ?>
    </form>
</div>
<br />