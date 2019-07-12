<tr>
    <td class="lbInfoPagFrm" colspan="2" align="left">
        <div id="container-fluxo">
            <h2 class="titulo-fluxo">Fluxo do Processo</h2>
            <div class="caixa-fluxo">
                <p><?php echo $setor['Setor']['descricao'] ?><br/><?php echo $setor['Orgao']['descricao'] ?></p>
            </div>
            <?php
            $i = 1;
            foreach($tramites as $tramite)
            {
                if($i == 3)
                {
                    $i = 1;
                    ?>
                    <div class="seta-retorno">
                        <p style="text-align: center; width: 100%; margin: 0px;">
                            <?php echo $protocolo->showDateBr($tramite['Tramite']['data_tramite'],true) ?>
                        </p>
                        <img border="0" style="position:relative; top:-10px" src="<?php echo $this->webroot; ?>img/seta-retorno.png" />
                    </div>
                    <?php
                }
                else
                {
                    $i++;
                    ?>
                    <div class="seta-fluxo">
                        <p style="text-align: center; width: 100%; margin: 0px;">
                            <?php echo $protocolo->showDateBr($tramite['Tramite']['data_tramite'],true) ?>
                        </p>
                        <img border="0"  src="<?php echo $this->webroot; ?>img/seta-fluxo.png" />
                    </div>
                    <?php
                }
            ?>
                <div class="caixa-fluxo<?php if(!$tramite['Tramite']['flag_recebimento']) echo ' aguardando'; ?>" <?php if($i == 1) { ?> style="clear: left;" <?php } ?>>
                    <p><?php echo $tramite['SetorRecebimento']['descricao'] ?><br/><?php echo $tramite['SetorRecebimento']['Orgao']['descricao'] ?></p>
                </div>
            <?php
            }
            ?>
        </div>
    </td>
    <style>
        #container-fluxo {
            width: 820px;
            margin: auto;
        }
        #container-fluxo .caixa-fluxo {
            width: 200px;
            padding: 5px 10px;
            text-align: center;
            clear: none;
            float: left;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        #container-fluxo .caixa-fluxo p {
            font-size:10px;
        }
        #container-fluxo .caixa-fluxo .sb-inner {
            background-color:#ddd;
        }
        #container-fluxo .aguardando .sb-inner {

        }
        #container-fluxo .seta-fluxo {
            margin-top:15px;
            width: 80px;
            clear: none;
            float: left;
        }
        #container-fluxo .seta-retorno {
            margin-left:100px;
            height: 35px;
            clear: both;
            float: left;
        }
        #container-fluxo .seta-retorno p, #container-fluxo .seta-fluxo p {
            font-size:8px;
        }
        #container-fluxo .titulo-fluxo {
            width: 100%;
            text-align: center;
        }
    </style>
    

    <script type="text/javascript">
        //lib de bordas arredondadas. Não funciona corretamente no IE6
        var border = RUZEE.ShadedBorder.create({ corner:8, shadow:16,  border:1 });
        border.render($$('#container-fluxo .caixa-fluxo'));
    </script>
</tr>
