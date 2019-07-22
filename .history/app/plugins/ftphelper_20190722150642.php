<?php

    class FTPHelper{
        function enviarArquivoUpload($caminho,$arquivo){
            $con_id = $this->getCon();
            if($con_id){                
                return ftp_put($con_id, $caminho, $arquivo, FTP_BINARY );
            } else {
                return false;         
            }
        }

        function enviarArquivoFTP($caminho){
            $con_id = $this->getCon();
            if($con_id){                
                return ftp_put( $con_id, $caminho, '/tmp/arquivo.pdf', FTP_BINARY );
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

        function moveArquivo($caminhoOrigem,$caminhoDestino){
            $con_id = $this->getCon();
            if($con_id){
                return ftp_rename($con_id, $caminhoOrigem, $caminhoDestino);
            } else {
                return false;         
            }            
        }

        function recuperarConteudoArquivo($caminho){
            $con_id = $this->getCon();
            $local_file = 'localfile.txt';
            $handle = fopen($local_file, 'w');
            if($con_id){
                return $this->ftp_get_contents($con_id, $caminho, FTP_BINARY );
            } else {
                return false;         
            }            
        }


        function ftp_get_contents($ftp_stream, $remote_file, $mode, $resume_pos=null){
            $pipes=stream_socket_pair(STREAM_PF_UNIX, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
            if($pipes===false) return false;
            if(!stream_set_blocking($pipes[1], 0)){
                fclose($pipes[0]); fclose($pipes[1]);
                return false;
            }
            $fail=false;
            $data='';
            if(is_null($resume_pos)){
                $ret=ftp_nb_fget($ftp_stream, $pipes[0], $remote_file, $mode);
            } else {
                $ret=ftp_nb_fget($ftp_stream, $pipes[0], $remote_file, $mode, $resume_pos);
            }
            while($ret==FTP_MOREDATA){
                while(!$fail && !feof($pipes[1])){
                    $r=fread($pipes[1], 8192);
                    if($r==='') break;
                    if($r===false){ $fail=true; break; }
                    $data.=$r;
                }
                $ret=ftp_nb_continue($ftp_stream);
            }
            while(!$fail && !feof($pipes[1])){
                $r=fread($pipes[1], 8192);
                if($r==='') break;
                if($r===false){ $fail=true; break; }
                $data.=$r;
            }
            fclose($pipes[0]); fclose($pipes[1]);
            if($fail || $ret!=FTP_FINISHED) return false;
            return $data;
        }


        function recuperarArquivoComNome($caminho){
            $con_id = $this->getCon();
            $local_file = $nomeArquivo;
            $handle = fopen($local_file, 'w');
            if($con_id){
                return ftp_get_contents($con_id, $caminho, FTP_BINARY);                
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