<?php

    class FTPHelper{
        function enviarArquivo($caminho,$arquivo){

            
            $con_id = getCon();
            if($con_id){
                return ftp_put( $con_id, $caminho.'/'.$arquivo['name'], $arquivo['tmp_name'], FTP_BINARY );
            } else {
                return false;         
            }
        }

        function criarDiretorio($diretorio){
            $con_id = getCon();
            if($con_id){
                return ftp_mkdir( $con_id, $diretorio, FTP_BINARY );
            } else {
                return false;         
            }            
        }
     
        function getCon(){
            $servidor = Configure::read("servidor_ftp");
            $usuario = Configure::read("usuario_ftp");
            $senha = Configure::read("senha_ftp");            
            $ftp_con = ftp_connect($servidor) ;
            if($ftp_con){
                if (ftp_login($ftp_con,$usuario,$senha)){
                    return $ftp_con;
                }else {
                    return false;
                }
            } else {
                return false;
            }
            
        }
    }
?>