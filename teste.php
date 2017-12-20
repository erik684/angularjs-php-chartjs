<?php 
session_start();
include_once("includes/efetuar_login.php");
?>
<!DOCTYPE html>
<html lang="pt-br" ng-app="Consultas">
<head>

<link rel="stylesheet" href="css/bootstrap.min.css"> 	
<link rel="stylesheet" type="text/css" href="css/custom.css">
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
<script src="https://code.angularjs.org/1.5.6/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-filter/0.5.17/angular-filter.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/angular-ui/0.4.0/angular-ui.min.js"></script>
<script src="js/angular-chart"></script>
<script src="js/angular-chart.min.js"></script>
<script src="js/consultas.module.js"></script>
<script src="js/consultas.controller.js"></script>

<meta charset="UTF-8">
<title>Página Inicial</title>

</head>
<body>

<!-- ALERTAS BOOTSTRAP -->
<?php 
	$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	

	if (strpos($url, 'login=sucesso') !== false) { 		
		echo '<div class="alert alert-success alert-dismissable fade in text-center" id="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Você entrou com sucesso!</strong> Bem Vindo <strong>'.$_SESSION['usuario'].'</strong>
				</div>';
	}
	if (strpos($url, 'login=erro') !== false) { 		
		echo '<div class="alert alert-danger alert-dismissable fade in text-center" id="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Houve um erro ao efetuar login!</strong> tente novamente.
				</div>';
	}

	if (strpos($url, 'filtro=sucesso') !== false) { 		
		echo '<div class="alert alert-success alert-dismissable fade in text-center" id="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Resultados filtrado!</strong> Clique novamente na guia para verificar.
				</div>';
	}

	if (strpos($url, 'filtro=erro') !== false) { 		
		echo '<div class="alert alert-info alert-danger fade in text-center" id="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Houve um erro!</strong> Clique novamente no filtro ou na guia para verificar.
				</div>';
	}	

?>	<!-- CONTAINER PRINCIPAL -->
<div class="container" ng-controller="FiltrarValoresCtrl"> 

	<!-- NAVBAR -->
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header"><a href="#" class="navbar-brand"><strong>Página principal</strong></a></div>
		    <ul class="nav navbar-nav">
		      <li class="active"><a href="#">Home</a></li>
		      <li><a href="#">Page 1</a></li>
		      <li><a href="#">Page 2</a></li>
		      <li><a href="#">Page 3</a></li>
		    </ul>
			<ul class="nav navbar-nav navbar-right">
				<?php 
				if (!isset($_SESSION['usuario'])) {
					echo 
					'<li class="active li-navbar" href=""><a class="btn btn-confirm pull-right" data-toggle="modal" data-target="#loginpopUpWindow" href="">LOGIN</a></li>';
				}
				else {
					echo '
					<li class="active li-navbar" href="">
						<form method="POST" action="">
							<button id="btn_sair" class="btn btn-danger btn-sair" name="btn_sair" type="submit">SAIR</button>
						</form>
					</li>';					
				}
				?>	

			</ul>
		</div>
	</nav>
	<?php if (isset($_SESSION['usuario'])) { ?>
	
	<div class="container">
		<ul class="nav nav-pills">
			<li class="active"><a href="#lucro" data-toggle="tab">LUCRO MENSAL</a></li>
			<li><a href="#filtrarLucro" data-toggle="tab">FILTRAR LUCRO</a></li>
			<li><a href="#todosValores" data-toggle="tab">TODOS OS VALORES</a></li>
		</ul>
	</div>


	
	<hr class="divider">

	<!-- CONTAINER CANVAS-CHARTJS -->
	<div class="container jumbotron"> 	
		<canvas class="chart chart-line" 
		chart-data="valor_total"
		chart-labels="meses"
		chart-series="series"
		chart-options="options">
		</canvas>
	</div>

	<?php } ?>			
		
	<hr class="divider">
	
	<!-- FOOTER -->
	<footer class="blockquote-footer stick-footer">		  
		<i>Erik Aleixo: <a class="btn btn-link" href="https:\\www.github.com/erik684/php-login-consulta">github.com/erik684/php-login-consulta</a>
	</footer>

<!-- FIM CONTAINER PRINCIPAL -->
</div>

<!-- LOGIN MODAL -->
<div class="modal fade" id="loginpopUpWindow">
	<div class="modal-dialog">
		<div class="modal-content">

		<!-- modal-header -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<legend>Insira os dados abaixo:</legend>
		</div>

		<div class="modal-body">
			<!-- FORM LOGIN -->
			<form class="form-horizontal" method="POST" id="form" action="">

			<!-- USER INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="user_input">Usuário: </label>  
			  <div class="col-md-4">
			  <input id="user_input" name="user_input" type="text" placeholder="Digite nome de usuário" class="form-control input-md" required="" maxlength="30">
			  <span class="help-block">Ex.: lucas_silva, araujo_lima, pedro354</span>  
			  </div>
			</div>

			<!-- PASSWORD INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="pwd_input">Senha: </label>
			  <div class="col-md-4">
			    <input id="pwd_input" name="pwd_input" type="password" placeholder="Digite a senha" class="form-control input-md" required="" maxlength="16">			    
			  </div>
			</div>

			<!-- BOTÃO FORM FORM-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="btn_form"></label>
			  <div class="col-md-4">
			    <button id="btn_login" name="btn_login" class="btn btn-success" type="submit">Entrar</button>
			  </div>
			</div>				
			</fieldset>
			</form>
		</div>
	</div>
</div>

<script src="js/bootstrap.min.js"></script> 
</body>

</html>