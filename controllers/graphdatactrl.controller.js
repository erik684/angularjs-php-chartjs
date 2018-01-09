// CONTROLLER graphDataCtrl
angular
	.module("Consultas")
	.controller("graphDataCtrl", graphDataCtrl);

function graphDataCtrl($scope, graphDataFactory) {	

	$scope.graphType = 'line';

	$scope['options'] = 
	{	
		title: { 
			display: true,
			text:'Gráfico com valor de consultas por Mês e Ano'
		},
		legend: { 
			display: true 
		}
	};

	factory.getYears().then(function (response) { // series de datas em Ano
		$scope['series'] = response.data.map(function(obj){
		return $scope.numAno(obj.ano);
		});
	});

	factory.getData().then(function (response) {

		//vars
		var auxArray;
		x = 0;
		count = Math.round(response.data.length/12); 
		sliced = [];
		$scope['meses'] = [];
		$scope['ano'] = [];
		$scope['valor_total'] = [];

		auxArray = response.data.map(function (obj) {
		  return obj.valor_total;
		});

		for(i = 1; i <= 12; i++) { //preenche 'meses' com nome de cada mes
			$scope['meses'][i-1] = $scope.numMes(i); //meses inicia com indice 0 a 11
		}

		for (i = 0; i < count; i++) {	
			if ( ((auxArray[x]||[]) === undefined) || ((auxArray[x]||[]) === undefined) )  {
				break;
			}
			else {								
				sliced = auxArray.slice(x, (x+12));			
				x = x + 12;	
				$scope['valor_total'][i] = sliced;	
				sliced = [];	
			}
		}
	});

	$scope.graphChange = function (type) {
		$scope.graphType = type;
	}

	$scope.roundValue = function(valor) {
		return (Math.round(valor));
	}

	$scope.numAno = function (ano) {
		ano = parseInt(ano);

		switch(ano) {		
			case (parseInt(ano)):
			return ('20' + ano);

			default:
			return "Todos";
		}
	}

	$scope.numMes = function (mes) {
		switch(parseInt(mes)) {

			case 1:
				return "Janeiro";
				break;	
			case 2:
				return "Fevereiro";
				break;				
			case 3:
				return "Março";
				break;
			case 4:
				return "Abril";
				break;
			case 5:
				return "Maio";
				break;
			case 6:
				return "Junho";
				break;
			case 7:
				return "Julho";
				break;
			case 8:
				return "Agosto";
				break;
			case 9:
				return "Setembro";
				break;
			case 10:
				return "Outubro";
				break;
			case 11:
				return "Novembro";
				break;
			case 12:
				return "Dezembro";
				break;
			default:
				return "Todos";

		}
	}

};