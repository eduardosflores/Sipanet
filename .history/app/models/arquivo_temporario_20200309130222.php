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

class ArquivoTemporario extends Model {

   var $name = 'ArquivoTemporario';
   
   var $belongsTo = array(
      'Processo' => array('className' => 'Processo',
          'foreignKey' => 'id_processos',
          'conditions' => '',
          'fields' => '',
          'order' => ''
      ));

    /**
     * Lista todos os trï¿½mites do processo
     * * */
   public function findByProcesso($id_processos) {
      // Remove associações desnecessárias
      return $this->find('all', array('conditions' => "id_processos = {$id_processos}", 'order' => "nome_arquivo asc"));
   }

   public function findByID($id) {
      // Remove associações desnecessárias
      return $this->find('first', array('conditions' => "Arquivo.id = {$id}"));
   }
}
?>