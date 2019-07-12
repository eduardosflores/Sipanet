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

class ProcessoAnexo extends AppModel {

	var $name = 'ProcessoAnexo';
	var $validate = array(
		'processo_principal_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Processo Principal é obrigatório.",
		),
		'processo_anexo_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Processo Anexo é obrigatório.",
		),
		'ativo' => array(
			'rule' => 'boolean',
			'required' => true,
			'message' => "Ativo é obrigatório.",
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'ProcessoPrincipal' => array('className' => 'Processo',
								'foreignKey' => 'processo_principal_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'ProcessoAnexado' => array('className' => 'Processo',
								'foreignKey' => 'processo_anexo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

    /**
     * Busca os processos anexos ao processo informado
     * **/
    public function findAnexo($processo_id)
    {
        return $this->find('all', array('conditions' => "(processo_principal_id = {$processo_id} or processo_anexo_id = {$processo_id}) and ativo = true"));
    }

    /**
     * Busca os anexos a partir do processo principal
     * **/
    public function findByProcessoPrincipal($processo_id, $recursive = null)
    {
        if($recursive === null)
        {
        	$recursive = 2;
        }
        
        $this->unbindModel( array('belongsTo' => array('ProcessoPrincipal')) );
        $this->ProcessoAnexado->unbindModel( array('belongsTo' => array('Servidor', 'Setor', 'Situacao'), 'hasMany' => array('Divisao', 'Tramite') ) );
        return $this->find('all', array('conditions' => "processo_principal_id = {$processo_id} and ativo = true", 'recursive' => $recursive));
    }
    
    /**
     * Busca os anexos a partir do processo anexado
     * **/
    public function findByProcessoAnexado($processo_id)
    {
        $this->unbindModel( array('belongsTo' => array('ProcessoAnexado')) );
        return $this->find('first', array('conditions' => "processo_anexo_id = {$processo_id} and ativo = true"));
    }
    
}
?>