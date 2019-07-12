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

class InteressadosController extends AppController
{
	public $helpers = array('Html', 'Session', 'Protocolo');
	public $uses = array('Interessado', 'TipoInteressado', 'Processo');
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('Interessado.nome' => 'asc'));

    
    function beforeFilter() {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }
    
	/**
	 * http://sistema/interessados/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Interessados');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->Interessado->recursive = 1;

    	// Busca os dados e envia para a view
        $this->set('interessados', $this->paginate('Interessado'));
    }


	/**
	* http://sistema/Interessados/exibir/$id **/
    public function exibir($id = null)
    {
        $this->set('fieldSetTitle','Informações do Interessado');

		// Verifica se o id passado é válido
		if( ! $this->checkValidId($id) )
		{
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/interessados/');
		}

		//Busca o registro
		$this->Interessado->recursive = 1;
		$interessado = $this->Interessado->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($interessado['Interessado']['id'] != $id)
		{
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/interessados/');
		}
        
        $this->Processo->recursive = 1;
        $processos = $this->Processo->findByInteressado($interessado['Interessado']['id']);
        
		$this->set('interessado', $interessado);
        $this->set('processos', $processos);
    }


	/**
	 * http://sistema/interessados/cadastrar/ **/
    public function cadastrar()
    {
        $this->verificarLogin(4);
        
		$this->set('tipos', $this->TipoInteressado->find('list', array('fields'=>'descricao')));

		$this->set('fieldSetTitle','Cadastrando Interessado');

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data))
		{
			$this->render();

		// Se tiver dado submit no form:
		}
		else
		{
			// Limpa os campos
			//$this->cleanUpFields();

			// Tenta salvar
			if( $this->Interessado->save($this->data) )
			{

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('interessados', null, 'C', null, $this->data['Interessado']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "Interessado cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/interessados');
			}
			else
			{
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->Interessado->validationErrors);
			}
		}
    }
    
    /**
     * http://sistema/interessados/consultar/ **/
    public function consultar()
    {
        $this->verificarLogin(14);
        
        $this->set('fieldSetTitle', 'Consultar Interessado');
        
        // Caso os dados tenham sido passados via URL, repassa os dados para a variável $this->data['Busca']. A partir desta variável será feita a consulta
        if(count($this->params['named']) > 0)
        {
            $this->data['Interessado'] = $this->params['named'];
        }
        
    	// Verifica se a busca ja foi realizada
        if(isset($this->data['Interessado']))
        {
            // Formata a URL que será chamada na paginação
            $this->set('url', $this->gerarNamedUrl($this->data['Interessado']));
            
            $criterios = $this->Interessado->resgatarCriteriosBusca($this->data['Interessado']);
            $this->Interessado->recursive = 1;
            
            // Verifica se foram encontrados interessados na busca
            if($interessados = $this->paginate('Interessado', $criterios))
            {
                // Busca pelo interessado
                $this->set("interessados", $interessados);	
            }
            else
            {
            	$this->setMessage("erro", "Nenhum interessado encontrado.");
            }
        }
    }


    /**
	 * http://sistema/interessados/alterar/ **/
    public function alterar($id = null)
    {


		$this->set('fieldSetTitle','Alterando Interessado');

		if( ! $this->checkValidId($id) )
		{
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/interessados/');
		}

		//Carregar listagem para ser exibida
		$this->set('tipos', $this->TipoInteressado->find('list', array('fields'=>'descricao')));

		//Carregar registro a ser alterado
        $this->Interessado->recursive = -1;
		$interessado = $this->Interessado->read(null, $id);
        
		if(empty($this->data))
		{

			// Busca o registro
			$this->data = $interessado;
		}
		else
		{
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $interessado;

			$this->Interessado->id = $id;

			// Tenta salvar o registro
			if($this->Interessado->save($this->data))
			{
				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('interessados', $id, 'U', $old_data, $this->data['Interessado']);

				$this->setMessage("sucesso", "Interessado atualizado com sucesso.");
				$this->redirect('/interessados/exibir/'.$id);
			}
			else
			{
				$this->setMessage("erro", "", $this->Interessado->validationErrors);
			}
		}
    }


    /**
	 * http://sistema/interessados/delete/ **/
    public function delete($id = null)
    {

		if( ! $this->checkValidId($id) )
		{
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/interessados/');
		}

		$this->Interessado->del($id);
		$this->setMessage("sucesso","Interessado removido com sucesso.");
		$this->redirect('/interessados/');
    }

    /**
     * http://sistema/interessados/busca_popup/ **/
    public function busca_popup()
    {
    	$this->set('fieldSetTitle','Pesquisar interessados');
        
        // Caso os dados tenham sido passados via URL, repassa os dados para a variável $this->data['Busca']. A partir desta variável será feita a consulta
        if(count($this->params['named']) > 0)
        {
            $this->params['form'] = $this->params['named'];
        }
        
        // Se foram passados dados, realiza a busca
        if(count($this->params['form']) > 0)
        {
            // Formata a URL que será chamada na paginação
            $this->set('url', $this->params['form']);
            
            $criterios = $this->Interessado->resgatarCriteriosBusca($this->params['form']);
            
            $this->set("interessados", $this->paginate('Interessado', $criterios));
        }
        
		$this->render(null, "popup");
    }
    
    /**
     * http://sistema/interessados/cadastrar_popup/ **/
    public function cadastrar_popup()
    {
        $this->verificarLogin(4);
        
        $this->set('tipos', $this->TipoInteressado->find('list', array('fields'=>'descricao')));

        $this->set('fieldSetTitle','Cadastrando Interessado');

        // Se estiver entrando na página pela primeira vez, apenas exibe o form
        if(empty($this->data))
        {
            $this->render(null, "popup");

        // Se tiver dado submit no form:
        }
        else
        {
            // Limpa os campos
            //$this->cleanUpFields();

            // Tenta salvar
            if( $this->Interessado->save($this->data) )
            {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('interessados', null, 'C', null, $this->data['Interessado']);

                // Cria variável que informará à view que o interessado já está cadastrado
                $this->set("interessado_cadastrado", true);
                $this->set("id", $this->Interessado->getLastInsertID());
                $this->set("nome", $this->data['Interessado']['nome']);
                
                // Redirecionar para listagem ou para exibição do item salvo
                $this->render(null, "popup");
            }
            else
            {
                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->Interessado->validationErrors);
                $this->render(null, "popup");
            }
        }
    }
}
?>
