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

class NaturezasController extends AppController
{
    public $helpers = array('Html', 'Session', 'Protocolo');
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('Natureza.descricao' => 'asc'));

    function beforeFilter() 
    {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

	/**
	 * http://sistema/naturezas/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Naturezas');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->Natureza->recursive = -1;

    	// Busca os dados e envia para a view
        $this->set('naturezas', $this->paginate('Natureza'));
    }

	/**
	* http://sistema/naturezas/exibir/$id **/
    public function exibir($id = null)
    {
        $this->verificarLogin(17);
        
        $this->set('fieldSetTitle','Informações do natureza');

		if( ! $this->checkValidId($id) )
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/naturezas/');
		}

		//Busca o registro
		$this->Natureza->recursive = -1;
		$natureza = $this->Natureza->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($natureza['Natureza']['id'] != $id)
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/naturezas/');
		}

		$this->set('natureza', $natureza);
    }


	/**
	 * http://sistema/naturezas/cadastrar/ **/
    public function cadastrar() 
    {
        $this->verificarLogin(17);

		$this->set('fieldSetTitle','Cadastrando Natureza');		

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
			if( $this->Natureza->save($this->data) )
            {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('naturezas', null, 'C', null, $this->data['Natureza']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "Natureza cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/naturezas');
			}
            else
            {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->Natureza->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/naturezas/alterar/ **/
    public function alterar($id = null) 
    {
        $this->verificarLogin(17);

		$this->set('fieldSetTitle','Alterando Natureza');

		if( ! $this->checkValidId($id) )
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/naturezas/');
		}

		$natureza = $this->Natureza->read(null, $id);
		if(empty($this->data))
        {

			// Busca o registro
			$this->data = $natureza;
		}
        else
        {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $natureza;

			$this->Natureza->id = $id;

			// Tenta salvar o registro
			if($this->Natureza->save($this->data))
            {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('naturezas', $id, 'U', $old_data, $this->data['Natureza']);

				$this->setMessage("sucesso", "Natureza atualizado com sucesso.");
				$this->redirect('/naturezas/exibir/'.$id);
			}
            else
            {
				$this->setMessage("erro", "", $this->Natureza->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/naturezas/delete/ **/
    public function delete($id = null) 
    {
        $this->verificarLogin(17);

		if( ! $this->checkValidId($id) )
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/naturezas/');
		}
        
		$this->Natureza->del($id);
		$this->setMessage("sucesso","Natureza removido com sucesso.");
		$this->redirect('/naturezas');
    }
}
?>