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

				<!-- ?rg?o -->
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
                <tr>
                    <td class="tbTituloFrm">Processos</td>
                    <td>
                        
                        <!-- Processo N? -->
                        <div class="multiselect">
                            <div class="selectBox" onclick="showCheckboxes()">                            
                        </div>
                        <div id="checkboxes">
                            <?php
                                /**
                                * TODO: Modificar para utilizar lista gerada automaticamente
                                * 
                                **/
                                $i=0;
                                foreach($tramites_no_setor as $tramite) {
                            ?>
                                <label for="one<?php echo $i;?>">
                                    <input type="checkbox" name="data[Processo][processos]" id="one<?php echo $i;?>" value="<?php echo $tramite[0]['id_processo'];?>"/><?php echo $tramite[0]['processo'];?></label>                                    
                            <?php
                                $i=$i+1;
                                }
                            ?>
            
                        </div>
                    </td>
                </tr>
                <!-- Ano -->
				<tr>
                    <td class="tbTituloFrm">
                        Ano:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('Processo.numero_ano', array('label'=>false,'class'=>'textArea textFieldWidth40', 'maxlength' => '4', 'value' => date('Y')))?>
                   </td>
                </tr>
                
                <!-- Etiqueta -->
                <tr>
                    <td class="tbTituloFrm">
                        Etiqueta:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Etiqueta][id]" id="EtiquetaId" class="comboBox textFieldWidth240">
                            <option value="">
                                Selecione
                            </option>
                            <?php
                            foreach($etiquetas as $etiqueta) {
                            ?>
                                <option value="<?php echo $etiqueta['Etiqueta']['id']; ?>">
                                    <?php echo "{$etiqueta['Etiqueta']['descricao']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        
                        <?php echo $ajax->observeField('EtiquetaId', array('url' => '/relatorios/impressao_etiqueta_ajax_retornar_linhas', 'update' => 'EtiquetaLinha', 'conditions' => "$('EtiquetaId').value != ''")); ?>
                   </td>
                </tr>
                
                
                
                <!-- Linha -->
                <tr>
                    <td class="tbTituloFrm">
                        Linha da etiqueta a ser impressa:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[Etiqueta][linha]" id="EtiquetaLinha" class="comboBox textFieldWidth240">
                            <option value="">
                                Selecione o Modelo
                            </option>
                        </select>
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


<script type="text/javascript" language="javascript">


</script>

<style type="text/css">
    .multiselect {
        width: 200px;
    }

    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkboxes {
        display: block;
        border: 1px #dadada solid;
    }

    #checkboxes label {
        display: block;
    }

    #checkboxes label:hover {
        background-color: #1e90ff;
    }
</style>
