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

class Servidor extends AppModel {

	var $name = 'Servidor';
	var $actsAs = array('Null' => array('data_permissao_inicio','data_permissao_fim'));
	var $validate = array(
		'setor_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Setor é obrigatório.",
		),
		'grupo_usuario_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Grupo de Usuário é obrigatório.",
		),
		'cargo_id' => array(
			'rule' => array('numeric'),
			'required' => true,
			'message' => "Cargo é obrigatório.",
		),
		'nome' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Nome é obrigatório.",
		),
		'cpf' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "CPF é obrigatório.",
		),
		'matricula' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Matrícula é obrigatória.",
		),
		'login' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Login é obrigatório.",
		),
		'senha' => array(
			'rule' => array('minLength', 1),
			'required' => true,
			'message' => "Senha é obrigatória.",
		),
		'ativo' => array('boolean')
	);


	var $belongsTo = array(
		'Setor' => array('className' => 'Setor',
							'foreignKey' => 'setor_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
		),
		'GrupoUsuario' => array('className' => 'GrupoUsuario',
							'foreignKey' => 'grupo_usuario_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
		),
		'Cargo' => array('className' => 'Cargo',
							'foreignKey' => 'cargo_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
		),
	);

	var $hasMany = array(
			'PermissaoServidor' => array('className' => 'PermissaoServidor',
								'foreignKey' => 'servidor_id',
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
                        'SetorServidor' => array('className' => 'SetorServidor',
								'foreignKey' => 'servidor_id',
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
			
    function findLogin($login, $senha, $orgao_id)
    {
        $this->unbindModel(array(
                                'belongsTo' => array('GrupoUsuario', 'Cargo'),
                                'hasMany' => array('PermissaoServidor')
                            ));
        
        // Codições em array para facilitar visualização
        $condicoes = array();
        $condicoes[] = "upper(login) = upper('{$login}')";
        $condicoes[] = "upper(senha) = upper('{$senha}')";
        $condicoes[] = "Setor.orgao_id = {$orgao_id}";
        
        $condicoes[] = "Servidor.ativo = true";
        $condicoes[] = "(Servidor.data_permissao_inicio is null or Servidor.data_permissao_inicio <= current_date)";
        $condicoes[] = "(Servidor.data_permissao_fim is null or Servidor.data_permissao_fim >= current_date)";
        $condicoes[] = "Setor.ativo = true";
                
        return $this->find('first', array('conditions' => join(' and ', $condicoes), 'recursive' => '2'));
    }

    function resgatarCriteriosBusca($condicoes)
    {
        if(count($condicoes) > 0)
        {
            $sql = array();
            
            if(array_key_exists('orgao_id', $condicoes) && ($condicoes['orgao_id'] != ""))
            {
                $sql[] = "Setor.orgao_id = {$condicoes['orgao_id']}";
            }
            
            if(array_key_exists('setor_id', $condicoes) && ($condicoes['setor_id'] != ""))
            {
                $sql[] = "setor_id = {$condicoes['setor_id']}";
            }

            if(array_key_exists('grupo_usuario_id', $condicoes) && ($condicoes['grupo_usuario_id'] != ""))
            {
                $sql[] = "grupo_usuario_id = {$condicoes['grupo_usuario_id']}";
            }

            if(array_key_exists('nome', $condicoes) && ($condicoes['nome'] != ""))
            {
                $maiusculo = stringToUpper($condicoes['nome']);
                $sql[] = "upper(nome) like upper('%{$maiusculo}%')";
            }

            if(array_key_exists('cpf', $condicoes) && ($condicoes['cpf'] != ""))
            {
                $sql[] = "cpf = '{$condicoes['cpf']}'";
            }
            
            if(array_key_exists('matricula', $condicoes) && ($condicoes['matricula'] != ""))
            {
                $sql[] = "matricula = '{$condicoes['matricula']}'";
            }
            
            if(array_key_exists('login', $condicoes) && ($condicoes['login'] != ""))
            {
                $sql[] = "upper(login) = upper('{$condicoes['login']}')";
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
            return $this->find('all', array('conditions' => $criterios));
        }
        else
        {
            return false;
        }
    }
}
?>