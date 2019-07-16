<div class="div_principal">
    <fieldset class="fieldset">
        <legend>
            <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
        </legend>
        
        <script type="text/javascript">
        function imprimir() {
        	var janela = window.open("", "Impressao");
            janela.document.open();
            janela.document.write($('folha-etiqueta').innerHTML);
            janela.print();
            janela.close();
        }
        </script>
        
        <style type="text/css">
            .etiqueta {
            	width: 298px;
                height: 100px;
                border: 1px solid #000;
                clear: none;
                float: left;
                text-align: left;
            }
            .etiqueta-esquerda {
                
            }
        </style>
        
        <input type="button" onclick="window.open('<?php echo $html->url("/relatorios/impressao_etiqueta_pdf/" . $processo['Processo']['id'] . "?linha=" . $linha_impressa . "&etiqueta_id=" . $etiqueta['Etiqueta']['id']); ?>', 'janelaImpressao')" value="Imprimir" />
        
        <div id="folha-etiqueta" style="width: 600px; height: <?php echo $etiqueta['Etiqueta']['linhas'] * 102 ?>px; background-color: #fff; border: 1px solid #000; left:0px; top: 0px;">
            <?php
            for($i = 1; $i <= $etiqueta['Etiqueta']['linhas']; $i++)
            {
            	?>
                
                <div class="etiqueta">
                    <?php
                    if($linha_impressa == $i)
                    {
                    ?>
                       Número: <?php echo $processo['Processo']['numero_orgao'] . '-' . $processo['Processo']['numero_processo'] . '/' . $processo['Processo']['numero_ano'].' '.$protocolo->showDateBr($processo['Processo']['data_cadastro']) ?>
                        <br />
                        <?php echo substr("Interessados: ". $processo['Interessado']['nome'], 0, 70) ?>
                        <!--<br />
                        Data de cadastro: <?php echo $protocolo->showDateBr($processo['Processo']['data_cadastro']) ?>-->
                        <br />
                        <?php echo substr("Natureza: ". $processo['Natureza']['descricao'], 0, 37) ?>
                        <br />
                        <?php echo substr("Assunto: ". $processo['Processo']['titulo_assunto'], 0, 37) ?>
                    <?php
                    }
                    ?>
                </div>
                <div class="etiqueta">
                    <?php
                    if($linha_impressa == $i)
                    {
                    ?>
                        Número: <?php $processo['Processo']['numero_processo'] . '/' . $processo['Processo']['numero_ano'].' '.$protocolo->showDateBr($processo['Processo']['data_cadastro']) ?>
                        <br />
                        <?php echo substr("Interessados: ". $processo['Interessado']['nome'], 0, 70) ?>
                        <!--<br />
                        Data de cadastro: <?php echo $protocolo->showDateBr($processo['Processo']['data_cadastro']) ?>-->
                        <br />
                        <?php echo substr("Natureza: ". $processo['Natureza']['descricao'], 0, 37) ?>
                        <br />
                        <?php echo substr("Assunto: ". $processo['Processo']['titulo_assunto'], 0, 37) ?>
                    <?php
                    }
                    ?>
                </div>
                
                <?php
            }
            ?>
        </div>
        
        <input type="button" onclick="window.open('<?php echo $html->url("/relatorios/impressao_etiqueta_pdf/" . $processo['Processo']['id'] . "?linha=" . $linha_impressa . "&etiqueta_id=" . $etiqueta['Etiqueta']['id']); ?>', 'janelaImpressao')" value="Imprimir" />
    </fieldset>
</div>
<br />


