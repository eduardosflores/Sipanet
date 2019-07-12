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

class GruposUsuarioController extends AppController
{
    public $helpers = array('Html', 'Session');
	public $uses = array('GrupoUsuario','Modulo','PermissaoGrupo');
    
    function beforeFilter() {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }
    
	/**
	 * http://sistema/grupos_usuario/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Grupos de Usuario');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->GrupoUsuario->recursive = -1;

    	// Busca os dados e envia para a view
		$this->set('grupos_usuario', $this->GrupoUsuario->find('all', null, 'descricao asc'));
    }

	/**
	* http://sistema/grupos_usuario/exibir/$id **/
    public function exibir($id = null)
    {
        $this->set('fieldSetTitle','Informações do grupo_usuario');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/grupos_usuario/');
		}

		//Busca o registro
		$this->GrupoUsuario->recursive = -1;
		$grupo_usuario = $this->GrupoUsuario->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($grupo_usuario['GrupoUsuario']['id'] != $id) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/grupos_usuario/');
		}

		$this->set('grupo_usuario', $grupo_usuario);
    }


	/**
	 * http://sistema/grupos_usuario/cadastrar/ **/
    public function cadastrar() {

		$this->set('fieldSetTitle','Cadastrando Grupo de Usuario');		

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data)) {
			$this->render();

		// Se tiver dado submit no form:
		} else {
			// Limpa os campos
			//$this->cleanUpFields();

			// Tenta salvar
			if( $this->GrupoUsuario->save($this->data) ) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('grupos_usuario', null, 'C', null, $this->data['GrupoUsuario']);

				// Exibe mensagem de sucesso
				$this->setMessage("sucesso", "GrupoUsuario cadastrado com sucesso.");
				// Redirecionar para listagem ou para exibição do item salvo
				$this->redirect('/grupos_usuario');
			} else {
				// Se ocorrer erro ao savar, exibe mensagem de erro
				// passando os arrays com os erros de validação
				$this->setMessage("erro", "", $this->GrupoUsuario->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/grupos_usuario/alterar/ **/
    public function alterar($id = null) {

		$this->set('fieldSetTitle','Alterando Grupo de Usuario');

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/grupos_usuario/');
		}

		$grupo_usuario = $this->GrupoUsuario->read(null, $id);
		if(empty($this->data)) {

			// Busca o registro
			$this->data = $grupo_usuario;
		} else {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $grupo_usuario;

			$this->GrupoUsuario->id = $id;

			// Tenta salvar o registro
			if($this->GrupoUsuario->save($this->data)) {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('grupos_usuario', $id, 'U', $old_data, $this->data['GrupoUsuario']);

				$this->setMessage("sucesso", "Grupo de Usuario atualizado com sucesso.");
				$this->redirect('/grupos_usuario/exibir/'.$id);
			} else {
				$this->setMessage("erro", "", $this->GrupoUsuario->validationErrors);
			}
		}
    }

    /**
	 * http://sistema/grupos_usuario/delete/ **/
    public function delete($id = null) {

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/grupos_usuario/');
		}
			$this->GrupoUsuario->del($id);
			$this->setMessage("sucesso","Grupo de Usuario removido com sucesso.");
			$this->redirect('/grupos_usuario');
    }



	/**
	 * http://sistema/grupos_usuario/exibir_permissoes/ 
	 **/
	function exibir_permissoes($grupo_id = null)
	{
	    
		$this->set('fieldSetTitle','Permissoes do Grupo de Usuario');

		if( ! $this->checkValidId($grupo_id) ) 
		{
		    $this->setMessage("erro", "Código Inválido");
		    $this->redirect('/grupos_usuario/');
		}
	    //Busca o servidor
		$this->GrupoUsuario->recursive = -1;
		$this->set('grupo',$this->GrupoUsuario->read(null,$grupo_id));

        $this->PermissaoGrupo->recursive = 1;
		$permissoes_grupo = $this->PermissaoGrupo->findAll("grupo_usuario_id = $grupo_id");
        $this->set('permissoes_grupo',$permissoes_grupo);
       
	}


	function cadastrar_permissoes($grupo_id = null) 
	{
	    
        $this->set('fieldSetTitle','Dar Permissao ao Grupo de Usuario');

		if ( ! $this->checkValidId($grupo_id) ) 
		{
		    $this->setMessage("erro", "Código Inválido");
		    $this->redirect('/grupos_usuario/');
		}

		$this->set('modulos',$this->Modulo->findAll());
	
		$grupo = $this->GrupoUsuario->findById($grupo_id);
		$this->set('grupo',$grupo);

		
		$permissoes_grupo = $this->PermissaoGrupo->find('all', array('conditions'=>"grupo_usuario_id = $grupo_id",'fields' =>array('modulo_id')));

		//Carregar modulos ja existentes
		$modulo_ids = array();
		foreach ($permissoes_grupo as $permissao_grupo) 
		{
		   $modulo_ids[] = $permissao_grupo['PermissaoGrupo']['modulo_id'];
		}
		$this->set('modulo_ids', $modulo_ids);

		//pr($modulo_ids);
		//die();

		if(empty($this->data)) {

		    $this->data = null;
			$this->render(); // Busca o registro

		} else {

	        // Apaga todos as permissoes do servidor.
			$this->PermissaoGrupo->deleteAll(array('grupo_usuario_id' => $grupo_id) );
    
			for ($i=0; $i<count($this->data['PermissaoGrupo']['modulo_id']);$i++)
			{
				$array['PermissaoGrupo']['modulo_id'] = $this->data['PermissaoGrupo']['modulo_id'][$i];
				$array['PermissaoGrupo']['grupo_usuario_id'] = $grupo_id;

                $this->PermissaoGrupo->create();
				if ($this->PermissaoGrupo->save($array['PermissaoGrupo'])) 
				{
				    $this->logger('permissoes_grupo', null, 'C', null, $array['PermissaoGrupo']);
   				    // Exibe mensagem de sucesso
				    $this->setMessage("sucesso", "Permissões alteradas com sucesso.");
				}
			}
				$this->redirect('/grupos_usuario/exibir_permissoes/'.$grupo_id);
		}
	}


	function deletar_permissoes($grupo_id = null,$id = null) 
	{

		if( ! $this->checkValidId($id) ) 
		{
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/grupos_usuario/');
		}

		$this->PermissaoGrupo->delete($id);
		$this->setMessage('sucesso','Permissão removida com sucesso');
		$this->redirect('/grupos_usuario/exibir_permissoes/'.$grupo_id);


	}
	

}
?>