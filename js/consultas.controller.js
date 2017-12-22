var app = angular.module("Consultas", [ "ui.router", "chart.js"]);

app.config(function ($stateProvider, $urlRouterProvider) {
$stateProvider
	.state('home', {
		url:'/home',
		templateUrl: './views/home.php'
	})
	.state('lucroMensal', {
		url:"/lucroMensal",
		templateUrl: './views/lucroMensal.php',
		controller: 'graphDataCtrl'
	})
	.state('todosValores', {
		url:"/todosValores",
		templateUrl: './views/todosValores.php',
		controller: 'todosValoresCtrl'

	});
	$urlRouterProvider.otherwise("/lucroMensal");
});

//CONTROLLER userCheck
app.controller("userCheck", function ($scope, $http) {

	//vars
	var userLogin = {
		username: undefined,
		password: undefined
	};

	//functions
	$scope.loginCheck = function () {

		var userLogin = {
			username: $scope.userLogin.username,
			password: $scope.userLogin.password
		};

		$http.post("./includes/json_login.php", userLogin)
		.then(function(response) {
			console.log(response);
		});

	};

	$scope.singinCheck = function () {

	data = [{'usuario': $scope.user_input, 'senha': $scope.usuario}];

	$http.get("http://localhost/AngularJS%20-%20Views/includes/json_login.php", data)
	.then(function(data) {
		console.log(data);
	});

}
});

// CONTROLLER todosValoresCtrl
app.controller("todosValoresCtrl", function ($scope, $http) {
	
	$scope.numOfPages = 0;
	$scope.prevPageActive = false;
	$scope.nextPageActive = false;
	$scope.itemsPerPage = 10;


	$scope.prevPage = function () {
		$scope.beginPage = $scope.beginPage - $scope.itemsPerPage;
		$scope.nextPageActive = false;
		$scope.prevPageActive = true;
		
	}

	$scope.nextPage = function () {
		$scope.beginPage = $scope.beginPage + $scope.itemsPerPage;
		$scope.nextPageActive = true;
		$scope.prevPageActive = false;
	}

	$scope.pageQtd = function () {
		$scope.itemsPerPage = $scope.pageQtdSelected;
	}

	$http.get("http://localhost/AngularJS%20-%20Views/includes/json_todosvalores.php")
		.then(function(data) {

			$scope['consultas'] = [];
			$scope['consultas'] = data.data;


		});

	$scope.sort = function (keyname) {
		$scope.sortKey = keyname;
		$scope.reverse = !$scope.reverse;
	}
});


// CONTROLLER graphDataCtrl
app.controller("graphDataCtrl", function ($scope, $http) {	

	$scope.graphType = 'line';

	$scope['options'] = 
	{	
		title: { 
			display: true,
			text:'Gráfico com valor de consultas por Mês e Ano'
		},
		legend: { 
			display: true 
		}
	};

	$http.get("http://localhost/Angular_ChartJs - Copia/includes/json_filtrar_distinct_ano") // series de datas em Ano
		.then(function(data){
			$scope['series'] = data.data.map(function(obj){
				return $scope.numAno(obj.ano);
		});
	});

	$http.get("http://localhost/Angular_ChartJs - Copia/includes/json_filtrar_valores.php?selectAno=todos&selectMes=todos")
		.then(function(data){

	$scope['meses'] = [];
	$scope['ano'] = [];
	$scope['valor_total'] = [];

	for(i = 1; i <= 12; i++) { //preenche 'meses' com nome de cada mes
		$scope['meses'][i-1] = $scope.numMes(i); //meses inicia com indice 0 a 11
	}

	var auxArray = data.data.map(function (obj) {
	  return obj.valor_total;
	});

	x = 0;
	count = Math.round(data.data.length/12); 
	sliced = [];

	for (i = 0; i < count; i++) {	
		if ( ((auxArray[x]||[]) === undefined) || ((auxArray[x]||[]) === undefined) )  {
			break;
		}
		else {	
							
			sliced = auxArray.slice(x, (x+12));			
			x = x + 12;	
			$scope['valor_total'][i] = sliced;	
			sliced = [];	
		}
	}

	});


	$scope.graphChange = function (type) {
		$scope.graphType = type;
	}

	$scope.roundValue = function(valor) {
		return (Math.round(valor));
	}

	$scope.numAno = function (ano) {
		ano = parseInt(ano);

		switch(ano) {		
			case (parseInt(ano)):
			return ('20' + ano);

			default:
			return "Todos";
		}
	}

	$scope.numMes = function (mes) {
		switch(parseInt(mes)) {

			case 1:
				return "Janeiro";
				break;	
			case 2:
				return "Fevereiro";
				break;				
			case 3:
				return "Março";
				break;
			case 4:
				return "Abril";
				break;
			case 5:
				return "Maio";
				break;
			case 6:
				return "Junho";
				break;
			case 7:
				return "Julho";
				break;
			case 8:
				return "Agosto";
				break;
			case 9:
				return "Setembro";
				break;
			case 10:
				return "Outubro";
				break;
			case 11:
				return "Novembro";
				break;
			case 12:
				return "Dezembro";
				break;
			default:
				return "Todos";

		}
	}

});