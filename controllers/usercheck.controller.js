//CONTROLLER userCheck
angular
	.module("Consultas")
	.controller("userCheck", userCheck);

function userCheck($scope, $rootScope, $state, user, userLogin) {

	//vars
	userLogin = {};
	userSingin = {};
	$scope.userDialog = {};
	$rootScope.userView = {};

	userLogin = {
		username: undefined,
		password: undefined
	};

	userSingin = {
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

		factory.login(data).then(function (response) {

		if (response.data.status == "Wrong username or password or user doesn't exist") {

			$scope.userDialog.userNExist = false;

		} else if (response.data.status == "User logged in") {

				user.setName = response.data.username;
				user.userLoggedIn();
				$rootScope.setUserView();
				$state.go('home');
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
};