<div class="div_principal">
    <form action="<?php echo $this->webroot; ?>ajuda/suporte" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
                
                <!-- �rg�o -->
                <tr>
                    <td style="width: 250px;">
                        Manual de Modifica��es:
                    </td>
                   <td class="tbFieldFrm">
                        <a href="<?php echo $this->webroot; ?>docs/documentos/SIPANet_manual_modificacoes.pdf" target="_blank">Download</a>
                   </td>
                </tr>
                
                <tr>
                    <td>
                        Suporte T�cnico:
                    </td>
                    <td class="tbFieldFrm">
                        <a href="<?php echo $this->webroot; ?>ajuda/suporte">Contato</a>
                    </td>
                </tr>
                
                <tr>
                    <td  colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                
                <!-- V�deos -->
                <tr>
                    <td>
                        <b>V�deos Explicativos:</b>
                    </td>
                    <td class="tbFieldFrm">
                        <a href="<?php echo $this->webroot; ?>videos/001/" target="_blank">Login e Vis�o Geral do Sistema</a>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td class="tbFieldFrm">
                        <a href="<?php echo $this->webroot; ?>videos/002/" target="_blank">Cadastro de Processos</a>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td class="tbFieldFrm">
                        <a href="<?php echo $this->webroot; ?>videos/003/" target="_blank">Tr�mite e Consulta de Processos</a>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td class="tbFieldFrm">
                        <a href="<?php echo $this->webroot; ?>videos/004/" target="_blank">Recebimento de Processos</a>
                    </td>
                </tr>
                
                <tr>
                    <td  colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                
                <!-- Telefones -->
                <tr>
                    <td>
                        <b>Telefones de contato:</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Carlos Francisco ou Gen�lson:
                    </td>
                   <td class="tbFieldFrm">
                        3315-5739 / 8867-6506
                   </td>
                </tr>
                
                <tr>
                    <td>
                        
                    </td>
                   <td class="tbFieldFrm">
                        <input type="button" id="btnVoltar" name="btnVoltar" value="Voltar" onclick="history.back(-1)" />
                   </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />