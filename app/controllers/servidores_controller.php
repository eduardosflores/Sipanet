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

class ServidoresController extends AppController
{
    public $helpers = array('Html', 'Session', 'Ajax', 'protocolo');
    public $uses = array('Setor','GrupoUsuario','Cargo','Servidor','PermissaoServidor', 'SetorServidor', 'Modulo', 'Orgao');
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('Servidor.nome' => 'asc'));

    function beforeFilter() 
    {
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

	/**
	 * http://sistema/servidores/ **/
    public function index()
    {
    	$this->set('fieldSetTitle','Lista de Servidores');

		// Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
    	$this->Servidor->recursive = 0;
        
        $this->paginate = array('conditions' => "Setor.orgao_id = {$this->Session->read('Orgao.id')}", 'limit' => 30, 'page' => 1, 'order' => array('Servidor.nome' => 'asc'));

    	// Busca os dados e envia para a view
        $this->set('servidores', $this->paginate('Servidor'));
		
    }

	/**
	* http://sistema/servidores/exibir/$id **/
    public function exibir($id = null)
    {
        $this->verificarLogin(16);
        
        $this->set('fieldSetTitle','Informações do servidor');

		if( ! $this->checkValidId($id) )
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/servidores/');
		}

		//Busca o registro
		$this->Servidor->recursive = 0;
		$servidor = $this->Servidor->read(null, $id);

		// Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
		if($servidor['Servidor']['id'] != $id)
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/servidores/');
		}

		$this->set('servidor', $servidor);
    }


	/**
	 * http://sistema/servidores/cadastrar/ **/
    public function cadastrar()
    {
        $this->verificarLogin(16);
        
		//Carregar listagens
		$this->set('cargos',$this->Cargo->find('list',array('fields'=>'descricao')));
		$this->set('grupos_usuario',$this->GrupoUsuario->find('list',array('fields'=>'descricao')));
        
        
        // Verifica se o usuário tem permissão para cadastrar setores de órgãos diferentes do seu
        $modulos = $this->Session->read('Modulos');
            
        if(in_array(18, $modulos))
        {
            //Carregar listagem de Orgaos
            $this->set('orgaos', $this->Orgao->listar());
            $cadastra_orgao = true;
        }
        else
        {
            $cadastra_orgao = false;
        }
        
        $this->set('cadastra_orgao', $cadastra_orgao);
        
        // Lista os setores do orgao em sessao
        $this->set('setores', $this->Setor->findByOrgao($this->Session->read('Orgao.id'), true));

		$this->set('fieldSetTitle','Cadastrando Servidor');		

    	// Se estiver entrando na página pela primeira vez, apenas exibe o form
		if(empty($this->data))
        {
			$this->render();

		// Se tiver dado submit no form:
		}
        else
        {
            //formata datas antes de salvar
			$this->data['Servidor']['data_permissao_inicio'] = $this->formatDateToIso($this->data['Servidor']['data_permissao_inicio']);
			$this->data['Servidor']['data_permissao_fim'] = $this->formatDateToIso($this->data['Servidor']['data_permissao_fim']);
			$this->data['Servidor']['senha'] = md5($this->data['Servidor']['senha']);
            
            
            
            // Verifica se o login é único dentro do órgão
            $count_servidor = $this->Servidor->find('count', array('conditions' => "upper(login) = upper('{$this->data['Servidor']['login']}') and Setor.orgao_id = {$this->params['form']['OrgaoSelect']}"));
            if($count_servidor != 0)
            {
            	$this->setMessage("erro", "O Login informado já está sendo utilizado neste Órgão.");
                
            }
            else
            {
            	
    			// Tenta salvar
    			if( $this->Servidor->save($this->data) )
                {
    
    				// Se for salvo com sucesso, cria um log no banco
    				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
    				$this->logger('servidores', null, 'C', null, $this->data['Servidor']);
    
    				// Exibe mensagem de sucesso
    				$this->setMessage("sucesso", "Servidor cadastrado com sucesso.");
    				// Redirecionar para listagem ou para exibição do item salvo
    				$this->redirect('/servidores');
    			}
                else
                {
    				// Se ocorrer erro ao savar, exibe mensagem de erro
    				// passando os arrays com os erros de validação
    				$this->setMessage("erro", "", $this->Servidor->validationErrors);
    			}
            }
		}
    }

    /**
	 * http://sistema/servidores/alterar/ **/
    public function alterar($id = null)
    {
        $this->verificarLogin(16);

		$this->set('fieldSetTitle','Alterando Servidor');

		if( ! $this->checkValidId($id) )
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/servidores/');
		}

		//Carregar listagens
		$this->set('cargos',$this->Cargo->find('list',array('fields'=>'descricao')));
		$this->set('grupos_usuario',$this->GrupoUsuario->find('list',array('fields'=>'descricao')));
		$this->set('setores',$this->Setor->find('list',array('fields'=>'sigla', 'order' => 'sigla')));

		//Carregar registro a ser alterado
		$servidor = $this->Servidor->read(null, $id,-1);
		if(empty($this->data))
        {

			// Busca o registro
			$this->data = $servidor;
		}
        else
        {
			// Caso tenha sido chamado após o submit

			// Busca os dados originais
			$old_data = $servidor;

			$this->Servidor->id = $id;
			
			//formata datas antes de salvar
			$this->data['Servidor']['data_permissao_inicio'] = $this->formatDateToIso($this->data['Servidor']['data_permissao_inicio']);
			$this->data['Servidor']['data_permissao_fim'] = $this->formatDateToIso($this->data['Servidor']['data_permissao_fim']);
			
			// Tenta salvar o registro
			if($this->Servidor->save($this->data))
            {

				// Se for salvo com sucesso, cria um log no banco
				// logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
				$this->logger('servidores', $id, 'U', $old_data, $this->data['Servidor']);

				$this->setMessage("sucesso", "Servidor atualizado com sucesso.");
				$this->redirect('/servidores/exibir/'.$id);
			}
            else
            {
				$this->setMessage("erro", "", $this->Servidor->validationErrors);
			}
		}
    }

    /**
     * http://sistema/servidores/alterar_senha/ **/
    public function alterar_senha()
    {

        $this->set('fieldSetTitle','Trocar Senha');

        //Carregar registro a ser alterado
        $servidor = $this->Servidor->read(null, $this->Session->read('Servidor.id'),-1);
        $this->set('servidor', $servidor);
        
        if(empty($this->data))
        {
            $this->render();
        }
        else
        {
            // Caso tenha sido chamado após o submit
            
            // Verifica se os dados são válidos
            
            if(strtoupper(md5($this->data['Servidor']['senha_atual'])) != $servidor['Servidor']['senha'])
            {
                $this->data['Servidor'] = null;
            	$this->setMessage("erro", "Senha atual inválida.");
                $this->render();
            }
            elseif($this->data['Servidor']['nova_senha'] != $this->data['Servidor']['nova_senha_confirmacao'])
            {
                $this->data['Servidor'] = null;
                $this->setMessage("erro", "Nova Senha e Confirmação são diferentes.");
                $this->render();
            }
            else
            {
                $dados = array('Servidor' => array());
                $dados['Servidor']['id'] = $servidor['Servidor']['id'];
                $dados['Servidor']['senha'] = strtoupper(md5($this->data['Servidor']['nova_senha']));
    
                // Tenta salvar o registro
                if($this->Servidor->save($dados, null, array('senha')))
                {
    
                    // Se for salvo com sucesso, cria um log no banco
                    // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                    $this->logger('servidores', $servidor['Servidor']['id'], 'U', $servidor, $dados['Servidor']);
    
                    $this->setMessage("sucesso", "Servidor atualizado com sucesso.");
                    $this->redirect('/servidores/alterar_senha/');
                }
                else
                {
                    $this->setMessage("erro", "", $this->Servidor->validationErrors);
                }
            }
        }
    }

    /**
     * http://sistema/servidores/redefinir_senha/$id **/
    public function redefinir_senha($id)
    {
        $this->set('fieldSetTitle', 'Redefinir Senha');
        $this->verificarLogin(16);
        if (!$this->checkValidId($id))
        {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/servidores/');
        }
        
        //Carregar registro a ser alterado
        $servidor = $this->Servidor->read(null, $id, -1);
        $this->set('servidor', $servidor);
        
        if (empty ($this->data))
        {
            $caracteresParaSenha = str_split('abcdefghijklmnpqrstuvwxyz123456789', 1);
            $senhaGerada = '';
            while (strlen($senhaGerada) < 10)
            {
                $index = count($caracteresParaSenha) - 1;
                $senhaGerada .= $caracteresParaSenha[rand(0, $index)];
            }
            $this->set('senhaGerada', str_replace(" ","",$senhaGerada));
            $this->render();
        }
        else
        {
            // Caso tenha sido chamado após o submit
            // Verifica se os dados são válidos
            $dados = array (
                'Servidor' => array ()
            );
            $dados['Servidor']['id'] = $servidor['Servidor']['id'];
            $dados['Servidor']['senha'] = strtoupper(md5($this->data['Servidor']['senha']));
            
            // Tenta salvar o registro
            if ($this->Servidor->save($dados, null, array ('senha')))
            {
                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('servidores', $servidor['Servidor']['id'], 'U', $servidor, $dados['Servidor']);
                $this->setMessage("sucesso", "Servidor atualizado com sucesso.");
                $this->redirect('/servidores/exibir/' . $servidor['Servidor']['id']);
            }
            else
            {
                $this->setMessage("erro", "", $this->Servidor->validationErrors);
                $this->redirect('/servidores/redefinir_senha/' . $servidor['Servidor']['id']);
            }
            
        }
    }

    /**
	 * http://sistema/servidores/delete/ **/
    public function delete($id = null)
    {
        $this->verificarLogin(16);

		if( ! $this->checkValidId($id) )
        {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/servidores/');
		}
        
		$this->Servidor->del($id);
		$this->setMessage("sucesso","Servidor removido com sucesso.");
		$this->redirect('/servidores');
    }

    function exibir_permissoes($servidor_id = null)
	{
        $this->verificarLogin(16);
	    
		$this->set('fieldSetTitle','Permissoes do Servidor');

		if( ! $this->checkValidId($servidor_id) ) 
		{
		    $this->setMessage("erro", "Código Inválido");
		    $this->redirect('/servidores/');
		}
	    //Busca o servidor
		$this->Servidor->recursive = -1;
		$this->set('servidor',$this->Servidor->read(null,$servidor_id));

        $this->PermissaoServidor->recursive = 1;
		$permissoes_servidor = $this->PermissaoServidor->findAll("servidor_id = $servidor_id");
        $this->set('permissoes_servidor',$permissoes_servidor);
       
	}
    
	function cadastrar_permissoes($servidor_id = null) 
	{
        $this->verificarLogin(16);
	    
        $this->set('fieldSetTitle','Dar Permissao ao Servidor');

		if ( ! $this->checkValidId($servidor_id) ) 
		{
		    $this->setMessage("erro", "Código Inválido");
		    $this->redirect('/servidores/');
		}

		$this->set('modulos',$this->Modulo->findAll());
	
		$servidor = $this->Servidor->findById($servidor_id);
		$this->set('servidor',$servidor);

		
		$permissoes_servidor = $this->PermissaoServidor->find('all', array('conditions'=>"servidor_id = $servidor_id",'fields' =>array('modulo_id')));

		//Carregar modulos ja existentes
		$modulo_ids = array();
		foreach ($permissoes_servidor as $permissao_servidor) 
		{
		   $modulo_ids[] = $permissao_servidor['PermissaoServidor']['modulo_id'];
		}
		$this->set('modulo_ids', $modulo_ids);

		//pr($modulo_ids);
		//die();

		if(empty($this->data)) {

		    $this->data = null;
			$this->render(); // Busca o registro

		} else {

	        // Apaga todos as permissoes do servidor.
			$this->PermissaoServidor->deleteAll(array('servidor_id' => $servidor_id) );
    
			for ($i=0; $i<count($this->data['PermissaoServidor']['modulo_id']);$i++)
			{
				$array['PermissaoServidor']['modulo_id'] = $this->data['PermissaoServidor']['modulo_id'][$i];
				$array['PermissaoServidor']['servidor_id'] = $servidor_id;

                $this->PermissaoServidor->create();
				if ($this->PermissaoServidor->save($array['PermissaoServidor'])) 
				{
				    $this->logger('permissoes_servidores', null, 'C', null, $array['PermissaoServidor']);
   				    // Exibe mensagem de sucesso
				    $this->setMessage("sucesso", "Permissões alteradas com sucesso.");
				}
			}
				$this->redirect('/servidores/exibir_permissoes/'.$servidor_id);
		}
	}


	function deletar_permissoes($servidor_id = null,$id = null) 
	{
        $this->verificarLogin(16);

		if( ! $this->checkValidId($id) ) 
		{
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/servidores/');
		}

		$this->PermissaoServidor->delete($id);
		$this->setMessage('sucesso','Permissão removida com sucesso');
		$this->redirect('/servidores/exibir_permissoes/'.$servidor_id);


	}


    /**
     * Exibe setores aos quais o servidor está associado
     * http://sistema/servidores/exibir_setor/$servidor_id
     * **/
    function exibir_setores($servidor_id = null)
    {
        $this->verificarLogin(16);
        
        $this->set('fieldSetTitle','Setores associados ao Servidor');

        if( ! $this->checkValidId($servidor_id) ) 
        {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/servidores/');
        }
        
        //Busca o servidor
        $this->Servidor->recursive = 1;
        $this->set('servidor',$this->Servidor->read(null,$servidor_id));

        $this->SetorServidor->recursive = 2;
        $setores_servidor = $this->SetorServidor->findAll("servidor_id = $servidor_id");
        $this->set('setores_servidor',$setores_servidor);
       
    }
    
    /**
     * Associa um novo setor ao servidor
     * http://sistema/servidores/cadastrar_setor/$servidor_id
     * **/
    function cadastrar_setor($servidor_id = null) 
    {
        $this->verificarLogin(16);
        
        $this->set('fieldSetTitle','Associar Setor ao Servidor');
        
        if ( ! $this->checkValidId($servidor_id) ) 
        {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/servidores/');
        }
        
        // Busca dados do servidor
        $this->Servidor->recursive = 1;
        $this->Servidor->unbindModel(array('hasMany' => array('PermissaoServidor'), 'belongsTo' => array('Cargo', 'GrupoUsuario')));
        $servidor = $this->Servidor->findById($servidor_id);
        $this->set('servidor', $servidor);
        
        // Busca os setores já associados ao servidor
        $setores_associados = $this->SetorServidor->find('list', array('conditions' => "servidor_id = {$servidor['Servidor']['id']}", 'fields' => 'setor_id'));
        
        // Adiciona o setor principal do servidor à lista
        array_push($setores_associados, $servidor['Servidor']['setor_id']);
        
        // Busca os setores do órgão ao qual este servidor está vinculado.
        // Não deve exibir nem o setor principal nem os setores já associados ao servidor.
        $conditions =   "orgao_id = {$servidor['Setor']['orgao_id']} " .
                        "and id not in (" . join(',', $setores_associados) . ") " .
                        "and ativo = true";
         
        $this->Setor->recursive = -1;
        $setores = $this->Setor->find('all', array('conditions' => $conditions, 'order' => 'descricao asc'));
        $this->set('setores', $setores);
        
        if(empty($this->data))
        {

            $this->data = null;
            $this->render();
        }
        elseif($this->data['SetorServidor']['setor_id'] != null)
        {
        	// Tenta salvar o registro passado
            if ($this->SetorServidor->save($this->data)) 
            {
                $this->logger('setores_servidores', null, 'C', null, $this->data['SetorServidor']);
                
                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Setor associado ao Servidor com sucesso.");
                $this->redirect("/servidores/exibir_setores/{$servidor['Servidor']['id']}");
            }
        }
    }

    /**
     * Remove a ssociação entre o servidor e o setor
     * http://sistema/servidores/deletar_setor/$servidor_id/$setor_id
     * **/
    function deletar_setor($servidor_id = null,$setor_id = null) 
    {
        $this->verificarLogin(16);

        if( ! $this->checkValidId($setor_id) ) 
        {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/servidores/');
        }

        $this->SetorServidor->delete($setor_id);
        $this->logger('setores_servidores', $setor_id, 'D', null, $setor_id);
        
        $this->setMessage('sucesso','Associação entre servidor e setor removida com sucesso');
        $this->redirect('/servidores/exibir_setores/' . $servidor_id);
    }


    /**
     * http://sistema/servidores/consultar/ **/
    public function consultar()
    {
        $this->verificarLogin(14);
        
        $this->set('fieldSetTitle', 'Consultar Servidor');
        
        // Busca a listagem de todos os órgãos
        $orgaos = $this->Orgao->listar();
        $this->set('orgaos', $orgaos);
        $grupos_usuario = $this->GrupoUsuario->listar();
        $this->set('grupos_usuario',$grupos_usuario);

        // Caso os dados tenham sido passados via URL, repassa os dados para a variável $this->data['Busca']. A partir desta variável será feita a consulta
        if(count($this->params['named']) > 0)
        {
            $this->data['Servidor'] = $this->params['named'];
        }
        
        // Verifica se a busca ja foi realizada
        if(isset($this->data['Servidor']))
        {
            // Formata a URL que será chamada na paginação
            $this->set('url', $this->gerarNamedUrl($this->data['Servidor']));
            
            $criterios = $this->Servidor->resgatarCriteriosBusca($this->data['Servidor']);
            $this->GrupoUsuario->unbindModel(array('hasMany' => array('PermissaoGrupo','Servidor')),false);
            $this->Setor->unbindModel(array('belongsTo' => array('Orgao')),false);
            $this->Servidor->recursive = 2;
            

            // Verifica se foram encontrados servidores na busca
            if($servidores = $this->paginate('Servidor', $criterios))
            {
                $this->set("servidores", $servidores);
            }
            else
            {
                $this->setMessage("erro", "Nenhum servidor encontrado.");
            }
        }
    }


    public function busca_popup()
    {
    	$this->set('fieldSetTitle','Pesquisar Servidores');
        $this->Interessado->recursive = -1;
        
        $this->set("servidores", $this->Servidor->buscar($this->params['form']));
        
		$this->render(null, "popup");
    }


}
?>