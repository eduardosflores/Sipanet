<?php
/**
 *  SipaNet 2.0 - Sistema de Informação Processual e Arquivo
 Copyright (C) 2008 Universidade Estadual de Ciências da Saúde de Alagoas - UNCISAL <http://www.uncisal.edu.br>

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.

 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/layout.css" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/ajuda.css" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/tablesort.css" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/forms.css" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/datepicker.css" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>js/jscookmenu/ThemePanel/theme.css" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/supernote.css" />

        <script language="JavaScript" type="text/javascript">
            var myThemePanelBase = "<?php echo $this->webroot; ?>js/jscookmenu/ThemePanel/";
        </script>
        <script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/prototype.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/fastinit.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/tablesort.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/datepicker.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/default.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/jscookmenu/JSCookMenu.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/jscookmenu/ThemePanel/theme.js"></script>
        <script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/tinymce/tinymce.min.js"></script>
        <script>tinymce.init({
            selector:'textarea#TramiteObservacoes',
            height: 500,
            width:300,
            menubar: false,
            plugins: ['advlist autolink lists link image charmap print preview anchor','searchreplace visualblocks code fullscreen','insertdatetime media table paste code help wordcount'],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: ['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i','//www.tiny.cloud/css/codepen.min.css']
        });
        </script>


        <style type="text/css">
            a.date-picker-control:link,
            a.date-picker-control:visited,
            a.date-picker-control:hover,
            a.date-picker-control:active,
            a.date-picker-control:focus
            {
                background:transparent url(<?php echo $this->webroot; ?>img/datepicker/cal.gif) no-repeat 50% 50%;
            }

            div.datePicker table
            {
                background:#fff url(<?php echo $this->webroot; ?>img/datepicker/gradient-e5e5e5-ffffff.gif) repeat-x 0 -20px;
            }

            div.datePicker table td
            {
                background:#fff url(<?php echo $this->webroot; ?>img/datepicker/gradient-e5e5e5-ffffff.gif) repeat-x 0 -40px;
            }

            div.datePicker table td.date-picker-unused
            {
                background:#fff url(<?php echo $this->webroot; ?>img/datepicker/backstripes.gif);
            }

            div.datePicker table td.date-picker-today
            {
                background:#fff url(<?php echo $this->webroot; ?>img/datepicker/bullet2.gif) no-repeat 0 0;
            }

            div.datePicker table tbody td.date-picker-hover
            {
                background:#fff url(<?php echo $this->webroot; ?>img/datepicker/bg_header.jpg) no-repeat 0 0;
            }
        </style>


        <title>Sipa Net</title>
    </head>
    <body>

        <!--top-->
        <div id="topo">
            <table class="tb_topo" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="brasao"><img src="<?php echo $this->webroot; ?>img/brasao_topo.jpg" /></td>

                    <td class="titulo_sistema"><img src="<?php echo $this->webroot; ?>img/logo_sistema.jpg" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="row_yellow"><img src="<?php echo $this->webroot; ?>img/img_row_yellow_topo.jpg" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="td_menu">
                        <?php
                        // Exibe o cabeçalho apenas se estiver logado
                        if($session->check('Servidor.id') && !$session->check('EsconderMenu')) {
                            ?>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="td_table_menu">

                                    <div id="menu">
                                        <script language="JavaScript" type="text/javascript">
                                            var myMenu =
                                                [
                                                ['', 'Início', '<?php echo $this->webroot; ?>acesso/boas_vindas', '_self', ''],  // a menu item
                                                _cmSplit,
                                                ['', 'Processos', '#', '', null,
                                                    ['', 'Cadastrar', '<?php echo $this->webroot; ?>processos/cadastrar', '_self', ''],
                                                    ['', 'Alterar', '<?php echo $this->webroot; ?>processos/alteracao', '_self', ''],
                                                    ['', 'Tramitar processo', '<?php echo $this->webroot; ?>processos/tramite', '_self', ''],
                                                    ['', 'Receber processo', '<?php echo $this->webroot; ?>processos/recebimento', '_self', ''],
                                                    ['', 'Receber processo externo', '<?php echo $this->webroot; ?>processos/recebimento_externo', '_self', ''],
                                                    ['', 'Cancelar Tramitação', '<?php echo $this->webroot; ?>processos/cancelamento_tramite', '_self', ''],
                                                    _cmSplit,
                                                    ['', 'Arquivar', '<?php echo $this->webroot; ?>processos/arquivamento', '_self', ''],
                                                    ['', 'Desarquivar', '<?php echo $this->webroot; ?>processos/desarquivamento', '_self', ''],
                                                    ['', 'Paralisar', '<?php echo $this->webroot; ?>processos/paralisacao', '_self', ''],
                                                    ['', 'Liberar processo paralisado', '<?php echo $this->webroot; ?>processos/liberacao', '_self', ''],
                                                    ['', 'Anexação/Desanexação de processos', '<?php echo $this->webroot; ?>processos/anexacao', '_self', ''],
                                                    _cmSplit,
                                                    ['', 'Distribuir processo', '<?php echo $this->webroot; ?>processos/divisao', '_self', ''],
                                                    ['', 'Devolver processo distribuído', '<?php echo $this->webroot; ?>processos/devolucao', '_self', ''],
                                                    _cmSplit,
                                                    ['', 'Cadastrar processo antigo', '<?php echo $this->webroot; ?>processos/cadastrar_antigos', '_self', ''],
                                                ],  // a menu item
                                                _cmSplit,
                                                ['', 'Consultar', '', '', '',
                                                    ['', 'Processos', '<?php echo $this->webroot; ?>processos/consultar_completo', '_self', null],
                                                    ['', 'Todos os Processos', '<?php echo $this->webroot; ?>processos/index', '_self', null],
                                                    ['', 'Tramitação', '<?php echo $this->webroot; ?>processos/tramitacao', '_self', null],
                                                    _cmSplit,
                                                    ['', 'Interessados', '<?php echo $this->webroot; ?>interessados/consultar', '_self', null],
                                                    ['', 'Órgãos', '<?php echo $this->webroot; ?>orgaos/consultar', '_self', null],
                                                    ['', 'Setores', '<?php echo $this->webroot; ?>setores/consultar', '_self', null],
                                                    ['', 'Servidores', '<?php echo $this->webroot; ?>servidores/consultar', '_self', null],
                                                ],
                                                _cmSplit,
                                                ['', 'Cadastros', '', '', '',

                                                    ['', 'Cargos', '<?php echo $this->webroot; ?>cargos/', '_self', null,
                                                        ['', 'Cadastrar', '<?php echo $this->webroot; ?>cargos/cadastrar/', '_self', ''],
                                                    ],

                                                    ['', 'Interessados', '<?php echo $this->webroot; ?>interessados/', '_self', null,
                                                        ['', 'Cadastrar', '<?php echo $this->webroot; ?>interessados/cadastrar/', '_self', ''],
                                                        ['', 'Tipos de Interessado', '<?php echo $this->webroot; ?>tipos_interessado/', '_self', '',
                                                            ['', 'Cadastrar', '<?php echo $this->webroot; ?>tipos_interessado/cadastrar', '_self', ''],
                                                        ]
                                                    ],

                                                    ['', 'Módulos', '<?php echo $this->webroot; ?>modulos/', '_self', null],

                                                    ['', 'Naturezas', '<?php echo $this->webroot; ?>naturezas/', '_self', null,
                                                        ['', 'Cadastrar', '<?php echo $this->webroot; ?>naturezas/cadastrar/', '_self', ''],
                                                    ],

                                                    ['', 'Órgãos', '<?php echo $this->webroot; ?>orgaos/', '_self', null,
                                                        ['', 'Cadastrar', '<?php echo $this->webroot; ?>orgaos/cadastrar/', '_self', ''],
                                                    ],

                                                    ['', 'Setores', '<?php echo $this->webroot; ?>setores/', '_self', null,
                                                        ['', 'Cadastrar', '<?php echo $this->webroot; ?>setores/cadastrar/', '_self', ''],
                                                    ],

                                                    ['', 'Servidores', '<?php echo $this->webroot; ?>servidores/', '_self', null,
                                                        ['', 'Cadastrar', '<?php echo $this->webroot; ?>servidores/cadastrar/', '_self', ''],
                                                    ],

                                                    ['', 'Situações', '<?php echo $this->webroot; ?>situacoes/', '_self', null],
                                                    _cmSplit,
                                                    ['', 'Trocar Senha', '<?php echo $this->webroot; ?>servidores/alterar_senha', '_self', null],
    <?php
    /**
     ['', 'Tipos de Tramite', '<?php echo $this->webroot; ?>tipos_tramite/', '_self', null,
     ['', 'Cadastrar', '<?php echo $this->webroot; ?>tipos_tramite/cadastrar/', '_self', ''],
     ],
     **/
    ?>
            ],
            _cmSplit,
            ['', 'Relatórios', '', '', '',
                ['', 'Processos', '<?php echo $this->webroot; ?>relatorios/processos', '_self', null],
                ['', 'Processos Lentos', '<?php echo $this->webroot; ?>relatorios/processos_lentos', '_self', null],
                <?php if ($session->check('Servidor.isAdmin')) { ?>
                ['', 'Processos Atrasados', '<?php echo $this->webroot; ?>relatorios/processos_atrasados', '_self', null],
                <?php } ?>
                ['', 'Trâmites', '<?php echo $this->webroot; ?>relatorios/tramites', '_self', null],
                ['', 'Trâmites não recebidos', '<?php echo $this->webroot; ?>relatorios/tramites_nao_recebidos', '_self', null],
                ['', 'Tramitação entre Setores', '<?php echo $this->webroot; ?>relatorios/tramitacao_entre_setores', '_self', null],
                ['', 'Etiquetas de Capa (PDF)', '<?php echo $this->webroot; ?>relatorios/impressao_etiqueta', '_self', null],
                ['', 'Distribuição de Processos (PDF)', '<?php echo $this->webroot; ?>relatorios/distribuicao', '_self', null],
                ['', 'Boletim de Informação (PDF)', '<?php echo $this->webroot; ?>relatorios/boletim_de_informacao', '_self', null],
                ['', 'Boletim de Informação de Distribuição (PDF)', '<?php echo $this->webroot; ?>relatorios/boletim_de_informacao_de_distribuicao', '_self', null],
            ],
            _cmSplit,
            ['', 'Gráficos', '', '', '',
                ['', 'Processos por Confirmação', '<?php echo $this->webroot; ?>graficos/processos_por_confirmacao', '_self', null],
                ['', 'Processos por Situação', '<?php echo $this->webroot; ?>graficos/processos_por_situacao', '_self', null],
            ],
    <?php if ($session->check('Servidor.isAdmin')) { ?>
            _cmSplit,
            ['', 'Administração', '<?php echo $this->webroot; ?>administracao/', '_self', 'null',
                ['', 'Cancelamento de Trâmite', '<?php echo $this->webroot; ?>administracao/cancelamento_tramite', '_self', null],
                ['', 'Alterar dados do Processo', '<?php echo $this->webroot; ?>administracao/alteracao_processo', '_self', null],
                ['', 'Max dias processo na mesa', '<?php echo $this->webroot; ?>administracao/maximo_index', '_self', null,
                    ['', 'Cadastrar', '<?php echo $this->webroot; ?>administracao/maximo_cadastrar', '_self', null],
                    //['', 'Editar', '<?php echo $this->webroot; ?>administracao/maximo_editar', '_self', null],
                    ['', 'Listar', '<?php echo $this->webroot; ?>administracao/maximo_index', '_self', null]],
            ],
    <? } ?>
            _cmSplit,
            ['', 'Ajuda', '', '', '',
                ['', 'Principal', '<?php echo $this->webroot; ?>ajuda', '_self', null],
                ['', 'Manual de Alterações', '<?php echo $this->webroot; ?>docs/SIPANet_manual_modificacoes.pdf', '_self', null],
                ['', 'Suporte Técnico', '<?php echo $this->webroot; ?>ajuda/suporte', '_self', null],
            ],
            _cmSplit,
        ];
        cmDraw ('menu', myMenu, 'hbr', cmThemePanel, 'ThemePanel');
                                        </script>
                                    </div>

                                </td>
                                <td class="td_btn_logoff">
                                    <a href="<?php echo $this->webroot; ?>acesso/logout"><img border="0" src="<?php echo $this->webroot; ?>img/btn_logout.jpg" /></a>
                                </td>
                            </tr>
                        </table>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="td_row_gray_topo"><img src="<?php echo $this->webroot; ?>img/row_gray_topo.jpg"/></td>
                </tr>
            </table>
        </div>
        <!--END top-->

        <!--content principal-->
        <div id="div_conteudo">
            <?php
            if($session->check('Servidor.id') && !$session->check('EsconderMenu')) {
                ?>
            <div class="div_ola_usuario">
                Olá, <?php echo ucw($session->read('Servidor.nome')); ?>&nbsp;|&nbsp;Setor: <?php echo $session->read('Setor.sigla'); ?>&nbsp;|&nbsp;Órgão: <?php echo $session->read('Orgao.sigla'); ?>
            </div>
            <?php
            }
            ?>
           <!-- <div id="desativacao" style="margin:5px auto;width:70%;text-align:center;background-color:#FFE951;border:1px solid #666;">
                <p><strong>Aviso Importante:</strong> O SipaNET será desativado na próxima Quarta-Feira dia 02/06/2010 a partir das 15:00, <br />e retornará no dia 07/06/2010 (Segunda-Feira) com o novo sistema de gestão pública, o INTEGRA com o módulo de protocolo CPAV<br />
                </p>
            </div>-->
            <?php 
           //Espaço para avisos
            if(isset($message_status)) {
           ?>
           
           <div id="mensagem_conteudo">
            <div class="funcionalidade">
                  <p><?php echo $message_status?></p>
            </div>
           </div>
           <?php
            }
           ?>
           

            <?php
            // Espaço para mensagens
            if($session->check('Message.flash')) {
                echo "<div id='mensagem_conteudo'>";
                $session->flash();
                echo "</div>";
            }
            ?>
           
           
            <?php
            //Escreve $pageTitle caso esteja setada no controller
            if (isset($pageTitle)) {
                echo "<h1>".$pageTitle."</h1>";
            }

            // Renderiza conteudo dos controllers
            echo $content_for_layout;
            ?>
        </div>
        <!--END content principal-->

        <!--content principal-->
        <div id="div_rodape">
            <strong>Sistema de Informação Processual e Arquivo - SipaNet 2.4.1&nbsp;</strong><br />
            Acordo de Cooperação Técnica ITEC/UNCISAL - 2008&nbsp;<br />
            Desenvolvido por: <?php echo $html->link('Gerência de Tecnologia da Informação (GTIN) - UNCISAL', 'http://gtin.uncisal.edu.br', array('target' => 'blank')); ?>&nbsp;
        </div>
        <!--END content principal-->

    </body>
</html>
