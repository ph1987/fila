<?php

    header('Content-type: text/html; charset=UTF-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $limitador = $_POST['limitador'];

    if(file_exists('fila.json'))  
    {  

        $abre_arquivo_limitador = file_get_contents('limitador.json');  
        $array_limitador = json_decode($abre_arquivo_limitador, JSON_UNESCAPED_UNICODE);

        if (!empty($array_limitador)) {

            array_splice($array_limitador, 0, count($array_limitador));

        }

        $atualizar_limitador = array(
            'limitador' =>   intval($limitador)
        );

        $array_limitador = array();
        $array_limitador[] = $atualizar_limitador;

        $escreve_arquivo_limitador = fopen('limitador.json', 'w');
        fwrite($escreve_arquivo_limitador, json_encode($array_limitador, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_limitador);

        echo 'Limite de atendimentos atualizado para: ' . $limitador;

    }  
    else  
    {  

        $error = 'arquivo fila.json não existe :(';  
        
    }
        
?>