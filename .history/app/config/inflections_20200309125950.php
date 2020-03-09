<?php

/* SVN FILE: $Id: inflections.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Custom Inflected Words.
 *
 * This file is used to hold words that are not matched in the normail Inflector::pluralize() and
 * Inflector::singularize()
 *
 * PHP versions 4 and %
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 * 								1785 E. Sahara Avenue, Suite 490-204
 * 								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app.config
 * @since			CakePHP(tm) v 1.0.0.2312
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 22:33:52 -0800 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a key => value array of regex used to match words.
 * If key matches then the value is returned.
 *
 *  $pluralRules = array('/(s)tatus$/i' => '\1\2tatuses', '/^(ox)$/i' => '\1\2en', '/([m|l])ouse$/i' => '\1ice');
 */
$pluralRules = array();
/**
 * This is a key only array of plural words that should not be inflected.
 * Notice the last comma
 *
 * $uninflectedPlural = array('.*[nrlm]ese', '.*deer', '.*fish', '.*measles', '.*ois', '.*pox');
 */
$uninflectedPlural = array();
/**
 * This is a key => value array of plural irregular words.
 * If key matches then the value is returned.
 *
 *  $irregularPlural = array('atlas' => 'atlases', 'beef' => 'beefs', 'brother' => 'brothers')
 */
$irregularPlural = array(
    'assunto_mensagem' => 'assuntos_mensagem',
    'divisao' => 'divisoes',
    'email_suporte' => 'emails_suporte',
    'grupo_usuario' => 'grupos_usuario',
    'mensagem_suporte' => 'mensagens_suporte',
    'orgao' => 'orgaos',
    'paralisacao' => 'paralisacoes',
    'permissao_grupo' => 'permissoes_grupo',
    'permissao_servidor' => 'permissoes_servidor',
    'processo_anexo' => 'processos_anexos',
    'servidor' => 'servidores',
    'setor' => 'setores',
    'setor_servidor' => 'setores_servidores',
    'situacao' => 'situacoes',
    'tipo_interessado' => 'tipos_interessado',
    'tipo_mensagem' => 'tipos_mensagem',
    'historico_divisao' => 'historico_divisoes',
    'historico_devolucao' => 'historico_devolucoes',
    'tipo_processo' => 'tipos_processo',
    'dia_na_mesa' => 'dias_na_mesa',
    'arquivo_temporario' => 'arquivos_temporarios',
);
/**
 * This is a key => value array of regex used to match words.
 * If key matches then the value is returned.
 *
 *  $singularRules = array('/(s)tatuses$/i' => '\1\2tatus', '/(matr)ices$/i' =>'\1ix','/(vert|ind)ices$/i')
 */
$singularRules = array();
/**
 * This is a key only array of singular words that should not be inflected.
 * You should not have to change this value below if you do change it use same format
 * as the $uninflectedPlural above.
 */
$uninflectedSingular = $uninflectedPlural;
/**
 * This is a key => value array of singular irregular words.
 * Most of the time this will be a reverse of the above $irregularPlural array
 * You should not have to change this value below if you do change it use same format
 *
 * $irregularSingular = array('atlases' => 'atlas', 'beefs' => 'beef', 'brothers' => 'brother')
 */
$irregularSingular = array_flip($irregularPlural);
?>