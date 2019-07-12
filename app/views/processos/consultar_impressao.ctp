<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" media="print" href="<?php echo $this->webroot; ?>css/impressao_tramites.css" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/impressao_tramites.css" />

        <title>Sipa Net</title>
    </head>
    <body>
        <div id="head">
            <img src="<?php echo $this->webroot; ?>img/brasao_topo.jpg" />
            <img src="<?php echo $this->webroot; ?>img/logo_sistema.jpg" />
        </div>


        <div id="content">
            <div class="tramites">
                <div class="dados_processos">

                    <span><strong>Número:</strong> <?php echo $processo['Processo']['numero_orgao'] ?>-<?php echo $processo['Processo']['numero_processo'] ?>/<?php echo $processo['Processo']['numero_ano'] ?></span><br />
                    <span><strong>Interessado:</strong> <?php echo $processo['Interessado']['nome'] ?></span><br />
                    <span><strong>Natureza:</strong> <?php echo $processo['Natureza']['descricao'] ?></span><br />
                    <span><strong>Título do Assunto:</strong> <?php echo $processo['Processo']['titulo_assunto'] ?></span><br />
                    <span><strong>Assunto:</strong> <?php echo $processo['Processo']['assunto'] ?></span><br />
                    <span><strong>Descrição:</strong> <?php echo $processo['Situacao']['descricao'] ?></span><br />
                    <span><strong>Servidor:</strong> <?php echo $processo['Servidor']['nome'] ?></span><br />
                    <span><strong>Setor/Órgão:</strong> <?php echo $setor['Setor']['sigla'] . '/' . $setor['Orgao']['sigla'] ?></span><br />
                    <span><strong>Volumes:</strong> <?php echo $processo['Processo']['volumes'] ?></span><br />
                    <span><strong>Páginas:</strong> <?php echo $processo['Processo']['paginas'] ?></span><br />
                    <span><strong>Número do Documento:</strong> <?php echo $processo['Processo']['documento_numero'] ?></span><br />
                    <span><strong>Cadastrado em: </strong><?php echo $protocolo->showDateBr($processo['Processo']['data_cadastro'],true) ?></span>

                </div>
                <br />
                <?php
                if(is_array($tramites) && (count($tramites) > 0)) {
                    ?>

                <b>Tramitação do processo:</b>
                <table cellpadding="2" cellspacing="0" border="0">
                        <?php echo $this->renderElement('../processos/_tabela_tramites'); ?>
                </table>

                <?php
                }
                else {
                    ?>
                <b>Nenhum trâmite registrado.</b>
                <?php
                }
                ?>

            </div>
            <div style="float:left;">
                <p>Gerado em: <?php echo date('d/m/Y H:m') ?></p>
            </div>
            <div style="float:right;">
                <p>Servidor: <?php echo ucw($session->read('Servidor.nome')); ?>&nbsp;|&nbsp;Setor: <?php echo $session->read('Setor.sigla'); ?>&nbsp;|&nbsp;Órgão: <?php echo $session->read('Orgao.sigla'); ?></p>
            </div>
        </div>

    </body>
</html>