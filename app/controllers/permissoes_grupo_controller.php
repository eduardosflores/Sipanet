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

class PermissoesGrupoController extends AppController
{
    public $helpers = array('Html', 'Session');

    function beforeFilter() {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

	/**
	 * http://sistema/permissoes_grupo/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de PermissoesGrupo');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->PermissaoGrupo->recursive = -1;

    	// Busca os dados e envia para a view
		$this->set('permissoes_grupo', $this->PermissaoGrupo->find('all', null, 'descricao asc'));
    }

	/**
	* http://sistema/permissoes_grupo/exibir/$id **/
    public function exibir($id = null)
    {
        $this->set('fieldSetTitle','Informações do permissao_grupo');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/permissoes_grupo/');
		}

		//Busca o registro
		$this->PermissaoGrupo->recursive = -1;
		$permissao_grupo = $this->PermissaoGrupo->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($permissao_grupo['PermissaoGrupo']['id'] != $id) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/permissoes_grupo/');
		}

		$this->set('permissao_grupo', $permissao_grupo);
    }


	/**
	 * http://sistema/permissoes_grupo/cadastrar/ **/
    public function cadastrar() {

		$this->set('fieldSetTitle','Cadastrando PermissaoGrupo');		

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data)) {
			$this->render();

		// Se tiver dado submit no form:
		} else {
			// Limpa os campos
			//$this->cleanUpFields();

			// Tenta salvar
			if( $this->PermissaoGrupo->save($this->data) ) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('permissoes_grupo', null, 'C', null, $this->data['PermissaoGrupo']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "PermissaoGrupo cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/permissoes_grupo');
			} else {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->PermissaoGrupo->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/permissoes_grupo/alterar/ **/
    public function alterar($id = null) {

		$this->set('fieldSetTitle','Alterando PermissaoGrupo');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/permissoes_grupo/');
		}

		$permissao_grupo = $this->PermissaoGrupo->read(null, $id);
		if(empty($this->data)) {

			// Busca o registro
			$this->data = $permissao_grupo;
		} else {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $permissao_grupo;

			$this->PermissaoGrupo->id = $id;

			// Tenta salvar o registro
			if($this->PermissaoGrupo->save($this->data)) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('permissoes_grupo', $id, 'U', $old_data, $this->data['PermissaoGrupo']);

				$this->setMessage("sucesso", "PermissaoGrupo atualizado com sucesso.");
				$this->redirect('/permissoes_grupo/exibir/'.$id);
			} else {
				$this->setMessage("erro", "", $this->PermissaoGrupo->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/permissoes_grupo/delete/ **/
    public function delete($id = null) {

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/permissoes_grupo/');
		}
			$this->PermissaoGrupo->del($id);
			$this->setMessage("sucesso","PermissaoGrupo removido com sucesso.");
			$this->redirect('/permissoes_grupo');
    }
}
?>