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
            <div>
      
                <pre>
                    <?php echo $tramite['Tramite']['observacoes']; ?>
                </pre>
      s
            </div>
    </fieldset>
    <br />
</div>