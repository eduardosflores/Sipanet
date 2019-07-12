<script type="text/javascript" language="JavaScript">

function enviarInteressado(id, nome)
{
    opener.receberInteressado(id, nome);
    window.close();
}

</script>

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

        <table cellpadding="2" cellspacing="0" border="0" class="tbGrid">
        	<form action="<?php echo $html->url("busca_popup"); ?>" method="post">

        	<!-- Nome -->
			<tr>
                <td class="tbTituloFrm">
                    Nome:
                </td>
               	<td class="tbFieldFrm">
               		<input type="text" name="nome" class="textField textFieldWidth240" />
                </td>
            </tr>

            <!-- CPF/CNPJ -->
			<tr>
                <td class="tbTituloFrm">
                    CPF/CNPJ:
                </td>
               	<td class="tbFieldFrm">
               		<input type="text" name="cpf_cnpj" class="textField textFieldWidth120" />
                </td>
            </tr>

			<!-- Busca -->

			<tr>
                <td class="tbTituloFrm">
                    &nbsp;
                </td>
                <td class="tbFieldFrm">
                    <input type="submit" id="btnBuscar" name="btnBuscar" value="Buscar" />
                </td>
            </tr>

			</form>
      	</table>
        <?php
        if(isset($interessados))
        {
        ?>
          	<table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                <tr>
                    <td colspan="2">
                        Não encontrou o interessado? <?php echo $html->link("Clique aqui para cadastrá-lo.", "cadastrar_popup"); ?>
                    </td>
                </tr>
                <tr>
                    <td class="tdTituloGrid">
                        Nome
                    </td>
                    <td class="tdTituloGrid">
                        CPF/CNPJ
                    </td>
                </tr>
                <?php
                foreach($interessados as $interessado)
                {
                ?>
                    <tr class="trDisplay">
                        <td class="tdConteudoGrid">
                        	<a href="#" onclick="enviarInteressado('<?php echo $interessado['Interessado']['id']; ?>', '<?php echo $interessado['Interessado']['nome']; ?>')">
                        		<?php echo $interessado['Interessado']['nome']; ?>
                    		</a>
                        </td>
    
    					<td class="tdConteudoGrid">
    						<a href="#" onclick="enviarInteressado('<?php echo $interessado['Interessado']['id']; ?>', '<?php echo $interessado['Interessado']['nome']; ?>')">
    							<?php echo $interessado['Interessado']['cpf_cnpj']; ?>
    						</a>
    					</td>
                    </tr>
    			<?php
                }
    			?>
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