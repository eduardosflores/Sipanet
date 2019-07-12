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

class HistoricoDivisao extends AppModel {

	var $name = 'HistoricoDivisao';
	var $validate = array(
		'processo_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Processo é obrigatório.",
		),
		'servidor_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Servidor é obrigatório.",
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

public function resgatarCriteriosBusca($condicoes)
    {
        if(count($condicoes) > 0)
        {
            $sql = array();

            if(array_key_exists('servidor_id', $condicoes) && ($condicoes['servidor_id'] != ""))
            {
                $sql[] = "HistoricoDivisao.servidor_id = {$condicoes['servidor_id']}";
            }

            if(array_key_exists('processo_id', $condicoes) && ($condicoes['processo_id'] != ""))
            {
                $sql[] = "HistoricoDivisao.processo_id = {$condicoes['processo_id']}";
            }
            
            if(array_key_exists('data_inicial', $condicoes) && ($condicoes['data_inicial'] != "") && array_key_exists('data_final', $condicoes) && ($condicoes['data_final'] != ""))
            {
                $sql[] = "CAST(HistoricoDivisao.data_divisao AS DATE) BETWEEN '{$condicoes['data_inicial']}' AND '{$condicoes['data_final']}'";
            }

            if(count($sql) > 0)
            {
                return implode(' and ', $sql);
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

}
?>