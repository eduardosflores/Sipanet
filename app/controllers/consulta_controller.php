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

class ConsultaController extends AppController
{
    public $helpers = array('Html', 'Session', 'Protocolo');
    public $uses = array(
            'Arquivamento',
            'Divisao',
            'Orgao',
            'Paralisacao',
            'Processo',
            'ProcessoAnexo',
            'Setor', 
            'Tramite', 
        );
    
    public $layout = 'consulta';
    
    /**
     * Busca o processo pelo número passado.
     * **/
    private function buscarProcesso($orgao, $numero, $ano, $action)
    {
    	$processo = $this->Processo->findByNumero($orgao, $numero, $ano);
        
        // Se o processo não foi encontrado, retorna erro.
        if($processo)
        {
        	return $processo;
        }
        else
        {
            $this->setMessage("erro", "Processo não encontrado");
            $this->redirect("/consulta/{$action}/", null, true);
        }
    }
    

    /**
    * Consultar processo. 
    * http://sistema/consulta/index/
    * **/
    public function index()
    {
        $this->set('fieldSetTitle', 'Consultar Processo');
        $this->set('action_form', '/consulta/index');
        
        
        
        // Verifica se a busca ja foi realizada ou se o $id foi informado
        if(empty($this->data))
        {
            // Lista de orgaos para a pesquisa
            $this->set('orgaos', $this->Orgao->listar());
            
            $this->render('busca');
        }
        else
        {
            $action_retorno = 'index';
            
            // Busca os dados do processo
            $this->Processo->unbindModel(array('hasMany' => array('Tramite')));
            $this->Processo->recursive = 1;
            
            $processo = $this->buscarProcesso($this->data['Processo']['numero_orgao'], $this->data['Processo']['numero_processo'], $this->data['Processo']['numero_ano'], $action_retorno);
            
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
            
            // Busca as paralisações do processo
            $paralisacoes = $this->Paralisacao->find('all', array('conditions' => "processo_id = {$processo['Processo']['id']}", 'order' => "data"));
            
            // Busca os arquivamentos do processo
            $arquivamentos = $this->Arquivamento->findByProcesso($processo['Processo']['id']);
            
            $this->set('processo', $processo);
            $this->set('setor', $setor);
            $this->set('tramites', $tramites);
            $this->set('divisoes', $divisoes);
            $this->set('paralisacoes', $paralisacoes);
            $this->set('arquivamentos', $arquivamentos);
            $this->set('processoComoAnexo', $processoAnexo);
            $this->set('processosAnexados', $processosAnexados);
        }
    }
}
?>