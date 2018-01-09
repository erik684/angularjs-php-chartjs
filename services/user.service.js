//SERVICE user
angular
	.module("Consultas")
	.service('user', user);
	
function user() {

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
};