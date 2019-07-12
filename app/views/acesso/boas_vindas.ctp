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
        <br />
        <table cellpadding="2" cellspacing="2" border="0" class="tbConteudoExibirDetalhes">
            <tr>
                <td class="tdTituloExibirDetalhes">
                    <b>Servidor:</b>
                </td>
                <td class="tdConteudoExibirDetalhes">
                    <?php echo $session->read('Servidor.nome'); ?>
                </td>
            </tr>
            <tr>
                <td class="tdTituloExibirDetalhes">
                    <b>Órgão:</b>
                </td>
                <td class="tdConteudoExibirDetalhes">
                    <?php echo $session->read('Orgao.sigla'); ?>
                </td>
            </tr>
            <tr>
                <td class="tdTituloExibirDetalhes">
                    <b>Setor:</b>
                </td>
                <td class="tdConteudoExibirDetalhes">
                    <?php echo $session->read('Setor.sigla'); ?>
                </td>
            </tr>
        </table>
        <?php
        if(count($tramites) == 0)
        {
        ?>
            <table cellpadding="2" cellspacing="2" border="0" class="tbConteudoExibirDetalhes">
                <tr>
                    <td class="lbInfoPagFrm" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="lbInfoPagFrm" align="left">
                        <b>Nenhum processo encaminhado ao seu setor.</b>
                    </td>
                </tr>
            </table>
        <?php
        }
        else
        {
        ?>
            <table cellpadding="2" cellspacing="2" border="0" class="tbConteudoExibirDetalhes">
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="lbInfoPagFrm" colspan="2" align="left">
                        <b>Processos não recebidos</b> 
                       <!--<b><?php echo $totalDeTramites; ?> processos foram encaminhados ao seu setor e ainda não foram recebidos:</b>-->
                    </td>
                </tr>
            </table>
        <form action="<?php echo $html->url('/processos/recebimento_lote')?>" method="post" name="recebimento_lote_form">
            <table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
                <tr>
                    <td class="tdTituloGrid">
                    
                    </td>
                 <td class="tdTituloGrid">
                        Número
                    </td>
                    <td class="tdTituloGrid">
                        Interessado
                    </td>
                    <td class="tdTituloGrid">
                        Vindo do órgão/setor
                    </td>
                    <td class="tdTituloGrid">
                        Encaminhado por
                    </td>
                    <td class="tdTituloGrid">
                        Na data
                    </td>
                </tr>
                <tr>
                        <td class="tdConteudoGrid" colspan="6">
                            <input type="submit" value="Receber Selecionados" />
                        </td>
                </tr>
                
                <?php
                foreach($tramites as $tramite)
                {
                ?>
                <script language="javascript">
                     function manageDiv<?php echo $tramite['Processo']['id'] ?>() {
                         $('cofirmacao-recebimento-<?php echo $tramite['Processo']['id'] ?>').toggle();
                     }
                </script>
                    <tr class="trDisplay" id="<?php echo $tramite['Processo']['numero_processo']?>">
                  <td>


                    <?php
            $remoteFunction = $ajax->remoteFunction(
            array(
            'url' => array( 'controller' => 'processos', 'action' => 'receber_lote_ajax', $tramite['Processo']['id'] ),
            'update' => 'cofirmacao-recebimento-'.$tramite['Processo']['id'],
            'loading' => 'manngeSpinner()',
            'complete' => 'manngeSpinner()'
                ));
            
            ?>
   
                        <input type="checkbox" name="data[Processo][ids][]" id="<?php echo $tramite['Processo']['id']?>" value="<?php echo $tramite['Processo']['id']?>" onclick="<?php echo $remoteFunction; ?>" onchange="<?php echo 'manageDiv'.$tramite['Processo']['id'].'()' ?>" />
                            
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $tramite['Processo']['numero_orgao'] . '-' . $tramite['Processo']['numero_processo'] . '/' . $tramite['Processo']['numero_ano'] ?>
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $tramite['Processo']['Interessado']['nome'] ?>
                        </td>
                        
                        <td class="tdConteudoGrid">
                            <?php echo $tramite['SetorOrigem']['Orgao']['sigla'] . '/' . $tramite['SetorOrigem']['sigla'] ?>
                        </td>
                        
                        <td class="tdConteudoGrid">
                            <?php echo $tramite['ServidorOrigem']['nome'] ?>
                        </td>
                        <td class="tdConteudoGrid">
                            <?php echo $protocolo->showDateBr($tramite['Tramite']['data_tramite'], true) ?>
                        </td>
                    </tr>
                    <tr id="cofirmacao-recebimento-<?php echo $tramite['Processo']['id'] ?>" style="display:none">
                        
                    </tr>
                <?php
                }
                ?>
    
             <tr>
                        <td class="tdConteudoGrid" colspan="6">
                            <input type="submit" value="Receber Selecionados" />
                        </td>
                    </tr>
    
            </table>
        </form>
        <?php
        }
        ?>
        
        <?php
            $remoteFunction = $ajax->remoteFunction(
            array(
            'url' => array( 'controller' => 'acesso', 'action' => 'ajax_nao_encaminhados', 1 ),
            'update' => 'ListagemNaoEncaminhados',
            'loading' => 'manageSpinner()',
            'complete' => 'manageSpinner()'
                ));
            
 ?>
        <script language="javascript">
             function manageSpinner() {
                 $('spinner').toggle();
             }


        </script>
        <br />
        <br />
        <input type="button" id="nao_encaminhados" onclick="<?php echo $remoteFunction; ?>" value="Clique para visualizar processos parados no seu setor" />
         <?php //echo $ajax->observeField('nao_encaminhados', array('url' => '/acesso/ajax_nao_encaminhados', 'update' => 'ListagemNaoEncaminhados', 'loading' => 'javascript:manageLoading()')); ?>
        <span id="spinner" style="display:none">Aguarde...</span>
        <div id="ListagemNaoEncaminhados">
            
        </div>
    </fieldset>
    <br />
</div>