angular
	.module("Consultas")
	.factory("graphAdd", graphAdd);

function graphAdd ($http) {
	factory = {}
	factory.graphAdd = function () {
		$http.post('./includes/json_cadastrar_dados.php/graph');
	};	

}