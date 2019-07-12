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

class AppController extends Controller {

	/**
	* Setacao de variavel para acesso ao model Log
	**/
	var $uses = array('Log');
	var $components = array('RequestHandler');

       
        /**
	* Verifica se o usu�rio est� autenticado
	* @param integer $modulo_id - Verifica tamb�m se o usu�rio possui permiss�o de acesso ao m�dulo especificado
	**/
	function verificarLogin($modulo_id = null) {
		// Usu�rio logado?
		if (!$this->Session->check('Servidor.id'))
        {
			$this->setMessage('erro', '�rea fechada.');
			$this->redirect('/acesso/login');
			die();
		}
        elseif($modulo_id !== null)
        {
        	$modulos = $this->Session->read('Modulos');
            
            if(!in_array($modulo_id, $modulos))
            {
                $this->setMessage('erro', 'Voc� n�o possui permiss�o de acesso a esta �rea.');
                $this->redirect('/acesso/boas_vindas');
                die();
            }
        }
	}
    
    function usuarioEstaLogado()
    {
    	return $this->Session->check('Servidor.id');
    }

	/**
	* Define a mensagem de alerta/erro/sucesso. A mensagem retornada est� no seguinte formato:
	* <code>
		<div class="tipo_da_mensagem">
			<p>Mensagem</p>
			// Caso o array $validationErrors tenha sido passado, cria a seguinte lista:
			<ul>
				<li>Campo 1</li>
				<li>Campo 2</li>
				<li>Campo 3</li>
			</ul>
		</div>
	* </code>
	* @param string $style - Estilo do erro (alerta/erro/sucesso)
	* @param string $message - Mensagem de erro - Caso n�o seja passada, receber� mensagem padr�o
	* @param array $validationError - Campos que n�o passaram na valida��o
	**/
	function setMessage($style, $message = "", $validationError = null) {
		// Se mensagem vazia define mensagem padr�o de erro
		$message = ($message != "") ? $message : "Ocorreram erros nos seguintes campos:";

		// Cria o in�cio do div que recebe a mensagem e define a mensagem
		$returnMessage = '<div class="'.$style.'"><p>'.$message.'</p>';

		// Caso tenha sido passado o array com os erros de valida��o, cria uma lista ordenada com os erros
		if(is_array($validationError) && (count($validationError) > 0)) {
			$returnMessage .= '<ul>';
			foreach($validationError as $error) {
				// Adiciona a mensagem de erro � lista.
				$returnMessage .= '<li>'.$error.'</li>';
			}
			$returnMessage .= '</ul>';
		}

		// Fecha o div
		$returnMessage .= '</div>';
        
        $this->Session->del('Message.flash');
		$this->Session->setFlash($returnMessage, null);
	}

	/**
	* Sobreescreve o beforeFilter de AppController, para permitir que o beforeFilter seja executado nas a��es desejadas (da mesma forma que o before_filter :only e :except do Ruby on Rails)
	<code>
		// Executa o m�todo $this->requireLogin(arg1, arg2), EXCETO quando a a��o for index
		var $beforeFilter = array('requireLogin'=>array('except'=>array('index'),
							'args'=>array('arg1','arg2')));

		// Executa o m�todo $this->requireLogin(arg1, arg2), APENAS quando a a��o for index
		var $beforeFilter = array('requireLogin'=>array('ony'=>array('index'),
							'args'=>array('arg1','arg2')));
	</code>
	* @return boolean
	* @author http://bakery.cakephp.org/articles/view/extended-beforefilter-snippet
	**/
	function beforeFilter(){
		if(empty($this->beforeFilter)) return true;
		$failures = false;
		foreach($this->beforeFilter as $func_name=>$func){
			$call_func = true;
			if(!empty($func['only'])){
				if(!in_array($this->action,$func['only']))
					$call_func = false;
			}
			if(!empty($func['except'])){
				if(in_array($this->action,$func['except']))
					$call_func = false;
			}
			if($call_func){
				$args = (isset($func['args'])) ? implode(',',$func['args']) : null;
				if(!$this->{$func_name}($args)){
					$failures = true;
					break;
				}
			}
		}
		return !$failures;
	}

	/**
	* Gera um log da a��o
	* @param string $entidade - Entidade sofrendo a a��o
	* @param integer $objeto_id - C�digo da entidade
	* @param string $acao
	* @param mixed $objeto_original
	* @param mixed $objeto_modificado
	**/
	function logger($entidade, $objeto_id, $acao, $objeto_original, $objeto_modificado) {

		$this->Log->create();

		$data['Log'] = array(
			'servidor_id' => $this->Session->read('Servidor.id'),
			'entidade' => $entidade,
			'objeto_id' => $objeto_id,
			'acao' => $acao,
			'objeto_original' => ($objeto_original) ? serialize($objeto_original) : null,
			'objeto_modificado' => serialize($objeto_modificado),
			'ip' => $this->RequestHandler->getClientIP(),
		);

		$this->Log->save($data);
	}

	/**
	* Verifica se o id informado � v�lido (deve iniciar com um n�mero de 1-9 e ter uma sequ�ncia indefinida de n�meros de 0-9)
	* @param integer $id
	* @return boolean
	**/
	function checkValidId($id) {
		if( !$id || !preg_match( "/^[1-9][0-9]*$/" , $id) ) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	* Formata uma data passada no formato yyyy-mm-dd para dd/mm/yyyy
	* @param string $date
	* @return string
	**/
	function formatDateToBr($date) {
		$new_date = explode('-', $date);
		if(count($new_date) == 3) {
			return $new_date[2].'/'.$new_date[1].'/'.$new_date[0];
		} else {
			return $date;
		}
	}
	
	/**
	* Formata uma data passada no formato dd/mm/yyyy para yyyy-mm-dd 
	* @param string $date
	* @param boolean $validade - Verifica se deve validar a data
	* @return string
	**/
	function formatDateToIso($date, $validate = false) {
		$new_date = explode('/', $date);
		if(count($new_date) == 3) {
			$new_date = $new_date[2].'-'.$new_date[1].'-'.$new_date[0];
			
			if($validate && ! $this->checkValidDate($new_date) ) {
				return "";
			}
			
			return $new_date;
		} else {
			return "";
		}
	}

    /**
    * Verifica se a data passada � v�lida
    * @param string $date
    * @return boolean
    **/
    function checkValidDate($date) {
        $date_check = explode("-", $date);
        if((count($date_check) == 3) && is_numeric($date_check[0]) && is_numeric($date_check[1]) && is_numeric($date_check[2]) && preg_match(VALID_DATE, $date) ) {
            return checkdate($date_check[1], $date_check[2], $date_check[0]);
        } else {
            return false;
        }
    }
    
    
    /**
    * Retorna um array com dados para gerar named URLs (utilizado principalmente em pagina��es com busca)
    * @param array $valores
    * @return array
    **/
    protected function gerarNamedUrl($valores)
    {
    	$url = array();
        foreach($valores as $chave => $valor)
        {
            $url[] = $chave .':'. $valor;
        }
        
        return $url;
    }
}
?>