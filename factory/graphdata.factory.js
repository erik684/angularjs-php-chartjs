angular
	.module("Consultas")
	.factory("graphDataFactory", graphDataFactory);

function graphDataFactory ($http) {

	factory = {};

	factory.getData = function () {
		return $http.get("./includes/json_filtrar_valores.php?selectAno=todos&selectMes=todos");
	}

	factory.getYears = function () {
		return $http.get("./includes/json_filtrar_distinct_ano");
	}

	return factory;
};