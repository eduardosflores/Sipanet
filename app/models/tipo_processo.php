<?php
/**
 *  SipaNet 2.0 - Sistema de Informa��o Processual e Arquivo
    Copyright (C) 2008 Universidade Estadual de Ci�ncias da Sa�de de Alagoas - UNCISAL <http://www.uncisal.edu.br>

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

class TipoProcesso extends AppModel {

	var $name = 'TipoProcesso';
	var $validate = array(
		'descricao' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Tipo de processo � obrigat�rio.",
		),
	);

    /**
     * Lista todas as situa��es
     * **/
    public function listar()
    {
        return $this->find('list', array('order' => 'descricao asc', 'recursive' => -1));
    }
}
?>