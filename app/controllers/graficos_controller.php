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

class GraficosController extends AppController
{
    var $name = "Graficos";
    public $uses = array (
        'Orgao',
        'Processo',
        'Setor',
        'Situacao',
        'Tramite',
    );
    var $helpers = array (
        'protocolo',
        'ajax'
    );
    
    function beforeFilter() 
    {
        //$modulo = 20;
        $modulo = null;
        
        parent::beforeFilter();
        $this->verificarLogin($modulo);
    }

    /**
     * Exibição do gráfico por confirmação
     * **/
    function processos_por_confirmacao() 
    {
        //Consulta geral dos processos
        $this->set('fieldSetTitle', 'Gráfico - Processos por Confirmação');
        
        // Listas necessárias para popular campos de seleção
        $this->set('orgaos', $this->Orgao->listar());
        
        if(isset($this->data))
        {
            $erros = array();
            
            // Verifica e formata a data incial
            if($this->data['Busca']['data_tramite_inicial'] == "")
            {
            	$erros[] = "Data inicial é obrigatória";
            }
            else
            {
            	$data_inicial = $this->formatDateToIso($this->data['Busca']['data_tramite_inicial']);
            }
            
            // Verifica e formata a data final
            if($this->data['Busca']['data_tramite_final'] == "")
            {
                $erros[] = "Data final é obrigatória";
            }
            else
            {
                $data_final = $this->formatDateToIso($this->data['Busca']['data_tramite_final']);
            }
            
            if(count($erros) > 0)
            {
            	$this->setMessage('erro', "", $erros);
            }
            else
            {
            	$this->set("query_string", "setor_id=" . $this->data['Busca']['setor_id'] . "&data_inicial=" . $data_inicial . "&data_final=" . $data_final);
            }
        }
    }
    
    /**
     * Geração da imagem do gráfico por confirmação
     * **/
    function gerar_processos_por_confirmacao()
    {
        // Busca os processos
        $confirmados = $this->Tramite->find('count', array('conditions' => "setor_recebimento_id = {$this->params['url']['setor_id']} AND CAST(data_recebimento AS DATE) BETWEEN '{$this->params['url']['data_inicial']}' AND '{$this->params['url']['data_final']}' AND flag_recebimento = TRUE"));
        $naoconfirmados = $this->Tramite->find('count', array('conditions' => "setor_recebimento_id = {$this->params['url']['setor_id']} AND CAST(data_recebimento AS DATE) BETWEEN '{$this->params['url']['data_inicial']}' AND '{$this->params['url']['data_final']}' AND flag_recebimento = FALSE"));
        $this->set("confirmados", $confirmados);
        $this->set("naoconfirmados", $naoconfirmados);
        
        $this->render(null, 'grafico');
    }
    
    /**
     * Exibição do gráfico por situação
     * **/
    function processos_por_situacao() 
    {
        //Consulta geral dos processos
        $this->set('fieldSetTitle', 'Gráfico - Processos por Situação');
        
        // Listas necessárias para popular campos de seleção
        $this->set('orgaos', $this->Orgao->listar());
        
        if(isset($this->data))
        {
            $erros = array();
            
            // Verifica e formata a data incial
            if($this->data['Busca']['data_cadastro_inicial'] == "")
            {
                $erros[] = "Data inicial é obrigatória";
            }
            else
            {
                $data_inicial = $this->formatDateToIso($this->data['Busca']['data_cadastro_inicial']);
            }
            
            // Verifica e formata a data final
            if($this->data['Busca']['data_cadastro_final'] == "")
            {
                $erros[] = "Data final é obrigatória";
            }
            else
            {
                $data_final = $this->formatDateToIso($this->data['Busca']['data_cadastro_final']);
            }
            
            if(count($erros) > 0)
            {
                $this->setMessage('erro', "", $erros);
            }
            else
            {
                $this->set("query_string", "orgao_id=" . $this->data['Busca']['orgao_id'] . "&data_inicial=" . $data_inicial . "&data_final=" . $data_final);
            }
        }
    }
    
    
    /**
     * Geração da imagem do gráfico por situação
     * **/
    function gerar_processos_por_situacao()
    {
        // Busca as situações
        $situacoes = $this->Situacao->listar();
        
        $quantidades = array();
        foreach($situacoes as $situacao)
        {
            // Remove associações de processo
            $this->Processo->unbindModel(array('belongsTo' => array('Interessado', 'Natureza')));
        	$processo = $this->Processo->find('count', array('conditions' => "Setor.orgao_id = {$this->params['url']['orgao_id']} AND situacao_id = {$situacao['Situacao']['id']} AND CAST(Processo.data_cadastro AS DATE) BETWEEN '{$this->params['url']['data_inicial']}' AND '{$this->params['url']['data_final']}'"));
            
            $quantidades[$situacao['Situacao']['id']] = $processo;
        }
        
        $this->set("situacoes", $situacoes);
        $this->set("quantidades", $quantidades);
        
        $this->render(null, 'grafico');
    }
}