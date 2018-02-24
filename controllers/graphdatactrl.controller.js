// CONTROLLER graphDataCtrl
angular
	.module("Consultas")
	.controller("graphDataCtrl", graphDataCtrl);

function graphDataCtrl($rootScope, $interval, graphDataFactory) {	
	var vm = this;

	//vars
	var currentTime = new Date();	
	vm['graphtype'] = 'line';	
	vm['options'] = {};
	vm['series'] = {};
	vm['meses'] = [];
	vm['ano'] = [];
	vm['valor_total'] = [];
	vm['options'] =	{
		title: { 
			display: true,
			text:'Gráfico com valor de consultas por Mês e Ano'
		},
		legend: { 
			display: true 
		}
	};


	//obj
	vm.graphDataAdd = {};
	vm.graphDialog = {};
	vm.graphView = {};

	//functions
	vm.addData = addData;
	vm.countAlert = countAlert;	
	vm.setGraphView = setGraphView;	
	vm.graphChange = graphChange;
	vm.numAno = numAno;
	vm.numMes = numMes;

	vm.graphDataAdd = {
		idade: undefined,
		valor: undefined,
		mes: undefined,
		ano: currentTime.getFullYear()
	};



	vm.graphDialog = {
		addData: false,
		delData: false,
		alterData: false
	};

	vm.graphView = {
		addData: false,
		addDataBtn: false,
		addDataConf: true
	};


	factory.getYears().then(function (response) { // series de datas em Ano
		vm['series'] = response.data.map(function(obj){
			return obj.ano;
		});
	});

	factory.getData().then(function (response) {

		//vars
		auxArray = [];
		auxArray['ano'] = [];
		auxArray['valor'] = [];
		
		
		count = Math.round(response.data.length/12); 
		sliced = [];

		for(i = 1; i <= 12; i++) { //preenche 'meses' com nome de cada mes
			vm['meses'][i-1] = vm.numMes(i); //meses inicia com indice 0 a 11
		}
		
		x = 0;
		i = 0;

		vm.series.forEach(function (currentValue, index) {

			while (vm['series'][i] == response.data[x].ano) {
				auxArray['valor'].push(response.data[x].valor_total);

				x++;
				if (response.data[x] == undefined) {
					break;
				}
			}
			vm['valor_total'][i] = auxArray['valor'];
			auxArray['valor'] = [];
			i++;

		});

	});

	function addData () {
		
		vm.graphDataAdd.ano = vm.graphDataAdd.ano.toString().slice(2);
		vm.graphDataAdd.mes = mesNum(vm.graphDataAdd.mes);
		factory.setData(vm.graphDataAdd).then(function (response) {

			if (response.data.status == "Registred") {
				vm.graphDialog.addData = true;
				vm.countAlert();
				// vm.$apply();
			} else {
				alert(response.data.status);
			}
		});

	};

	function countAlert () {
		vm.timer = 5;

		function count () {
		vm.timer--;			
		};

		timer = $interval(count, 1000, 5)
			.then(function() {
				vm.graphDialog.addData = false;
				vm.graphDialog.delData = false;
				vm.graphDialog.alterData = false;
			});
			
	};

	function setGraphView () {

		vm.graphView.addData = !vm.graphView.addData;
		vm.graphView.addDataBtn = !vm.graphView.addDataBtn;	

	};

	function graphChange (type) {

		vm.graphtype = type;

	};

	function roundValue (valor) {

		return (Math.round(valor));

	};

	function numAno (ano) {
		ano = parseInt(ano);

		switch(ano) {		
			case (parseInt(ano)):
			return ('20' + ano);

			default:
			return "Todos";
		}
	};

	function numMes (num) {
		switch(parseInt(num)) {

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
	};

	function mesNum (mes) {
		switch (mes) {

			case "Janeiro":
				return 1;
				break;	
			case "Fevereiro":
				return 2;
				break;				
			case "Março":
				return 3;
				break;
			case "Abril":
				return 4;
				break;
			case "Maio":
				return 5;
				break;
			case "Junho":
				return 6;
				break;
			case "Julho":
				return 7;
				break;
			case "Agosto":
				return 8;
				break;
			case "Setembro":
				return 9;
				break;
			case "Outubro":
				return 10;
				break;
			case "Novembro":
				return 11;
				break;
			case "Dezembro":
				return 12;
				break;
			default:
				return "Todos";

		}
	

	}

};