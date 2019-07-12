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

class AjudaController extends AppController
{
	public $name = "Ajuda";
	public $uses = array('AssuntoMensagem', 'EmailSuporte', 'MensagemSuporte', 'Orgao', 'TipoMensagem');
    public $components = array('Email');
    

    public function index()
    {
    	$this->set('fieldSetTitle', 'Ajuda');
    }

	public function suporte()
	{
        $this->set('fieldSetTitle', 'Suporte Técnico');
        
        // Lista de orgaos para a pesquisa
        $this->set('orgaos', $this->Orgao->listarInternos());
        
        // Lista todos os assuntos
        $this->set('assuntos', $this->AssuntoMensagem->find('all'));
        
        // Lista todos os tipos de mensagem
        $this->set('tipos', $this->TipoMensagem->find('all'));
        
        if(isset($this->data))
        {
            
            $mensagem = $this->data;
            $mensagem['MensagemSuporte']['data_cadastro'] = 'now()';
            
            // Tenta salvar
            if( $this->MensagemSuporte->save($mensagem) )
            {
                
                // Lista os e-mails para os quais a mensagem deve ser enviada
                $emails = $this->EmailSuporte->find('all', array('fields' => 'email'));
                
                // Busca o assunto
                $assunto = $this->AssuntoMensagem->read(null, $mensagem['MensagemSuporte']['assunto_mensagem_id']);
                $this->set('assunto', $assunto);
                
                // Busca o tipo
                $tipo = $this->TipoMensagem->read(null, $mensagem['MensagemSuporte']['tipo_mensagem_id']);
                $this->set('tipo', $tipo);
                
                // Busca o órgão
                $orgao = $this->Orgao->read(null, $mensagem['MensagemSuporte']['orgao_id']);
                $this->set('orgao', $orgao);
                
                // Envia os dados da mensagem para a view
                $this->set('mensagem', $mensagem);
                
                // Envia os e-mails para o suporte
                $this->Email->subject = "Suporte SipaNet";
                $this->Email->from = $mensagem['MensagemSuporte']['email'];
                $this->Email->replyTo = $mensagem['MensagemSuporte']['email']; 
                $this->Email->template = 'suporte_tecnico';
                $this->Email->sendAs = 'html';
                
                foreach($emails as $email)
                {
                    $this->Email->to = $email['EmailSuporte']['email'];
                    $this->Email->send();
                }

                // Se for salvo com sucesso, cria um log no banco
                // logger($entidade, $entidade_id, $acao, $objeto_original, $objeto_alterado)
                $this->logger('mensagens_suporte', null, 'C', null, $mensagem);

                // Exibe mensagem de sucesso
                $this->setMessage("sucesso", "Mensagem enviada com sucesso.");
                // Redirecionar para listagem ou para exibição do item salvo
                $this->redirect('/');
            }
            else
            {
                // Se ocorrer erro ao savar, exibe mensagem de erro
                // passando os arrays com os erros de validação
                $this->setMessage("erro", "", $this->MensagemSuporte->validationErrors);
            }
        }
	}
}
?>
