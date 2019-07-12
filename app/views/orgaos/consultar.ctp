<div class="div_principal">
    
    <fieldset class="fieldset">
        
        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        <form action="<?php echo $html->url("/orgaos/consultar")?>" method="post" name="addform">
        <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            <tr>
                <td colspan="2" align="left">
                    &nbsp;
                </td>
            </tr>

            
            <!-- Nome -->
            <tr>
                <td class="tbTituloFrm">
                    Nome:
                </td>
               <td class="tbFieldFrm">
                    <?php echo $form->input('Orgao.descricao', array('label'=>false,'class'=>'textArea textFieldWidth240'))?>
               </td>
            </tr>

            <!-- Sigla -->
            <tr>
                <td class="tbTituloFrm">
                    Sigla:
                </td>
               <td class="tbFieldFrm">
                    <?php echo $form->input('Orgao.sigla', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
               </td>
            </tr>

            <!-- Código -->
            <tr>
                <td class="tbTituloFrm">
                    Código:
                </td>
               <td class="tbFieldFrm">
                    <?php echo $form->input('Orgao.codigo', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
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
                    <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/orgaos/consultar") ?>'" value="Cancelar" />
                </td>
            </tr>
        </table>
    </form>
    
    <?php
    if(isset($orgaos))
    {
    ?>
        <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
            <tr>
                <td class="tdTituloGrid">
                    Órgão
                </td>
                <td class="tdTituloGrid">
                    Sigla
                </td>
                <td class="tdTituloGrid">
                    Código
                </td>
            </tr>
            <?php foreach($orgaos as $orgao) { ?>
                <tr class="trDisplay">
                    <td class="tdConteudoGrid">
                        <?php echo $orgao['Orgao']['descricao'] ?>
                    </td>
					
					<td class="tdConteudoGrid">
						<?php echo $orgao['Orgao']['sigla'] ?>
					</td>
					
					<td class="tdConteudoGrid">
						<?php echo $orgao['Orgao']['codigo'] ?>
					</td>
                </tr>
			<?php } ?>
        </table>
        
        <?php echo $paginator->options(array('url' => $url)); ?>
        <?php echo $paginator->first('<< Primeiro'); ?>
        <?php echo $paginator->prev('< Anterior'); ?>
        <?php echo $paginator->numbers(); ?>
        <?php echo $paginator->next('Próximo >'); ?>
        <?php echo $paginator->last('Último >>'); ?>
    <?php
    }
    ?>
    </fieldset>
    <br />
</div>