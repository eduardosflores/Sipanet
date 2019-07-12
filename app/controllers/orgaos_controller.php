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

class OrgaosController extends AppController
{
    public $helpers = array('Html', 'Session','protocolo');
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('Orgao.codigo' => 'asc'));

    function beforeFilter() {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

	/**
	 * http://sistema/orgaos/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Orgaos');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->Orgao->recursive = -1;

    	// Busca os dados e envia para a view
        $this->set('orgaos', $this->paginate('Orgao'));
    }

	/**
	* http://sistema/orgaos/exibir/$id **/
    public function exibir($id = null)
    {
        $this->verificarLogin(17);
        
        $this->set('fieldSetTitle','Informações do orgao');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/orgaos/');
		}

		//Busca o registro
		$this->Orgao->recursive = -1;
		$orgao = $this->Orgao->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($orgao['Orgao']['id'] != $id) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/orgaos/');
		}

		$this->set('orgao', $orgao);
    }

    /**
     * http://sistema/orgaos/consultar/ **/
    public function consultar()
    {
        $this->verificarLogin(14);
        
        $this->set('fieldSetTitle', 'Consultar Órgãos');
        
        
        
        // Caso os dados tenham sido passados via URL, repassa os dados para a variável $this->data['Busca']. A partir desta variável será feita a consulta
        if(count($this->params['named']) > 0)
        {
            $this->data['Orgao'] = $this->params['named'];
        }
        
        // Verifica se a busca ja foi realizada
        if(isset($this->data['Orgao']))
        {
            // Formata a URL que será chamada na paginação
            $this->set('url', $this->gerarNamedUrl($this->data['Orgao']));
            
            $criterios = $this->Orgao->resgatarCriteriosBusca($this->data['Orgao']);
            
            // Verifica se foram encontrados interessados na busca
            if($orgaos = $this->paginate('Orgao', $criterios))
            {
                // Busca pelo interessado
                $this->set("orgaos", $orgaos);  
            }
            else
            {
                $this->setMessage("erro", "Nenhum órgão encontrado.");
            }
        }
    }

	/**
	 * http://sistema/orgaos/cadastrar/ **/
    public function cadastrar()
    {
        $this->verificarLogin(18);
        
		$this->set('fieldSetTitle','Cadastrando Orgao');		

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data)) {
			$this->render();

		// Se tiver dado submit no form:
		} else {
			// Limpa os campos
			//$this->cleanUpFields();

			// Tenta salvar
			if( $this->Orgao->save($this->data) ) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('orgaos', null, 'C', null, $this->data['Orgao']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "Orgao cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/orgaos');
			} else {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->Orgao->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/orgaos/alterar/ **/
    public function alterar($id = null)
    {
        $this->verificarLogin(18);
        
		$this->set('fieldSetTitle','Alterando Orgao');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/orgaos/');
		}

		$orgao = $this->Orgao->read(null, $id);
		if(empty($this->data)) {

			// Busca o registro
			$this->data = $orgao;
		} else {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $orgao;

			$this->Orgao->id = $id;

			// Tenta salvar o registro
			if($this->Orgao->save($this->data)) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('orgaos', $id, 'U', $old_data, $this->data['Orgao']);

				$this->setMessage("sucesso", "Orgao atualizado com sucesso.");
				$this->redirect('/orgaos/exibir/'.$id);
			} else {
				$this->setMessage("erro", "", $this->Orgao->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/orgaos/delete/ **/
    public function delete($id = null)
    {
        $this->verificarLogin(18);

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/orgaos/');
		}
			$this->Orgao->del($id);
			$this->setMessage("sucesso","Orgao removido com sucesso.");
			$this->redirect('/orgaos');
    }
}
?>