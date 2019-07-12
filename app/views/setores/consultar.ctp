<div class="div_principal">
    
    <fieldset class="fieldset">
        
        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        <form action="<?php echo $html->url("/setores/consultar")?>" method="post" name="addform">
        <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            <tr>
                <td colspan="2" align="left">
                    &nbsp;
                </td>
            </tr>
            
            <!-- Orgao -->
            <tr>
                <td class="tbTituloFrm">
                    Órgão:
                </td>
               <td class="tbFieldFrm">
                    <select name="data[Setor][orgao_id]" id="SetorOrgaoId" class="comboBox textFieldWidth240">
                        <option value="">Selecione</option>
                        <?php
                        foreach($orgaos as $orgao) {
                        ?>
                            <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if($orgao['Orgao']['id'] == $session->read('Orgao.id')) { echo "selected=\"selected\""; } ?> >
                                <?php echo "{$orgao['Orgao']['sigla']}"; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
               </td>
            </tr>
            
            <!-- Nome -->
            <tr>
                <td class="tbTituloFrm">
                    Nome:
                </td>
               <td class="tbFieldFrm">
                    <?php echo $form->input('Setor.descricao', array('label'=>false,'class'=>'textArea textFieldWidth240'))?>
               </td>
            </tr>

            <!-- Sigla -->
            <tr>
                <td class="tbTituloFrm">
                    Sigla:
                </td>
               <td class="tbFieldFrm">
                    <?php echo $form->input('Setor.sigla', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
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
                    <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/setores/consultar") ?>'" value="Cancelar" />
                </td>
            </tr>
        </table>
    </form>
    
    <?php
    if(isset($setores))
    {
    ?>
        <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
            <tr>
                <?php
                if($cadastra_orgao)
                {
                ?>
                    <td class="tdTituloAcoesGrid nosort">
                        Ações
                    </td>
                <?php
                }
                ?>
                <td class="tdTituloGrid">
                    Setor
                </td>
                <td class="tdTituloGrid">
                    Órgão
                </td>
                <td class="tdTituloGrid">
                    Sigla
                </td>
            </tr>
            <?php foreach($setores as $setor) { ?>
                <tr class="trDisplay">
                    <?php
                    if($cadastra_orgao)
                    {
                    ?>
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('alterar/'.$setor['Setor']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/setores/delete/'.$setor['Setor']['id'],null,'Tem certeza?',false)?>
                        </td>
                    <?php
                    }
                    ?>
                    <td class="tdConteudoGrid">
                        <?php echo $setor['Setor']['descricao'] ?>
                    </td>
					
                    <td class="tdConteudoGrid">
                        <?php echo $setor['Orgao']['descricao'] ?>
                    </td>
                    
					<td class="tdConteudoGrid">
						<?php echo $setor['Setor']['sigla'] ?>
					</td>
                </tr>
			<?php } ?>
        </table>
    <?php
    }
    ?>
    </fieldset>
    <br />
</div>