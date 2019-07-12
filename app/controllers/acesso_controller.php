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

/**
 *@property Servidor $Servidor 
 */

class AcessoController extends AppController
{

    public $name = "Acesso";
    public $helpers = array('Protocolo','Ajax');
    public $uses = array('Servidor', 'PermissaoGrupo', 'PermissaoServidor', 'Tramite', 'SetorServidor', 'Setor', 'Orgao');
    public $components = array('Cookie');

    /**
     * Método privado para redirecionar para boas-vindas
     */
    private function redirecionarParaBoasVindas($nome)
    {
        $this->setMessage('sucesso', "Bem-vindo ao SipaNet, {$nome}");
        $this->redirect('/acesso/boas_vindas');
    }

    public function login()
    {
        // Verifica se o usuário já está logado
        if($this->usuarioEstaLogado())
        {
            $this->redirect('/acesso/boas_vindas');
            die();
        }

        $this->set('fieldSetTitle', 'Acesso ao Sistema');

        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listarInternos());

        // Verifica se o cookie está marcado para lembrar o usuário.
        // Se estiver, envia os dados para a view
        if($this->Cookie->read('Servidor'))
        {
            $cookie = $this->Cookie->read('Servidor');
            if($cookie['lembrar'] == '1')
            {
                $this->set('lembrarServidor', $cookie);
            }
        }

