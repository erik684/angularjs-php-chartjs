<html lang="pt-br" ng-app="Consultas">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/custom.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js"></script>
<script src="//unpkg.com/@uirouter/angularjs/release/angular-ui-router.min.js"></script>
<script src="js/angular-chart"></script>
<script src="js/angular-chart.min.js"></script>
<script src="js/consultas.module.js"></script>
<script src="js/consultas.controller.js"></script>

<meta charset="UTF-8">
<title>Página Inicial</title>

</head>
<body>

<!-- CONTAINER PRINCIPAL -->
<div class="container"> 
	
	<header ng-include="'views/header.php'"></header>
	
	<main ui-view></main>

	<hr class="divider">
	
	<!-- FOOTER -->
	<footer class="footer stick-footer">	
		<span class="text-muted"><i>Erik Aleixo:</i> </span>	  
		<a class="btn btn-link" href="https:\\www.github.com/erik684/php-login-consulta">github.com/erik684/php-login-consulta</a>
	</footer>

<!-- FIM CONTAINER PRINCIPAL -->
</div>

<!-- LOGIN MODAL -->
<div class="modal fade bd-modal-sm" role="dialog" id="loginpopUpWindow" ng-controller="userCheck">
	<div class="modal-dialog">
		<div class="modal-content">

		<!-- modal-header -->
		<div class="modal-header">
			<legend>Insira os dados abaixo:</legend>
			<button type="button" class="close" data-dismiss="modal">&times;</button>			
		</div>

		<div class="modal-body">
			<!-- FORM LOGIN -->
			<form class="form-horizontal" id="form" ng-submit="loginCheck()">

			<!-- USER INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="userLogin.username">Usuário: </label>  
			  <div class="col-md-7">
			  <input id="userLogin.username" ng-model="userLogin.username" type="text" placeholder="Digite nome de usuário" class="form-control input-md" required="" maxlength="30">			  
			  <small class="form-text text-muted">Ex.: lucas_silva, araujo_lima, pedro354</small>
			  </div>

			</div>

			<!-- PASSWORD INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="userLogin.password">Senha: </label>
			  <div class="col-md-7">
			    <input id="userLogin.password" ng-model="userLogin.password" type="password" placeholder="Digite a senha" class="form-control input-md" required="" maxlength="16">			    
			  </div>
			</div>

			<!-- BOTÃO FORM FORM-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="btn_form"></label>
			  <div class="col-md-4">	
			  	<button id="btn_login" name="btn_login" class="btn btn-success mb-1" type="submit">Entrar</button>		    			    
			  	<button id="btn_register" name="btn_register" class="btn btn-primary" type="submit">Cadastrar</button>			  	
			  </div>


			</div>				
			</fieldset>
			</form>
		</div>
	</div>
</div>

</body>

</html>