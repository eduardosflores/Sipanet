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

class SituacoesController extends AppController
{
    public $helpers = array('Html', 'Session');
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('Situacao.descricao' => 'asc'));

    function beforeFilter() {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

	/**
	 * http://sistema/situacoes/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Situações');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->Situacao->recursive = -1;

    	// Busca os dados e envia para a view
        $this->set('situacoes', $this->paginate('Situacao'));
    }

	/**
	* http://sistema/situacoes/exibir/$id **/
    public function exibir($id = null)
    {
        $this->set('fieldSetTitle','Informações da Situação');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/situacoes/');
		}

		//Busca o registro
		$this->Situacao->recursive = -1;
		$situacao = $this->Situacao->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($situacao['Situacao']['id'] != $id) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/situacoes/');
		}

		$this->set('situacao', $situacao);
    }


	/**
	 * http://sistema/situacoes/cadastrar/ **/
    public function cadastrar() {

		$this->set('fieldSetTitle','Cadastrando Situacao');		

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data)) {
			$this->render();

		// Se tiver dado submit no form:
		} else {
			// Limpa os campos
			//$this->cleanUpFields();

			// Tenta salvar
			if( $this->Situacao->save($this->data) ) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('situacoes', null, 'C', null, $this->data['Situacao']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "Situacao cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/situacoes');
			} else {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->Situacao->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/situacoes/alterar/ **/
    public function alterar($id = null) {

		$this->set('fieldSetTitle','Alterando Situacao');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/situacoes/');
		}

		$situacao = $this->Situacao->read(null, $id);
		if(empty($this->data)) {

			// Busca o registro
			$this->data = $situacao;
		} else {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $situacao;

			$this->Situacao->id = $id;

			// Tenta salvar o registro
			if($this->Situacao->save($this->data)) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('situacoes', $id, 'U', $old_data, $this->data['Situacao']);

				$this->setMessage("sucesso", "Situacao atualizado com sucesso.");
				$this->redirect('/situacoes/exibir/'.$id);
			} else {
				$this->setMessage("erro", "", $this->Situacao->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/situacoes/delete/ **/
    public function delete($id = null) {

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/situacoes/');
		}
			$this->Situacao->del($id);
			$this->setMessage("sucesso","Situacao removido com sucesso.");
			$this->redirect('/situacoes');
    }
}
?>