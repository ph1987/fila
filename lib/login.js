jQuery(document).ready(function($) {

    $('#login').val('');
    $('#senha_inea_fila').val('');

});

function login() {

    const login = $('#login').val();
    const senha = $('#senha_inea_fila').val();

    var ajaxurl = './controllers/controller_login.php', data = {
        "login": login,
        "senha": senha
    };

    $.post(ajaxurl, data, function (response) {

        if (response == "ok") {

            window.location.href = "admin";

        } else {

            alert(response);

        }

        
    });

  }