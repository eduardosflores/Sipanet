<script type="text/javascript" language="JavaScript">

function enviarInteressado(id, nome)
{
    opener.receberInteressado(id, nome);
    window.close();
}

</script>

<div class="div_principal" style="text-align:left;">
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
      
              
                <?php
                    if ($tramite['Tramite']['observacoes'] != strip_tags($tramite['Tramite']['observacoes'])) echo $tramite['Tramite']['observacoes']; else echo "<xmp>".$tramite['Tramite']['observacoes']."</xmp>";
                ?> 
              
      
            </div>
    </fieldset>
    <br />
</div>