<?php

    class FTPHelper{
        function enviarArquivo($caminhoArquivo,$arquivo){

            $servidor = Configure::read("servidor_ftp");
            $usuario = Configure::read("usuario_ftp");
            $senha = Configure::read("senha_ftp");
            $resposta = false;
            $con_id = ftp_connect($servidor) or die( $resposta = true );
            if($resposta){
                return false;
            } else if (ftp_login($con_id,$usuario,$senha)){
                return ftp_put( $con_id, $caminhoArquivo, $arquivo['tmp_name'], FTP_BINARY );
            } else {
                return false;         
            }
        }

        function criarDiretorio($diretorio){
            $servidor = Configure::read("servidor_ftp");
            $usuario = Configure::read("usuario_ftp");
            $senha = Configure::read("senha_ftp");
            $resposta = false;
            $con_id = ftp_connect($servidor) or die( $resposta = true );
            if($resposta){
                return false;
            } else if (ftp_login($con_id,$usuario,$senha)){
                return ftp_mkdir( $con_id, $diretorio, FTP_BINARY );
            } else {
                return false;         
            }            
        }
     
        function getCon(){
            $servidor = Configure::read("servidor_ftp");
            $usuario = Configure::read("usuario_ftp");
            $senha = Configure::read("senha_ftp");
            $resposta = false;
            return ftp_connect($servidor) or die( $resposta = true );
        }
    }
?>