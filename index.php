<?php
	session_start();
	$minha_senha = '';
	if(isset($_SESSION["minhasenha"])) {
		$minha_senha = strval($_SESSION["minhasenha"]);
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>INEA - Fila de Atendimento</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="lib/jquery-3.3.1.min.js"></script>
	<script src="https://momentjs.com/downloads/moment.js"></script>
	<script src="lib/index.js?<? php echo time(); ?>"></script>
</head>

<body>
	<div class="barraTop">&nbsp;</div>
	<div class="container page">
		<div class="row">
			<div class="col-12">
				<img src="imagens/3logotipos_coloridos.png" class="logo">
			</div>
		</div>

		<div class="row">
			<div class="col-12" id="solicitacao" style="text-align: center;">
				<a href="./atendimento" style="color:#fff; text-decoration:none;">
					<button class="btn btn-primary" style="width: 50%; padding: 12px; font-size: 2.0vw;">
						<i class="fa fa-plus-circle" aria-hidden="true"></i> Solicitar Atendimento
					</button>
				</a>
			</div>
		</div>

		<br/>

		<div class="senhaAtual" id="painelSenha">
		</div>
		<br/>
		<div class="row">
			<div class="col-12" style="text-align: center;">
				<p class="nomeAtualTexto">

					<i class="fa fa-bell" title="Insira sua senha ao lado para receber a notificação" aria-hidden="true"></i> 
					Notificar quando chegar minha vez: 

					<input type="text" style="width: 8%; padding: 0px 10px; text-align:center;" 
					title="Insira sua senha para receber a notificação"
					value="<?php echo $minha_senha; ?>"
					id="senhaNotificacao" placeholder="">

					<button class="btn btn-danger" id="notificacao" onclick="pararNotificacao()">
						<i class="fa fa-bell-slash" aria-hidden="true"></i> 
						Parar notificação
					</button>

				</p>

			</div>
		</div>

		<hr>

		<div class="row text-center">
			<div class="col-12">
				<img src="imagens/LOGO_GETEC_FINAL.png" class="logo" style="width: 25%; padding: 12px;">
			</div>
		</div>


	</div>
	<audio id="audioChamada" src="audio/chamada.wav"></audio>
	
</body>
</html>