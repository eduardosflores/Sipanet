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

class CargosController extends AppController
{
    public $helpers = array('Html', 'Session');
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('Cargo.descricao' => 'asc'));
    
    function beforeFilter() {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }
    
	/**
	 * http://sistema/cargos/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Cargos');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->Cargo->recursive = -1;

    	// Busca os dados e envia para a view
        $this->set('cargos', $this->paginate('Cargo'));
    }

	/**
	* http://sistema/cargos/exibir/$id **/
    public function exibir($id = null)
    {
        $this->verificarLogin(17);
        
        $this->set('fieldSetTitle','Informações do cargo');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/cargos/');
		}

		//Busca o registro
		$this->Cargo->recursive = -1;
		$cargo = $this->Cargo->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($cargo['Cargo']['id'] != $id) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/cargos/');
		}

		$this->set('cargo', $cargo);
    }


	/**
	 * http://sistema/cargos/cadastrar/ **/
    public function cadastrar()
    {
        $this->verificarLogin(17);
        
		$this->set('fieldSetTitle','Cadastrando Cargo');		

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
			if( $this->Cargo->save($this->data) )
            {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('cargos', null, 'C', null, $this->data['Cargo']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "Cargo cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/cargos');
			}
            else
            {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->Cargo->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/cargos/alterar/ **/
    public function alterar($id = null) 
    {
        $this->verificarLogin(17);

		$this->set('fieldSetTitle','Alterando Cargo');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/cargos/');
		}

		$cargo = $this->Cargo->read(null, $id);
		if(empty($this->data))
        {

			// Busca o registro
			$this->data = $cargo;
		}
        else
        {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $cargo;

			$this->Cargo->id = $id;

			// Tenta salvar o registro
			if($this->Cargo->save($this->data))
            {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('cargos', $id, 'U', $old_data, $this->data['Cargo']);

				$this->setMessage("sucesso", "Cargo atualizado com sucesso.");
				$this->redirect('/cargos/exibir/'.$id);
			}
            else
            {
				$this->setMessage("erro", "", $this->Cargo->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/cargos/delete/ **/
    public function delete($id = null) 
    {
        $this->verificarLogin(17);
        
		if( ! $this->checkValidId($id) )
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/cargos/');
		}
        
		$this->Cargo->del($id);
		$this->setMessage("sucesso","Cargo removido com sucesso.");
		$this->redirect('/cargos');
    }
}
?>