<?php
/**
 *  SipaNet 2.0 - Sistema de Informaï¿½ï¿½o Processual e Arquivo
 Copyright (C) 2008 Universidade Estadual de Ciï¿½ncias da Saï¿½de de Alagoas - UNCISAL <http://www.uncisal.edu.br>

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
 * @property Arquivo $Arquivo
 * @property Processo $Processo
 * @property Tramite $Tramite
 * @property Model $Model
 * @property Interessado $Interessado
 */
class RelatoriosController extends AppController {
    var $name = "Relatorios";
    public $uses = array (
    'Processo',
    'Orgao',
    'Situacao',
    'Natureza',
    'Tramite',
    'Setor',
    'Etiqueta',
    'Servidor',
    'HistoricoDivisao',
    'Divisao',

    );
    var $helpers = array (
    'protocolo',
    'ajax'
    );

    function beforeFilter() {
    //$modulo = 19;
        $modulo = null;

        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

    /**
     * Relatï¿½rio de processos com busca completa
     * **/
    function processos() {
    //Consulta geral dos processos
        $this->set('fieldSetTitle', 'Relatï¿½rio - Processos');

        // Listas necessï¿½rias para popular campos de seleï¿½ï¿½o
        $this->set('orgaos', $this->Orgao->listar());
        $this->set('naturezas', $this->Natureza->find('all', array('order' => 'descricao asc', 'recursive' => -1)));
        $this->set('situacoes', $this->Situacao->listar());

        // Caso os dados tenham sido passados via URL, repassa os dados para a variï¿½vel $this->data['Busca']. A partir desta variï¿½vel serï¿½ feita a consulta
        if(count($this->params['named']) > 0) {
            $this->data['Busca'] = $this->params['named'];
        }

        if(isset($this->data)) {
        // Verifica se a consulta acabou de ser realizada
            if(count($this->params['named']) == 0) {
            // Formata as datas
                $datas = array(
                    'data_inicial' => $this->formatDateToIso($this->data['Busca']['data_cadastro_inicial']),
                    'data_final' => $this->formatDateToIso($this->data['Busca']['data_cadastro_final']),
                );

                unset($this->data['Busca']['data_cadastro_inicial']);
                unset($this->data['Busca']['data_cadastro_final']);

                $this->data['Busca'] = array_merge($this->data['Busca'], $datas);
            }

            // Formata a URL que serï¿½ chamada na paginaï¿½ï¿½o
            $this->set('url', $this->gerarNamedUrl($this->data['Busca']));

            // Verifica se o ï¿½rgï¿½o foi passado. Se foi, resgata a lista de setores para exibiï¿½ï¿½o
            if(array_key_exists('orgao_id', $this->data['Busca']) && ($this->data['Busca']['orgao_id'] != "")) {
            // Lista de seleï¿½ï¿½o de setores - jï¿½ que o ï¿½rgï¿½o foi selecionado, podemos retornar o setor para exibiï¿½ï¿½o
                $this->set('setores', $this->Setor->findByOrgao($this->data['Busca']['orgao_id']));
            }

            // Resgata os critï¿½rios para busca
            $criterios = $this->Processo->resgatarCriteriosBusca($this->data['Busca']);

            if($criterios) {
            // Define os critï¿½rios da pï¿½ginaï¿½ï¿½o
                $this->paginate = array('limit' => 30, 'page' => 1, 'recursive' => 1, 'order' => array('Processo.data_cadastro' => 'asc'));

                // Realiza a busca
                $this->set('processos', $this->paginate('Processo', $criterios));
            }
            else {
                $this->setMessage('erro', 'Nenhum critï¿½rio de busca informado.');
            }
        }
    }

    /**
     * Relatï¿½rio de processos lentos.
     * Sï¿½o resgatados os processos nï¿½o recebidos e encaminhados determinada quantidade de dias atrï¿½s
     * **/
    function processos_lentos() {
        $this->set('fieldSetTitle', 'Relatï¿½rio - Processos Lentos');

        // Caso os dados tenham sido passados via URL, repassa os dados para a variï¿½vel $this->data['Busca']. A partir desta variï¿½vel serï¿½ feita a consulta
        if(count($this->params['named']) > 0) {
            $this->data['Busca'] = $this->params['named'];
        }

        if(isset($this->data)) {
        // Formata a URL que serï¿½ chamada na paginaï¿½ï¿½o
            $this->set('url', $this->gerarNamedUrl($this->data['Busca']));

            $dias = (strlen($this->data['Busca']['dias']) > 0) ? $this->data['Busca']['dias'] : 5;
            $data = date('Y-m-d', mktime(null, null, null, date('m'), date('d') - $dias, date('Y')));

            // Remove associaï¿½ï¿½es desnecessï¿½rias
            $this->Tramite->unbindModel(
                array('belongsTo' => array(
                'TipoTramite',
                'ServidorOrigem',
                'ServidorRecebimento'
                ))
            );
            $this->Tramite->Processo->unbindModel(
                array('belongsTo' => array(
                'Natureza',
                'Servidor',
                'Setor',
                'Situacao',
                ),
                'hasMany' => array(
                'Divisao',
                'Tramite'
                )
                )
            );
            $this->Tramite->SetorOrigem->unbindModel(
                array('belongsTo' => array(
                'Orgao',
                ),
                )
            );
            $this->Tramite->SetorRecebimento->unbindModel(
                array('belongsTo' => array(
                'Orgao',
                ),
                )
            );

            // Define os critï¿½rios da pï¿½ginaï¿½ï¿½o
            $this->paginate = array('limit' => 30, 'page' => 1, 'order' => array('data_tramite' => 'asc'), 'recursive' => 2);

            // Realiza a busca
            $this->set('tramites', $this->paginate('Tramite', "flag_recebimento = false and data_tramite < '{$data}'"));
        }
    }


    /**
     * Relatorio para exibiï¿½ï¿½o de dos processos que estï¿½o atrasados, de acordo
     * com a configuraï¿½ï¿½o existem em dias na mesa.
     */

    function processos_atrasados() {

        $this->set('fieldSetTitle', 'Relatï¿½rio - Processos Atrasados');

                // Listas necessï¿½rias para popular campos de seleï¿½ï¿½o
        $this->set('orgaos', $this->Orgao->listar());

        // Caso os dados tenham sido passados via URL, repassa os dados para a variï¿½vel $this->data['Busca']. A partir desta variï¿½vel serï¿½ feita a consulta
        if(count($this->params['named']) > 0) {
            $this->data['Busca'] = $this->params['named'];
        }

        if(isset($this->data)) {
            if(array_key_exists('OrgaoSelect', $this->params['form']) && ($this->params['form']['OrgaoSelect'] != "")) {
            // Lista de seleï¿½ï¿½o de setores - jï¿½ que o ï¿½rgï¿½o foi selecionado, podemos retornar o setor para exibiï¿½ï¿½o
                $this->set('setores', $this->Setor->findByOrgao($this->params['form']['OrgaoSelect']));
            }

            if (isset($this->data['Busca']['setor_recebimento_id'])&&isset($this->data['Busca']['orgao_id'])) {
                $setor_id = $this->data['Busca']['setor_recebimento_id'];
                $orgao_id = $this->data['Busca']['orgao_id'];
                
                if($setor_id == '*') {
                    $setor_id = "in (select dias_na_mesa.setor_id from dias_na_mesa join setores on setores.orgao_id = {$orgao_id} and setores.id = dias_na_mesa.setor_id)";
                } else {
                    $setor_id = ' = '.$this->data['Busca']['setor_recebimento_id'];
            }
            }
            
            if ($setor_id != null) {
            $result = $this->Tramite->query("select
                            Processo.numero_orgao || '-' || Processo.numero_processo || '/' || Processo.numero_ano as Processo,
                            Interessado.nome as Interessado,
                            SetorOrigem.sigla,
                            Servidor.nome,
                            Tramite.data_recebimento,
                            TipoProcesso.descricao as tipo_processo,
                            DiaNaMesa.max_dias_na_mesa
                            from tramites as Tramite
                            join processos as Processo
                             on Processo.id = Tramite.processo_id
                            join interessados as Interessado on
                            Processo.interessado_id = Interessado.id
                            join tipos_processo as TipoProcesso
                             on Processo.tipo_processo_id = TipoProcesso.id
                            join setores as SetorRecebimento
                             on Tramite.setor_recebimento_id = SetorRecebimento.id
                            join setores as SetorOrigem
                             on Tramite.setor_origem_id = SetorOrigem.id
                            join dias_na_mesa as DiaNaMesa
                             on (DiaNaMesa.tipo_processo_id = TipoProcesso.id
                            and DiaNaMesa.setor_id = Tramite.setor_recebimento_id)
                            join servidores as Servidor on
                            Tramite.servidor_recebimento_id = Servidor.id
                            where
                            Tramite.setor_recebimento_id {$setor_id}
                            and
                            Tramite.flag_recebimento = true
                            and
                            Tramite.flag_encaminhado = false
                            order by Tramite.data_recebimento
                            ");

            $this->set('tramites_nao_encaminhados', $result);
            }
        }
    }

    /**
     * Relatï¿½rio com busca pelos trï¿½mites
     * **/
    function tramites() {
    //Consulta geral dos processos
        $this->set('fieldSetTitle', 'Relatï¿½rio - Trï¿½mites');

        // Listas necessï¿½rias para popular campos de seleï¿½ï¿½o
        $this->set('orgaos', $this->Orgao->listar());

        // Caso os dados tenham sido passados via URL, repassa os dados para a variï¿½vel $this->data['Busca']. A partir desta variï¿½vel serï¿½ feita a consulta
        if(count($this->params['named']) > 0) {
            $this->data['Busca'] = $this->params['named'];
        }

        if(isset($this->data)) {
            if(array_key_exists('OrgaoSelect', $this->params['form']) && ($this->params['form']['OrgaoSelect'] != "")) {
            // Lista de seleï¿½ï¿½o de setores - jï¿½ que o ï¿½rgï¿½o foi selecionado, podemos retornar o setor para exibiï¿½ï¿½o
                $this->set('setores', $this->Setor->findByOrgao($this->params['form']['OrgaoSelect']));
            }

            // Verifica se a consulta acabou de ser realizada
            if(count($this->params['named']) == 0) {
            // Formata as datas
                $datas = array(
                    'data_inicial' => $this->formatDateToIso($this->data['Busca']['data_tramite_inicial']),
                    'data_final' => $this->formatDateToIso($this->data['Busca']['data_tramite_final']),
                );

                unset($this->data['Busca']['data_tramite_inicial']);
                unset($this->data['Busca']['data_tramite_final']);

                $orgao = array('orgao_id' => $this->params['form']['OrgaoSelect']);
                $this->data['Busca'] = array_merge($this->data['Busca'], $datas, $orgao);
            }

            // Formata a URL que serï¿½ chamada na paginaï¿½ï¿½o
            $this->set('url', $this->gerarNamedUrl($this->data['Busca']));

            // Define os critï¿½rios da pï¿½ginaï¿½ï¿½o
            $this->paginate = array('limit' => 30, 'page' => 1, 'order' => array('Processo.numero_orgao ASC','Processo.numero_processo ASC', 'Processo.numero_ano ASC', 'Tramite.data_tramite asc'), 'recursive' => 2);

            // Resgata os critï¿½rios para busca
            //pr($this->data['Busca']);
            //die();
            $criterios = $this->Tramite->resgatarCriteriosBusca($this->data['Busca']);


            // Remove relacionamentos indesejados
            $this->Tramite->unbindModel(array('belongsTo' => array('TipoTramite')));

            $this->Tramite->Processo->unbindModel(
                array(
                'hasMany' => array(
                'Divisao',
                'Tramite'
                ),
                'belongsTo' => array(
                'Interessado',
                'Natureza',
                'Servidor',
                'Setor',
                'Situacao',
                ),
                )
            );

            $this->Tramite->ServidorOrigem->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            $this->Tramite->ServidorRecebimento->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            // Realiza a busca
            $this->set('tramites', $this->paginate('Tramite', $criterios));
        }
    }


    /**
     * Relatï¿½rio com busca pelos trï¿½mites nï¿½o recebidos
     * **/
    function tramites_nao_recebidos() {
    //Consulta geral dos processos
        $this->set('fieldSetTitle', 'Relatï¿½rio - Trï¿½mites');

        // Listas necessï¿½rias para popular campos de seleï¿½ï¿½o
        $this->set('orgaos', $this->Orgao->listar());

        // Caso os dados tenham sido passados via URL, repassa os dados para a variï¿½vel $this->data['Busca']. A partir desta variï¿½vel serï¿½ feita a consulta
        if(count($this->params['named']) > 0) {
            $this->data['Busca'] = $this->params['named'];
        }

        if(isset($this->data)) {
            if(array_key_exists('OrgaoSelect', $this->params['form']) && ($this->params['form']['OrgaoSelect'] != "")) {
            // Lista de seleï¿½ï¿½o de setores - jï¿½ que o ï¿½rgï¿½o foi selecionado, podemos retornar o setor para exibiï¿½ï¿½o
                $this->set('setores', $this->Setor->findByOrgao($this->params['form']['OrgaoSelect']));
            }

            // Verifica se a consulta acabou de ser realizada
            if(count($this->params['named']) == 0) {
            // Formata as datas
                $datas = array(
                    'data_inicial' => $this->formatDateToIso($this->data['Busca']['data_tramite_inicial']),
                    'data_final' => $this->formatDateToIso($this->data['Busca']['data_tramite_final']),
                );

                unset($this->data['Busca']['data_tramite_inicial']);
                unset($this->data['Busca']['data_tramite_final']);

                $orgao = array('orgao_id' => $this->params['form']['OrgaoSelect']);
                $this->data['Busca'] = array_merge($this->data['Busca'], $datas, $orgao);
            }

            // Informa o setor de origem como o setor onde o usuï¿½rio estï¿½ logado
            $this->data['Busca']['setor_origem_id'] = $this->Session->read('Setor.id');

            // Informa que deve retornar apenas os trï¿½mites nï¿½o recebidos
            $this->data['Busca']['flag_recebimento'] = 'false';

            // Formata a URL que serï¿½ chamada na paginaï¿½ï¿½o
            $this->set('url', $this->gerarNamedUrl($this->data['Busca']));

            // Define os critï¿½rios da pï¿½ginaï¿½ï¿½o
            $this->paginate = array('limit' => 30, 'page' => 1, 'order' => array('Tramite.data_tramite' => 'asc'), 'recursive' => 2);


            // Resgata os critï¿½rios para busca
            $criterios = $this->Tramite->resgatarCriteriosBusca($this->data['Busca']);

            // Remove relacionamentos indesejados
            $this->Tramite->unbindModel(array('belongsTo' => array('TipoTramite')));

            $this->Tramite->Processo->unbindModel(
                array(
                'hasMany' => array(
                'Divisao',
                'Tramite'
                ),
                'belongsTo' => array(
                'Interessado',
                'Natureza',
                'Servidor',
                'Setor',
                'Situacao',
                ),
                )
            );

            $this->Tramite->ServidorOrigem->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            $this->Tramite->ServidorRecebimento->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            // Realiza a busca
            $this->set('tramites', $this->paginate('Tramite', $criterios));
        }
    }


    /**
     * Relatï¿½rio com busca pelos trï¿½mites
     * **/
    function tramitacao_entre_setores() {
    //Consulta geral dos processos
        $this->set('fieldSetTitle', 'Relatï¿½rio - Tramitaï¿½ï¿½o entre setores');

        // Listas necessï¿½rias para popular campos de seleï¿½ï¿½o
        $this->set('orgaos', $this->Orgao->listar());

        // Caso os dados tenham sido passados via URL, repassa os dados para a variï¿½vel $this->data['Busca']. A partir desta variï¿½vel serï¿½ feita a consulta
        if(count($this->params['named']) > 0) {
            $this->data['Busca'] = $this->params['named'];
        }

        if(isset($this->data) && ($this->data['Busca']['setor_origem_id'] != '') && ($this->data['Busca']['setor_recebimento_id'] != '')) {
        // Lista de seleï¿½ï¿½o de setores - jï¿½ que o ï¿½rgï¿½o foi selecionado, podemos retornar o setor para exibiï¿½ï¿½o
            $this->set('setoresOrigem', $this->Setor->findByOrgao($this->data['Busca']['orgao_origem_id']));
            $this->set('setoresRecebimento', $this->Setor->findByOrgao($this->data['Busca']['orgao_recebimento_id']));

            // Verifica se a consulta acabou de ser realizada
            if(count($this->params['named']) == 0) {
            // Formata as datas
                $datas = array(
                    'data_inicial' => $this->formatDateToIso($this->data['Busca']['data_tramite_inicial']),
                    'data_final' => $this->formatDateToIso($this->data['Busca']['data_tramite_final']),
                );

                unset($this->data['Busca']['data_tramite_inicial']);
                unset($this->data['Busca']['data_tramite_final']);

                $this->data['Busca'] = array_merge($this->data['Busca'], $datas);
            }

            // Formata a URL que serï¿½ chamada na paginaï¿½ï¿½o
            $this->set('url', $this->gerarNamedUrl($this->data['Busca']));

            // Define os critï¿½rios da pï¿½ginaï¿½ï¿½o
            $this->paginate = array('limit' => 30, 'page' => 1, 'order' => array('Tramite.data_tramite' => 'asc'), 'recursive' => 2);

            // Resgata os critï¿½rios para busca
            $criterios = $this->Tramite->resgatarCriteriosBusca($this->data['Busca']);

            // Remove relacionamentos indesejados
            $this->Tramite->unbindModel(array('belongsTo' => array('TipoTramite')));

            $this->Tramite->Processo->unbindModel(
                array(
                'hasMany' => array(
                'Divisao',
                'Tramite'
                ),
                'belongsTo' => array(
                'Interessado',
                'Natureza',
                'Servidor',
                'Setor',
                'Situacao',
                ),
                )
            );

            $this->Tramite->ServidorOrigem->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            $this->Tramite->ServidorRecebimento->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            // Realiza a busca
            $this->set('tramites', $this->paginate('Tramite', $criterios));
        }
    }

    function impressao_etiqueta() {
        $this->set('action_form', 'impressao_etiqueta');
        $this->set('fieldSetTitle', 'Imprimir Etiqueta do Processo');

        // Verifica se a busca ja foi realizada
        if(empty($this->data)) {
        // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            // Lista as etiquetas disponï¿½veis
            $this->set('etiquetas', $this->Etiqueta->find('all', array('order' => 'descricao')));

            $this->render('impressao_etiqueta_busca');
        }
        else {

        // Busca o processo e verifica se foi encontrado
            $this->Processo->recursive = 1;
            $this->Processo->unbindModel( array('hasMany' => array('Tramite')) );
            $processos = $this->Processo->findByProcessosNumeroIntervalo($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo_inicio'], $this->data['Processo']['numero_processo_fim'], $this->data['Processo']['numero_ano']);

            // Dados da etiqueta
            
            $etiqueta = $this->Etiqueta->read(null, $this->data['Etiqueta']['id']);
            $this->set('etiqueta', $etiqueta);
            
            // Linha impressa
            $this->set("etiqueta_impressa", $this->data['Etiqueta']['linha']);;

            // Dados do processo
            $this->set("processos", $processos);

            $this->render('impressao_etiqueta_pdf_cmg','');
        }
    }

    function impressao_etiqueta_lote() {
        $this->set('action_form', 'impressao_etiqueta_lote');
        $this->set('fieldSetTitle', 'Imprimir Etiqueta do Processo');

        // Verifica se a busca ja foi realizada
        if(empty($this->data)) {
        // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());

            // Lista as etiquetas disponï¿½veis
            $this->set('etiquetas', $this->Etiqueta->find('all', array('order' => 'descricao')));

            $this->Tramite->recursive = 2;
            $this->Tramite->unbindModel(array('belongsTo' => array('SetorRecebimento')));
            $this->Tramite->Processo->unbindModel(array('belongsTo' => array('Servidor', 'Situacao'), 'hasMany' => array('Divisao', 'Tramite')));
            $this->Tramite->ServidorOrigem->unbindModel(array('belongsTo' => array('Setor', 'GrupoUsuario', 'Cargo'), 'hasMany' => array('PermissaoServidor')));
            $tramites_no_setor = $this->Tramite->tramitesNaoEncaminhadosDoSetor($this->Session->read('Setor.id'));

            $this->set('tramites_no_setor',$tramites_no_setor);

            $this->render('impressao_etiqueta_lote');
        }
        else {

        // Busca o processo e verifica se foi encontrado
            $this->Processo->recursive = 1;
            $this->Processo->unbindModel( array('hasMany' => array('Tramite')) );
            $processos = $this->Processo->findByProcessosNumeroIntervalo($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo_inicio'], $this->data['Processo']['numero_processo_fim'], $this->data['Processo']['numero_ano']);

            // Dados da etiqueta
            
            $etiqueta = $this->Etiqueta->read(null, $this->data['Etiqueta']['id']);
            $this->set('etiqueta', $etiqueta);
            
            // Linha impressa
            $this->set("etiqueta_impressa", $this->data['Etiqueta']['linha']);;

            // Dados do processo
            $this->set("processos", $processos);

            $this->render('impressao_etiqueta_pdf_cmg','');
        }
    }


    function impressao_etiqueta_ajax_retornar_linhas() {
        $etiqueta = $this->Etiqueta->read(array('id', 'linhas'), $this->data['Etiqueta']['id']);
        $this->set('etiqueta', $etiqueta);

        $this->render(null, 'ajax');
    }

    function impressao_etiqueta_pdf($id) {
        $this->Processo->recursive = 1;
        $this->set("processo", $this->Processo->read(null, $id));
        $this->set("linha_impressa", $this->params['url']['linha']);

        // Dados da etiqueta
        $etiqueta = $this->Etiqueta->read(null, $this->params['url']['etiqueta_id']);
        $this->set('etiqueta', $etiqueta);

        $this->render('impressao_etiqueta_pdf', '');


    }

    /**
     * Impressï¿½o do boletim de informaï¿½ï¿½o. Primeiro passo, busca pelos trï¿½mites.
     * O BI ï¿½ um documento contendo processos encaminhados de um setor para o outro e as assinaturas de envio e recebimento.
     * **/
    function boletim_de_informacao() {
        $this->set('fieldSetTitle', 'Imprimir Boletim de Informaï¿½ï¿½o');

        // Listas necessï¿½rias para popular campos de seleï¿½ï¿½o
        $this->set('orgaos', $this->Orgao->listar());
        // Setores do ï¿½rgï¿½o onde o usuï¿½rio estï¿½ logado
        $this->set('setoresDoUsuario', $this->Setor->findByOrgao($this->Session->read('Orgao.id')));

        // Verifica se a busca ja foi realizada
        if(isset($this->data) && ($this->data['Busca']['setor_origem_id'] != '') && ($this->data['Busca']['setor_recebimento_id'] != '')) {
        // Formata as datas
            $datas = array(
                'data_inicial' => $this->formatDateToIso($this->data['Busca']['data_tramite_inicial']),
                'data_final' => $this->formatDateToIso($this->data['Busca']['data_tramite_final']),
            );

            $this->data['Busca'] = array_merge($this->data['Busca'], $datas);

            // Formata a URL que serï¿½ chamada para impressï¿½o
            $this->set('url', join('/', $this->gerarNamedUrl($this->data['Busca'])));

            // Resgata os critï¿½rios para busca
            $criterios = $this->Tramite->resgatarCriteriosBusca($this->data['Busca']);

            // Remove relacionamentos indesejados
            $this->Tramite->unbindModel(array('belongsTo' => array('TipoTramite')));

            $this->Tramite->Processo->unbindModel(
                array(
                'hasMany' => array(
                'Divisao',
                'Tramite'
                ),
                'belongsTo' => array(
                'Interessado',
                'Natureza',
                'Servidor',
                'Setor',
                'Situacao',
                ),
                )
            );

            $this->Tramite->ServidorOrigem->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            $this->Tramite->ServidorRecebimento->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            // Faz a busca
            $tramites = $this->Tramite->find('all', array('conditions' => $criterios, 'order' => 'Processo.numero_orgao asc, Processo.numero_ano desc, Processo.numero_processo,data_tramite', 'recursive' => 2));
            $this->set('tramites', $tramites);
        }

    }
    /**
     *
     * Impressï¿½o do boletim de informaï¿½ï¿½o de processos distribuidos. Primeiro passo, buscar processos distribuidos para o servidor selecionado.
     * O BI de distribuicao ï¿½ um documento contendo processos encaminhados para um servidor e as assinaturas de envio e recebimento.
     * **/
    function boletim_de_informacao_de_distribuicao() {
        $this->set('fieldSetTitle', 'Imprimir Boletim de Informaï¿½ï¿½o de Distribuiï¿½ï¿½o');

        // Setores do ï¿½rgï¿½o onde o usuï¿½rio estï¿½ logado

        $this->set('servidores',$this->Servidor->find('all',array('conditions' => array(
            "Setor.orgao_id" => $this->Session->read('Orgao.id'),
            "setor_id" => $this->Session->read('Setor.id'),
            )
            ,'order'=>'nome')));

        $this->set('orgao',$this->Session->read('Orgao.sigla'));

        // Verifica se a busca ja foi realizada
        if(isset($this->data)) {

        // Formata as datas
            $datas = array(
                'data_inicial' => $this->formatDateToIso($this->data['Busca']['data_inicial']),
                'data_final' => $this->formatDateToIso($this->data['Busca']['data_final']),
            );

            $this->data['Busca'] = array_merge($this->data['Busca'], $datas);

            // Formata a URL que serï¿½ chamada para impressï¿½o
            $this->set('url', join('/', $this->gerarNamedUrl($this->data['Busca'])));


            // Resgata os critï¿½rios para busca
            $criterios = $this->HistoricoDivisao->resgatarCriteriosBusca($this->data['Busca']);

            // Faz a busca
            $divisoes = $this->HistoricoDivisao->find('all', array('conditions' => $criterios, 'order' => 'data_divisao'));
            $this->set('divisoes', $divisoes);

        //var_dump($this->data['Busca']);

        }

    }

    /**
     * Impressï¿½o do boletim de informaï¿½ï¿½o. Segundo passo, geraï¿½ï¿½o do pdf.
     * **/
    function boletim_de_informacao_pdf() {
        if(count($this->data['Busca']['Tramites']) > 0) {
            $this->set('data_inicial', $this->params['named']['data_inicial']);
            $this->set('data_final', $this->params['named']['data_final']);

            // Busca os dados detalhados do setor de origem e de destino
            $setorOrigem = $this->Setor->find('first', array('conditions' => "Setor.id = {$this->params['named']['setor_origem_id']}", 'fields' => array('Setor.id', 'Setor.descricao', 'Setor.sigla', 'Orgao.id', 'Orgao.descricao', 'Orgao.sigla')));
            $setorDestino = $this->Setor->find('first', array('conditions' => "Setor.id = {$this->params['named']['setor_recebimento_id']}", 'fields' => array('Setor.id', 'Setor.descricao', 'Setor.sigla', 'Orgao.id', 'Orgao.descricao', 'Orgao.sigla')));

            $this->set('setorOrigem', $setorOrigem);
            $this->set('setorDestino', $setorDestino);

            // Remove relacionamentos indesejados
            $this->Tramite->unbindModel(array('belongsTo' => array('TipoTramite')));

            $this->Tramite->Processo->unbindModel(
                array(
                'hasMany' => array(
                'Divisao',
                'Tramite'
                ),
                'belongsTo' => array(
                'Natureza',
                'Servidor',
                'Setor',
                'Situacao',
                ),
                )
            );

            $this->Tramite->ServidorOrigem->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            $this->Tramite->ServidorRecebimento->unbindModel(
                array(
                'hasMany' => array(
                'PermissaoServidor',
                ),
                'belongsTo' => array(
                'Setor',
                'GrupoUsuario',
                'Cargo',
                ),
                )
            );

            // Faz a busca
            $ids = join(',', $this->data['Busca']['Tramites']);
            $tramites = $this->Tramite->find('all', array('conditions' => "Tramite.id in ({$ids})", 'order' => 'data_tramite', 'recursive' => 2));
            $this->set('tramites', $tramites);

            $this->render('boletim_de_informacao_pdf', '');
        }
    }
    function boletim_de_distribuicao_pdf() {
        if(count($this->data['Busca']['HistoricoDivisoes']) > 0) {
        // Busca os dados detalhados do servidor
            $servidor = $this->Servidor->find('first', array('conditions' => "Servidor.id = {$this->params['named']['servidor_id']}"));

            $this->set('servidor',$servidor);
            $this->set('data_inicial', $this->params['named']['data_inicial']);
            $this->set('data_final', $this->params['named']['data_final']);

            // Faz a busca
            $ids = join(',', $this->data['Busca']['HistoricoDivisoes']);
            $divisoes = $this->HistoricoDivisao->find('all', array('conditions' => "HistoricoDivisao.id in ({$ids})", 'order' => 'data_divisao', 'recursive' => 2));
            $this->set('divisoes', $divisoes);

            $this->render('boletim_de_distribuicao_pdf', '');
        }
    }

    function distribuicao() {

        $this->set('fieldSetTitle', 'Imprimir Relatï¿½rio de Distribuiï¿½ï¿½o');

        // Setores do ï¿½rgï¿½o onde o usuï¿½rio estï¿½ logado

        $this->set('servidores',$this->Servidor->find('all',array('conditions' => array(
            "Setor.orgao_id" => $this->Session->read('Orgao.id'),
            "setor_id" => $this->Session->read('Setor.id'),
            )
            ,'order'=>'nome')));

        $this->set('orgao',$this->Session->read('Orgao.sigla'));

        // Verifica se a busca ja foi realizada
        if(isset($this->data)) {

        // Formata as datas
            $datas = array(
                'data_inicial' => $this->formatDateToIso($this->data['Busca']['data_inicial']),
                'data_final' => $this->formatDateToIso($this->data['Busca']['data_final']),
            );

            $this->data['Busca'] = array_merge($this->data['Busca'], $datas);

            // Formata a URL que serï¿½ chamada para impressï¿½o
            $this->set('url', join('/', $this->gerarNamedUrl($this->data['Busca'])));


            // Resgata os critï¿½rios para busca
            $criterios = $this->HistoricoDivisao->resgatarCriteriosBusca($this->data['Busca']);

            // Faz a busca
            $divisoes = $this->HistoricoDivisao->find('all', array('conditions' => $criterios, 'order' => 'data_divisao'));
            $this->set('divisoes', $divisoes);

        //var_dump($this->data['Busca']);

        }
    }

    function distribuicao_pdf() {
        if(count($this->data['Busca']['HistoricoDivisoes']) > 0) {
        // Busca os dados detalhados do servidor
            $servidor = $this->Servidor->find('first', array('conditions' => "Servidor.id = {$this->params['named']['servidor_id']}"));

            $this->set('servidor',$servidor);
            $this->set('data_inicial', $this->params['named']['data_inicial']);
            $this->set('data_final', $this->params['named']['data_final']);

            // Faz a busca
            $ids = join(',', $this->data['Busca']['HistoricoDivisoes']);
            $divisoes = $this->HistoricoDivisao->find('all', array('conditions' => "HistoricoDivisao.id in ({$ids})", 'order' => 'data_divisao', 'recursive' => 2));
            $this->set('divisoes', $divisoes);

            $this->render('distribuicao_pdf', '');
        }
    }

    function impressao_capa_pdf(int $id) {
        $processo = $this->Processo->read(null, $id);

        $this->set('processo',$processo);

        $this->Setor->recursive = 1;
        $setor = $this->Setor->read(null, $processo['Processo']['setor_id']);
        $this->set('setor',$setor);

        // Busca divisões do processo
        $this->Divisao->unbindModel( array('belongsTo' => array('Processo')) );
        $divisoes = $this->Divisao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}"));
        $this->set('divisoes', $divisoes);

        $servidor = $this->Session->read('Servidor.nome');
        $this->set('servidor', $servidor);
        

        $this->render('impressao_capa_pdf', '');

        
    }
}