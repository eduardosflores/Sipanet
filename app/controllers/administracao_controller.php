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
class AdministracaoController extends AppController {

    public $name = "Administracao";
    public $uses = array(
        'Processo',
        'ProcessoAnexo',
        'Tramite',
        'Orgao',
        'ServidorOrigem',
        'Natureza',
        'Situacao',
        'TipoProcesso',
        'DiaNaMesa',
        'Setor',
    );
    public $helpers = array('Html', 'Session', 'Protocolo', 'Ajax');

    function index() {
        $this->set('fieldSetTitle', 'Administração');
    }

    function beforeFilter() {
        $this->verificarLogin(21);
    }

    /**
     * Busca o processo pelo número passado.
     * * */
    private function buscarProcesso($orgao, $numero, $ano, $action) {
        $processo = $this->Processo->findByNumero($orgao, $numero, $ano);

        // Se o processo não foi encontrado, retorna erro.
        if ($processo) {
            return $processo;
        } else {
            $this->setMessage("erro", "Processo não encontrado");
            $this->redirect("/administracao/{$action}/", null, true);
        }
    }

    /**
     * Alterar processo. Primeiro passo, seleciona processo.
     * http://sistema/administracao/alteracao_processo/
     * * */
    public function alteracao_processo() {
        $this->set('fieldSetTitle', '[Administração] Alterar Processos');
        $this->set('action_form', '/administracao/alteracao_processo');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            $this->render('busca_generica');
        } else {
            $action_retorno = 'alteracao_processo';

            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;

            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);

            // Verifica se o processo se encontra na situação NORMAL
            //$this->verificarSituacao($processo, 'N', $action_retorno);

