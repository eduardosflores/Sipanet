<?php

    class FTPHelper{
        function enviarArquivo($caminho,$arquivo,$ftp=true){
            $con_id = $this->getCon();
            if($con_id){
                if($ftp){
                    return ftp_put( $con_id, $caminho, $arquivo['tmp_name'], FTP_BINARY );
                } else {
                    return ftp_put( $con_id, $caminho, $arquivo['localfile.txt'], FTP_BINARY );
                }
            } else {
                return false;         
            }
        }

        function criarDiretorio($diretorio){
            $con_id = $this->getCon();
            if($con_id){
                return ftp_mkdir( $con_id, $diretorio);
            } else {
                return false;         
            }            
        }


        function recuperaTodosArquivosPasta($caminho){
            $con_id = $this->getCon();
            if($con_id){
                return ftp_nlist($con_id,$caminho);
            } else {
                return false;         
            }            
        }

        function recuperarArquivo($caminho){
            $con_id = $this->getCon();
            $local_file = 'localfile.txt';
            $handle = fopen($local_file, 'w');
            if($con_id){
                if (ftp_fget($con_id, $handle , $caminho, FTP_BINARY )==false){
                    return false;
                } else {
                    return $handle;
                }
            } else {
                return false;         
            }            
        }

        function deletaArquivo($caminho){
            $con_id = $this->getCon();
            if($con_id){
                return ftp_delete($con_id, $caminho );
            } else {
                return false;         
            } 
        }

        function verificarDiretorioExiste($caminho){
            $con_id = $this->getCon();
            if($con_id){
                return ftp_chdir($con_id, $caminho);
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