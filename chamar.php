<?php

    header('Content-type: text/html; charset=UTF-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $id = intval($_POST['id']);

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d-m-Y H:i:s");

    if(file_exists('fila.json'))  
    {  

        $abre_arquivo_fila = file_get_contents('fila.json');  
        $array_fila = json_decode($abre_arquivo_fila, JSON_UNESCAPED_UNICODE);
   
        if (!empty($array_fila)) {

            $resultadoBusca = null;
            $indice = 0;

            foreach($array_fila as $struct) {
                if ($id == $struct["id"]) {
                    $resultadoBusca = $struct;
                    array_splice($array_fila, $indice, 1);
                    break;
                }
                $indice++;
            }

        }

        if ($resultadoBusca != null) {

            $array_chamada[] = $resultadoBusca;

            $escreve_arquivo_fila = fopen('fila.json', 'w');
            fwrite($escreve_arquivo_fila, json_encode($array_fila, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            fclose($escreve_arquivo_fila);

            $resultadoBusca["data"] = $data;

            $escreve_arquivo_chamar = fopen('chamado.json', 'w');
            fwrite($escreve_arquivo_chamar, json_encode($array_chamada, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            fclose($escreve_arquivo_chamar);

        }

    }  
    else  
    {  

        $error = 'arquivo fila.json não existe :(';  
        
    }
        
?>