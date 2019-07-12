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

class Setor extends AppModel {

	var $name = 'Setor';
	var $validate = array(
		'orgao_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Órgão é obrigatório.",
		),
		'sigla' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Sigla é obrigatório.",
		),
		'descricao' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Descrição é obrigatória.",
		),
		'ativo' => array(
			'rule' => array('minLength', 1),
            'required' => true,
			'message'=>'Ativo não pode ser vazio.',
		)
		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Orgao' => array('className' => 'Orgao',
								'foreignKey' => 'orgao_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

        var $hasMany = array(
			'DiaNaMesa' => array('className' => 'DiaNaMesa',
								'foreignKey' => 'setor_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
         );
    
    function buscar($condicoes)
    {
        if(count($condicoes) > 0)
        {
            $sql = array();

            if(array_key_exists('descricao', $condicoes) && ($condicoes['descricao'] != ""))
            {
                $sql[] = "upper(Setor.descricao) like upper('%{$condicoes['descricao']}%')";
            }

            if(array_key_exists('sigla', $condicoes) && ($condicoes['sigla'] != ""))
            {
                $sql[] = "upper(Setor.sigla) like upper('%{$condicoes['sigla']}%')";
            }
            
            if(array_key_exists('orgao_id', $condicoes) && ($condicoes['orgao_id'] != ""))
            {
                $sql[] = "orgao_id = '{$condicoes['orgao_id']}'";
            }
            
            if(count($sql) > 0)
            {
                return $this->find('all', array('conditions' => implode(' and ', $sql), 'order' => 'Setor.descricao asc'));
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

    /**
     * Lista todas as setores por orgao
     * **/
    public function findByOrgao($orgao_id, $ativo=null)
    {
        $conditions = array();
        $conditions[] = "orgao_id = {$orgao_id}";
        
        if($ativo === true)
        {
        	$conditions[] = "ativo = true";
        }
        
        if($ativo === false)
        {
        	$conditions[] = "ativo = false";
        }
        
        return $this->find('all', array('conditions' => join(' and ', $conditions), 'order' => 'sigla', 'recursive' => -1));
    }
}
?>