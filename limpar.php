<?php

    header('Content-type: text/html; charset=UTF-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    date_default_timezone_set('America/Sao_Paulo');

    $data = date("d-m-Y");
    $validacao = true;
    $validacaoErro = "";

    if(file_exists('finalizados.json'))  
    {  

        $abre_arquivo_finalizados = file_get_contents('finalizados.json');
        $array_finalizados = json_decode($abre_arquivo_finalizados, JSON_UNESCAPED_UNICODE);

        if (!empty($array_finalizados)) {

            $escreve_arquivo_historico = fopen('./historico/' . $data . '.json', 'w');
            fwrite($escreve_arquivo_historico, json_encode($array_finalizados, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            fclose($escreve_arquivo_historico);

            array_splice($array_finalizados, 0, count($array_finalizados));

        }

        $escreve_arquivo_finalizados = fopen('finalizados.json', 'w');
        fwrite($escreve_arquivo_finalizados, json_encode($array_finalizados, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_finalizados);

        


    }  
    else  
    {  

        $error = 'arquivo finalizados.json não existe :(';  
        
    }

    if(file_exists('contador.json'))  
    {  

        $abre_arquivo_contador = file_get_contents('contador.json');
        $array_contador = json_decode($abre_arquivo_contador, JSON_UNESCAPED_UNICODE);

        if (!empty($array_contador)) {

            array_splice($array_contador, 0, count($array_contador));

        }

        $escreve_arquivo_contador = fopen('contador.json', 'w');
        fwrite($escreve_arquivo_contador, json_encode($array_contador, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_contador);

    }  
    else  
    {  

        $error = 'arquivo contador.json não existe :('; 
        $validacao = false;
        $validacaoErro .= "contador ";

    }


    if(file_exists('chamado.json'))  
    {  

        $abre_arquivo_chamado = file_get_contents('chamado.json');
        $array_chamado = json_decode($abre_arquivo_chamado, JSON_UNESCAPED_UNICODE);

        if (!empty($array_chamado)) {

            array_splice($array_chamado, 0, count($array_chamado));

        }

        $escreve_arquivo_chamado = fopen('chamado.json', 'w');
        fwrite($escreve_arquivo_chamado, json_encode($array_chamado, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_chamado);

    }  
    else  
    {  

        $error = 'arquivo chamado.json não existe :(';
        $validacao = false;
        $validacaoErro .= "chamado ";
        
    }


    if(file_exists('fila.json'))  
    {  

        $abre_arquivo_fila = file_get_contents('fila.json');
        $array_fila = json_decode($abre_arquivo_fila, JSON_UNESCAPED_UNICODE);

        if (!empty($array_fila)) {

            array_splice($array_fila, 0, count($array_fila));

        }

        $escreve_arquivo_fila = fopen('fila.json', 'w');
        fwrite($escreve_arquivo_fila, json_encode($array_fila, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_fila);

    }  
    else  
    {  

        $error = 'arquivo fila.json não existe :(';
        $validacao = false;
        $validacaoErro .= "fila ";
        
    }


    if ($validacao == true) {

        echo "Encerramento realizado com sucesso";

    } else {

        echo "Erro com o(s) arquivo(s) : " . $validacaoErro;

    }
    
        
?>