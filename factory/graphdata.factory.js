angular
	.module("Consultas")
	.factory("graphDataFactory", graphDataFactory);

function graphDataFactory ($http) {

	factory = {};

	factory.getData = function () {
		return $http.get("./includes/json_graph_api.php/graph");
	}

	factory.getYears = function () {
		return $http.get("./includes/json_filtrar_distinct_ano");
	}

	factory.setData = function (data) {
		return $http.post("./includes/json_graph_api.php/graph", data)
	}

	return factory;
};