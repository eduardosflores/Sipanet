<?php
/* SVN FILE: $Id: bootstrap.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app.config
 * @since			CakePHP(tm) v 0.10.8.2117
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 22:33:52 -0800 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
//EOF

/**
 * Data em um formato válido
 */
    define('VALID_DATE', '/^(1|2)\d{3}\\-(0[1-9]|1[012])\\-(0[1-9]|[12][0-9]|3[01])$/');

/**
* Mês em formato válido (01 a 12 ou 1 a 12)
*/
    define('VALID_MONTH', '/^(0?[1-9]|1[012])$/');

/**
 * Hora em um formato válido
 */
    define('VALID_TIME', '/^((0|1)[0-9]|2[0-3]):[0-5][0-9]$/');


function stringToUpper($string) {
	$string = strtoupper($string);

	$busca = array('ã', 'á', 'â', 'é', 'ê', 'í', 'ó', 'ô', 'õ', 'ú', 'ç');
	$troca = array('Ã', 'Á', 'Â', 'É', 'Ê', 'Í', 'Ó', 'Ô', 'Õ', 'Ú', 'Ç');

	return str_replace($busca, $troca, $string);
}

function ucw($string)
{
    return ucwords(strtolower($string));
}

function arrayToUpper($array) {
	foreach($array as &$item) {
		if(!is_array($item)) {
			$item = stringToUpper($item);
		}
	}

	return $array;
}


function validaCpf( $cpf )
{
    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '99999999999')
    {
        return false;
    }
    else
    {
        for ($t = 9; $t < 11; $t++)
        {
            for ($d = 0, $c = 0; $c < $t; $c++)
            {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d)
            {
                return false;
            }
        }

        return true;
    }
}

function formatarDataTimestamp($date, $time = null) {
    $date = explode('-', $date);
    if($time) {
        $time = explode(':', $time);
    } else {
        $time = array(0, 0);
    }
    
    return mktime($time[0], $time[1], 0, $date[1], $date[2], $date[0]);
}

/**
* Retorna a quantidade de dias existentes entre as datas
**/
function diasEntreDatas($data_inicial, $data_final) {
    if($data_inicial > $data_final) {
        return false;
    }
    
    $data_inicial = formatarDataTimestamp($data_inicial);
    $data_final = formatarDataTimestamp($data_final);
    
    return floor(($data_final - $data_inicial) / 86400);
}

/**
 * Counts the dimensions of an array
 *
 * @param array $array
 * @return int The number of dimensions in $array
 */
function countdim($array) {
	if (is_array(reset($array))) {
		$return = countdim(reset($array)) + 1;
	} else {
		$return = 1;
	}
	return $return;
}

$modelPaths = array();
$controllerPaths = array();

function enableSubFoldersOn($baseDir, &$var) {         
  $cwd =getcwd();
  chdir($baseDir);
  $dirs = glob("*", GLOB_ONLYDIR);
  if(sizeof($dirs) > 0) { 
    foreach($dirs as $dir) { 
      $var[] = $baseDir.DS.$dir.DS;
    }
  }
  chdir($cwd);
}

enableSubFoldersOn(ROOT.DS.APP_DIR.'/controllers', $controllerPaths);
enableSubFoldersOn(ROOT.DS.APP_DIR.'/models', $modelPaths); 

?>