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

class HistoricoDevolucao extends AppModel {

	var $name = 'HistoricoDevolucao';
	var $validate = array(
		'processo_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Processo � obrigat�rio.",
		),
		'servidor_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Servidor � obrigat�rio.",
		),
                'tipo_devolucao' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Tipo de devolu��o � obrigat�rio",
		),
                'num_doc' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "N�mero de documento � obrigat�rio.",
		),
                'ano_doc' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Ano do documento � obrigat�rio.",
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Processo' => array('className' => 'Processo',
								'foreignKey' => 'processo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Servidor' => array('className' => 'Servidor',
								'foreignKey' => 'servidor_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>