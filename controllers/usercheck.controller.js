//CONTROLLER userCheck
angular
	.module("Consultas")
	.controller("userCheck", userCheck);

function userCheck($rootScope, $state, $interval, user, userLogin) {
	var vm = this;

	//vars
	vm.timer;

	//obj
	vm.userLogin = {};
	vm.userSingin = {};
	vm.userDialog = {};
	$rootScope.userView = {};

	//functions
	vm.countAlert = countAlert;
	vm.loginCheck = loginCheck;
	vm.singinCheck = singinCheck;


	vm.userLogin = {
		username: undefined,
		password: undefined
	};

	vm.userSingin = {
		username: undefined,
		password: undefined,
		password2: undefined
	}

	$rootScope.userView = { //mostrar/esconder menu para usuário
		lucroBtn: false,
		tdvaloresBtn: false,
		logoutBtn: false,		
		userLogout: function() {
			user.userLogout();
			$rootScope.userView.lucroBtn = false;
			$rootScope.userView.tdvaloresBtn = false;
			$rootScope.userView.logoutBtn = false;
			$state.reload();
			}
		}


	vm.userDialog = { //mostrar/esconder dialogos para usuário
		passwordMatch: false, //password combina
		userNotMatch: false, //usuário já existe
		userRegistred: false, //usuário registrado
		userNExist: false //usuário não registrado
	};

	//functions
	$rootScope.setUserView = function () {
		$rootScope.userView.lucroBtn = true;
		$rootScope.userView.tdvaloresBtn = true;
		$rootScope.userView.logoutBtn = true;

	};

	function countAlert () {
		vm.timer = 5;

		function count () {
			vm.timer--;			
		};

		timer = $interval(count, 1000, 5)
			.then(function() {
				vm.userDialog.passwordMatch = false;
				vm.userDialog.userNotMatch = false;
				vm.userDialog.userRegistred = false;
				vm.userDialog.userNExist = false;
			});

	};

	function loginCheck () {

		data = {
			"username": vm.userLogin.username,
			"password": vm.userLogin.password
		};

		factory.login(data).then(function (response) {

		if (response.data.status == "Wrong username or password or user doesn't exist") {

			vm.userDialog.userNExist = true;
			vm.countAlert();

		} else if (response.data.status == "User logged in") {

				user.setName = response.data.username;
				user.userLoggedIn();
				$rootScope.setUserView();
				$state.go('home');
			};			
		});

	};

	function singinCheck () {

		var userSingin = {
			username: vm.userSingin.username,
			password: vm.userSingin.password,
			password2: vm.userSingin.password2
		};

		if (userSingin.password != userSingin.password2) { // se passsword não combina

			vm.userDialog.passwordMatch = true;
			vm.countAlert();

		} else {

			//verifica request se usuário existe			
			data = {
				"username": userSingin.username,
				"password": userSingin.password
			};

			factory.singin(data).then(function (response) {

				if (response.data.status == "User registred") {

					vm.userDialog.userRegistred = true;
					vm.countAlert();

				} else if (response.data.status == "User already exists") {			

					vm.userDialog.userNotMatch = true;
					vm.countAlert();

				};
			});
		};

	};

};