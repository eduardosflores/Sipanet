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

class GrupoUsuario extends AppModel {

    var $name = 'GrupoUsuario';
    var $validate = array(
        'descricao' => array(
            'rule' => array('minLength', 1),
            'required' => true,
            'message' => "Descrição é obrigatória.",
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $hasMany = array(
            'PermissaoGrupo' => array('className' => 'PermissaoGrupo',
                                'foreignKey' => 'grupo_usuario_id',
                                'dependent' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => '',
                                'limit' => '',
                                'offset' => '',
                                'exclusive' => '',
                                'finderQuery' => '',
                                'counterQuery' => ''
        ),
            'Servidor' => array('className' => 'Servidor',
                                'foreignKey' => 'grupo_usuario_id',
                                'dependent' => false,
                                'conditions' => '',
                                'fields' => '',
                                'order' => '',
                                'limit' => '',
                                'offset' => '',
                                'exclusive' => '',
                                'finderQuery' => '',
                                'counterQuery' => ''
        )
    );

    public function listar()
    {
        return $this->find('all', array('order' => 'descricao asc', 'recursive' => -1));
    }

}
?>