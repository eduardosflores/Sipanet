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

class Interessado extends AppModel {

	var $name = 'Interessado';
	var $validate = array(
		'tipo_interessado_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Tipo do Interessado é obrigatório.",
		),
		'nome' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Nome é obrigatório.",
		),
        /**
		'cpf_cnpj' => array(
            'tamanho' => array(
    			'rule' => array('minLength', 1),
    			'required' => true,
    			'message' => "CPF/CNPJ é obrigatório.",
            ),
            
            'unico' => array(
                'rule' => array('isUnique'),
                'message' => "O CPF/CNPJ informado já está cadastrado.",
            ),
		),
        **/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'TipoInteressado' => array('className' => 'TipoInteressado',
								'foreignKey' => 'tipo_interessado_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Processo' => array('className' => 'Processo',
								'foreignKey' => 'interessado_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);
    
    function resgatarCriteriosBusca($condicoes)
    {
        if(count($condicoes) > 0)
        {
            $sql = array();

            if(array_key_exists('nome', $condicoes) && ($condicoes['nome'] != ""))
            {
                $sql[] = "upper(nome) like upper('%{$condicoes['nome']}%')";
            }

            if(array_key_exists('cpf_cnpj', $condicoes) && ($condicoes['cpf_cnpj'] != ""))
            {
                $sql[] = "cpf_cnpj = '{$condicoes['cpf_cnpj']}'";
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
    
    function buscar($condicoes)
    {
        $criterios = $this->resgatarCriteriosBusca($condicoes); 
        if($criterios != false)
        {
        	return $this->find('all', array('conditions' => $criterios, 'order' => 'nome asc'));
        }
        else
        {
        	return false;
        }
    }

    function paginateCount($conditions = null, $recursive = null) {
        $this->unbindModel(array('hasMany'=> array('Processo')));
        return $this->findCount($conditions, $recursive);
    } 
    
    function paginate($conditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null)
    {
        $this->unbindModel(array('hasMany'=> array('Processo')));
        return $this->findAll($conditions, $fields, $order, $limit, $page, $recursive); 
    }
}
?>