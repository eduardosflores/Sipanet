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


 class AppModel extends Model
 {
    //public $recursive = -1;
    
 	/**
 	 * Sobrescreve o método save para transformar todas as strings em maiúsculo
 	 * */
 	function save($data = null, $validate = true, $fieldList = array())
 	{
		if($data)
		{
			if(countdim($data) == 1)
			{
				$data = array($this->name => $data);
			}
		}

		$data[$this->name] = arrayToUpper($data[$this->name]);

		return parent::save($data, $validate, $fieldList);
	}
    
    /**
    * Callback beforeSave
    * @return boolean true
    **/
    function beforeSave() {
        // Simulação do actsAs
        if(isset($this->actsAs) && !empty($this->actsAs)) {
            foreach($this->actsAs as $behavior => $values) {
                if($behavior == 'Null') {
                    foreach($values as $field) {
                        if(true === array_key_exists($field, $this->data[$this->name] ) && true === empty( $this->data[$this->name][$field] ) && 0 === strlen( $this->data[$this->name][$field] ) ) {
                            unset($this->data[$this->name][$field]);
                        }
                    }
                }
            }
        }
        
        return true;
    }

    function begin() {
        $db =ConnectionManager::getDataSource($this->useDbConfig);
        $db->begin($this);
    }
    function commit() {
        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        $db->commit($this);
    }
    function rollback() {
        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        $db->rollback($this);
    }


 }
?>
