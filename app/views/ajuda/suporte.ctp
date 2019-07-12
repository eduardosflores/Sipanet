<div class="div_principal">
    <form action="<?php echo $html->url('/ajuda/suporte')?>" method="post" name="addform">
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
                
                <!-- Órgão -->
                <tr>
                    <td class="tbTituloFrm">
                        Órgão:
                    </td>
                   <td class="tbFieldFrm">
                        <select name="data[MensagemSuporte][orgao_id]" id="MensagemSuporteOrgaoId" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php
                            foreach($orgaos as $orgao) {
                            ?>
                                <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if($orgao['Orgao']['id'] == $this->data['MensagemSuporte']['orgao_id']) { echo "selected=\"selected\""; } ?> >
                                    <?php echo "{$orgao['Orgao']['sigla']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                   </td>
                </tr>
                
                <tr>
                    <td class="tbTituloFrm">
                        Nome:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->input('MensagemSuporte.nome', array('label'=>false,'class'=>'textField textFieldWidth240'))?>
                   </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        Telefone:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('MensagemSuporte.telefone', array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        E-mail:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('MensagemSuporte.email', array('label'=>false,'class'=>'textField textFieldWidth120'))?>
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        Tipo da Mensagem:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[MensagemSuporte][tipo_mensagem_id]" id="MensagemSuporteTipoMensagemId" class="comboBox textFieldWidth120">
                            <option value="">Selecione</option>
                            <?php
                            foreach($tipos as $tipo) {
                            ?>
                                <option value="<?php echo $tipo['TipoMensagem']['id']; ?>" <?php if($tipo['TipoMensagem']['id'] == $this->data['MensagemSuporte']['tipo_mensagem_id']) { echo "selected=\"selected\""; } ?> >
                                    <?php echo "{$tipo['TipoMensagem']['descricao']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        Assunto:
                    </td>
                    <td class="tbFieldFrm">
                        <select name="data[MensagemSuporte][assunto_mensagem_id]" id="MensagemSuporteAssuntoMensagemId" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php
                            foreach($assuntos as $assunto) {
                            ?>
                                <option value="<?php echo $assunto['AssuntoMensagem']['id']; ?>" <?php if($assunto['AssuntoMensagem']['id'] == $this->data['MensagemSuporte']['assunto_mensagem_id']) { echo "selected=\"selected\""; } ?> >
                                    <?php echo "{$assunto['AssuntoMensagem']['descricao']}"; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                
                <!-- Mensagem -->
                <tr>
                    <td class="tbTituloFrm">
                        Mensagem:
                    </td>
                   <td class="tbFieldFrm">
                        <?php echo $form->textarea('MensagemSuporte.mensagem', array('label'=>false,'class'=>'textArea textFieldWidth240', 'rows' => '5'))?>
                   </td>
                </tr>
                
                <tr>
                    <td  colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <input type="submit" id="btnEnviar" name="btnEnviar" value="Enviar Mensagem" />
                        <input type="button" id="btnVoltar" name="btnVoltar" value="Voltar" onclick="history.back(-1)" />
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
                    <td class="tbTituloFrm">
                        Carlos Francisco ou Genílson:
                    </td>
                   <td class="tbFieldFrm">
                        3315-5739 / 8867-6506
                   </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />