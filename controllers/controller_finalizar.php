<?php

    header('Content-type: text/html; charset=UTF-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $id = $_POST['id'];
    date_default_timezone_set('America/Sao_Paulo');

    $data = date("d-m-Y H:i:s");

    if(file_exists('finalizados.json'))  
    {  

        $abre_arquivo_chamado = file_get_contents('chamado.json');
        $array_chamado = json_decode($abre_arquivo_chamado, JSON_UNESCAPED_UNICODE);
   
        if (!empty($array_chamado)) {

            $resultadoBusca = null;
            $indice = 0;

            foreach($array_chamado as $struct) {
                if ($id == $struct["id"]) {
                    $resultadoBusca = $struct;
                    array_splice($array_chamado, $indice, 1);
                    break;
                }
                $indice++;
            }

        }

        $array_finalizado[] = $resultadoBusca;

        $escreve_arquivo_chamado = fopen('chamado.json', 'w');
        fwrite($escreve_arquivo_chamado, json_encode($array_chamado, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_chamado);

        $resultadoBusca["data"] = $data;

        $abre_arquivo_finalizado = file_get_contents('finalizados.json');
        $array_arquivo_finalizado = json_decode($abre_arquivo_finalizado, JSON_UNESCAPED_UNICODE);

        $array_arquivo_finalizado[] = $resultadoBusca;

        $escreve_arquivo_finalizado = fopen('finalizados.json', 'w');
        fwrite($escreve_arquivo_finalizado, json_encode($array_arquivo_finalizado, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_finalizado);

    }  
    else  
    {  

        $error = 'arquivo finalizados.json não existe :(';  
        
    }
        
?>