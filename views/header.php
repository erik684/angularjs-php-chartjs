<!-- ALERTAS BOOTSTRAP -->
<?php 

	$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	

	if (strpos($url, 'login=sucesso') !== false) { 		
		echo '<div class="alert alert-success alert-dismissable fade show text-center mb-auto" id="alert" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Você entrou com sucesso!</strong> Bem Vindo <strong>'.$_SESSION['usuario'].'</strong>
				</div>';
	}
	if (strpos($url, 'login=erro') !== false) {
		echo '<div class="alert alert-danger alert-dismissable fade show text-center mb-auto" id="alert" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Houve um erro ao efetuar login!</strong> tente novamente.
				</div>';
	}

	if (strpos($url, 'filtro=sucesso') !== false) { 		
		echo '<div class="alert alert-success alert-dismissable fade show text-center mb-auto" id="alert" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Resultados filtrado!</strong> Clique novamente na guia para verificar.
				</div>';
	}

	if (strpos($url, 'filtro=erro') !== false) { 		
		echo '<div class="alert alert-info alert-danger fade show text-center mb-auto" id="alert" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Houve um erro!</strong> Clique novamente no filtro ou na guia para verificar.
				</div>';
	}

?>

<!-- NAVBAR -->
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse rounded mr-0 mt-0 pb-auto pt-auto" ng-controller="userCheck">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#/home">Página Inicial</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item" ng-show="userView.lucroBtn">
        <a class="nav-link" href="#/lucroMensal">Lucro Mensal</a>
      </li>
      <li class="nav-item" ng-show="userView.tdvaloresBtn">
        <a class="nav-link " href="#/todosValores">Todos Valores</a>
      </li>
<!-- 	  <li class="nav-item active">
		<a class="nav-link" data-toggle="modal" data-target="#loginpopUpWindow" href="">Entrar</a>
	   </li> -->
		<li class="active li-navbar" ng-show="userView.logoutBtn">
			<button id="btn_sair" class="btn btn-danger mt-0 mb-0 btn-sair" name="btn_sair" type="submit">Sair</button>
		</li>			
    </ul>
  </div>
</nav>