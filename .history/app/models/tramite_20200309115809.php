<?php

/**
 *  SipaNet 2.0 - Sistema de Informa��o Processual e Arquivo
  Copyright (C) 2008 Universidade Estadual de Ci�ncias da Sa�de de Alagoas - UNCISAL <http://www.uncisal.edu.br>

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
 */
class Tramite extends AppModel {

    var $name = 'Tramite';
    var $validate = array(
        'processo_id' => array(
            'rule' => array('numeric'),
            'required' => true,
            'message' => "Processo � obrigat�rio.",
        ),
        'servidor_origem_id' => array(
            'rule' => array('numeric'),
            'required' => true,
            'message' => "Servidor de Origem � obrigat�rio.",
        ),
        'flag_recebimento' => array('boolean'),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
        'Processo' => array('className' => 'Processo',
            'foreignKey' => 'processo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'SetorOrigem' => array('className' => 'Setor',
            'foreignKey' => 'setor_origem_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ServidorOrigem' => array('className' => 'Servidor',
            'foreignKey' => 'servidor_origem_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'SetorRecebimento' => array('className' => 'Setor',
            'foreignKey' => 'setor_recebimento_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ServidorRecebimento' => array('className' => 'Servidor',
            'foreignKey' => 'servidor_recebimento_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function tramitesNaoRecebidosDoSetor($setor_id) {
        if ($setor_id != null) {
            return $this->find('all', array("conditions" => "Tramite.setor_recebimento_id = {$setor_id} and flag_recebimento = false", "order" => "data_tramite desc", "limit" => "50"));
        } else {
            return false;
        }
    }

    public function countTramitesNaoRecebidosDoSetor($setor_id) {
        if ($setor_id != null) {
            return $this->find('count', array("conditions" => "Tramite.setor_recebimento_id = {$setor_id} and flag_recebimento = false", "order" => "data_tramite desc", "limit" => "50"));
        } else {
            return false;
        }
    }

    public function tramitesNaoEncaminhadosDoSetor($setor_id) {
        if ($setor_id != null) {
            $result = $this->query("select
                            Processo.numero_processo || '/' || Processo.numero_ano as Processo,
                            Interessado.nome as Interessado,
                            (select sigla from setores where id = Tramite.setor_origem_id) as Sigla,
                            Servidor.nome,
                            COALESCE(Tramite.data_recebimento,Processo.data_cadastro) as data_recebimento,
                            TipoProcesso.descricao as tipo_processo,
                            DiaNaMesa.max_dias_na_mesa,
                            Processo.id as id_processo
                            from tramites as Tramite
                            right join processos as Processo
                             on (Processo.id = Tramite.processo_id and Processo.situacao_id = 1)
                            join interessados as Interessado on
                            Processo.interessado_id = Interessado.id
                            left join tipos_processo as TipoProcesso
                             on Processo.tipo_processo_id = TipoProcesso.id
                            left join setores as Setor
                             on Tramite.setor_recebimento_id = Setor.id
                            left join dias_na_mesa as DiaNaMesa
                             on (DiaNaMesa.tipo_processo_id = TipoProcesso.id
                            and DiaNaMesa.setor_id = Tramite.setor_recebimento_id)
                            left join servidores as Servidor on
                            Tramite.servidor_recebimento_id = Servidor.id
                            where
                            (Tramite.setor_recebimento_id = ". $setor_id . "
                            and
                            Tramite.flag_recebimento = true
                            and
                            Tramite.flag_encaminhado = false) or
                            (
                                (select count(1) from tramites where tramites.processo_id = Processo.id ) = 0 and
							    Processo.setor_id = ". $setor_id . "
                            )
                            order by Processo.numero_ano desc,Processo.numero_processo desc
                            ");

            // pr($result);
            //die();

            return $result;
        } else {
            return false;
        }
    }

    public function countTramitesNaoEncaminhadosDoSetor($setor_id) {
        if ($setor_id != null) {
            return $this->find('count', array("conditions" => "Tramite.setor_recebimento_id = {$setor_id} and flag_recebimento = true and flag_encaminhado = false", "order" => "data_tramite desc", "limit" => "50"));
        } else {
            return false;
        }
    }

    public function ultimoTramiteDoProcesso($processo_id, $recursive = -1) {
        $this->recursive = $recursive;
        return $this->find('first', array("conditions" => "Tramite.processo_id = {$processo_id}", "order" => "Tramite.data_tramite desc, Tramite.id desc"));
    }

    public function resgatarCriteriosBusca($condicoes) {
        if (count($condicoes) > 0) {
            $sql = array();

            if (array_key_exists('setor_id', $condicoes) && ($condicoes['setor_id'] != "")) {
                if ($condicoes['setor_id'] == '*') {
                    $sql[] = "Tramite.setor_{$condicoes['filtro']}_id is not null";
                    $sql[] = "Tramite.setor_{$condicoes['filtro']}_id in (select id from setores where orgao_id = {$condicoes['orgao_id']})";
                } else {
                    $sql[] = "Tramite.setor_{$condicoes['filtro']}_id = {$condicoes['setor_id']}";
                }
            }

            if (array_key_exists('setor_origem_id', $condicoes) && ($condicoes['setor_origem_id'] != "")) {
                if (($condicoes['setor_origem_id'] == '*') && ((array_key_exists('orgao_origem_id', $condicoes)))) {
                    $sql[] = "Tramite.setor_origem_id in (select id from setores where orgao_id = {$condicoes['orgao_origem_id']})";
                } else {
                    $sql[] = "Tramite.setor_origem_id = {$condicoes['setor_origem_id']}";
                }
            } elseif (array_key_exists('orgao_origem_id', $condicoes) && ($condicoes['orgao_origem_id'] != "")) {
                $sql[] = "Tramite.setor_origem_id in (select id from setores where orgao_id = {$condicoes['orgao_origem_id']})";
            }

            if (array_key_exists('setor_recebimento_id', $condicoes) && ($condicoes['setor_recebimento_id'] != "")) {
                if (($condicoes['setor_recebimento_id'] == '*') && ((array_key_exists('orgao_recebimento_id', $condicoes)))) {
                    $sql[] = "Tramite.setor_recebimento_id in (select id from setores where orgao_id = {$condicoes['orgao_recebimento_id']})";
                } else {
                    $sql[] = "Tramite.setor_recebimento_id = {$condicoes['setor_recebimento_id']}";
                }
            } elseif (array_key_exists('orgao_recebimento_id', $condicoes) && ($condicoes['orgao_recebimento_id'] != "")) {
                $sql[] = "Tramite.setor_recebimento_id in (select id from setores where orgao_id = {$condicoes['orgao_recebimento_id']})";
            }

            if (array_key_exists('flag_recebimento', $condicoes) && ($condicoes['flag_recebimento'] != "")) {
                $sql[] = "Tramite.flag_recebimento = {$condicoes['flag_recebimento']}";
            }

            if (array_key_exists('data_inicial', $condicoes) && ($condicoes['data_inicial'] != "") && array_key_exists('data_final', $condicoes) && ($condicoes['data_final'] != "")) {
                $sql[] = "CAST(Tramite.data_tramite AS DATE) BETWEEN '{$condicoes['data_inicial']}' AND '{$condicoes['data_final']}'";
            }

            if (count($sql) > 0) {
                return implode(' and ', $sql);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function buscar($condicoes) {
        $criterios = $this->resgatarCriteriosBusca($condicoes);
        if ($criterios != false) {

            $this->Processo->unbindModel(
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

            $this->ServidorOrigem->unbindModel(
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

            $this->ServidorRecebimento->unbindModel(
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

            return $this->find('all', array('conditions' => $criterios, 'order' => 'Tramite.data_tramite asc', 'recursive' => 2));
        } else {
            return false;
        }
    }

    /**
     * Lista todos os tr�mites do processo
     * * */
    public function findByProcesso($processo_id) {
        // Remove associa��es desnecess�rias
        $this->unbindModel(array('belongsTo' => array('Processo')));
        $this->ServidorOrigem->unbindModel(array('belongsTo' => array('Setor', 'GrupoUsuario', 'Cargo'), 'hasMany' => array('PermissaoServidor')));
        $this->ServidorRecebimento->unbindModel(array('belongsTo' => array('Setor', 'GrupoUsuario', 'Cargo'), 'hasMany' => array('PermissaoServidor')));

        return $this->find('all', array('conditions' => "processo_id = {$processo_id}", 'order' => "data_tramite asc", 'recursive' => 2));
    }

}

?>