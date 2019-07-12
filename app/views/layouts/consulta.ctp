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

<script language="JavaScript" type="text/javascript">
    var myThemePanelBase = "<?php echo $this->webroot; ?>js/jscookmenu/ThemePanel/";
</script>
<script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/prototype.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/fastinit.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/tablesort.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/datepicker.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo $this->webroot; ?>js/default.js"></script>
  
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
                <td colspan="2" class="td_row_gray_topo"><img src="<?php echo $this->webroot; ?>img/row_gray_topo.jpg"/></td>
            </tr>
        </table>
    </div>
    <!--END top-->

    <!--content principal-->
    <div id="div_conteudo">
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

    <!--content principal-->
    <div id="div_rodape">
        <strong>Sistema de Informação Processual e Arquivo - SipaNet 2.0&nbsp;</strong><br />
        Acordo de Cooperação Técnica ITEC/UNCISAL - 2008&nbsp;<br />
        Desenvolvido por: <?php echo $html->link('CETIS (GTIN) - UNCISAL', 'http://www.uncisal.edu.br/cetis', array('target' => 'blank')); ?>&nbsp;
    </div>
    <!--END content principal-->

</body>
</html>