        if(empty($this->data))
        {
            $this->render();
        }
        else
        {
            $login = $this->data['Servidor']['login'];
            $senha = md5($this->data['Servidor']['senha']);
            $orgao_id = $this->data['Orgao']['id'];

            $servidor = $this->Servidor->findLogin($login, $senha, $orgao_id);

            // Verifica se encontrou o servidor
            if(!$servidor)
            {
                $this->setMessage("erro", "Login e senha não encontrados");

                // Não retorna a senha para a view
                $this->data['Servidor']['senha'] = null;
            }
            else
            {
                // Verifica se o usuário marcou a caixa para lembrar
                if($this->data['Opcoes']['lembrar'] == 1)
                {
                    $expirar = '+4 weeks';
                    $cookie = array();
                    $cookie['login'] = $this->data['Servidor']['login'];
                    $cookie['orgao_id'] = $this->data['Orgao']['id'];
                    $cookie['lembrar'] = '1';
                    $this->Cookie->write('Servidor', $cookie, true, $expirar);
                }

                // Remove associações indesejadas
                // Obs: é necessário resgatar as permissões.
                $this->Servidor->unbindModel(array(
                                                    'hasMany' => array('PermissaoServidor')
                    ));

                // Busca as permissões, tanto para o grupo quanto para o servidor
                $this->PermissaoGrupo->recursive = -1;
                $this->PermissaoServidor->recursive = -1;

                $permissoesGrupo = $this->PermissaoGrupo->find('all', array('conditions' => "grupo_usuario_id = {$servidor['Servidor']['grupo_usuario_id']}"));
                $permissoesUsuario = $this->PermissaoServidor->find('all', array('conditions' => "servidor_id = {$servidor['Servidor']['id']}"));

                $modulosPermitidos = array();

                // Cria um vetor com as permissões disponíveis
                foreach($permissoesGrupo as $permissao)
                {
                    $modulosPermitidos[] = $permissao['PermissaoGrupo']['modulo_id'];
                }

                foreach($permissoesUsuario as $permissao)
                {
                    $modulosPermitidos[] = $permissao['PermissaoUsuario']['modulo_id'];
                }

                //Escreve na Sessao Servidor.isAdmin caso contenha o modulo 21 (administracao)
                if (in_array('21',$modulosPermitidos))
                {
                    $this->Session->write('Servidor.isAdmin', true);
                }

           
                // Escreve os dados do servidor em sessão
                $this->Session->write('Servidor.id', $servidor['Servidor']['id']);
                $this->Session->write('Servidor.nome', $servidor['Servidor']['nome']);
                $this->Session->write('Setor.id', $servidor['Setor']['id']);
                $this->Session->write('Setor.sigla', $servidor['Setor']['sigla']);
                $this->Session->write('Setor.descricao', $servidor['Setor']['descricao']);
                $this->Session->write('Setor.permite_divisao', $servidor['Setor']['permite_divisao']);
                $this->Session->write('Orgao.id', $servidor['Setor']['Orgao']['id']);
                $this->Session->write('Orgao.codigo', $servidor['Setor']['Orgao']['codigo']);
                $this->Session->write('Orgao.sigla', $servidor['Setor']['Orgao']['sigla']);
                $this->Session->write('Modulos', $modulosPermitidos);

                $this->Session->write('Acesso', date('Y-m-d H:i:s'));

                // Cria log para a ação
                $this->logger('login', null, null, null, null);

                // Verifica se o servidor possui setores associados a ele, além do setor principal
                $setores_associados = $this->SetorServidor->find('count', array('conditions' => "servidor_id = {$servidor['Servidor']['id']} and ativo = true"));

                if($setores_associados == 0)
                {
                    $this->redirecionarParaBoasVindas($servidor['Servidor']['nome']);
                }
                else
                {
                    $this->Session->write('EsconderMenu', true);
                    $this->redirect('/acesso/selecionar_setor');
                }
            }
        }
    }

    public function selecionar_setor($setor_id = null)
    {
        $this->verificarLogin();
        $this->set('fieldSetTitle', 'Selecione qual setor você deseja utilizar durante esta sessão');

        // Busca o servidor
        $this->Servidor->recursive = 1;
        $servidor = $this->Servidor->read(null, $this->Session->read('Servidor.id'));
        $this->set('servidor', $servidor);

        // Busca os setores associados a ele
        $setores_servidor = $this->SetorServidor->findAll("servidor_id = {$this->Session->read('Servidor.id')} and ativo = true");
        $this->set('setores_servidor',$setores_servidor);

        if($setor_id == null)
        {
            $this->render();
        }
        else
        {
            // Verifica se o servidor está mesmo associado ao setor passado
            $setores_associados = $this->SetorServidor->find('list', array('conditions' => "servidor_id = {$servidor['Servidor']['id']}", 'fields' => 'setor_id'));
            array_push($setores_associados, $servidor['Servidor']['setor_id']);

            if(in_array($setor_id, $setores_associados))
            {
                // Busca os dados do setor informado
                $setor = $this->Setor->read(array('id', 'sigla', 'descricao', 'permite_divisao'), $setor_id);

                // Escreve os dados do setor em sessão
                $this->Session->write('Setor.id', $setor['Setor']['id']);
                $this->Session->write('Setor.sigla', $setor['Setor']['sigla']);
                $this->Session->write('Setor.permite_divisao', $setor['Setor']['permite_divisao']);

                // Retira a trava do menu
                $this->Session->del('EsconderMenu');

                $this->redirecionarParaBoasVindas($servidor['Servidor']['nome']);
            }
            else
            {
                $this->setMessage('erro', "O setor informado não está associado ao servidor");
            }
        }
    }

    public function boas_vindas()
    {
        $this->verificarLogin();
        $this->set('fieldSetTitle', 'Bem-vindo');
        $this->set('message_status', '<span style=\'font-size:12pt\'>Agora você pode receber um ou mais processos de uma só vez!</span> <br /> É só selecionar os processos desejados abaixo e clicar no botão "Receber Selecionados".');
        // Busca os processos encaminhados para o setor do usuário e não recebidos
        $this->Tramite->recursive = 2;
        $this->Tramite->unbindModel(array('belongsTo' => array('SetorRecebimento', 'ServidorRecebimento')));
        $this->Tramite->Processo->unbindModel(array('belongsTo' => array('Servidor', 'Situacao'), 'hasMany' => array('Divisao', 'Tramite')));
        $this->Tramite->ServidorOrigem->unbindModel(array('belongsTo' => array('Setor', 'GrupoUsuario', 'Cargo'), 'hasMany' => array('PermissaoServidor')));
        $tramites = $this->Tramite->tramitesNaoRecebidosDoSetor($this->Session->read('Setor.id'));
        $this->set('tramites', $tramites);
    }

    public function ajax_nao_encaminhados() {
        $this->Tramite->recursive = 2;
        $this->Tramite->unbindModel(array('belongsTo' => array('SetorRecebimento')));
        $this->Tramite->Processo->unbindModel(array('belongsTo' => array('Servidor', 'Situacao'), 'hasMany' => array('Divisao', 'Tramite')));
        $this->Tramite->ServidorOrigem->unbindModel(array('belongsTo' => array('Setor', 'GrupoUsuario', 'Cargo'), 'hasMany' => array('PermissaoServidor')));
        $tramites_nao_encaminhados = $this->Tramite->tramitesNaoEncaminhadosDoSetor($this->Session->read('Setor.id'));
        $this->set('tramites_nao_encaminhados', $tramites_nao_encaminhados);
        $this->render(null, 'ajax');
    }

    public function logout()
    {
        $this->Session->destroy();
        $this->Session->activate();
        $this->setMessage('sucesso', "Obrigado por utilizar o SipaNet");
        $this->redirect('/acesso/login');
    }
}
?>
