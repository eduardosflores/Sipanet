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

class Orgao extends AppModel {

	var $name = 'Orgao';
	var $validate = array(
		'codigo' => array(
            'tamanho' => array(
                'rule' => array('minLength', 1),
                'required' => true,
                'message' => "Código é obrigatório.",
            ),
            'unico' => array(
                'rule' => array('isUnique'),
                'message' => "O Código informado já está cadastrado.",
            ),
            
		),
		'descricao' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Descrição é obrigatória.",
		),
		'sigla' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Sigla é obrigatória.",
		),
		'ativo' => array('boolean'),
        'externo' => array('boolean'),
	);
    
    public function listar()
    {
    	return $this->find('all', array('order' => 'codigo asc', 'recursive' => -1));
    }
    
    public function listarInternos()
    {
    	return $this->find('all', array('order' => 'sigla asc', 'conditions' => 'externo = false', 'recursive' => -1));
    }
    
    public function listarExternos()
    {
    	return $this->find('all', array('order' => 'codigo asc', 'conditions' => 'externo = true and ativo = true', 'recursive' => -1));
    }

    function resgatarCriteriosBusca($condicoes)
    {
        if(count($condicoes) > 0)
        {
            $sql = array();

            if(array_key_exists('descricao', $condicoes) && ($condicoes['descricao'] != ""))
            {
                $sql[] = "upper(descricao) like upper('%{$condicoes['descricao']}%')";
            }

            if(array_key_exists('sigla', $condicoes) && ($condicoes['sigla'] != ""))
            {
                $sql[] = "upper(sigla) like upper('%{$condicoes['sigla']}%')";
            }
            
            if(array_key_exists('codigo', $condicoes) && ($condicoes['codigo'] != ""))
            {
                $sql[] = "codigo = '{$condicoes['codigo']}'";
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
            return $this->find('all', array('conditions' => $criterios, 'order' => 'descricao asc'));
        }
        else
        {
            return false;
        }
    }

}
?>