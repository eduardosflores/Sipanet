<script type="text/javascript" language="JavaScript">

function receberInteressado(id, nome)
{
    $('ProcessoInteressadoId').value = id;
    $('ProcessoInteressadoNome').value = nome;
}

</script>

<div class="div_principal">
    <form action="<?php echo $html->url('/processos/cadastrar')?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formul�rio para cadastrar um novo Processo:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                
                <!-- Processo Externo -->
                <tr>
                    <td class="tbTituloFrm">
                        Processo:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Processo][processo_externo]" id="ProcessoProcessoExterno" class="comboBox textFieldWidth120">
                            <option value="0">Interno</option>
                            <option value="1">Externo</option>
                        </select>
                   </td>
                </tr>
               
                <!-- Tipo de Processo -->
	        <tr id="tipo_de_processo">
                    <td class="tbTituloFrm">
                        Tipo de processo:
                    </td>
                    <td class="tbFieldFrm">
                   	<select name="data[Processo][tipo_processo_id]" id="ProcessoProcessoId" class="comboBox textFieldWidth240">
                           <?php echo $protocolo->optionsTag($tipos_processo, true, $this->data['Processo']['tipo_processo_id']); ?>
                        </select>
                    </td>
                </tr>

                <!-- Data de cadastro -->
                <tr id="data_cadastro" style="display: none">
                    <td class="tbTituloFrm">
                        Data de cadastro:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Processo.data_cadastro') ?>
                    </td>
                </tr>
                
                <script type="text/javascript" language="JavaScript">
                    Event.observe('ProcessoProcessoExterno', 'change', function() {
                        if($('ProcessoProcessoExterno').value == '1')
                        {
                        	$('data_cadastro').show();
                            $('numero_orgao_manual').show();
                            $('numero_orgao_automatico').hide();
                            $('numero_processo_manual').show();
                            $('numero_processo_automatico').hide();
                            $('numero_ano_manual').show();
                            $('numero_ano_automatico').hide();
                        }
                        else
                        {
                        	$('data_cadastro').hide();
                            $('ProcessoDataCadastro').value = '';
                            $('ProcessoNumeroOrgao').value = '';
                            $('ProcessoNumeroProcesso').value = '';
                            $('ProcessoNumeroAno').value = '';
                            $('numero_orgao_manual').hide();
                            $('numero_orgao_automatico').show();
                            $('numero_processo_manual').hide();
                            $('numero_processo_automatico').show();
                            $('numero_ano_manual').hide();
                            $('numero_ano_automatico').show();
                        }
                    });
                    
                    $('ProcessoProcessoExterno').value = '<?php echo $this->data['Processo']['processo_externo']; ?>';
                </script>
                
				<!-- �rg�o -->
				<tr id="numero_orgao_manual"  style="display: none">
                    <td class="tbTituloFrm">
                        �rg�o:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Processo][numero_orgao]" id="ProcessoNumeroOrgao" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
							<?php
							foreach($orgaos as $orgao) {
                                if($orgao['Orgao']['id'] != $session->read('Orgao.id'))
                                {
							?>
    								<option value="<?php echo $orgao['Orgao']['codigo']; ?>">
    									<?php echo "{$orgao['Orgao']['codigo']} - {$orgao['Orgao']['sigla']}"; ?>
    								</option>
							<?php
                                }
							}
							?>
						</select>
                    </td>
                </tr>
                <tr id="numero_orgao_automatico">
                    <td class="tbTituloFrm">
                        �rg�o:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo "{$session->read('Orgao.codigo')} - {$session->read('Orgao.sigla')}"; ?>
                    </td>
                </tr>

				<!-- Processo N� -->
				<tr id="numero_processo_manual" style="display: none">
                    <td class="tbTituloFrm">
                        Processo N�:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.numero_processo', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
                    </td>
                </tr>
                
                <!-- Processo N� -->
                <tr id="numero_processo_automatico">
                    <td class="tbTituloFrm">
                        Processo N�:
                    </td>
                    <td class="tbFieldFrm">
                        Numera��o Autom�tica
                    </td>
                </tr>

                <!-- Ano -->
				<tr id="numero_ano_manual" style="display: none">
                    <td class="tbTituloFrm">
                        Ano:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.numero_ano', array('label'=>false,'class'=>'textArea textFieldWidth40', 'maxlength' => '4', 'value' => date('Y')))?>
                    </td>
                </tr>
                
                <!-- Ano -->
                <tr id="numero_ano_automatico">
                    <td class="tbTituloFrm">
                        Ano:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo date('Y') ?>
                    </td>
                </tr>

				<!-- Interessado -->
				<tr>
                    <td class="tbTituloFrm">
                        Interessado:
                    </td>
                    <td class="tbFieldFrm">
                   		<input type="text" name="data[Processo][interessado_nome]" id="ProcessoInteressadoNome" class="textField textFieldWidth240 textFieldDisabled" readonly="true" value="<?php if($this->data['Processo']['interessado_nome'] != "") echo $this->data['Processo']['interessado_nome']; ?>" />
                   		<input type="hidden" name="data[Processo][interessado_id]" id="ProcessoInteressadoId" value="<?php if($this->data['Processo']['interessado_id'] != "") echo $this->data['Processo']['interessado_id']; ?>" />
                   		<a href="#" onclick="window.open('<?php echo $html->url('/interessados/busca_popup') ?>', 'buscarInteressados', 'location=0,status=0,scrollbars=1,width=650, height=400')">Buscar</a>
                    </td>
                </tr>

                <!-- Natureza -->
				<tr>
                    <td class="tbTituloFrm">
                        Natureza:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Processo][natureza_id]" id="ProcessoNaturezaId" class="comboBox textFieldWidth240">
							<?php echo $protocolo->optionsTag($naturezas, true, $this->data['Processo']['natureza_id']); ?>
						</select>
                    </td>
                </tr>

				<!-- T�tulo -->
				<tr>
                    <td class="tbTituloFrm">
                        T�tulo:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.titulo_assunto', array('label'=>false,'class'=>'textArea textFieldWidth240'))?>
                    </td>
                </tr>

				<!-- Assunto -->
				<tr>
                    <td class="tbTituloFrm">
                        Assunto:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->textarea('Processo.assunto', array('label'=>false,'class'=>'textArea textFieldWidth240', 'rows' => '5'))?>
                   </td>
                </tr>

                <!-- Situa��o -->
				<tr>
                    <td class="tbTituloFrm">
                        Situa��o:
                    </td>
                    <td class="tbFieldFrm">
                   		<select name="data[Processo][situacao_id]" id="ProcessoSituacaoId" class="comboBox textFieldWidth240">
                            <?php
                            foreach($situacoes as $situacao) {
                                /**
                                 * Verifica se o campo deve estar selecionado.
                                 * Ele estar� selecionado se:
                                 * 1 - j� tiver sido efetuado um post e ocorreu erro;
                                 * 2 - primeira vez na tela, seleciona a situa��o NORMAL;
                                 * **/
                                if(($this->data['Processo']['situacao_id'] == $situacao['Situacao']['id']) || (($this->data['Processo']['situacao_id'] === null) && (strtoupper($situacao['Situacao']['sigla']) == 'N')))
                                {
                                    $selecionar = true; 
                                } 
                                else 
                                { 
                                    $selecionar = false; 
                                }
                            ?>
                                <option value="<?php echo $situacao['Situacao']['id']; ?>" <?php if($selecionar) echo 'selected="selected"'; ?> >
                                    <?php echo "{$situacao['Situacao']['descricao']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <!-- Documento -->
                <tr>
                    <td class="tbTituloFrm">
                        Tipo do documento:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[Processo][documento_numero_tipo]" id="ProcessoDocumentoNumeroTipo" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <option value="of">Of�cio</option>
                            <option value="mem">Memorando</option>
                            <option value="ci">Comunica��o Interna</option>
                            <option value="juridico">Processo Jur�dico</option>
                            <option value="of. circ.">Of�cio Circular</option>
                            <option value="mem. circ">Memorando Circular</option>
                            <option value="requerimento">Requerimento</option>
                            <option value="solicitacao">Solicita��o</option>
                            <option value="mandado">Mandado</option>
                            <option value="outros">Outros</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        N�mero do documento:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.documento_numero', array('label'=>false,'class'=>'textArea textFieldWidth80', 'maxlength' => '40'))?>
                    </td>
                </tr>
                
                <!-- Volumes -->
                <tr>
                    <td class="tbTituloFrm">
                        Volumes:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.volumes', array('label'=>false,'class'=>'textArea textFieldWidth40', 'value' => '1'))?>
                   </td>
                </tr>
                
                <!-- P�ginas -->
                <tr>
                    <td class="tbTituloFrm">
                        P�ginas:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.paginas', array('label'=>false,'class'=>'textArea textFieldWidth40', 'value' => '2'))?>
                   </td>
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
                        <input type="submit" id="btnSalvar" name="btnSalvar" value="Salvar informa��es" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'processos/cadastrar' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />