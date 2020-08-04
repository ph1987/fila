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
	<script src="lib/login.js?<? php echo time(); ?>"></script>
</head>

<body>
	<div class="barraTop">&nbsp;</div>
	<div class="container page">
		<div class="row">
			<div class="col-12">
				<img src="imagens/3logotipos_coloridos.png" class="logo">
			</div>
		</div>

        <div id="incluir">
			<div class="row">
                <div class="col-2"></div>
				<div class="col-4" style="text-align: center;">
					<input type="text" class="campoTxt form-control" value="" id="login" placeholder="Login">
				</div>
				<div class="col-4" style="text-align: center;">
					<input type="password" class="campoTxt form-control" value="" id="senha_inea_fila" placeholder="Senha">
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8" style="text-align: center;">
                    <button type="button" class="btnAtendimento iniciarAtendimento" onclick="login()" value="Normal">LOGIN</button>
				</div>
            </div>

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