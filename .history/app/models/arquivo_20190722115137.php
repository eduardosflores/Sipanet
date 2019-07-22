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

class Arquivo extends Model {

   var $name = 'Arquivo';
   
   var $belongsTo = array(
      'Processo' => array('className' => 'Processo',
          'foreignKey' => 'id_processos',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ),
      'Tramite' => array('className' => 'Tramite',
          'foreignKey' => 'id_tramitacao',
          'conditions' => '',
          'fields' => '',
          'order' => ''
   ));

    /**
     * Lista todos os tr�mites do processo
     * * */
   public function findByTramitacao($id_tramitacao) {
      // Remove associa��es desnecess�rias
      return $this->find('all', array('conditions' => "id_tramitacao = {$id_tramitacao}", 'order' => "nome_arquivo asc"));
   }   

   public function findByProcesso($id_processos) {
      // Remove associa��es desnecess�rias
      return $this->find('all', array('conditions' => "id_processos = {$id_processos}", 'order' => "nome_arquivo asc"));
   }

   public function findByID($id) {
      // Remove associa��es desnecess�rias
      return $this->find('first', array('conditions' => "id = {$id}"));
   }
}
?>