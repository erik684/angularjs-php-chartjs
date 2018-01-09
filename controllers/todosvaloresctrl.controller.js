// CONTROLLER todosValoresCtrl
angular
	.module("Consultas")
	.controller("todosValoresCtrl", todosValoresCtrl);

function todosValoresCtrl($scope, $http) {
	
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
};