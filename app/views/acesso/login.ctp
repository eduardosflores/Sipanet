<div class="div_principal">
    <form action="<?php echo $html->url('/acesso/login')?>" method="post" name="addform">
       <!-- <div class="aviso atencao">
            <p class="aviso"><span style="text-decoration:underline">Aviso aos Usuários</span>: Próxima Sexta-Feira, às 14:00, o SIPANET sairá do ar para ser integrado à base de dados do Estado, retornando na Segunda-Feira (20/07). <a href="#" class="supernote-hover-demo4">O que vai mudar?</a></p>
        </div>
        <div id="supernote-note-demo4" class="tooltip snp-triggeroffset notedefault">

            <h2>Mudanças devido a Integração</h2>
            <ul>
                <li>O endereço oficial do SIPANET será <b>http://sipanet.itec.al.gov.br.</b></li>
                <li>Processos de outros orgãos do Estado não serão mais "Processos Externos".</li>
                <li>Centralização de Suporte a Usuário com equipe especializada no ITEC.</li>
                
            </ul>
            <p>Duvidas? <br /> cetis.dev@uncisal.edu.br</p>
        </div>
        -->
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
                        <select name="data[Orgao][id]" id="OrgaoId" class="comboBox textFieldWidth240">
                            <option value="">Selecione</option>
                            <?php
                            foreach($orgaos as $orgao) {
                                ?>
                            <option value="<?php echo $orgao['Orgao']['id']; ?>" <?php if($orgao['Orgao']['id'] == $this->data['Orgao']['id']) { echo "selected=\"selected\""; } ?> >
                                <?php echo "{$orgao['Orgao']['sigla']}"; ?>
                            </option>
                            <?php
                        }
                        ?>
                        </select>
                    </td>
                </tr>

                <script language="JavaScript" type="text/javascript">
                    $('OrgaoId').focus();
                </script>


                <tr>
                    <td class="tbTituloFrm">
                        Login:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.login', array('label'=>false,'class'=>'textField textFieldWidth240'))?>
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        Senha:
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Servidor.senha', array('label'=>false,'class'=>'textField textFieldWidth240', 'type' => 'password'))?>
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <?php echo $form->input('Opcoes.lembrar', array('label'=>false, 'type' => 'checkbox', 'label' => 'Lembrar meu usuário'))?>
                        <?php
                        if(isset($lembrarServidor) && ($lembrarServidor['lembrar'] == '1'))
                        {
                            ?>
                        <script language="JavaScript" type="text/javascript">
                            $('OrgaoId').value = '<?php echo $lembrarServidor['orgao_id']; ?>';
                            $('ServidorLogin').value = '<?php echo $lembrarServidor['login']; ?>';
                            $('OpcoesLembrar').checked = true;
                        </script>
                        <?php
                    }
                    ?>
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
                        <input type="submit" id="btnAcesso" name="btnAcesso" value="Acessar" />
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <b><?php echo $html->link('Consultar Processo', '/consulta/'); ?></b> | <?php echo $html->link('Ajuda', '/ajuda/'); ?> | <?php echo $html->link('Suporte Técnico', '/ajuda/suporte'); ?>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />