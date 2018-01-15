angular
	.module("Consultas", [ 
		"ui.router", 
		"chart.js"
	])
	.config(function ($stateProvider, $urlRouterProvider) {
	$stateProvider
		.state('login', {
			url:'/login',
			templateUrl: './views/loginPage.html',
			controller: 'userCheck as user'
		})
		.state('home', {
			url:'/home',
			templateUrl: './views/home.html',
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
			templateUrl: './views/lucroMensal.html',
			controller: 'graphDataCtrl as graph',
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
			templateUrl: './views/todosValores.html',
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