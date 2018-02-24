<html lang="pt-br" ng-app="Consultas">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/custom.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<!-- angular -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
<script src="js/angular-chart.min.js"></script>


<script src="//unpkg.com/@uirouter/angularjs/release/angular-ui-router.min.js"></script>


<script src="js/consultas.module.js"></script>

<script src="services/user.service.js"></script>

<script src="factory/userlogin.factory.js"></script>
<script src="factory/graphdata.factory.js"></script>

<script src="controllers/usercheck.controller.js"></script>
<script src="controllers/graphdatactrl.controller.js"></script>
<script src="controllers/todosvaloresctrl.controller.js"></script>


<meta charset="UTF-8">
<title>Página Inicial</title>

</head>
<body>

<!-- CONTAINER PRINCIPAL -->
<div class="container"> 
	
	<header ng-include="'views/header.html'"></header>
	
	<main ui-view></main>
	
	<footer ng-include="'views/footer.html'"></footer>

<!-- FIM CONTAINER PRINCIPAL -->
</div>

</body>

</html>