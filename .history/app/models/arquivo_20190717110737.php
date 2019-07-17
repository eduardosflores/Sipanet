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

class Arquivo extends AppModel {

	var $name = 'Arquivo';
	

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Processo' => array('className' => 'Processo',
								'foreignKey' => 'Processo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

    
    /**
     * Busca os processos pelo seu número
     * **/
	public function findByProcessoId($processo_id)
	{
		if($processo_id != null)			
		{
            return $this->find('first', array('conditions' => "Arquivo.processo_id = '{$processo_id}'"));
		}
		else
		{
		    return false;
		}

	}
    
    /**
     * Busca os processos pelo código do interessado
     * **/
    public function findByInteressado($interessado_id)
    {
     	if($interessado_id != null)
        {
        	return $this->find('all', array('conditions' => "Arquivo.pr_id = {$interessado_id}", 'order' => 'Processo.data_cadastro'));
        }
        else
        {
        	return false;
        }
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
                $sql[] = "Processo.setor_id = {$condicoes['setor_id']}";
            }
            
            if(array_key_exists('natureza_id', $condicoes) && ($condicoes['natureza_id'] != ""))
            {
                $sql[] = "natureza_id = {$condicoes['natureza_id']}";
            }
            
            if(array_key_exists('situacao_id', $condicoes) && ($condicoes['situacao_id'] != ""))
            {
                $sql[] = "situacao_id = {$condicoes['situacao_id']}";
            }
            
            if(array_key_exists('numero_ano', $condicoes) && ($condicoes['numero_ano'] != ""))
            {
                $sql[] = "numero_ano = {$condicoes['numero_ano']}";
            }
            
            if(array_key_exists('titulo_assunto', $condicoes) && ($condicoes['titulo_assunto'] != ""))
            {
                $maiusculo = stringToUpper($condicoes['titulo_assunto']);
                $sql[] = "upper(titulo_assunto) LIKE upper('%{$maiusculo}%')";
            }
            
            if(array_key_exists('interessado', $condicoes) && ($condicoes['interessado'] != ""))
            {
                $maiusculo = stringToUpper($condicoes['interessado']);
                $sql[] = "(upper(Interessado.nome) LIKE upper('%{$maiusculo}%') OR Interessado.cpf_cnpj = '{$condicoes['interessado']}')";
            }
            
            if(array_key_exists('documento_numero', $condicoes) && ($condicoes['documento_numero'] != ""))
            {
                $sql[] = "upper(documento_numero) LIKE upper('%{$condicoes['documento_numero']}%')";
            }
            
            if(array_key_exists('data_inicial', $condicoes) && ($condicoes['data_inicial'] != "") && array_key_exists('data_final', $condicoes) && ($condicoes['data_final'] != ""))
            {
                $sql[] = "CAST(Processo.data_cadastro AS DATE) BETWEEN '{$condicoes['data_inicial']}' AND '{$condicoes['data_final']}'";
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
    
    function paginateCount($conditions = null, $recursive = null) {
        $this->unbindModel(array('hasMany'=> array('Tramite', 'Divisao')));
        return $this->findCount($conditions, $recursive);
    } 
    
    function paginate($conditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null)
    {
        $this->unbindModel(array('hasMany'=> array('Tramite', 'Divisao')));
    	return $this->findAll($conditions, $fields, $order, $limit, $page, $recursive); 
    }
}
?>