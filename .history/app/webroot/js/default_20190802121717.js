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

function abrirTela() {
    alert('Hello World');
  };

function upload(){
    var client = new XMLHttpRequest();
    client.open("post", "add_paginas_processo", true);
    client.onreadystatechange = function(){
       if (client.readyState == 4 && client.status == 200){
            var tableRef = document.getElementById('tblUpload').getElementsByTagName('tbody')[0];
            var newRow   = tableRef.insertRow(tableRef.rows.length);

            newRow.innerHTML = client.responseText;
       }
    };
  
    var file = document.getElementById("paginas");
    var nomeArquivo = file.files[0].name;
    var ext = nomeArquivo.split('.').reverse()[0];
    if((ext=="pdf")||(ext=="pdf")){
      var ProcessoId = document.getElementById("ProcessoId");
      var chaveArquivo = document.getElementById("chaveArquivo");
      var formData = new FormData();
      formData.append("upload", file.files[0]);
      formData.append("MAX_FILE_SIZE", '30000');
      formData.append("userfile", 'pdf');
      formData.append("data[Processo][id]", ProcessoId.value);
      formData.append("data[chaveArquivo][valor]", chaveArquivo.value);
      client.send(formData);
    } else {
      alert("Arquivo deve ser apenas do tipo PDF.");
    }

  
    
  }


function abrirCapaProcesso(id) {
    var redirectWindow = window.open('/sipanet/relatorios/impressao_capa_pdf/'+id, '_blank');
    redirectWindow.location;
};