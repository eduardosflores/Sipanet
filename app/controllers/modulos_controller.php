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

class ModulosController extends AppController
{
    public $helpers = array('Html', 'Session');
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('Modulo.descricao' => 'asc'));

    function beforeFilter()
    {
        $modulo = 17;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

	/**
	 * http://sistema/modulos/ **/
    public function index()
    {
        $this->set('fieldSetTitle','Lista de Modulos');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->Modulo->recursive = -1;

    	// Busca os dados e envia para a view
        $this->set('modulos', $this->paginate('Modulo'));
    }

	/**
	* http://sistema/modulos/exibir/$id **/
    public function exibir($id = null)
    {
        $this->set('fieldSetTitle','Informações do modulo');

		if( ! $this->checkValidId($id) )
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/modulos/');
		}

		//Busca o registro
		$this->Modulo->recursive = -1;
		$modulo = $this->Modulo->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($modulo['Modulo']['id'] != $id)
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/modulos/');
		}

		$this->set('modulo', $modulo);
    }


	/**
	 * http://sistema/modulos/cadastrar/ **/
    public function cadastrar() 
    {
        $this->set('fieldSetTitle','Cadastrando Modulo');		

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data))
        {
			$this->render();

		// Se tiver dado submit no form:
		} else {
			// Limpa os campos
			//$this->cleanUpFields();

			// Tenta salvar
			if( $this->Modulo->save($this->data) ) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('modulos', null, 'C', null, $this->data['Modulo']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "Modulo cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/modulos');
			} else {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->Modulo->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/modulos/alterar/ **/
    public function alterar($id = null) {

		$this->set('fieldSetTitle','Alterando Modulo');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/modulos/');
		}

		$modulo = $this->Modulo->read(null, $id);
		if(empty($this->data)) {

			// Busca o registro
			$this->data = $modulo;
		} else {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $modulo;

			$this->Modulo->id = $id;

			// Tenta salvar o registro
			if($this->Modulo->save($this->data)) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('modulos', $id, 'U', $old_data, $this->data['Modulo']);

				$this->setMessage("sucesso", "Modulo atualizado com sucesso.");
				$this->redirect('/modulos/exibir/'.$id);
			} else {
				$this->setMessage("erro", "", $this->Modulo->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/modulos/delete/ **/
    public function delete($id = null) {

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/modulos/');
		}
			$this->Modulo->del($id);
			$this->setMessage("sucesso","Modulo removido com sucesso.");
			$this->redirect('/modulos');
    }
}
?>