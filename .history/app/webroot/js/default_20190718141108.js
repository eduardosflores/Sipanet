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


function upload(){
    var client = new XMLHttpRequest();
    client.open("post", "add_paginas_processo", true);
    client.onreadystatechange = function(){
       if (client.readyState == 4 && client.status == 200){
          $("#resposta").html(client.responseText);
       }
    };
  
    var file = document.getElementById("paginas");
    var ProcessoId = document.getElementById("ProcessoId");
    var chaveArquivo = document.getElementById("chaveArquivo");
    var formData = new FormData();
    formData.append("upload", file.files[0]);
    formData.append("MAX_FILE_SIZE", '30000');
    formData.append("userfile", 'pdf');
    formData.append("data[Processo][id]", ProcessoId.value);
    formData.append("data[chaveArquivo][valor]", chaveArquivo.value);
  
    client.send(formData);
  }