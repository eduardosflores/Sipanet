<div class="div_principal">
    <form action="<?php echo $html->url( $action_form )?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para pesquisar o Processo:</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>

				<!-- Órgão -->
				<tr>
                    <td class="tbTituloFrm">
                        Órgão:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Processo][numero_orgao]" id="ProcessoNumeroOrgao" class="comboBox textFieldWidth240">
							<?php
							/**
							 * TODO: Modificar para utilizar lista gerada automaticamente
							 * **/
							foreach($orgaos as $orgao) {
							?>
								<option value="<?php echo $orgao['Orgao']['codigo']; ?>" <?php if($orgao['Orgao']['id'] == $session->read('Orgao.id')) { echo "selected=\"selected\""; } ?> >
									<?php echo "{$orgao['Orgao']['codigo']} - {$orgao['Orgao']['sigla']}"; ?>
								</option>
							<?php
							}
							?>
						</select>
                   </td>
                </tr>
                
                <!-- Processo Nº -->
				<tr>
                    <td class="tbTituloFrm">
                        Processo Nº:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.numero_processo', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
                   </td>
                </tr>
                
                <script language="JavaScript" type="text/javascript">
                    $('ProcessoNumeroProcesso').focus();
                </script>

                <!-- Ano -->
				<tr>
                    <td class="tbTituloFrm">
                        Ano:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.numero_ano', array('label'=>false,'class'=>'textArea textFieldWidth40', 'maxlength' => '4', 'value' => date('Y')))?>
                   </td>
                </tr>


				<!-- Autor -->
				<tr>
                    <td class="tbTituloFrm">
                        Autor:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[busca][Interessado]" id="Interessado" class="comboBox textFieldWidth480">
                        "<option value="">SELECIONE...</option>"
							<?php
							/**
							 * TODO: Modificar para utilizar lista gerada automaticamente
							 * **/                     
                            
							for($m = 0; $m< count($interessados);$m++) {
							?>
								<option value="<?php echo $interessados[$m]['Interessado']['id']; ?>" >
									<?php echo $interessados[$m]['Interessado']['nome']; ?>
								</option>
							<?php
							}
							?>
						</select>
                   </td>
                </tr>                

                <!-- Título + Assunto -->
				<tr>
                    <td class="tbTituloFrm">
                    Título + Assunto:
                    </td>
                   <td class="tbFieldFrm">
                        <input type="text" name="data[busca][conteudo]" class="textArea textFieldWidth240"/>
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
                        <input type="submit" id="btnContinuar" name="btnContinuar" value="Continuar" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("{$action_form}") ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />


