<?php

/**
 *  SipaNet 2.0 - Sistema de Informa??o Processual e Arquivo
  Copyright (C) 2008 Universidade Estadual de Ci?ncias da Sa?de de Alagoas - UNCISAL <http://www.uncisal.edu.br>

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

/**
 * @property Processo $Processo
 * @property Tramite $Tramite
 * @property Model $Model
 */
class ProcessosController extends AppController {

    public $helpers = array('Html', 'Session', 'Ajax', 'Protocolo');
    public $uses = array(
        'Processo',
        'Orgao',
        'Interessado',
        'Natureza',
        'Situacao',
        'ProcessoAnexo',
        'Tramite',
        'Servidor',
        'Divisao',
        'Setor',
        'Paralisacao',
        'Arquivamento',
        'HistoricoDivisao',
        'HistoricoDevolucao',
        'TipoProcesso',
    );
    public $paginate = array('limit' => 30, 'page' => 1, 'order' => array('Processo.data_cadastro' => 'asc'));

    function beforeFilter() {
        $modulo = null;

        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

    /**
     * Verifica se o processo se encontra na situação esperada
     * Se não estiver, redireciona para a ação $action
     * **/
    private function verificarSituacao($processo, $esperada, $action, $mensagem = null) {

        if (strtoupper($processo['Situacao']['sigla']) !== strtoupper($esperada)) {
            $mensagem = ($mensagem != null) ? $mensagem : "Este processo se encontra " . $processo['Situacao']['descricao'] . ".";
            $this->setMessage("erro", $mensagem);
            $this->redirect("/processos/{$action}/");
        }
    }

    /**
     * Verifica se o processo se encontra no setor no qual o servidor está logado
     * Se não estiver, redireciona para a ação $action
     * **/
    private function verificarSeProcessoEstaNoSetor($processo, $action) {
        // Como o processo foi encontrado, busca o ultimo tramite realizado
        $this->Tramite->recursive = -1;
        $tramite = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);

        // Verifica se existe tramite. Se existir, busca o setor onde este processo deve estar.
        if ($tramite && (count($tramite) > 0)) {
            if ($tramite['Tramite']['flag_recebimento'] == false) {
                $this->data = null;
                $this->setMessage("erro", "Este processo não se encontra no seu setor.");
                $this->redirect("/processos/{$action}/");

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
        if($setor_id != $this->Session->read('Setor.id')) {
            $this->data = null;
            $this->setMessage("erro", "Este processo não se encontra no seu setor.");
            $this->redirect("/processos/{$action}/");
        }

        return $setor_id;
    }

    /**
     * Verifica se o processo está anexado a outro ou se existe algum outro anexado a ele
     * Se uma das condições for satisfeita, redireciona para a ação $action
     * **/
    private function verificarSeAnexo($processo, $action, $mensagem = null) {
        $this->ProcessoAnexo->recursive = -1;
        $anexos = $this->ProcessoAnexo->findAnexo($processo['Processo']['id']);

        if (count($anexos) > 0) {
            $mensagem = ($mensagem != null) ? $mensagem : "Este processo se encontra anexado a outro processo.";
            $this->setMessage("erro", $mensagem);
            $this->redirect("/processos/{$action}/");
        }
    }

    /**
     * Verifica apenas se o processo está anexado a outro.
     * **/
    private function verificarSeEstaAnexado($processo, $action) {
        $this->ProcessoAnexo->recursive = -1;
        $anexos = $this->ProcessoAnexo->find('all', array('conditions' => "processo_anexo_id = {$processo['Processo']['id']} and ativo = true"));

        if (count($anexos) > 0) {
            $mensagem = "Este processo se encontra anexado a outro processo.";
            $this->setMessage("erro", $mensagem);
            $this->redirect("/processos/{$action}/");
        }
    }

    /**
     * Lista processos que estao no setor. Verificar campo flag_encaminhado
     * * */
    private function ListaProcessosDoSetor($action = null) {
        
    }

    /**
     * Busca o processo pelo número passado.
     * **/
    private function buscarProcesso($orgao, $numero, $ano, $action) {
        $processo = $this->Processo->findByNumero($orgao, $numero, $ano);

        // Se o processo não foi encontrado, retorna erro.
        if($processo) {
            return $processo;
        }
        else {
            $this->setMessage("erro", "Processo não encontrado");
            $this->redirect("/processos/{$action}/", null, true);
        }
    }

    /**
     * http://sistema/processo/ * */
    public function index() {
        $this->verificarLogin(13);

        $this->set('fieldSetTitle', 'Lista de Processos');

        // Define a recursividade. Caso seja necessário exibir dados de tabelas relacionadas.
        $this->Processo->recursive = 1;

        // Busca os dados e envia para a view
        $this->set('processos', $this->paginate('Processo'));
    }

    /**
     * Consultar processo.
     * http://sistema/processos/consultar/
     * http://sistema/processos/consultar/$id
     * * */
    public function consultar($id = null) {
        $this->set('fieldSetTitle', 'Consultar Processo');
        $this->set('action_form', '/processos/consultar');

        // Verifica se a busca ja foi realizada ou se o $id foi informado
        if (empty($this->data) && ($id == null)) {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());
        /// Lista tipos de processo para exibicão
            $this->set('tipos_processo', $this->TipoProcesso->listar());
            $this->render('busca_generica');
        } else {

            $action_retorno = 'consultar';

            // Busca os dados do processo
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;

            // Se foi passado o id, busca pelo id. Senão, busca pelo número
            if($id) {
                $processo = $this->Processo->read(null, $id);
            } else {
                $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);
            }

            // Dados completos do setor onde o processo foi criado
            $this->Setor->recursive = 1;
            $setor = $this->Setor->read(null, $processo['Processo']['setor_id']);

            // Busca os trâmites do processo
            $tramites = $this->Tramite->findByProcesso($processo['Processo']['id']);

            // Verifica se está anexado a outro processo
            $this->ProcessoAnexo->recursive = 1;
            $processoAnexo = $this->ProcessoAnexo->findByProcessoAnexado($processo['Processo']['id']);

            // Busca os processos anexados a ele
            $processosAnexados = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id']);

            // Busca as divisões do processo
            $divisoes = $this->Divisao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}", 'order' => "Servidor.nome", 'recursive' => '1'));

            // Busca as historico de divisões do processo
            $historicoDivisoes = $this->HistoricoDivisao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}", 'order' => "data_divisao asc", 'recursive' => '1'));

            // Busca as historico de Devolucoes do processo
            $historicoDevolucoes = $this->HistoricoDevolucao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}", 'order' => "data_devolucao asc", 'recursive' => '1'));

            // Busca as paralisações do processo
            $paralisacoes = $this->Paralisacao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}", 'order' => "data"));

            // Busca os arquivamentos do processo
            $arquivamentos = $this->Arquivamento->findByProcesso($processo['Processo']['id']);

            $this->set('processo', $processo);
            $this->set('setor', $setor);
            $this->set('tramites', $tramites);
            $this->set('divisoes', $divisoes);
            $this->set('historicoDivisoes', $historicoDivisoes);
            $this->set('historicoDevolucoes', $historicoDevolucoes);
            $this->set('paralisacoes', $paralisacoes);
            $this->set('arquivamentos', $arquivamentos);
            $this->set('processoComoAnexo', $processoAnexo);
            $this->set('processosAnexados', $processosAnexados);


            if ($this->params['form']['imprimir']) {
                $this->render(null, false, 'consultar_impressao');
            }
        }
    }

    /**
     * http://sistema/processos/exibir/$id * */
    public function exibir($id = null) {
        $this->set('fieldSetTitle','Informações do Processo');

        // Verifica se o id passado é válido
        if( ! $this->checkValidId($id) ) {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/processos/');
        }

        //Busca o registro
        $this->Processo->recursive = 1;
        $processo = $this->Processo->read(null, $id);

        // Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
        if($processo['Processo']['id'] != $id) {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/processos/');
        }

        $this->set('processo', $processo);

        // Verifica se está anexado a outro processo
        $processoAnexo = $this->ProcessoAnexo->findByProcessoAnexado($processo['Processo']['id']);
        $this->set('processoComoAnexo', $processoAnexo);

        /**
         * Busca processos que estão anexados a este
         * Além disto, deve buscar também as informações a respeito do interessado dos Processos Anexados
         * **/
        $this->ProcessoAnexo->unbindModel( array('belongsTo' => array('ProcessoPrincipal')) );
        $this->ProcessoAnexo->recursive = 2;
        $processosAnexados = $this->ProcessoAnexo->findAll("processo_principal_id = {$processo['Processo']['id']} and ativo = true");
        $this->set('processosAnexados', $processosAnexados);

        // Busca divisões do processo
        $this->Divisao->unbindModel( array('belongsTo' => array('Processo')) );
        $divisoes = $this->Divisao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}"));
        $this->set('divisoes', $divisoes);
    }

    /**
     * http://sistema/processos/tramitacao
     * Lista os tramites do processo
     * * */
    public function tramitacao() {
        $this->verificarLogin(13);

        $this->set('fieldSetTitle', 'Lista de Trâmites do Processo');
        $this->set('action_form', '/processos/tramitacao');



        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            $this->render('busca_generica');
        } else {
            $action_retorno = 'tramitacao';

            // Busca os dados do processo
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);

            // Busca os trâmites do processo
            // Recursive = 2 para retornar o órgão
            $tramites = $this->Tramite->findByProcesso($processo['Processo']['id']);

            $this->set('processo', $processo);
            $this->set('tramites', $tramites);
        }
    }

    /**
     * http://sistema/processos/cadastrar/ * */
    public function cadastrar() {
        $this->verificarLogin(4);

        $this->set('orgaos', $this->Orgao->listarExternos());
        $this->set('naturezas', $this->Natureza->find('list', array('conditions' => 'ativo = true', 'fields' => 'descricao', 'order' => 'descricao asc')));
        $this->set('situacoes', $this->Situacao->find('all', array('conditions' => "sigla = 'n'")));
        $this->set('tipos_processo', $this->TipoProcesso->find('list', array('fields' => 'descricao', 'order' => 'descricao asc')));

        $this->set('fieldSetTitle', 'Cadastro de Processos');

        // Se estiver entrando na página pela primeira vez, apenas exibe o form
        if(empty($this->data)) {
            $this->render();

            // Se tiver dado submit no form:
        } else {
            // Limpa os campos
            //$this->cleanUpFields();

            $processo = $this->data;

            /**
             * Verifica se é um processo interno ou externo.
             * Se for um processo interno, deve-se buscar o próximo número para o processo, além de resgatar automaticamente o código do órgão no qual o processo foi cadastrado;
             * Se for externo, utiliza-se os dados informados pelo usuário.
             * **/
            // Processo interno
            if($processo['Processo']['processo_externo'] == false) {
            // Informa a data de cadastro como sendo now()
                $processo['Processo']['data_cadastro'] = 'now()';

                // Informa o código do órgão
                $processo['Processo']['numero_orgao'] = $this->Session->read('Orgao.codigo');

                // Informa o ano do processo
                $processo['Processo']['numero_ano'] = date('Y');

                /**
                 * Resgata o próximo número de processo para o órgão e o ano especificados
                 *
                 * Se já existirem processos para o órgão e ano especificados, define como próximo número o último número + 1
                 * Senão, define como 1
                 * **/

                $this->Processo->recursive = -1;
                $processoNumero = $this->Processo->find("numero_orgao = '{$processo['Processo']['numero_orgao']}' and numero_ano = '{$processo['Processo']['numero_ano']}'", 'max(numero_processo)');

                if (!is_null($processoNumero[0]['max'])) {
                    $numero = $processoNumero[0]['max'] + 1;
                } else {
                    $numero = 1;
                }

                $processo['Processo']['numero_processo'] = $numero;
            } else {
                // Formata a data de cadastro
                $processo['Processo']['data_cadastro'] = $this->formatDateToIso($processo['Processo']['data_cadastro']);
            }

            // Verifica se o número do processo já foi cadastrado
            $this->Processo->recursive = -1;
            $verificacao = $this->Processo->findByNumero($processo['Processo']['numero_orgao'], $processo['Processo']['numero_processo'], $processo['Processo']['numero_ano']);
            if($verificacao != null) {
                $this->setMessage("erro", "Já existe um processo cadastrado com o número informado.");
            }
            // Se o número ainda não tiver sido cadastrado, continua o cadastro do processo
            else {

            // Formata o número do documento do processo
                if((strlen($processo['Processo']['documento_numero']) > 0) && (strlen($processo['Processo']['documento_numero_tipo']) > 0)) {
                    $processo['Processo']['documento_numero'] = "{$processo['Processo']['documento_numero_tipo']} {$processo['Processo']['documento_numero']}";
                }

                // Informa o código do servidor e setor logado
                $processo['Processo']['servidor_id'] = $this->Session->read('Servidor.id');
                $processo['Processo']['setor_id'] = $this->Session->read('Setor.id');

                // Tenta salvar
                if ($this->Processo->save($processo)) {

                    // Se for salvo com sucesso, cria um log no banco
                    // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                    $this->logger('processos', null, 'C', null, $processo['Processo']);

                    // Exibe mensagem de sucesso
                    $this->setMessage("sucesso", "Processo cadastrado com sucesso.");
                    // Redirecionar para listagem ou para exibição do item salvo
                    $this->redirect('/processos/consultar/' . $this->Processo->getLastInsertID() );
                }
                else {
                    // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                    $this->setMessage("erro", "", $this->Processo->validationErrors);
                }
            }
        }
    }

    /**
     * http://sistema/processos/cadastrar_antigos/ * */
    public function cadastrar_antigos() {
        $this->verificarLogin(4);

        $this->set('orgaos', $this->Orgao->listarExternos());
        $this->set('naturezas', $this->Natureza->find('list', array('conditions' => 'ativo = true', 'fields' => 'descricao', 'order' => 'descricao asc')));
        $this->set('situacoes', $this->Situacao->listar());

        $this->set('fieldSetTitle', 'Cadastro de Processos Antigos');

        // Se estiver entrando na página pela primeira vez, apenas exibe o form
        if(empty($this->data)) {
            $this->render();

            // Se tiver dado submit no form:
        } else {
            // Limpa os campos
            //$this->cleanUpFields();

            $processo = $this->data;

            // Força o código do órgão a ser sempre o logado
            $processo['Processo']['numero_orgao'] = $this->Session->read('Orgao.codigo');

            // Formata a data de cadastro
            $processo['Processo']['data_cadastro'] = $this->formatDateToIso($processo['Processo']['data_cadastro']);

            // Verifica se o número do processo já foi cadastrado
            $this->Processo->recursive = -1;
            $verificacao = $this->Processo->findByNumero($processo['Processo']['numero_orgao'], $processo['Processo']['numero_processo'], $processo['Processo']['numero_ano']);
            if ($verificacao != null) {
                $this->setMessage("erro", "J? existe um processo cadastrado com o n?mero informado.");
            }
            // Se o número ainda não tiver sido cadastrado, continua o cadastro do processo
            else {

            // Formata o número do documento do processo
                if((strlen($processo['Processo']['documento_numero']) > 0) && (strlen($processo['Processo']['documento_numero_tipo']) > 0)) {
                    $processo['Processo']['documento_numero'] = "{$processo['Processo']['documento_numero_tipo']} {$processo['Processo']['documento_numero']}";
                }

                // Informa o código do servidor e setor logado
                $processo['Processo']['servidor_id'] = $this->Session->read('Servidor.id');
                $processo['Processo']['setor_id'] = $this->Session->read('Setor.id');

                // Tenta salvar
                if ($this->Processo->save($processo)) {

                    // Se for salvo com sucesso, cria um log no banco
                    // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                    $this->logger('processos', null, 'C', null, $processo['Processo']);

                    // Exibe mensagem de sucesso
                    $this->setMessage("sucesso", "Processo cadastrado com sucesso.");
                    // Redirecionar para listagem ou para exibição do item salvo
                    $this->redirect('/processos/consultar/' . $this->Processo->getLastInsertID() );
                }
                else {
                    // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                    $this->setMessage("erro", "", $this->Processo->validationErrors);
                }
            }
        }
    }

    /**
     * Alterar processo. Primeiro passo, seleciona processo.
     * http://sistema/processos/alteracao/
     * * */
    public function alteracao() {
        $this->verificarLogin(4);

        $this->set('fieldSetTitle', 'Alterar Processos');
        $this->set('action_form', '/processos/alteracao');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            $this->render('busca_generica');
        } else {
            $action_retorno = 'alteracao';

            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;

            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);

            // Verifica se o processo se encontra na situação NORMAL
            $this->verificarSituacao($processo, 'N', $action_retorno);

            // Verifica se o processo se encontra no setor do servidor
            $this->verificarSeProcessoEstaNoSetor($processo, $action_retorno);

            $this->redirect("/processos/alterar/{$processo['Processo']['id']}");
        }
    }

    /**
     * http://sistema/processos/alterar/$id * */
    public function alterar($id) {
        $this->verificarLogin(4);
        $action_retorno = 'alteracao';

        $processo = $this->Processo->read(null, $id);

        // Verifica se o processo se encontra na situação NORMAL
        $this->verificarSituacao($processo, 'N', $action_retorno);

        // Verifica se o processo se encontra no setor do servidor
        $this->verificarSeProcessoEstaNoSetor($processo, $action_retorno);

        $this->set('naturezas', $this->Natureza->find('list', array('conditions' => 'ativo = true', 'fields' => 'descricao', 'order' => 'descricao asc')));
        $this->set('situacoes', $this->Situacao->listar());
        $this->set('tipos_processo', $this->TipoProcesso->find('list', array('fields' => 'descricao', 'order' => 'descricao asc')));
        $this->set('fieldSetTitle','Alteração de Processos');

        $this->set('processo', $processo);

        // Se estiver entrando na página pela primeira vez, apenas exibe o form
        if(empty($this->data)) {
            $this->render();

            // Se tiver dado submit no form:
        }
        else {
        // Formata o número do documento do processo
            if((strlen($this->data['Processo']['documento_numero']) > 0) && (strlen($this->data['Processo']['documento_numero_tipo']) > 0)) {
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
                $this->redirect('/processos/consultar/' . $processo['Processo']['id'] );
            }
            else {
                // Se ocorrer erro ao savar, exibe mensagem de erro
            // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->Processo->validationErrors);
            }
        }
    }

    /**
     * Anexar processo. Primeiro passo, seleciona processo principal.
     * http://sistema/processos/anexacao/
     * * */
    public function anexacao() {
        $this->verificarLogin(9);

        $this->set('fieldSetTitle', 'Anexação/Desanexação de Processos - Informe o processo principal');
        $this->set('action_form', '/processos/anexacao');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            $this->render('busca_generica');
        } else {
            $action_retorno = 'anexacao';

            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;

            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);

            // Verifica se o processo se encontra na situação NORMAL
            $this->verificarSituacao($processo, 'N', $action_retorno);

            // Verifica se o processo se encontra no setor do servidor
            $this->verificarSeProcessoEstaNoSetor($processo, $action_retorno);

            // Verifica se está anexado a outro processo
            $processoAnexo = $this->ProcessoAnexo->find("processo_anexo_id = {$processo['Processo']['id']} and ativo = true");
            $this->set('processoComoAnexo', $processoAnexo);

            // Busca os processos anexados a ele
            $processosAnexados = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id']);

            $this->set('processo', $processo);
            $this->set('processosAnexados', $processosAnexados);
        }
    }

    public function anexacao_exibir($processo_principal_id) {
        $this->verificarLogin(9);

        $action_retorno = 'anexacao';

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Busca o processo e verifica se foi encontrado
        $this->Processo->unbindModel(array('hasMany' => array('Tramite')));

        $processo = $this->Processo->read(null, $processo_principal_id);

        // Verifica se o processo se encontra na situação NORMAL
        $this->verificarSituacao($processo, 'N', $action_retorno);

        // Verifica se o processo se encontra no setor do servidor
        $this->verificarSeProcessoEstaNoSetor($processo, $action_retorno);

        // Verifica se está anexado a outro processo
        $processoAnexo = $this->ProcessoAnexo->find("processo_anexo_id = {$processo['Processo']['id']} and ativo = true");
        $this->set('processoComoAnexo', $processoAnexo);

        // Busca os processos anexados a ele
        $processosAnexados = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id']);

        $this->set('processo', $processo);
        $this->set('processosAnexados', $processosAnexados);

        $this->render('anexacao');
    }

    /**
     * Anexar processo. Segundo passo, confirmar.
     * http://sistema/processos/confirmar_anexacao/
     * * */
    public function confirmar_anexacao() {
        $this->verificarLogin(9);

        $action_retorno = 'anexacao';

        // Resgata os dados do processo principal
        $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
        $this->Processo->recursive = 1;

        $processoPrincipal = $this->Processo->read(null, $this->data['Processo']['id']);

        // Busca o processo anexo
        $processoAnexo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);

        // Verifica não é o mesmo processo
        if($processoPrincipal['Processo']['id'] == $processoAnexo['Processo']['id']) {
            $this->setMessage("erro", "O processo informado tem o mesmo número do processo principal.");
            $this->redirect("/processos/{$action_retorno}/");
        }

        // Verifica a situação dos dois processos é NORMAL
        $this->verificarSituacao($processoPrincipal, 'N', $action_retorno);
        $this->verificarSituacao($processoAnexo, 'N', $action_retorno);

        // Verifica se os processos estão no setor do servidor
        $this->verificarSeProcessoEstaNoSetor($processoPrincipal, $action_retorno);
        $this->verificarSeProcessoEstaNoSetor($processoAnexo, $action_retorno);

        // Verifica se o processo anexo já não possui processos anexados a ele
        $this->verificarSeAnexo($processoAnexo, $action_retorno);

        // Se satisfez todas as validações, exibe tela de confirmação
        $this->set('processoPrincipal', $processoPrincipal);
        $this->set('processoAnexo', $processoAnexo);
        $this->render();
    }

    /**
     * Anexar processo. Terceiro passo, anexar.
     * http://sistema/processos/anexar/
     * * */
    public function anexar() {
        $this->verificarLogin(9);

        $processo_principal_id = $this->data['ProcessoPrincipal']['id'];
        $processo_anexo_id = $this->data['ProcessoAnexo']['id'];

        // Cria o anexo
        $anexo = array('ProcessoAnexo' => array());
        $anexo['ProcessoAnexo']['processo_principal_id'] = $processo_principal_id;
        $anexo['ProcessoAnexo']['processo_anexo_id'] = $processo_anexo_id;
        $anexo['ProcessoAnexo']['ativo'] = true;

        // Tenta salvar
        if ($this->ProcessoAnexo->save($anexo)) {

            // Se for salvo com sucesso, cria um log no banco
            // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
            $this->logger('processos_anexos', null, 'C', null, $anexo['ProcessoAnexo']);

            // Exibe mensagem de sucesso
            $this->setMessage("sucesso", "Processo anexado com sucesso.");
            // Redirecionar para listagem ou para exibição do item salvo
            $this->redirect('/processos/anexacao/');
        } else {
            // Se ocorrer erro ao savar, exibe mensagem de erro
        // passando os arrays com os erros de validação
            $this->setMessage("erro", "", $this->ProcessoAnexo->validationErrors);
            $this->redirect('/processos/anexacao/');
        }
    }

    /**
     * Desanexar processos. Primeiro passo, confirmar.
     * http://sistema/processos/desanexacao/$processo_principal_id/$processo_anexo_id
     * * */
    public function desanexacao($processo_principal_id, $processo_anexo_id) {
        $this->verificarLogin(10);

        $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
        $processoPrincipal = $this->Processo->read(null, $processo_principal_id);
        $processoAnexo = $this->Processo->read(null, $processo_anexo_id);

        $this->set('processoPrincipal', $processoPrincipal);
        $this->set('processoAnexo', $processoAnexo);
    }

    /**
     * Desanexar processos. Segundo passo, desanexar.
     * http://sistema/processos/desanexar/$processo_principal_id/$processo_anexo_id
     * * */
    public function desanexar($processo_principal_id, $processo_anexo_id) {
        $this->verificarLogin(10);

        // Busca o ProcessoAnexo
        $processoAnexo = $old_data = $this->ProcessoAnexo->find("processo_principal_id = {$processo_principal_id} and processo_anexo_id = {$processo_anexo_id} and ativo = true");

        // Define como ativo = false
        $processoAnexo['ProcessoAnexo']['ativo'] = '0';

        // Tenta salvar
        if ($this->ProcessoAnexo->save($processoAnexo)) {

            // Se for salvo com sucesso, cria um log no banco
            // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
            $this->logger('processo_anexos', $processoAnexo['ProcessoAnexo']['id'], 'U', $old_data['ProcessoAnexo'], $processoAnexo['ProcessoAnexo']);

            // Exibe mensagem de sucesso
            $this->setMessage("sucesso", "Processos desanexados com sucesso.");

            // Redirecionar para listagem ou para exibição do item salvo
            $this->redirect('/processos/anexacao/');
        } else {
            // Se ocorrer erro ao savar, exibe mensagem de erro
        // passando os arrays com os erros de validação
            $this->setMessage("erro", "", $this->ProcessoAnexo->validationErrors);

            // Redirecionar para exibição do processo
            $this->redirect('/processos/anexacao/');
        }
    }

    /**
     * Primeiro passo da divisão do processo. Nesta etapa, o servidor digita o número do processo e busca os dados.
     * Após isto, são exibidas informações sobre o processo e é solicitado o setor de destino.
     * Depois, é encaminhado para a ação dividir
     * http://sistema/processos/divisao **/
    public function divisao() {
        $this->verificarLogin(11);

        $this->set('fieldSetTitle', 'Distribuir o Processo entre Servidores do Setor');
        $this->set('action_form', '/processos/divisao');

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            $this->render('busca_generica');
        } else {
            $action_retorno = 'divisao';

            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);

            // Verifica se o processo se encontra na situação NORMAL
            $this->verificarSituacao($processo, 'N', $action_retorno);

            // Verifica se o processo se encontra no setor do servidor
            $setor_id = $this->verificarSeProcessoEstaNoSetor($processo, $action_retorno);

            // Lista os servidores do setor e a quantidade de processos que cada um está no momento
            $servidores = $this->Servidor->find('all', array('fields' => array('id', 'nome', "(select count(1) from {$this->Divisao->table} where servidor_id = \"Servidor\".\"id\") as quantidade"), 'conditions' => "setor_id = {$setor_id} and Servidor.ativo = true and (Servidor.data_permissao_inicio is null or Servidor.data_permissao_inicio <= current_date) and (Servidor.data_permissao_fim is null or Servidor.data_permissao_fim >= current_date)", 'order' => 'quantidade asc, nome asc', 'recursive' => -1));

            // Lista tambem os servidores que estao com o processo no momento
            $divisoes = $this->Divisao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}", 'fields' => array('servidor_id')));

            // Cria um vetor com os ids dos servidores que estao com o processo
            $servidor_ids = array();
            foreach ($divisoes as $divisao) {
                $servidor_ids[] = $divisao['Divisao']['servidor_id'];
            }

            $this->set("processo", $processo);
            $this->set("servidores", $servidores);
            $this->set("servidor_ids", $servidor_ids);
        }
    }

    /**
     * Segundo passo da divisão do processo. Executa a divisão.
     * http://sistema/processos/dividir/$id **/
    public function dividir($id = null) {
        $this->verificarLogin(11);

        $this->set('fieldSetTitle', 'Distribuir o Processo entre Servidores do Setor');

        // Verifica se o id passado é válido
        if( ! $this->checkValidId($id) ) {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/processos/');
        }

        //Busca o registro
        $this->Processo->recursive = 1;
        $processo = $this->Processo->read(null, $id);

        // Verifica se foi retornado. Se não foi, redireciona para listagem setando msg de erro
        if($processo['Processo']['id'] != $id) {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/processos/');
        }

        // Apaga todos as divisões do processo.
        $this->Divisao->deleteAll(array('processo_id' => $id) );

        // Percorre as divisões passadas pelo form
        if(is_array($this->data['Divisao'])) foreach($this->data['Divisao']['servidor_id'] as $servidor_id) {

            // Cria e a nova divisão
                $divisao = array('Divisao' => array());

                $divisao['Divisao']['servidor_id'] = $servidor_id;
                $divisao['Divisao']['processo_id'] = $id;

                $this->Divisao->create();

                // Salva a divisao
                if ($this->Divisao->save($divisao)) {
                    $this->logger('divisoes', null, 'C', null, $divisao['Divisao']);
                }

                //Cria Historico da Divisao

                $historico_divisao = array('HistoricoDivisao' => array());

                $historico_divisao['HistoricoDivisao']['data_divisao'] = 'now()';
                $historico_divisao['HistoricoDivisao']['processo_id'] = $id;
                $historico_divisao['HistoricoDivisao']['servidor_id'] = $servidor_id;

                $this->HistoricoDivisao->create();

                // Salva a historico divisao
                if ($this->HistoricoDivisao->save($historico_divisao)) {
                    $this->logger('historico_divisoes', null, 'C', null, $historico_divisao['HistoricoDivisao']);
                }
            }

        // Exibe mensagem de sucesso
        $this->setMessage("sucesso", "Distribuição cadastrada com sucesso.");
        $this->redirect('/processos/consultar/' . $id);
    }

    /**
     * Devolução de processo que foi distribuído aos servidores do setor. Somente os próprios servidores podem devolver o processo.
     * Primeiro passo da devolução do processo. Nesta etapa, o servidor digita o número do processo e busca os dados.
     * Após isto, são exibidas informações sobre o processo e é solicitada a confirmação da devolução.
     * Depois, é encaminhado para a ação devolver
     * http://sistema/processos/devolucao **/
    public function devolucao() {
        $this->verificarLogin(12);

        $this->set('fieldSetTitle', 'Devolução de Processo ao Setor');
        $this->set('action_form', '/processos/devolucao');

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            $this->render('busca_generica');
        } else {
            $action_retorno = 'devolucao';

            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);

            // Verifica se o processo se encontra na situação NORMAL
            $this->verificarSituacao($processo, 'N', $action_retorno);

            // Verifica se o processo se encontra no setor do servidor
            $setor_id = $this->verificarSeProcessoEstaNoSetor($processo, $action_retorno);

            // Verifica se o servidor está de posse do processo.
            $divisao = $this->Divisao->find('first', array('conditions' => "processo_id = {$processo['Processo']['id']} AND servidor_id = {$this->Session->read('Servidor.id')}", 'recursive' => -1));

            if(!is_array($divisao)) {
                $this->setMessage("erro", "O processo não foi distribuído a você.");
                $this->redirect("/processos/{$action_retorno}/");
            }


            $this->set("processo", $processo);
            $this->set("divisao", $divisao);
        }
    }

    /**
     * Segundo passo da devolução de processo distribuído. Executa a devolução.
     * http://sistema/processos/devolver/ **/
    public function devolver() {
        $this->verificarLogin(12);

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect('/processos/devolucao/');
        }
        else {
        // Busca a divisão
            $this->Divisao->recursive = -1;
            $divisao = $old_data = $this->Divisao->read(null, $this->data['Divisao']['id']);

            // Verifica se os dados estão corretos e se o servidor logado é mesmo o servidor da divisão
            if(($divisao['Divisao']['processo_id'] != $this->data['Processo']['id']) || ($divisao['Divisao']['servidor_id'] != $this->Session->read('Servidor.id'))) {
                $this->setMessage("erro", "Erro.");
                $this->redirect('/processos/devolucao/');
            }

            //Cria Historico da Devolucao
            $historico_devolucao = array('HistoricoDevolucao' => array());

            $historico_devolucao['HistoricoDevolucao']['data_devolucao'] = 'now()';
            $historico_devolucao['HistoricoDevolucao']['processo_id'] = $divisao['Divisao']['processo_id'];
            $historico_devolucao['HistoricoDevolucao']['servidor_id'] = $divisao['Divisao']['servidor_id'];
            $historico_devolucao['HistoricoDevolucao']['tipo_devolucao'] = $this->data['HistoricoDevolucao']['tipo_devolucao'];
            $historico_devolucao['HistoricoDevolucao']['num_doc'] = $this->data['HistoricoDevolucao']['num_doc'];
            $historico_devolucao['HistoricoDevolucao']['ano_doc'] = $this->data['HistoricoDevolucao']['ano_doc'];

            $this->HistoricoDevolucao->create();

            // Salva a historico devolucao
            if ($this->HistoricoDevolucao->save($historico_devolucao)) {
                $this->logger('historico_devolucoes', null, 'C', null, $historico_devolucao['HistoricoDevolucao']);
            } else {
                $this->setMessage("erro", "", $this->HistoricoDevolucao->validationErrors);
                $this->redirect('devolucao');
            }

            // Tenta excluir
            if ($this->Divisao->delete($divisao['Divisao']['id'])) {

                // Se for excluído com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('processos', $divisao['Divisao']['id'], 'D', $old_data, "");

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo devolvido com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/processos/consultar/' . $divisao['Divisao']['processo_id'] );
            }
            else {
                // Se ocorrer erro ao savar, exibe mensagem de erro
            // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->Divisao->validationErrors);
                $this->redirect('devolucao');
            }
        }
    }

    /**
     * Arquivar processo. Primeiro passo, busca e confirmação
     * http://sistema/processos/arquivamento **/
    public function arquivamento() {
        $this->verificarLogin(5);

        $this->set('fieldSetTitle', 'Arquivar Processo');
        $this->set('action_form', '/processos/arquivamento');

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            $this->render('busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'arquivamento');

            // Verifica se o processo se encontra na situação NORMAL
            $this->verificarSituacao($processo, 'N', 'arquivamento');

            // Verifica se o processo se encontra no setor do servidor
            $this->verificarSeProcessoEstaNoSetor($processo, 'arquivamento');

            // Verifica se o processo está anexado a outro
            $this->verificarSeEstaAnexado($processo, 'arquivamento');

            // Se cumpriu as exigências, exibe a view
            $this->set("processo", $processo);

            $this->render();
        }
    }

    /**
     * Arquivar processo. Segundo passo.
     * http://sistema/processos/arquivar * */
    public function arquivar() {
        $this->verificarLogin(5);

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect('/processos/arquivamento/');
        } else {
            // Busca os dados do processo
            $this->Processo->recursive = -1;
            $processo = $old_data = $this->Processo->read(null, $this->data['Processo']['id']);

            // Busca a situacao ARQUIVAMENTO
            $situacao = $this->Situacao->findBySigla('A');

            // Define a nova situacao do processo
            $processo['Processo']['situacao_id'] = $situacao['Situacao']['id'];


            // Cria o histórico de arquivamento
            $arquivamento = array('Arquivamento' => array());
            $arquivamento['Arquivamento']['processo_id'] = $this->data['Processo']['id'];
            $arquivamento['Arquivamento']['setor_id'] = $this->Session->read('Setor.id');
            $arquivamento['Arquivamento']['motivo'] = $this->data['Arquivamento']['motivo'];


            // Tenta salvar
            if ($this->Processo->save($processo, null, array('situacao_id')) && $this->Arquivamento->save($arquivamento)) {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('processos', $processo['Processo']['id'], 'U', $old_data, $processo);
                $this->logger('arquivamentos', null, 'C', null, $arquivamento);

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo arquivado com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/processos/consultar/' . $processo['Processo']['id'] );
            }
            else {
                // Se ocorrer erro ao savar, exibe mensagem de erro
            // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->Processo->validationErrors);
                $this->redirect('arquivamento');
            }
        }
    }

    /**
     * Desarquivar processo. Primeiro passo, busca e confirmação
     * http://sistema/processos/desarquivamento **/
    public function desarquivamento() {
        $this->verificarLogin(6);

        $this->set('fieldSetTitle', 'Desarquivar Processo');
        $this->set('action_form', '/processos/desarquivamento');

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            $this->render('busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'liberacao');

            // Verifica se o processo se encontra na situação ARQUIVADO
            $this->verificarSituacao($processo, 'A', 'arquivamento', "Este processo se encontra " . $processo['Situacao']['descricao'] . ". Apenas processos arquivados podem ser desarquivados.");

            // Verifica se o processo se encontra no setor do servidor
            $this->verificarSeProcessoEstaNoSetor($processo, 'arquivamento');

            // Se cumpriu as exigências, exibe a view
            $this->set("processo", $processo);

            $this->render();
        }
    }

    /**
     * Desarquivar processo. Segundo passo.
     * http://sistema/processos/desarquivar * */
    public function desarquivar() {
        $this->verificarLogin(6);

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect('/processos/desarquivamento/');
        } else {
            // Busca os dados do processo
            $this->Processo->recursive = -1;
            $processo = $old_data = $this->Processo->read(null, $this->data['Processo']['id']);

            // Busca a situacao NORMAL
            $situacao = $this->Situacao->findBySigla('N');

            // Define a nova situacao do processo
            $processo['Processo']['situacao_id'] = $situacao['Situacao']['id'];

            // Busca os dados do último arquivamento do processo
            $old_arquivamento = $arquivamento = $this->Arquivamento->ultimoArquivamentoDoProcesso($processo['Processo']['id']);
            $arquivamento['Arquivamento']['data_desarquivamento'] = 'now()';
            $arquivamento['Arquivamento']['motivo_desarquivamento'] = $this->data['Arquivamento']['motivo_desarquivamento'];

            // Tenta salvar - salva apenas a situação do processo
            if( $this->Processo->save($processo, null, array('situacao_id')) && $this->Arquivamento->save($arquivamento) ) {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('processos', $processo['Processo']['id'], 'U', $old_data, $processo);
                $this->logger('arquivamentos', $arquivamento['Arquivamento']['id'], 'U', $old_arquivamento, $arquivamento);

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo liberado com sucesso.");
                // Redirecionar para listagem ou para exibi??o do item salvo
                $this->redirect('/processos/consultar/' . $processo['Processo']['id']);
            } else {
                // Se ocorrer erro ao savar, exibe mensagem de erro
            // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->Processo->validationErrors);
                $this->redirect('liberacao');
            }
        }
    }

    /**
     * Paralisar processo. Primeiro passo, busca e confirmação
     * http://sistema/processos/paralisacao **/
    public function paralisacao() {
        $this->verificarLogin(7);

        $this->set('fieldSetTitle', 'Paralisar Processo');
        $this->set('action_form', '/processos/paralisacao');

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            $this->render('busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'paralisacao');

            // Verifica se o processo se encontra na situação NORMAL
            $this->verificarSituacao($processo, 'N', 'paralisacao');

            // Verifica se o processo se encontra no setor do servidor
            $this->verificarSeProcessoEstaNoSetor($processo, 'paralisacao');

            // Verifica se o processo está anexado a outro
            $this->verificarSeEstaAnexado($processo, 'paralisacao');

            // Se cumpriu as exigências, exibe a view
            $this->set("processo", $processo);

            $this->render();
        }
    }

    /**
     * Paralisar processo. Segundo passo.
     * http://sistema/processos/paralisar * */
    public function paralisar() {
        $this->verificarLogin(7);

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect('/processos/paralisacao/');
        } else {
            // Busca os dados do processo
            $this->Processo->recursive = -1;
            $processo = $old_data = $this->Processo->read(null, $this->data['Processo']['id']);

            // Busca a situacao PARALISADO
            $situacao = $this->Situacao->findBySigla('P');

            // Define a nova situacao do processo
            $processo['Processo']['situacao_id'] = $situacao['Situacao']['id'];

            // Cria o histórico de paralisação
            $paralisacao = array('Paralisacao' => array());
            $paralisacao['Paralisacao']['processo_id'] = $this->data['Processo']['id'];
            $paralisacao['Paralisacao']['setor_id'] = $this->Session->read('Setor.id');
            $paralisacao['Paralisacao']['servidor_id'] = $this->Session->read('Servidor.id');
            $paralisacao['Paralisacao']['motivo'] = $this->data['Paralisacao']['motivo'];

            // Tenta salvar
            if ($this->Processo->save($processo, null, array('situacao_id')) && $this->Paralisacao->save($paralisacao)) {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('processos', $processo['Processo']['id'], 'U', $old_data, $processo);
                $this->logger('paralisacoes', null, 'C', null, $paralisacao);

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo paralisado com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/processos/consultar/' . $processo['Processo']['id'] );
            }
            else {
                // Se ocorrer erro ao savar, exibe mensagem de erro
            // passando os arrays com os erros de validação
                $this->setMessage("erro", "", array_merge($this->Processo->validationErrors, $this->Paralisacao->validationErrors));
                $this->redirect('paralisacao');
            }
        }
    }

    /**
     * Liberar processo. Primeiro passo, busca e confirmação
     * http://sistema/processos/liberacao **/
    public function liberacao() {
        $this->verificarLogin(8);

        $this->set('fieldSetTitle', 'Liberar Processo paralisado');
        $this->set('action_form', '/processos/liberacao');

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            $this->render('busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'liberacao');

            // Verifica se o processo se encontra na situação PARALISADO
            $this->verificarSituacao($processo, 'P', 'liberacao', "Este processo se encontra " . $processo['Situacao']['descricao'] . ". Apenas processos paralisados podem ser liberados.");

            // Verifica se o processo se encontra no setor do servidor
            $this->verificarSeProcessoEstaNoSetor($processo, 'liberacao');

            // Se cumpriu as exigências, exibe a view
            $this->set("processo", $processo);

            $this->render();
        }
    }

    /**
     * Liberar processo. Segundo passo.
     * http://sistema/processos/liberar * */
    public function liberar() {
        $this->verificarLogin(8);

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect('/processos/liberacao/');
        } else {
            // Busca os dados do processo
            $this->Processo->recursive = -1;
            $processo = $old_data = $this->Processo->read(null, $this->data['Processo']['id']);
            $this->Paralisacao->recursive = -1;
            $paralisacao = $old_paralisacao_data = $this->Paralisacao->findByProcessoId($this->data['Processo']['id']);

            // Busca a situacao NORMAL
            $situacao = $this->Situacao->findBySigla('N');

            // Define a nova situacao do processo
            $processo['Processo']['situacao_id'] = $situacao['Situacao']['id'];
            // Grava a Data da Liberação do Processo
            $paralisacao['Paralisacao']['data_liberacao'] = 'now()';

            // Tenta salvar
            if ($this->Processo->save($processo, null, array('situacao_id')) && $this->Paralisacao->save($paralisacao)) {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('processos', $processo['Processo']['id'], 'U', $old_data, $processo);
                $this->logger('paralisacoes', $paralisacao['Paralisacao']['id'], 'U', $old_paralisacao_data, $paralisacao);

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo liberado com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/processos/consultar/' . $processo['Processo']['id'] );
            }
            else {
                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de valida??o
                $this->setMessage("erro", "", $this->Processo->validationErrors);
                $this->redirect('liberacao');
            }
        }
    }

    /**
     * Tramitar processo. Primeiro passo, busca e confirmação
     * http://sistema/processos/tramite **/
    public function tramite() {
        $this->verificarLogin(1);

        $this->set('fieldSetTitle', 'Tramitar Processo');
        $this->set('action_form', '/processos/tramite');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Lista os setores do orgao em sessao
        $this->set('setores', $this->Setor->findByOrgao($this->Session->read('Orgao.id'), true));

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            $this->render('busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'tramite');

            // Verifica se o processo se encontra na situação NORMAL
            $this->verificarSituacao($processo, 'N', 'tramite');

            // Verifica se o processo se encontra no setor do servidor
            $this->verificarSeProcessoEstaNoSetor($processo, 'tramite');

            // Verifica se o processo está anexado a outro
            $this->verificarSeEstaAnexado($processo, 'tramite');

            // Verifica se o processo esta dividido para servidores
            $this->Divisao->recursive = -1;
            $divisao = $this->Divisao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}"));

            if(count($divisao) > 0) {
                $this->setMessage("erro", "Não é possível tramitar o processo pois ele se encontra dividido entre Servidores deste setor.");
                $this->redirect('/processos/tramite/');
            }

            // Se cumpriu as exigências, exibe a view

            // Busca os processos anexados a ele
            $processosAnexados = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id']);

            $this->set('processo', $processo);
            $this->set('processosAnexados', $processosAnexados);

            $this->render();
        }
    }

    /**
     * Tramitar processo. Segundo passo.
     * http://sistema/processos/tramitar * */
    public function tramitar($id = null) {
        $this->verificarLogin(1);

        // Verifica se o id passado é válido
        if( ! $this->checkValidId($id) ) {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect('/processos/tramite/');
        }

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect('/processos/tramite/');
        } else {
            // Busca os detalhes do processo
            $processo = $processoAntigo = $this->Processo->find('first', array('conditions' => "id = {$this->data['Processo']['id']}", 'fields' => array('id', 'volumes', 'paginas', 'setor_id'), 'recursive' => -1));

            // Verifica se o processo se encontra no setor do servidor
            $this->verificarSeProcessoEstaNoSetor($processo, 'tramite');

            // Verifica se os dados de volumes foi passado
            if(empty($this->data['Processo']['volumes'])) {
                $this->setMessage("erro", "Número de volumes não informado.");
                $this->redirect('/processos/tramite/');
            }


            // Verifica se os dados de páginas foi passado
            if(empty($this->data['Processo']['paginas'])) {
                $this->setMessage("erro", "Número de páginas não informado.");
                $this->redirect('/processos/tramite/');
            }

            /**
             * 20/01/2009 - Filipe
             * Comentado a pedido do Carlos
             *

             // Verifica se o número de volumes é menor ao atual
              if($this->data['Processo']['volumes'] < $processo['Processo']['volumes'])
              {
             $this->setMessage("erro", "Novo número de volumes não pode ser inferior ao antigo.");
              $this->redirect('/processos/tramite/');
              }

             // Verifica se o número de páginas é menor ao atual
              if($this->data['Processo']['paginas'] < $processo['Processo']['paginas'])
              {
             $this->setMessage("erro", "Novo número de páginas não pode ser inferior ao antigo.");
              $this->redirect('/processos/tramite/');
              }

             */
            // Verifica se o setor de destino foi informado
            if(empty($this->data['Tramite']['setor_id'])) {
                $this->setMessage("erro", "Setor de destino não informado.");
                $this->redirect('/processos/tramite/');
            }

            // Verifica se o setor selecionado e igual ao setor onde o processo esta
            if ($this->Session->read('Setor.id') == $this->data['Tramite']['setor_id']) {
                $this->setMessage("erro", "O processo se encontra atualmente no setor informado.");
                $this->redirect('/processos/tramite/');
            }

            /*             * **********************************
             * Setar ultimo tramite como encaminhado
             * ********************************** */
            //buscar ultimo tramite do processo
            $ultimo_tramite = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);
            if ($ultimo_tramite) {
                $ultimo_tramite['Tramite']['flag_encaminhado'] = '1';
            }
            //set 'true' to flag_encaminhado

            /*************************************
             * Dados do novo trâmite
             *************************************/
            $tramite = array('Tramite' => array());

            $tramite['Tramite']['processo_id'] = $id;
            $tramite['Tramite']['setor_origem_id'] = $this->Session->read('Setor.id');
            $tramite['Tramite']['servidor_origem_id'] = $this->Session->read('Servidor.id');
            $tramite['Tramite']['setor_recebimento_id'] = $this->data['Tramite']['setor_id'];
            $tramite['Tramite']['observacoes'] = $this->data['Tramite']['observacoes'];
            $tramite['Tramite']['flag_recebimento'] = '0';
            $tramite['Tramite']['flag_encaminhado'] = false;



            /*             * ***********************************
             * Alterando dados do processo
             * *********************************** */
            $processo['Processo']['volumes'] = $this->data['Processo']['volumes'];
            $processo['Processo']['paginas'] = $this->data['Processo']['paginas'];

            // Inicia transação
            $this->Tramite->transactional = true;
            $this->Tramite->query('begin;');





            // Tenta salvar tanto o trâmite quanto o processo
            if(($this->Tramite->save($tramite)) && $this->Processo->save($processo, false, array('volumes', 'paginas'))) {
                if ($ultimo_tramite) {
                    $this->Tramite->save($ultimo_tramite, false, array('flag_encaminhado'));
                }

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('tramites', null, 'C', null, $tramite['Tramite']);
                $this->logger('processos', $processo['Processo']['id'], 'U', $processoAntigo['Processo'], $processo['Processo']);

                // Busca os processos anexos
                $anexos = $this->ProcessoAnexo->findByProcessoPrincipal($id, 1);

                // Percorre os anexos e cria um trâmite novo para cada um
                foreach($anexos as $anexo) {
                // Cria o novo trâmite
                    $this->Tramite->create();

                    $tramite = array('Tramite' => array());

                    $tramite['Tramite']['processo_id'] = $anexo['ProcessoAnexado']['id'];
                    $tramite['Tramite']['setor_origem_id'] = $this->Session->read('Setor.id');
                    $tramite['Tramite']['servidor_origem_id'] = $this->Session->read('Servidor.id');
                    $tramite['Tramite']['setor_recebimento_id'] = $this->data['Tramite']['setor_id'];
                    $tramite['Tramite']['flag_recebimento'] = '0';

                    // Salva o trâmite do processo anexo
                    if( $this->Tramite->save($tramite) ) {
                        // Se for salvo com sucesso, cria um log no banco
                        // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                        $this->logger('tramites', null, 'C', null, $tramite['Tramite']);
                    } else {
                        // Rollback na transacao
                        $this->Tramite->query('rollback;');

                        // Se ocorrer erro ao savar, exibe mensagem de erro
                        // passando os arrays com os erros de validação
                        $this->setMessage("erro", "Ocorreu um erro ao tramitar o processo.");
                        $this->redirect('/processos/tramite');
                    }
                }

                // Confirma a transacao
                $this->Tramite->query('commit;');

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo encaminhado com sucesso.");

                // Redirecionar para nova ação ou para exibição do item salvo
                if($this->data['Configuracao']['visualizar_processo'] == '1') {
                    $this->redirect('/processos/consultar/' . $id);
                } else {
                    $this->redirect('/processos/tramite/');
                }
            } else {
                // Rollback na transacao
                $this->Tramite->query('rollback;');

                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                $this->setMessage("erro", "Ocorreu um erro ao tramitar o processo.");
                $this->redirect('/processos/tramite');
            }
        }
    }

    /**
     * Cancelar trâmite de processo. Primeiro passo, busca e confirmação
     * http://sistema/processos/cancelamento_tramite **/
    public function cancelamento_tramite() {
        $this->verificarLogin(3);

        $this->set('fieldSetTitle', 'Cancelar Trâmite de Processo');
        $this->set('action_form', '/processos/cancelamento_tramite');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            $this->render('busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'tramite');

            // Como o processo foi encontrado, busca o ultimo tramite realizado
            $this->Tramite->unbindModel(array('belongsTo' => array('Processo', 'SetorOrigem', 'ServidorRecebimento')));
            $this->Tramite->ServidorOrigem->unbindModel(array('belongsTo' => array('GrupoUsuario', 'Setor', 'Cargo'), 'hasMany' => array('PermissaoServidor')));
            $tramite = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id'], 2);

            // Se não existe trâmite, retorna erro.
            if(!$tramite) {
                $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                $this->redirect('/processos/cancelamento_tramite/');
            }

            // Verifica se o processo está anexado a outro
            $this->verificarSeEstaAnexado($processo, 'cancelamento_tramite');

            // Verifica se o setor do processo e o mesmo do usuario.
            // Se não estiver, exibe erro e redireciona para a mesma acao.
            if(($tramite['Tramite']['setor_origem_id'] != $this->Session->read('Setor.id')) || ($tramite['Tramite']['flag_recebimento'] != false)) {
                $this->data = null;
                $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                $this->redirect('/processos/cancelamento_tramite/');
            }

            // Se cumpriu as exigências, exibe a view
            $this->set("processo", $processo);
            $this->set("tramite", $tramite);

            $this->render();
        }
    }

    /**
     * Cancelar trâmite do processo. Segundo passo.
     * http://sistema/processos/cancelar_tramite **/
    public function cancelar_tramite($id = null) {
        $this->verificarLogin(3);

        $action_retorno = 'cancelamento_tramite';

        // Verifica se o id passado é válido
        if( ! $this->checkValidId($id) ) {
            $this->setMessage("erro", "Código Inválido");
            $this->redirect("/processos/{$action_retorno}/");
        }

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect("/processos/{$action_retorno}/");
        } else {
            // Busca o ultimo tramite realizado
            $tramite = $this->Tramite->ultimoTramiteDoProcesso($id);

            // Se não existe trâmite, retorna erro.
            if(!$tramite) {
                $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                $this->redirect("/processos/{$action_retorno}/");
            }

            // Verifica se o código é igual ao código passado pelo formulário
            if($tramite['Tramite']['id'] != $this->data['Tramite']['id']) {
                $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                $this->redirect("/processos/{$action_retorno}/");
            }

            // Verifica se o setor do processo e o mesmo do usuario.
            // Se não estiver, exibe erro e redireciona para a mesma acao.
            if(($tramite['Tramite']['setor_origem_id'] != $this->Session->read('Setor.id')) || ($tramite['Tramite']['flag_recebimento'] != false)) {
                $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                $this->redirect("/processos/{$action_retorno}/");
            }

            // Inicia transação
            $this->Tramite->transactional = true;
            $this->Tramite->query('begin;');

            // Tenta excluir
            if( $this->Tramite->delete($tramite['Tramite']['id']) ) {
            // Se for excluído com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('tramites', $tramite['Tramite']['id'], 'D', null, null);

                // Busca os processos anexos
                $anexos = $this->ProcessoAnexo->findByProcessoPrincipal($id, 1);

                // Percorre os anexos e exclui os trâmites de cada um
                foreach($anexos as $anexo) {
                    $tramite = $this->Tramite->ultimoTramiteDoProcesso($anexo['ProcessoAnexado']['id']);

                    // Verifica se o setor do processo e o mesmo do usuario.
                    // Se não estiver, exibe erro e redireciona para a mesma acao.
                    if(($tramite['Tramite']['setor_origem_id'] != $this->Session->read('Setor.id')) || ($tramite['Tramite']['flag_recebimento'] != false)) {
                        $this->setMessage("erro", "Este processo não foi encaminhado pelo seu setor.");
                        $this->redirect("/processos/{$action_retorno}/");
                    }

                    // Exclui o trâmite do processo anexo
                    if( $this->Tramite->delete($tramite['Tramite']['id']) ) {
                        // Se for salvo com sucesso, cria um log no banco
                        // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                        $this->logger('tramites', $tramite['Tramite']['id'], 'D', null, null);
                    } else {
                        // Rollback na transacao
                        $this->Tramite->query('rollback;');

                        // Se ocorrer erro ao savar, exibe mensagem de erro
                        // passando os arrays com os erros de validação
                        $this->setMessage("erro", "Ocorreu um erro ao cancelar o trâmite.");
                        $this->redirect("/processos/{$action_retorno}/");
                    }
                }

                // Confirma a transacao
                $this->Tramite->query('commit;');

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Trâmite cancelado com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/processos/consultar/' . $id );
            }
            else {
                // Rollback na transacao
                $this->Tramite->query('rollback;');

                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                $this->setMessage("erro", "Ocorreu um erro ao cancelar o trâmite.");
                $this->redirect("/processos/{$action_retorno}/");
            }
        }
    }

    /**
     * Receber processo. Primeiro passo, busca e confirmação
     * http://sistema/processos/recebimento **/
    public function recebimento() {
        $this->verificarLogin(2);

        $this->set('fieldSetTitle', 'Receber Processo');
        $this->set('action_form', '/processos/recebimento');
        $this->set('retorno', 'processos/recebimento');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            $this->render('busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'recebimento');

            // Verifica se o processo está anexado a outro
            $this->verificarSeEstaAnexado($processo, 'recebimento');

            // Como o processo foi encontrado, busca o ultimo tramite realizado
            $tramite = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);

            // Se não existe trâmite, retorna erro.
            if(!$tramite) {
                $this->setMessage("erro", "Este processo não foi encaminhado ao seu setor.");
                $this->redirect('/processos/recebimento/');
            }

            // Verifica se o setor do processo e o mesmo do usuario.
            // Se não estiver, exibe erro e redireciona para a mesma acao.
            if(($tramite['Tramite']['setor_recebimento_id'] != $this->Session->read('Setor.id')) || ($tramite['Tramite']['flag_recebimento'] != false)) {
                $this->data = null;
                $this->setMessage("erro", "Este processo não foi encaminhado ao seu setor.");
                $this->redirect('/processos/recebimento/');
            }

            // Se cumpriu as exigências, exibe a view

            // Busca os processos anexados a ele
            $processosAnexados = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id']);

            $this->set("processo", $processo);
            $this->set('processosAnexados', $processosAnexados);

            $this->render();
        }
    }

    /**
     * Receber processo. Segundo passo.
     * http://sistema/processos/receber * */
    public function receber() {
        $this->verificarLogin(2);

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect('/processos/recebimento/');
        } else {

            // Busca os dados do processo
            $this->Processo->recursive = -1;
            $processo = $old_data = $this->Processo->read(null, $this->data['Processo']['id']);

            // Busca o último trâmite do processo
            $tramite = $old_data = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);

            // Define os dados de recebimento
            $tramite['Tramite']['flag_recebimento'] = 't';
            $tramite['Tramite']['flag_encaminhado'] = false;
            $tramite['Tramite']['data_recebimento'] = 'now()';
            $tramite['Tramite']['servidor_recebimento_id'] = $this->Session->read('Servidor.id');

            // Inicia transação
            $this->Tramite->transactional = true;
            $this->Tramite->query('begin;');

            // Tenta salvar
            if ($this->Tramite->save($tramite, null, array('flag_recebimento', 'data_recebimento', 'flag_encaminhado', 'servidor_recebimento_id'))) {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('tramites', $tramite['Tramite']['id'], 'U', $old_data, $tramite);


                // Busca os processos anexos
                $anexos = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id'], 1);

                // Percorre os anexos para busca o trâmite e marcar como recebido
                foreach($anexos as $anexo) {
                // Busca o último trâmite do processo
                    $tramite = $old_data = $this->Tramite->ultimoTramiteDoProcesso($anexo['ProcessoAnexado']['id']);

                    // Define os dados de recebimento
                    $tramite['Tramite']['flag_recebimento'] = 't';
                    $tramite['Tramite']['flag_encaminhado'] = false;
                    $tramite['Tramite']['data_recebimento'] = 'now()';
                    $tramite['Tramite']['servidor_recebimento_id'] = $this->Session->read('Servidor.id');

                    // Tenta salvar
                    if ($this->Tramite->save($tramite, null, array('flag_recebimento', 'data_recebimento', 'flag_encaminhado', 'servidor_recebimento_id'))) {
                        // Se for salvo com sucesso, cria um log no banco
                        // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                        $this->logger('tramites', $tramite['Tramite']['id'], 'U', $old_data, $tramite);
                    }
                    else {
                    // Rollback na transação
                        $this->Tramite->query('rollback;');

                        // Se ocorrer erro ao savar, exibe mensagem de erro
                        // passando os arrays com os erros de valida??o
                        $this->setMessage("erro", "", $this->Processo->validationErrors);
                        $this->redirect('recebimento');
                    }
                }

                // Confirma a transação
                $this->Tramite->query('commit;');

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo recebido com sucesso.");

                // Redirecionar para nova a??o ou para exibi??o do item salvo
                if ($this->data['Configuracao']['visualizar_processo'] == '1') {
                    $this->redirect('/processos/consultar/' . $processo['Processo']['id']);
                } else {
                    $this->redirect('/processos/recebimento/');
                }
            } else {
                // Rollback na transação
                $this->Tramite->query('rollback;');

                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->Processo->validationErrors);
                $this->redirect('recebimento');
            }
        }
    }

    /**
     * Author: Alan Flaubert
     * Receber processo em lote.
     * http://sistema/acesso/recebimento_lote
     * */
public function recebimento_lote() {
        $this->verificarLogin(2);
      
        if (empty($this->data)) {
            $this->setMessage("erro", "Não foi selecionado nenhum processo para receber.");
            $this->redirect('/acesso/boas_vindas/');
        } else {

            //atribuo os dados do formulario para variavel
            $processos = $this->data;

            // Inicia transacao
            $this->Tramite->transactional = true;
            $this->Tramite->query('begin');

            
            //percorrer os processos e criar um array com os tramites 
            foreach ($processos['Processo']['ids'] as $processo) {
                // Busca os dados do processo
                $this->Processo->recursive = -1;
                $processo = $old_data = $this->Processo->read(null, $processo);

                // Busca o Ultimo tramite do processo
                $tramite = $old_data = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);

                // Define os dados de recebimento
                $tramite['Tramite']['flag_recebimento'] = 't';
                $tramite['Tramite']['flag_encaminhado'] = false;
                $tramite['Tramite']['data_recebimento'] = 'now()';
                $tramite['Tramite']['servidor_recebimento_id'] = $this->Session->read('Servidor.id');
                
                // Tenta salvar
                if ($this->Tramite->save($tramite, null, array('flag_recebimento', 'data_recebimento', 'flag_encaminhado', 'servidor_recebimento_id'))) {

                    // Se for salvo com sucesso, cria um log no banco
                    // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                    $this->logger('tramites', $tramite['Tramite']['id'], 'U', $old_data, $tramite);

                    // Busca os processos anexos
                    $anexos = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id'], 1);

                    if (!empty($anexos)) { 
                        // Percorre os anexos para busca o tr?mite e marcar como recebido
                        foreach ($anexos as $anexo) {
                            // Busca o ?ltimo tr?mite do processo
                            $tramite = $old_data = $this->Tramite->ultimoTramiteDoProcesso($anexo['ProcessoAnexado']['id']);

                            // Define os dados de recebimento
                            $tramite['Tramite']['flag_recebimento'] = 't';
                            $tramite['Tramite']['flag_encaminhado'] = false;
                            $tramite['Tramite']['data_recebimento'] = 'now()';
                            $tramite['Tramite']['servidor_recebimento_id'] = $this->Session->read('Servidor.id');

                            // Tenta salvar
                            if ($this->Tramite->save($tramite, null, array('flag_recebimento', 'data_recebimento', 'flag_encaminhado', 'servidor_recebimento_id'))) {
                                // Se for salvo com sucesso, cria um log no banco
                                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                                $this->logger('tramites', $tramite['Tramite']['id'], 'U', $old_data, $tramite);
                            } else {
                                // Rollback na transa??o
                                $this->Tramite->query('rollback;');

                                // Se ocorrer erro ao savar, exibe mensagem de erro
                                // passando os arrays com os erros de valida??o
                                $this->setMessage("erro", "", $this->Tramite->validationErrors);
                                $this->redirect('/acesso/boas_vindas');
                            }
                        }
                    }

                    // Confirma a transação
                    $this->Tramite->query('commit;');

                    // Exibe mensagem de sucesso
                    $this->setMessage("sucesso", "Processo(s) recebido(s) com sucesso.");
              
                    

                    //$this->redirect('/acesso/boas_vindas/');
                } else {
                    // Rollback na transa??o
                    $this->Tramite->query('rollback;');

                    // Se ocorrer erro ao savar, exibe mensagem de erro
                    // passando os arrays com os erros de valida??o
                    $this->setMessage("erro", "", $this->Processo->validationErrors);
                    //$this->redirect('/acesso/boas_vindas/');
                }
            }
            $this->redirect('/acesso/boas_vindas');
        }
    }
        
    public function receber_lote_ajax($processo_id = null) {

        $this->verificarLogin(2);

        // Verifica se a busca ja foi realizada
        // Busca o processo e verifica se foi encontrado
        $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
        $this->Processo->recursive = 1;
        $processo = $this->Processo->read(null, $processo_id);

        // Verifica se o processo est? anexado a outro
        $this->verificarSeEstaAnexado($processo, 'recebimento');

        // Como o processo foi encontrado, busca o ultimo tramite realizado
        $tramite = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);

        // Se n?o existe tr?mite, retorna erro.
        if (!$tramite) {
            $this->setMessage("erro", "Este processo não foi encaminhado ao seu setor.");
            $this->redirect('/processos/recebimento/');
        }

        // Verifica se o setor do processo e o mesmo do usuario.
        // Se n?o estiver, exibe erro e redireciona para a mesma acao.
        if (($tramite['Tramite']['setor_recebimento_id'] != $this->Session->read('Setor.id')) || ($tramite['Tramite']['flag_recebimento'] != false)) {
            $this->data = null;
            $this->setMessage("erro", "Este processo n?o foi encaminhado ao seu setor.");
            $this->redirect('/processos/recebimento/');
        }

        // Se cumpriu as exig?ncias, exibe a view
        // Busca os processos anexados a ele
        $processosAnexados = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id']);

        $this->set("processo", $processo);
        $this->set('processosAnexados', $processosAnexados);

        $this->render(null, 'ajax');
    }

    /**
     * Receber processo externo. Primeiro passo, busca e confirmação
     * http://sistema/processos/recebimento_externo **/
    public function recebimento_externo() {
        $this->verificarLogin(4);

        $this->set('fieldSetTitle', 'Receber Processo Externo');
        $this->set('action_form', '/processos/recebimento_externo');
        $this->set('retorno', 'processos/recebimento_externo');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listar());

        // Verifica se a busca ja foi realizada
        if (empty($this->data)) {
            $this->render('busca_generica');
        } else {
            // Busca o processo e verifica se foi encontrado
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], 'recebimento');

            // Verifica se o processo está anexado a outro
            $this->verificarSeEstaAnexado($processo, 'recebimento_externo');

            // Como o processo foi encontrado, busca o ultimo tramite realizado
            $tramite = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);

            // Busca os dados do setor
            $setorRecebimento = $this->Setor->read(array('Setor.id', 'Orgao.id', 'Orgao.sigla', 'Orgao.externo'), $tramite['Tramite']['setor_recebimento_id']);

            // Verifica se o último trâmite do processo foi para um órgão externo
            if($setorRecebimento['Orgao']['externo'] != true) {
                $this->setMessage("erro", "Este processo não foi encaminhado a um órgão externo.");
                $this->redirect('/processos/recebimento_externo/');
            }

            // Se cumpriu as exigências, exibe a view

            // Busca os processos anexados a ele
            $processosAnexados = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id']);

            $this->set("processo", $processo);
            $this->set('processosAnexados', $processosAnexados);

            $this->render();
        }
    }

    /**
     * Receber processo. Segundo passo.
     * http://sistema/processos/receber_externo * */
    public function receber_externo() {
        $this->verificarLogin(4);

        if (empty($this->data)) {
            $this->setMessage("erro", "Erro.");
            $this->redirect('/processos/recebimento_externo/');
        } else {
            // Busca os dados do processo
            $this->Processo->recursive = -1;
            $processo = $old_data = $this->Processo->read(null, $this->data['Processo']['id']);

            // Busca o último trâmite do processo
            $tramite = $old_data = $this->Tramite->ultimoTramiteDoProcesso($processo['Processo']['id']);

            // Define os dados de recebimento
            $tramite['Tramite']['flag_recebimento'] = 't';
            $tramite['Tramite']['flag_encaminhado'] = false;
            $tramite['Tramite']['data_recebimento'] = 'now()';
            $tramite['Tramite']['servidor_recebimento_id'] = $this->Session->read('Servidor.id');

            // Inicia transação
            $this->Tramite->transactional = true;
            $this->Tramite->query('begin;');

            // Tenta salvar
            if ($this->Tramite->save($tramite, null, array('flag_recebimento', 'data_recebimento', 'flag_encaminhado', 'servidor_recebimento_id'))) {

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('tramites', $tramite['Tramite']['id'], 'U', $old_data, $tramite);

                // Cria o trâmite do órgão externo para o órgão e setor do servidor logado
                $tramiteRecebimento = array('Tramite' => array());
                $tramiteRecebimento['Tramite']['id'] = false;
                $tramiteRecebimento['Tramite']['processo_id'] = $tramite['Tramite']['processo_id'];
                $tramiteRecebimento['Tramite']['setor_origem_id'] = $tramite['Tramite']['setor_recebimento_id'];
                $tramiteRecebimento['Tramite']['servidor_origem_id'] = $this->Session->read('Servidor.id');
                $tramiteRecebimento['Tramite']['data_tramite'] = 'now()';
                $tramiteRecebimento['Tramite']['setor_recebimento_id'] = $this->Session->read('Setor.id');
                $tramiteRecebimento['Tramite']['servidor_recebimento_id'] = $this->Session->read('Servidor.id');
                $tramiteRecebimento['Tramite']['flag_recebimento'] = 't';
                $tramiteRecebimento['Tramite']['flag_encaminhado'] = false;
                $tramiteRecebimento['Tramite']['data_recebimento'] = 'now()';

                // Tenta salvar
                if ($this->Tramite->save($tramiteRecebimento, false)) {
                    // Se for salvo com sucesso, cria um log no banco
                    // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                    $this->logger('tramites', null, 'C', null, $tramiteRecebimento);
                } else {
                    // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                    $this->setMessage("erro", "", $this->Tramite->validationErrors);
                    $this->redirect('recebimento_externo');
                }

                // Busca os processos anexos
                $anexos = $this->ProcessoAnexo->findByProcessoPrincipal($processo['Processo']['id'], 1);

                // Percorre os anexos para busca o trâmite e marcar como recebido
                foreach($anexos as $anexo) {
                // Busca o último trâmite do processo
                    $tramite = $old_data = $this->Tramite->ultimoTramiteDoProcesso($anexo['ProcessoAnexado']['id']);

                    // Define os dados de recebimento
                    $tramite['Tramite']['flag_recebimento'] = 't';
                    $tramite['Tramite']['flag_encaminhado'] = false;
                    $tramite['Tramite']['data_recebimento'] = 'now()';
                    $tramite['Tramite']['servidor_recebimento_id'] = $this->Session->read('Servidor.id');

                    // Tenta salvar
                    if ($this->Tramite->save($tramite, null, array('flag_recebimento', 'data_recebimento', 'flag_encaminhado', 'servidor_recebimento_id'))) {
                        // Se for salvo com sucesso, cria um log no banco
                        // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                        $this->logger('tramites', $tramite['Tramite']['id'], 'U', $old_data, $tramite);


                        // Cria o trâmite do órgão externo para o órgão e setor do servidor logado
                        $tramiteRecebimento = array('Tramite' => array());
                        $tramiteRecebimento['Tramite']['id'] = false;
                        $tramiteRecebimento['Tramite']['processo_id'] = $tramite['Tramite']['processo_id'];
                        $tramiteRecebimento['Tramite']['setor_origem_id'] = $tramite['Tramite']['setor_recebimento_id'];
                        $tramiteRecebimento['Tramite']['servidor_origem_id'] = $this->Session->read('Servidor.id');
                        $tramiteRecebimento['Tramite']['data_tramite'] = 'now()';
                        $tramiteRecebimento['Tramite']['setor_recebimento_id'] = $this->Session->read('Setor.id');
                        $tramiteRecebimento['Tramite']['servidor_recebimento_id'] = $this->Session->read('Servidor.id');
                        $tramiteRecebimento['Tramite']['flag_recebimento'] = 't';
                        $tramiteRecebimento['Tramite']['flag_encaminhado'] = false;
                        $tramiteRecebimento['Tramite']['data_recebimento'] = 'now';

                        // Tenta salvar
                        if ($this->Tramite->save($tramiteRecebimento, false)) {
                            // Se for salvo com sucesso, cria um log no banco
                            // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                            $this->logger('tramites', null, 'C', null, $tramiteRecebimento);
                        } else {
                            // Se ocorrer erro ao savar, exibe mensagem de erro
                            // passando os arrays com os erros de valida??o
                            $this->setMessage("erro", "", $this->Tramite->validationErrors);
                            $this->redirect('recebimento_externo');
                        }

                    }
                    else {
                    // Rollback na transação
                        $this->Tramite->query('rollback;');

                        // Se ocorrer erro ao savar, exibe mensagem de erro
                        // passando os arrays com os erros de valida??o
                        $this->setMessage("erro", "", $this->Processo->validationErrors);
                        $this->redirect('recebimento');
                    }
                }

                // Confirma a transação
                $this->Tramite->query('commit;');

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Processo recebido com sucesso.");


                // Redirecionar para nova ação ou para exibição do item salvo
                if($this->data['Configuracao']['visualizar_processo'] == '1') {
                    $this->redirect('/processos/consultar/' . $processo['Processo']['id']);
                } else {
                    $this->redirect('/processos/recebimento_externo/');
                }

            }
            else {
            // Rollback na transação
                $this->Tramite->query('rollback;');

                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->Processo->validationErrors);
                $this->redirect('recebimento');
            }
        }
    }

}

?>