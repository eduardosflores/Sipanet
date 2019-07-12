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

class TiposInteressadoController extends AppController
{
    public $helpers = array('Html', 'Session');
	public $uses = array('TipoInteressado');
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('TipoInteressado.descricao' => 'asc'));

    function beforeFilter() {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

	/**
	 * http://sistema/tipos_interessado/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Tipos de Interessado');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->TipoInteressado->recursive = -1;

    	// Busca os dados e envia para a view
        $this->set('tipos_interessado', $this->paginate('TipoInteressado'));
    }

	/**
	* http://sistema/tipos_interessado/exibir/$id **/
    public function exibir($id = null)
    {
        $this->set('fieldSetTitle','Informações do Tipo de Interessado');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/tipos_interessado/');
		}

		//Busca o registro
		$this->TipoInteressado->recursive = -1;
		$tipo_interessado = $this->TipoInteressado->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($tipo_interessado['TipoInteressado']['id'] != $id) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/tipos_interessado/');
		}

		$this->set('tipo_interessado', $tipo_interessado);
    }


	/**
	 * http://sistema/tipos_interessado/cadastrar/ **/
    public function cadastrar() {

		$this->set('fieldSetTitle','Cadastrando Tipo de Interessado');		

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data)) {
			$this->render();

		// Se tiver dado submit no form:
		} else {
			// Limpa os campos
			//$this->cleanUpFields();

			// Tenta salvar
			if( $this->TipoInteressado->save($this->data) ) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('tipos_interessado', null, 'C', null, $this->data['TipoInteressado']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "Tipo de Interessado cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/tipos_interessado');
			} else {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->TipoInteressado->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/tipos_interessado/alterar/ **/
    public function alterar($id = null) {

		$this->set('fieldSetTitle','Alterando Tipo de Interessado');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/tipos_interessado/');
		}

		$tipo_interessado = $this->TipoInteressado->read(null, $id);
		if(empty($this->data)) {

			// Busca o registro
			$this->data = $tipo_interessado;
		} else {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $tipo_interessado;

			$this->TipoInteressado->id = $id;

			// Tenta salvar o registro
			if($this->TipoInteressado->save($this->data)) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('tipos_interessado', $id, 'U', $old_data, $this->data['TipoInteressado']);

				$this->setMessage("sucesso", "Tipo de Interessado atualizado com sucesso.");
				$this->redirect('/tipos_interessado/exibir/'.$id);
			} else {
				$this->setMessage("erro", "", $this->TipoInteressado->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/tipos_interessado/delete/ 
	 **/
    public function delete($id = null) {

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/tipos_interessado/');
		}
			$this->TipoInteressado->del($id);
			$this->setMessage("sucesso","Tipo de Interessado removido com sucesso.");
			$this->redirect('/tipos_interessado');
    }
}
?>