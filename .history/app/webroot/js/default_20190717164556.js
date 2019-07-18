/**
 * funcao para formatar campos
 * Utilizada da seguinte maneira no campo: 
 * <input type="text" name="cpf" onkeypress="formatField(this,'###.###.###-##');" />
 */
function formatField(src, mask)
{
    var i = src.value.length;
    var saida = mask.substring(0,1);
    var texto = mask.substring(i)
    if (texto.substring(0,1) != saida)
    {
        src.value += texto.substring(0,1);
    }
}