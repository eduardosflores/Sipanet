<?php

    class FTPHelper{
        function enviarArquivo(){

            $servidor = Configure::read("servidor_ftp");
            $usuario = Configure::read("usuario_ftp");
            $senha = Configure::read("senha_ftp");
    
            $con_id = ftp_connect($servidor) or die( $resposta = 'Não conectou em: '.$servidor );
            if (ftp_login($con_id,$usuario,$senha)){            
    

        }
    }
?>