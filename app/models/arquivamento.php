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

class Arquivamento extends AppModel {


        var $name = 'Arquivamento';
	var $validate = array(
		'processo_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Processo é obrigatório.",
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
            'Setor' => array('className' => 'Setor',
                                'foreignKey' => 'setor_id',
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
            ),
    );
    
    /**
     * Retorna o último arquivamento de um processo
     * **/
    public function ultimoArquivamentoDoProcesso($processo_id)
    {
        return $this->find('first', array('conditions' => "processo_id = {$processo_id}", 'order' => 'data desc', 'recursive' => -1));
    }
    
    /**
     * Retorna todos os arquivamentos do processo
     * **/
    public function findByProcesso($processo_id)
    {
        // Campos que deverão ser retornados
        $fields = array(
            'Arquivamento.id', 'Arquivamento.setor_id', 'Arquivamento.motivo', 
            'Arquivamento.data', 'Arquivamento.data_desarquivamento', 'Arquivamento.motivo_desarquivamento',
            'Setor.id', 'Setor.sigla'
        );
        return $this->find('all', array('conditions' => "processo_id = {$processo_id}", 'order' => "data", 'fields' => $fields, 'recursive' => 1));
    }
}
?>