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
      
              
                <?php 
                    
                    $a = document.createElement('div');
                    $a.innerHTML = str;

                    $ishtml = false;

                    for ($c = $a.childNodes, i = $c.length; i--; ) {
                        if (c[i].nodeType == 1) $ishtml = true;
                    }
                      
                        
                      
                    if ($ishtml) echo $tramite['Tramite']['observacoes']; else "<pre>".echo $tramite['Tramite']['observacoes']."</pre>";
                ?> 
              
      
            </div>
    </fieldset>
    <br />
</div>