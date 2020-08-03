<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>INEA - Solicitar Atendimento</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="lib/jquery-3.3.1.min.js"></script>
	<script src="lib/atendimento.js"></script>
</head>

<body>
	<div class="barraTop">&nbsp;</div>
	<div class="container page">
		<div class="row barraSuperior">
			<div class="col-12">
				<img src="imagens/3logotipos_coloridos.png" class="logo">
			</div>
		</div>

		<div class="row">
			<div class="col-12" style="text-align: center;">
			<a href="./index" style="color:#fff; text-decoration:none;">
				<button class="btn btn-primary" style="width: 50%; padding: 12px; font-size: 2.0vw;">
				<i class="fa fa-home" aria-hidden="true"></i> Página inicial
				</button>
			</a>
			</div>
		</div>

		<br/>
		
		<div id="incluir">
			<div class="row">
				<div class="col-6" style="text-align: center;">
					<input type="text" class="campoTxt form-control" id="nome" placeholder="Nome e Sobrenome">
				</div>
				<div class="col-6" style="text-align: center;">
					<input type="text" class="campoTxt form-control" id="doc" placeholder="RG ou CPF">
				</div>
			</div>
			
			<br/>

			<div class="row">
				<div class="col-12" style="text-align: center;">
					<button type="button" class="btnAtendimento iniciarAtendimento" value="Normal">SOLICITAR ATENDIMENTO</button>
				</div>
			</div>

			<div class="row">
				<div class="col-12" style="text-align: center;"><br>
					<button type="button" class="btnAtendimento iniciarAtendimento" value="Prioritário">SOLICITAR ATENDIMENTO PRIORITÁRIO</button>
				</div>
			</div>
		</div>
		
		<br/>

		<div class="row">
			<div class="col-md-6" id="chamadoAtendimento"></div>
		</div>
		
		<hr>

		<div class="row text-center">
			<div class="col-12">
				<img src="imagens/LOGO_GETEC_FINAL.png" class="logo" style="width: 25%; padding: 12px;">
			</div>
		</div>
		
		<br/>
        
	</div>
</body>
</html>