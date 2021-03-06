<div class="div_principal">
    <fieldset class="fieldset">
        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        <form action="<?php echo $html->url("/interessados/consultar")?>" method="post" name="addform">
        <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
            <tr>
                <td colspan="2" align="left">
                    &nbsp;
                </td>
            </tr>

            
            <!-- Processo N� -->
            <tr>
                <td class="tbTituloFrm">
                    Nome:
                </td>
               <td class="tbFieldFrm">
                    <?php echo $form->input('Interessado.nome', array('label'=>false,'class'=>'textArea textFieldWidth240'))?>
               </td>
            </tr>

            <!-- Ano -->
            <tr>
                <td class="tbTituloFrm">
                    CPF/CNPJ:
                </td>
               <td class="tbFieldFrm">
                    <?php echo $form->input('Interessado.cpf_cnpj', array('label'=>false,'class'=>'textArea textFieldWidth120'))?>
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
                    <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $form->url("/interessados/consultar") ?>'" value="Cancelar" />
                </td>
            </tr>
        </table>
        </form>
        
        <?php
        if(isset($interessados))
        {
        ?>
            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                <tr>
                    <td class="tdTituloAcoesGrid nosort">
                        A��es
                    </td>
                    <td class="tdTituloGrid">
                        Nome
                    </td>
                    <td class="tdTituloGrid">
                        CPF/CNPJ
                    </td>
                    <td class="tdTituloGrid">
                        Tipo
                    </td>
                </tr>
                <?php foreach($interessados as $interessado) { ?>
                    <tr class="trDisplay">
                        <td class="tdAcoesGrid">
                            <a href="<?php echo $html->url('alterar/'.$interessado['Interessado']['id'])?>"><img border="0"  alt="Alterar registro" title="Alterar registro" src="<?php echo $this->webroot; ?>img/edit.png" /></a>&nbsp;
                            <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'border' => 'none')),'/interessados/delete/'.$interessado['Interessado']['id'],null,'Tem certeza?',false)?>
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $html->link($interessado['Interessado']['nome'],'exibir/'.$interessado['Interessado']['id'])?>
                        </td>
    					
    					<td class="tdConteudoGrid">
    						<?php echo $interessado['Interessado']['cpf_cnpj']; ?>
    					</td>
    					
    					<td class="tdConteudoGrid">
    						<?php echo $interessado['TipoInteressado']['descricao']; ?>
    					</td>
                    </tr>
    			<?php } ?>
            </table>
            
            <?php echo $paginator->options(array('url' => $url)); ?>
            <?php echo $paginator->first('<< Primeiro'); ?>
            <?php echo $paginator->prev('< Anterior'); ?>
            <?php echo $paginator->numbers(); ?>
            <?php echo $paginator->next('Pr�ximo >'); ?>
            <?php echo $paginator->last('�ltimo >>'); ?>
        <?php
        }
        ?>
    </fieldset>
    <br />
</div>