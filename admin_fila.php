<?php
  if(!isset($_COOKIE['inea_fila'])) {
    header("Location: login"); 
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>INEA - Admin fila</title>

	<meta charset="utf-8">
	<meta http-equiv="Cache-control" content="NO-CACHE" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="lib/jquery-3.3.1.min.js"></script>
  <script src="https://momentjs.com/downloads/moment.js"></script>
  <script src="lib/fila.js?<? php echo time(); ?>"></script>
</head>

<body>
	<div class="barraTop">&nbsp;</div>
	<div class="container">
		<!-- <div class="row barraSuperior">
			<div class="col-xs-12">
				<img src="imagens/3logotipos_coloridos.png" class="logo">
			</div>
    </div> -->

    <div class="row">
        <div class="col-md-6" id="chamado" style="width: 21.5em;margin:0 auto; text-align: center;">
        </div>
    </div>

    <br/>

		<div class="row">
			<div class="col-12">
				<table class="table table-striped">
          <thead>
            <tr>
              <th>Senha</th>
              <th>Data</th>
              <th>Nome</th>
              <th>Tipo</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="fila">
          <!-- dados da tabela dinâmica -->
          </tbody>
        </table>
			</div>
    </div>

    <hr>
    
    <p id="ultima_atualizacao" class="text-center"></p>
    
    <p id="encerrar" class="text-center"></p>
    
	</div>
</body>
</html>