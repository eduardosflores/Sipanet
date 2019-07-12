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

class SetoresController extends AppController
{
    public $helpers = array('Html', 'Session','protocolo');
    public $uses = array('Orgao','Setor');

    function beforeFilter() 
    {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

	/**
	 * http://sistema/setores/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Setores');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->Setor->recursive = 0;
        
        $this->paginate = array('conditions' => "Setor.orgao_id = {$this->Session->read('Orgao.id')}", 'limit' => 30, 'page' => 1, 'order' => array('Orgao.codigo' => 'asc', 'Setor.descricao' => 'asc'));
    	// Busca os dados e envia para a view
        $this->set('setores', $this->paginate('Setor'));
		
    }

	/**
	* http://sistema/setores/exibir/$id **/
    public function exibir($id = null)
    {
        $this->verificarLogin(15);
        
        $this->set('fieldSetTitle','Informações do setor');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/setores/');
		}

		//Busca o registro
		$this->Setor->recursive = 0;
		$setor = $this->Setor->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($setor['Setor']['id'] != $id) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/setores/');
		}

		$this->set('setor', $setor);
    }

    /**
     * http://sistema/setores/consultar/ **/
    public function consultar()
    {
        $this->verificarLogin(14);
        
        $this->set('fieldSetTitle', 'Consultar Setores');
        
        
        // Verifica se o usuário tem permissão para cadastrar setores de órgãos diferentes do seu
        $modulos = $this->Session->read('Modulos');
        $cadastra_orgao = in_array(18, $modulos);
        $this->set('cadastra_orgao', $cadastra_orgao);
        
        
        //Carregar listagem de Orgaos
        $this->set('orgaos',$this->Orgao->listar());
        
        // Verifica se a busca ja foi realizada
        if(empty($this->data))
        {
            $this->render();
        }
        else
        {
            $this->Setor->recursive = 1;
            
            // Verifica se foram encontrados registros na busca
            if($setores = $this->Setor->buscar($this->data['Setor']))
            {
                $this->set("setores", $setores);  
            }
            else
            {
                $this->setMessage("erro", "Nenhum setor encontrado.");
            }
        }
    }

	/**
	 * http://sistema/setores/cadastrar/ **/
    public function cadastrar()
    {
        $this->verificarLogin(15);
        
        // Verifica se o usuário tem permissão para cadastrar setores de órgãos diferentes do seu
        $modulos = $this->Session->read('Modulos');
            
        if(in_array(18, $modulos))
        {
    		//Carregar listagem de Orgaos
    		$this->set('orgaos',$this->Orgao->listar());
            $cadastra_orgao = true;
        }
        else
        {
        	$cadastra_orgao = false;
        }
        
        $this->set('cadastra_orgao', $cadastra_orgao);

		$this->set('fieldSetTitle','Cadastrando Setor');		

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data)) {
			$this->render();

		// Se tiver dado submit no form:
		} else {
			// Limpa os campos
			//$this->cleanUpFields();
            
            if(!$cadastra_orgao)
            {
                $this->data['Setor']['orgao_id'] = $this->Session->read('Orgao.id');
            }
            

			// Tenta salvar
			if( $this->Setor->save($this->data) ) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('setores', null, 'C', null, $this->data['Setor']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "Setor cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/setores');
			} else {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->Setor->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/setores/alterar/ **/
    public function alterar($id = null)
    {
        $this->verificarLogin(15);

		$this->set('fieldSetTitle','Alterando Setor');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/setores/');
		}

		//Carregar listagem para ser exibida
		//$this->set('orgaos',$this->Orgao->find('list',array('fields'=>'descricao')));

		//Carregar registro a ser alterado
		$setor = $this->Setor->read(null, $id,1);
        
		if(empty($this->data))
        {

			// Busca o registro
			$this->data = $setor;
		}
        else
        {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $setor;

			$this->Setor->id = $id;
			
			// Tenta salvar o registro
			if($this->Setor->save($this->data))
            {
				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('setores', $id, 'U', $old_data, $this->data['Setor']);

				$this->setMessage("sucesso", "Setor atualizado com sucesso.");
				$this->redirect('/setores/exibir/'.$id);
			}
            else
            {
				$this->setMessage("erro", "", $this->Setor->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/setores/delete/ **/
    public function delete($id = null)
    {
        $this->verificarLogin(15);

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/setores/');
		}
			$this->Setor->del($id);
			$this->setMessage("sucesso","Setor removido com sucesso.");
			$this->redirect('/setores');
    }
    
    
    public function ajax_list() {
        if(isset($this->params['url']['tipo']) && in_array($this->params['url']['tipo'], array('orgao_origem_id', 'orgao_recebimento_id')))
        {
        	$orgao = $this->data['Busca'][$this->params['url']['tipo']];
        }
        else 
        {
            // Verifica se o órgão foi passado, tanto como parâmetro do form ou como data
            if($this->params['form']['OrgaoSelect'] != "")
            {
                $orgao = $this->params['form']['OrgaoSelect'];
            }
            elseif($this->data['Busca']['orgao_id'] != "")
            {
            	$orgao = $this->data['Busca']['orgao_id'];
            }
            //Se o parametro vier da consulta de Servidores
            elseif($this->data['Servidor']['orgao_id'] != "")
            {
            	$orgao = $this->data['Servidor']['orgao_id'];
            }
        }
        
        // Se o órgão foi passado, realiza a busca
        if($orgao)
        {
            // Verifica se foi passado o parâmetro para apenas setors ativos ou não
            if($this->params['url']['ativo'] == 'true')
            {
            	$ativo = true;
            }
            
            $setores = $this->Setor->findByOrgao($orgao, $ativo);
            $this->set("setores", $setores);
        }
        
        $this->set("orgao", $orgao);
        $this->render(null, 'ajax');
    }
}
?>