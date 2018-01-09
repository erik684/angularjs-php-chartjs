angular
	.module("Consultas", [ 
		"ui.router", 
		"chart.js"
	])
	.config(function ($stateProvider, $urlRouterProvider) {
	$stateProvider
		.state('login', {
			url:'/login',
			templateUrl: './views/loginPage.php',
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