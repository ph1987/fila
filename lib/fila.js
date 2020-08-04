var myTimer = setInterval(function() {
    fila()
    contador()
}, 10000);

var existeChamadoAberto = false;

jQuery(document).ready(function($) {

    chamado();
    fila();
    contador();
    limitador();
    
});

function fila() {
 
    dataformatada = moment().format('DD-MM-YYYY HH:mm:ss');

    $.ajax({
        url: './fila.json?v=' + makeid(15),
        dataType: 'json',
        success: function(data) {

            var resultadosJson = "";
    
            $.each(data, function(key, val) {

                    resultadosJson += `<tr id="${val.id}">
                    <td>${val.id ? val.id : ''}</td>
                    <td>${val.data ? val.data : ''}</td>
                    <td>${val.nome ? val.nome : ''}</td>
                    <td>${val.tipo == 'Prioritário' ? '<i style="color:#D4AC0D;" class="fa fa-star" aria-hidden="true"></i> ' : ''}
                        ${val.tipo ? val.tipo : ''}
                    </td>
                    <td>
                        <button class="btnChamar btn btn-warning" id="chamar_${val.id}" type="button" onclick="chamar('${val.id}')">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                        </button>

                        <button class="btn btn-danger" id="deletar_${val.id}" type="button" onclick="confirmar('${val.id}')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                    </tr>`;
                    
            });

            let tabelaResultados = document.querySelector('#fila');
            tabelaResultados.innerHTML = resultadosJson;

            let ultimaAtualizacao = document.querySelector('#ultima_atualizacao');
            ultimaAtualizacao.innerHTML = `<b>Última atualização:</b> ${dataformatada}`;

            let encerrar = document.querySelector('#encerrar');
            encerrar.innerHTML = `<button class="btnEncerrar btn btn-danger" onclick="confirmarEncerramento()" class="text-center">Encerrar atendimentos</button>`;

            if (existeChamadoAberto) {

                $(".btnChamar").prop("disabled", true);
                $(".btnEncerrar").prop("disabled", true);

            }
            

        },
        statusCode: {
            
            404: function() {

                console.log(`Erro ao tentar carregar o arquivo fila.json - ${dataformatada}`);
                
            }

        }
    });

}

function chamado() {
 
    $.ajax({
        url: './chamado.json?v=' + makeid(15),
        dataType: 'json',
        success: function(data) {

            var resultadosJson = "";
            
            $.each(data, function(key, val) {

                existeChamadoAberto = true;

                resultadosJson += `
                <div class="card">
                    <div class="card-header">
                        <b>Chamado atual</b>
                    </div>
                    <div class="card-body">
                        <p>
                            <b>Senha:</b>&nbsp;&nbsp;
                            <span style="padding:3px 12px; background-color:#ffc107; border-radius:2px;">
                                <b>${val.id ? val.id : ''}</b>
                            </span>
                        </p>
                        <p><b>Nome:</b> ${val.nome ? val.nome : ''}</p>
                        <p><b>Documento:</b> ${val.doc ? val.doc : ''}</p>
                        <p><b>Tipo:</b> ${val.tipo ? val.tipo : ''}</p>
                    </div>
                    <div class="card-footer">
                        <button class="btnFinalizar btn btn-dark" id="finalizar_${val.id}" value="${val.id}" type="button" onclick="finalizar('${val.id}')">
                            <i class="fa fa-check"></i> Finalizar
                        </button>
                    </div>                       
                </div>`;
                
            });
            
    
            let chamadoAtual = document.querySelector('#chamado');
            chamadoAtual.innerHTML = resultadosJson;

        },
        statusCode: {
            
            404: function() {

                console.log(`Erro ao tentar carregar o arquivo chamado.json - ${dataformatada}`);
                
            }

        }
    });

}

function chamar(id) {

    $("button").prop("disabled", true);
    
    var chamar = "#chamar_" + id;
    $(chamar).html('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>');

    clearInterval(myTimer);

    var ajaxurl = './controllers/controller_chamar.php', data = {
        "id": id
    };

    $.post(ajaxurl, data, function (response) {

        setTimeout(function() {
            location.reload();
        }, 5000);
        
    });
    
}

function finalizar(id) {

    $("button").prop("disabled", true);

    var finalizar = "#finalizar_" + id;
    $(finalizar).html('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>');

    clearInterval(myTimer);

    var ajaxurl = './controllers/controller_finalizar.php', data = {
        "id": id
    };

    $.post(ajaxurl, data, function (response) {

        setTimeout(function() {
            location.reload();
        }, 5000);

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

 function confirmar(id) {

    var resposta = confirm("Tem certeza que deseja excluir este chamado?");

    if (resposta == true) {

        deletar(id);
      
    }

  }

  function confirmarEncerramento() {

    var resposta = confirm("Tem certeza que deseja encerrar?");

    if (resposta == true) {

        limpar();
      
    }

  }

  function deletar(id) {

    var ajaxurl = './controllers/controller_excluir_fila.php', data = {
        "id": id
    };

    $.post(ajaxurl, data, function (response) {

        alert(response);
        location.reload();
        
    });

  }

  function limpar() {

    var ajaxurl = './controllers/controller_limpar.php';

    $.post(ajaxurl, function (response) {

        alert(response);
        location.reload();
        
    });

  }

  function logout() {

    var ajaxurl = './controllers/controller_logout.php';

    $.post(ajaxurl, function (response) {

        if (response == "ok") {
        
            window.location.href = "login";
            
        }
    });

  }

  function contador() {

    let atendimentos_hoje = document.querySelector('#atendimentos_hoje');
    
    $.ajax({
        url: './contador.json?v=' + makeid(15),
        dataType: 'json',
        success: function(data) {
            
            if (data.length == 0) {

                atendimentos_hoje.innerHTML = 0;

            } else {

                $.each(data, function(key, val) {

                    atendimentos_hoje.innerHTML = `${val.contador ? val.contador : '0'}`;
                    
                });
            }

        },
        statusCode: {
            
            404: function() {

                atendimentos_hoje.innerHTML = '0';
                console.log(`Erro ao tentar carregar o arquivo contador.json - ${dataformatada}`);
                
            }

        }
    });

  }

  function limitador() {
 
    $.ajax({
        url: './limitador.json?v=' + makeid(15),
        dataType: 'json',
        success: function(data) {
            
            $.each(data, function(key, val) {

                $('#atendimentos_max').val(`${val.limitador ? val.limitador : '0'}`);
                
            });

        },
        statusCode: {
            
            404: function() {

                $('#atendimentos_max').val(0);
                console.log(`Erro ao tentar carregar o arquivo limitador.json - ${dataformatada}`);
                
            }

        }
    });

  }

  function alterar_limitador(limitador) {

    var ajaxurl = './controllers/controller_limitador.php', data = {
        "limitador": limitador
    };

    $.post(ajaxurl, data, function (response) {

        alert(response);
        location.reload();
        
    });

  }