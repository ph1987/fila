<?php

    session_start();

    header('Content-type: text/html; charset=UTF-8');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $doc = $_POST['doc'];
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d-m-Y H:i:s");

    if(file_exists('./fila.json'))  
    {  

        $abre_arquivo_fila = file_get_contents('./fila.json');  
        $array_fila = json_decode($abre_arquivo_fila, JSON_UNESCAPED_UNICODE);

        $abre_arquivo_contador = file_get_contents('./contador.json');  
        $array_contador = json_decode($abre_arquivo_contador, JSON_UNESCAPED_UNICODE);

        $id = 0;

        if (!empty($abre_arquivo_contador)) {
            $primeiro_item = reset($array_contador);
            $id = intval($primeiro_item["contador"]);
        }

        $id = $id + 1;

        $adicionar = array(
            'id'   =>     $id,  
            'nome' =>     $nome,
            'doc'  =>     $doc, 
            'tipo' =>     $tipo,
            'data' =>     $data  
        );

        $contador = array(
            'contador' =>   $id
        );

        $array_fila[] = $adicionar;

        $array_contador = array();
        $array_contador[] = $contador;

        $escreve_arquivo_fila = fopen('./fila.json', 'w');
        fwrite($escreve_arquivo_fila, json_encode($array_fila, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_fila);

        $escreve_arquivo_contador = fopen('./contador.json', 'w');
        fwrite($escreve_arquivo_contador, json_encode($array_contador, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($escreve_arquivo_contador);

        $_SESSION["minhasenha"] = $id;

        echo $id;

    }  
    else  
    {  

        $error = 'arquivo fila.json não existe :(';  
        
    }
        
?>