<div class="div_principal">
    <form action="<?php echo $form->url("/graficos/processos_por_situacao"); ?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Preencha os dados do formulário para gerar o gráfico de processos por situação:</label>
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
                        <select name="data[Busca][orgao_id]" id="BuscaOrgaoId" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php
                            foreach($orgaos as $orgao) {
                            ?>
                                <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if($orgao['Orgao']['id'] == $this->data['Busca']['orgao_id']) echo 'selected="selected"'; ?>>
                                    <?php echo "{$orgao['Orgao']['sigla']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                   </td>
                </tr>
                
                <!-- Data de cadastro inicial -->
                <tr>
                    <td class="tbTituloFrm">
                        Data inicial:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Busca.data_cadastro_inicial'); ?>
                   </td>
                </tr>
                
                <!-- Data de cadastro final -->
                <tr>
                    <td class="tbTituloFrm">
                        Data final:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $protocolo->dateInput('Busca.data_cadastro_final'); ?>
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
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/graficos/processos_por_situacao") ?>'" value="Cancelar" />
                    </td>
                </tr>
                
                <?php
                /**
                 * Verifica se a busca já foi efetuada
                 * **/
                if(isset($query_string))
                {
                ?>
                    <tr>
                        <td class="tbFieldFrm" colspan="2">
                            <img src="<?php echo $form->url("/graficos/gerar_processos_por_situacao/?{$query_string}") ?>" alt="Gráfico de Processos por Situação" />
                        </td>
                    </tr>
                <?php
                }
                ?>
                
                
            </table>
        </fieldset>
    </form>
</div>
<br />


