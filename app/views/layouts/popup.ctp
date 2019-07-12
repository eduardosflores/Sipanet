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
<link rel="stylesheet" href="<?php echo $this->webroot; ?>css/tablesort.css" />
<link rel="stylesheet" href="<?php echo $this->webroot; ?>css/forms.css" />

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
        </table>
    </div>
    <!--END top-->

    <!--content principal-->
    <div id="div_conteudo">
        <?php
        	// Espaço para mensagens
        	if($session->check('Message.flash')) 
        	{
        		echo "<div id='mensagem_conteudo'>";
				$session->flash();
				echo "</div>";
			}
        ?>
        <?php
        	//Escreve $pageTitle caso esteja setada no controller
			if (isset($pageTitle))
			{
				echo "<h1>".$pageTitle."</h1>";
			}

			// Renderiza conteudo dos controllers
			echo $content_for_layout;
        ?>
    </div>
    <!--END content principal-->

</body>
</html>