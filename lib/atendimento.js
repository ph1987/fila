jQuery(document).ready(function($) {

	$('.iniciarAtendimento').click(function(){

        var atendimentoSelecionado = $(this).val();

        var nome = $('#nome').val();
        var doc = $('#doc').val();
        
        var envioValido = false;

        if (nome.length >= 3 && doc.length > 6) {

            envioValido = true;

        }

        if (envioValido) {

            var ajaxurl = './controllers/controller_add.php', data = {
                "nome": nome,
                "doc": doc,
                "tipo": atendimentoSelecionado
            };

            $.post(ajaxurl, data, function (response) {
            
                if (response) { 

                    $('#nome').val('');
                    $('#doc').val('');

                    $('#incluir').hide();

                    const cardResultado = `<div class="card">
                        <div class="card-header">
                            <b>Solicitação enviada com sucesso</b>
                        </div>
                        <div class="card-body">
                            <p>
                                <b>Sua senha é:&nbsp;&nbsp;</b>
                                
                                <span style="padding:3px 12px; background-color:#ffc107; border-radius:2px; font-size:40px;">
                                    <b>${response}</b>
                                </span>

                                <p>Aguarde o chamado na <a href="./">Página inicial</a>.</p>
                                <p>Você será notificado quando chegar sua vez.</p>

                                <button class="btnFinalizar btn btn-dark" type="button">
                                    <a class="acompanharFila" href="./"><i class="fa fa-list-ol"></i> Acompanhar a fila</a>
                                </button>

                                <button class="btnFinalizar btn btn-dark" onclick="window.print()" type="button">
                                    <i class="fa fa-print" aria-hidden="true"></i> Imprimir (não é obrigatório)
                                </button>
                            </p>
                        </div>
                    </div>`;

                    let chamado = document.querySelector('#chamadoAtendimento');
                    chamado.innerHTML = cardResultado;

                    $('#chamadoAtendimento').show();

                }


            });

        } else {

            alert("Por favor, preencha todos os campos");

        }
        
    });

});