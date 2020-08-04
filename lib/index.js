jQuery(document).ready(function($) {

    verificarDisponibilidade();
    chamado();
    

    setInterval(function() {
        chamado()
        verificarDisponibilidade()
    }, 10000);

});

function chamado() {
 
    $.ajax({
        url: './chamado.json?v=' + makeid(15),
        dataType: 'json',
        success: function(data) {

            var resultadosJson = "";
            
            if (data.length > 0) {

                $.each(data, function(key, val) {

                    resultadosJson += `
                    <div class="col-xs-11" style="text-align: center;">
                        <span class="senhaAtualTexto">SENHA &nbsp;</span>
                        <span id="senhaAtualNumero">${val.tipo == 'Prioritário' ? '<span style="opacity: 0.5;">P</span>' : ''}${val.id ? val.id : ''}</span>
                        <p class="nomeAtualTexto">${val.nome ? val.nome.toUpperCase() : ''}</p><br/>
                    </div>`;

                    if (val.id == $("#senhaNotificacao").val())
                        notificar();
                    
                });

            } else {

                resultadosJson += `
                <div class="col-xs-11" style="text-align: center;">
                <br/><br/><br/><br/>
                <div class="spinner-border"></div>
                <br/><br/><br/><br/>
                </div>`;

            }
            
            let painelSenha = document.querySelector('#painelSenha');
            painelSenha.innerHTML = resultadosJson;

        },
        error: function() {
            
            const resultadosJson = `
            <div class="col-xs-11" style="text-align: center;">
            <br/><br/><br/><br/>
            <div class="spinner-border"></div>
            <br/><br/><br/><br/>
            </div>`;

            let painelSenha = document.querySelector('#painelSenha');
            painelSenha.innerHTML = resultadosJson;

        },
        statusCode: {
            
            404: function() {

                console.log(`Erro ao tentar carregar o arquivo chamado.json - ${dataformatada}`);
                
            }

        }
    });

}

function verificarDisponibilidade() {

    function functContador() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: './contador.json?v=' + makeid(15),
                dataType: 'json',
                success: function(data) {

                    resolve(data[0].contador ? data[0].contador : -1);

                }

            });
        });
    }

    functContador().then(function(data) {
        var contador = data;

        function functLimitador() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: './limitador.json?v=' + makeid(15),
                    dataType: 'json',
                    success: function(data) {
    
                        resolve(data[0].limitador ? data[0].limitador : -1);
    
                    }
    
                });
            });
        }
    
        functLimitador().then(function(data) {
            var limitador = data;

            console.log(contador, limitador);
            
            if (contador >= limitador) {

                $('#solicitacao').hide();
        
            } else {

                $('#solicitacao').show();

            }

        });

    });

}

function makeid(length) {

    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;

    for ( var i = 0; i < length; i++ ) {

       result += characters.charAt(Math.floor(Math.random() * charactersLength));

    }

    return result;

 }

 function notificar() {

    var audioChamada = $("#audioChamada");
    audioChamada.trigger("play");
    document.title = "Sua vez chegou!"
    $('#notificacao').show();

 }

 function pararNotificacao() {

    document.title = "INEA - Fila de Atendimento"
    $('#notificacao').hide();
    $('#senhaNotificacao').val('');

 }

 