            $this->redirect("/administracao/alterar_processo/{$processo['Processo']['id']}");
        }
    }

    /**
     * http://sistema/processos/alterar/$id * */
    public function alterar_processo($id) {
        $action_retorno = 'alteracao_processo';

        $processo = $this->Processo->read(null, $id);

        // Verifica se o processo se encontra na situação NORMAL
        //$this->verificarSituacao($processo, 'N', $action_retorno);

        $this->set('naturezas', $this->Natureza->find('list', array('conditions' => 'ativo = true', 'fields' => 'descricao', 'order' => 'descricao asc')));
        $this->set('situacoes', $this->Situacao->listar());
        $this->set('orgaos', $this->Orgao->listar());
        //seta variavel com os tipos de processo
        $this->set('tipos_processo', $this->TipoProcesso->find('list', array('fields' => 'descricao', 'order' => 'descricao asc')));

        $this->set('fieldSetTitle', '[Administração] Alteração de Processos');

        $this->set('processo', $processo);

        // Se estiver entrando na página pela primeira vez, apenas exibe o form
        if (empty($this->data)) {
            $this->render();

            // Se tiver dado submit no form:
        } else {
            // Formata o número do documento do processo
            if ((strlen($this->data['Processo']['documento_numero']) > 0) && (strlen($this->data['Processo']['documento_numero_tipo']) > 0)) {
                $this->data['Processo']['documento_numero'] = "{$this->data['Processo']['documento_numero_tipo']} {$this->data['Processo']['documento_numero']}";
            }

            // Tenta salvar
            if ($this->Processo->save($this->data)) {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('processos', null, 'U', $processo['Processo'], $this->data['Processo']);

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo alterado com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/processos/consultar/' . $processo['Processo']['id']);
            } else {
                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->Processo->validationErrors);
            }
        }
    }

    public function cancelamento_tramite() {
        $this->set('fieldSetTitle', '[Administração] Cancelar Último Trâmite de Processo');
        $this->set('action_form', '/administracao/cancelamento_tramite');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            $this->render('/administracao/busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'cancelamento_tramite');

            // Como o processo foi encontrado, busca o ultimo tramite realizado
            $this->Tramite->unbindModel(array('belongsTo' => array('Processo', 'SetorOrigem', 'ServidorRecebimento')));
            $this->Tramite->ServidorOrigem->unbindModel(array('belongsTo' => array('GrupoUsuario', 'Setor', 'Cargo'), 'hasMany' => array('PermissaoServidor')));
            $tramite = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id'], 2);

            // Se não existe trâmite, retorna erro.
            if (!$tramite) {
                $this->setMessage("erro", "Este processo não foi encaminhado");
                $this->redirect('/administracao/cancelamento_tramite/');
            }

            // Verifica se o processo está anexado a outro
            $this->verificarSeEstaAnexado($processo, 'cancelamento_tramite');

            //verifica se o processo ja foi recebido pelo setor de origem
            if (($tramite['Tramite']['flag_recebimento'] == true)) {
                $this->data = null;
                $this->setMessage("erro", "Este processo já foi recebido e seu tramite não pode ser cancelado.");
                $this->redirect('/administracao/cancelamento_tramite/');
            }

            // Se cumpriu as exigências, exibe a view
            $this->set("processo", $processo);
            $this->set("tramite", $tramite);

            $this->render();
        }
    }

    public function cancelar_tramite($id = null) {


        $action_retorno = 'cancelamento_tramite';

        // Verifica se o id passado é válido
        if (!$this->checkValidId($id)) {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect("/administracao/{$action_retorno}/");
        }

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect("/adminisracao/{$action_retorno}/");
        } else {
            // Busca o ultimo tramite realizado
            $tramite = $this->Tramite->ultimoTramiteDoProcesso($id);

            // Se não existe trâmite, retorna erro.
            if (!$tramite) {
                $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                $this->redirect("/administracao/{$action_retorno}/");
            }

            // Verifica se o código é igual ao código passado pelo formulário
            if ($tramite['Tramite']['id'] != $this->data['Tramite']['id']) {
                $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                $this->redirect("/administracao/{$action_retorno}/");
            }

            // Verifica se o processo já foi ou nao recebido
            // Se não estiver, exibe erro e redireciona para a mesma acao.
            if (($tramite['Tramite']['flag_recebimento'] != false)) {
                $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                $this->redirect("/administracao/{$action_retorno}/");
            }

            // Inicia transação
            $this->Tramite->transactional = true;
            $this->Tramite->query('begin;');

            // Tenta excluir
            if ($this->Tramite->delete($tramite['Tramite']['id'])) {
                // Se for excluído com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('tramites', $tramite['Tramite']['id'], 'D', null, null);

                // Busca os processos anexos
                $anexos = $this->ProcessoAnexo->findByProcessoPrincipal($id, 1);

                // Percorre os anexos e exclui os trâmites de cada um
                foreach ($anexos as $anexo) {
                    $tramite = $this->Tramite->ultimoTramiteDoProcesso($anexo['ProcessoAnexado']['id']);

                    // Verifica se o processo já foi recebido
                    // Se não estiver, exibe erro e redireciona para a mesma acao.
                    if (($tramite['Tramite']['flag_recebimento'] != false)) {
                        $this->setMessage("erro", "Este processo já foi recebido.");
                        $this->redirect("/administracao/{$action_retorno}/");
                    }

                    // Exclui o trâmite do processo anexo
                    if ($this->Tramite->delete($tramite['Tramite']['id'])) {
                        // Se for salvo com sucesso, cria um log no banco
                        // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                        $this->logger('tramites', $tramite['Tramite']['id'], 'D', null, null);
                    } else {
                        // Rollback na transacao
                        $this->Tramite->query('rollback;');

                        // Se ocorrer erro ao savar, exibe mensagem de erro
                        // passando os arrays com os erros de validação
                        $this->setMessage("erro", "Ocorreu um erro ao cancelar o trâmite.");
                        $this->redirect("/administracao/{$action_retorno}/");
                    }
                }

                // Confirma a transacao
                $this->Tramite->query('commit;');

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Trâmite cancelado com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/processos/consultar/' . $id);
            } else {
                // Rollback na transacao
                $this->Tramite->query('rollback;');

                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                $this->setMessage("erro", "Ocorreu um erro ao cancelar o trâmite.");
                $this->redirect("/administracao/{$action_retorno}/");
            }
        }
    }

    /**
     * Verifica apenas se o processo está anexado a outro.
     * * */
    private function verificarSeEstaAnexado($processo, $action) {
        $this->ProcessoAnexo->recursive = -1;
        $anexos = $this->ProcessoAnexo->find('all', array('conditions' => "processo_anexo_id = {$processo['Processo']['id']} and ativo = true"));

        if (count($anexos) > 0) {
            $mensagem = "Este processo se encontra anexado a outro processo.";
            $this->setMessage("erro", $mensagem);
            $this->redirect("/administracao/cancelamento_tramite/");
        }
    }

    /**
     * Verifica se o processo se encontra na situação esperada
     * Se não estiver, redireciona para a ação $action
     * * */
    private function verificarSituacao($processo, $esperada, $action, $mensagem = null) {

        if (strtoupper($processo['Situacao']['sigla']) !== strtoupper($esperada)) {
            $mensagem = ($mensagem != null) ? $mensagem : "Este processo se encontra " . $processo['Situacao']['descricao'] . ".";
            $this->setMessage("erro", $mensagem);
            $this->redirect("/amdinistracao/{$action}/");
        }
    }

    /**
     * Verifica se o processo se encontra no setor no qual o servidor está logado
     * Se não estiver, redireciona para a ação $action
     * * */
    private function verificarSeProcessoEstaNoSetor($processo, $action) {
        // Como o processo foi encontrado, busca o ultimo tramite realizado
        $this->Tramite->recursive = -1;
        $tramite = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);

        // Verifica se existe tramite. Se existir, busca o setor onde este processo deve estar.
        if ($tramite && (count($tramite) > 0)) {
            if ($tramite['Tramite']['flag_recebimento'] == false) {
                $this->data = null;
                $this->setMessage("erro", "Este processo não se encontra no seu setor.");
                $this->redirect("/administracao/{$action}/");

                return null;
            }
            $setor_id = $tramite['Tramite']['setor_recebimento_id'];
        }
        // Se não existe, define como o setor aquele onde o processo foi criado.
        else {
            $setor_id = $processo['Processo']['setor_id'];
        }

        // Verifica se o setor do processo e o mesmo do usuario.
        // Se não estiver, exibe erro e redireciona para a mesma acao.
        if ($setor_id != $this->Session->read('Setor.id')) {
            $this->data = null;
            $this->setMessage("erro", "Este processo não se encontra no seu setor.");
            $this->redirect("/administracao/{$action}/");
        }

        return $setor_id;
    }

    public function maximo_cadastrar() {

        $this->set('fieldSetTitle', '[Administração] Configurar Número máximo de dias de um processo em um setor');

        //Carregar lista de tipos de processo

        $this->set('tipos_processo', $this->TipoProcesso->find('list', array('fields' => 'descricao', 'order' => 'descricao asc')));


        //Carregar listagem de Orgaos
        $this->set('orgaos', $this->Orgao->listar());

        // Verifica se o formulario foi enviado com dados
        if (empty($this->data)) {

            $this->render();
        } else {

            // Tenta salvar
            if ($this->DiaNaMesa->save($this->data)) {
                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('dias_na_mesa', null, 'C', null, $this->data['DiaNaMesa']);

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Configuração adicionada com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/administracao/maximo_index');
            } else {
                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação e com os nomes dos campos para exibição
                $this->setMessage("erro", "", $this->DiaNaMesa->validationErrors, $this->DiaNaMesa->humanizedFields);
            }
        }
    }

    public function maximo_index() {

        $this->set('fieldSetTitle', '[Administração] Listagem do máximo de dias de um processo em um setor');

        //Carregar toda a listagem para exibição
        $this->DiaNaMesa->recursive = 1;
        $dias_na_mesa = $this->DiaNaMesa->find('all', array('order' => 'setor_id asc'));
        $this->set('dias_na_mesa', $dias_na_mesa);
        //pr($dias_na_mesa);
        //die();
    }

    /**
     * http://sistema/administracao/maxdimo_alterar/ * */
    public function maximo_alterar($id = null) {
        
         $this->set('fieldSetTitle', '[Administração] Alteracao do máximo de dias de um processo em um setor');

        if (!$this->checkValidId($id)) {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/administracao/');
        }


        //Carregar lista de tipos de processo
        $this->set('tipos_processo', $this->TipoProcesso->find('list', array('fields' => 'descricao', 'order' => 'descricao asc')));
        //Carregar listagem de Orgaos
        //$this->set('orgaos', $this->Orgao->listar());

        //Carregar registro a ser alterado
        $dia_na_mesa = $this->DiaNaMesa->read(null, $id, 1);
        $this->set('dia_na_mesa', $dia_na_mesa);

        $this->Setor->recursive = 1;
        $setores = $this->Setor->find('all', array('conditions' => "orgao_id = {$dia_na_mesa['Setor']['orgao_id']}", 'order' => 'Setor.sigla asc'));
        $this->set('setores', $setores);
        
        if (empty($this->data)) {

            // Busca o registro
            $this->data = $dia_na_mesa;
        } else {
            // Caso tenha sido chamado após o submit
            // Busca os dados originais
            $old_data = $dia_na_mesa;

            $this->DiaNaMesa->id = $id;

            // Tenta salvar o registro
            if ($this->DiaNaMesa->save($this->data)) {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('dias_na_mesa', $id, 'U', $old_data, $this->data['DiaNaMesa']);

                $this->setMessage("sucesso", "Maximo de dias atualizado com sucesso.");
                $this->redirect('/administracao/maximo_index/');
            } else {
                $this->setMessage("erro", "", $this->DiaNaMesa->validationErrors);
            }
        }
    }

    public function maximo_delete($id) {

        $this->verificarLogin(21);

		if( ! $this->checkValidId($id) ) {
			$this->setMessage("erro", "Código Inválido");
			$this->redirect('/administracao/');
		}
			$this->DiaNaMesa->del($id);
			$this->setMessage("sucesso","Configuracao removida com sucesso.");
			$this->redirect('/administracao/maximo_index');

    }

}

?>
