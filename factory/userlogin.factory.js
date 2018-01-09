angular
	.module("Consultas")
	.factory("userLogin", userLogin);

function userLogin ($http) {

	factory = {};

	factory.login = function (data) {
		return $http.post("./includes/json_login.php/usuariologgin", data);
	}

	factory.singin = function (data) {
		return $http.post("./includes/json_login.php/usuario", data);
	}

	return factory;
};