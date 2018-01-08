var app = angular.module("Consultas", [ "ui.router", "chart.js"]);

app.config(function ($stateProvider, $urlRouterProvider) {
$stateProvider
	.state('login', {
		url:'/login',
		templateUrl: './views/login_page.php',
		controller: 'userCheck'
	})
	.state('home', {
		url:'/home',
		templateUrl: './views/home.php',
		resolve: {
			check: function($state, user) {
				if (!user.userStatus()) {
					$state.go("login");
				};
			}
		}
	})
	.state('lucroMensal', {
		url:"/lucroMensal",
		templateUrl: './views/lucroMensal.php',
		controller: 'graphDataCtrl',
		resolve: {
			check: function($state, user) {
				if (!user.userStatus()) {
					$state.go("login");
				};
			}
		}
	})
	.state('todosValores', {
		url:"/todosValores",
		templateUrl: './views/todosValores.php',
		controller: 'todosValoresCtrl',
		resolve: {
			check: function($state, user) {
				if (!user.userStatus()) {
					$state.go("login");
				};
			}
		}
	});
	$urlRouterProvider.otherwise("login");
});


//SERVICE user
app.service('user', function () {

	var loggedIn = false;
	var username;

	this.setName = function (name) {
		username = name;
	};

	this.getName = function () {
		return username;
	};

	this.userStatus = function () {
		return loggedIn;
	};

	this.userLoggedIn = function () {
		loggedIn = true;
	}

	this.getUserView = function () {
		return userView;
	}
});

app.factory("userLogin", function ($http) {

	factory = {};

	factory.login = function (data) {
		return $http.post("./includes/json_login.php/usuariologgin", data);
	}

	factory.singin = function (data) {
		return $http.post("./includes/json_login.php/usuario", data);
	}

	return factory;
});

app.factory("graphDataFactory", function ($http) {

	factory = {};

		factory.getData = function () {
			return $http.get("./includes/json_filtrar_valores.php?selectAno=todos&selectMes=todos");
		}

		factory.getYears = function () {
			return $http.get("./includes/json_filtrar_distinct_ano");
		}

	return factory;
});

//CONTROLLER userCheck
app.controller("userCheck", function ($scope, $rootScope, $state, $http, user, userLogin) {

	//vars
	var userLogin = {
		username: undefined,
		password: undefined
	};

	var userSingin = {
		username: undefined,
		password: undefined,
		password2: undefined
	}

	$rootScope.userView = { //mostrar/esconder menu para usuário
		lucroBtn: false,
		tdvaloresBtn: false,
		logoutBtn: false
	};

	$scope.userDialog = { //mostrar/esconder dialogos para usuário
		passwordMatch: true, //password combina
		userNotMatch: true, //usuário já existe
		userRegistred: true, //usuário registrado
		userNExist: true //usuário não registrado
	};

	//functions
	$rootScope.setUserView = function () {
		$rootScope.userView.lucroBtn = true;
		$rootScope.userView.tdvaloresBtn = true;
		$rootScope.userView.logoutBtn = true;
	};

	$scope.loginCheck = function () {

		data = {
			"username": $scope.userLogin.username,
			"password": $scope.userLogin.password
		};

		$http.post("./includes/json_login.php/usuariologgin", data)
		.then(function (response) {

			if (response.data.status == "Wrong username or password or user doesn't exist") {

				$scope.userDialog.userNExist = false;

			} else if (response.data.status == "User logged in") {

				factory.login(data).then(function (response) {

					user.setName = response.data.username;
					user.userLoggedIn();
					$rootScope.setUserView();
					$state.go('home');

				});
				


			};
		});

	};

	$scope.singinCheck = function () {

		var userSingin = {
			username: $scope.userSingin.username,
			password: $scope.userSingin.password,
			password2: $scope.userSingin.password2
		};

		if (userSingin.password != userSingin.password2) { // se passsword não combina

			$scope.userDialog.passwordMatch = false;

		} else {
			//verifica request se usuário existe
			
			data = {
				"username": userSingin.username,
				"password": userSingin.password
			};

			factory.singin(data).then(function (response) {

				if (response.data.status == "User registred") {

					$scope.userDialog.userRegistred = false;

				} else if (response.data.status == "User already exists") {				
					$scope.userDialog.userNotMatch = false;
				};
			});

		};
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
app.controller("graphDataCtrl", function ($scope, $http, graphDataFactory) {	

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

	factory.getYears().then(function (response) { // series de datas em Ano
		$scope['series'] = response.data.map(function(obj){
		return $scope.numAno(obj.ano);
		});
	});

	factory.getData().then(function (response) {

		//vars
		var auxArray;
		x = 0;
		count = Math.round(response.data.length/12); 
		sliced = [];
		$scope['meses'] = [];
		$scope['ano'] = [];
		$scope['valor_total'] = [];

		for(i = 1; i <= 12; i++) { //preenche 'meses' com nome de cada mes
			$scope['meses'][i-1] = $scope.numMes(i); //meses inicia com indice 0 a 11
		}

		auxArray = response.data.map(function (obj) {
		  return obj.valor_total;
		});

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