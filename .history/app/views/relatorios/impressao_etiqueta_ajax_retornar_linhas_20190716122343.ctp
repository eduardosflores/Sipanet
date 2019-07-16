<?php
if($etiqueta['Etiqueta']['id'] != "")
{
    ?>
    <option value="">Selecione</option>
    <?php
    
    for($i = 1; $i <= $etiqueta['Etiqueta']['linhas']; $i++)
    {
    	?>
        <option value="<?php echo $i; ?>">Etiqueta <?php echo $i; ?></option>
        <?php
    }
}
else
{
	?>
    <option value="">Selecione o Modelo</option>
    <?php
}
?>
