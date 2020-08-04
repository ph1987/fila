<?php

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if ($login == 'admin' && $senha == 'getec') {

        $cookie_name = "inea_fila";
        $cookie_value = "admin";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30)); // 86400 = 1 day
        echo "ok";

    } else { 

        echo "Acesso negado";

    }

?>