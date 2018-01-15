// CONTROLLER graphDataCtrl
angular
	.module("Consultas")
	.controller("graphDataCtrl", graphDataCtrl);

function graphDataCtrl($rootScope, $interval, graphDataFactory) {	
	var vm = this;

	//vars
	vm['graphType'] = 'line';	
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
		ano: undefined
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
			return vm.numAno(obj.ano);
		});

		console.log(vm['series']);;
	});

	factory.getData().then(function (response) {

		//vars
		var auxArray;
		x = 0;
		count = Math.round(response.data.length/12); 
		sliced = [];


		auxArray = response.data.map(function (obj) {
		  return obj.valor_total;
		});

		for(i = 1; i <= 12; i++) { //preenche 'meses' com nome de cada mes
			vm['meses'][i-1] = vm.numMes(i); //meses inicia com indice 0 a 11
		}

		for (i = 0; i < count; i++) {	
			if ( ((auxArray[x]||[]) === undefined) || ((auxArray[x]||[]) === undefined) )  {
				break;
			}
			else {								
				sliced = auxArray.slice(x, (x+12));			
				x = x + 12;	
				vm['valor_total'][i] = sliced;	
				sliced = [];	
			}
		}
	});

	function addData () {

		factory.setData(vm.graphDataAdd).then(function (response) {
			console.log(vm.graphDataAdd);
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

		vm.graphType = type;

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

	function numMes (mes) {
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
	};

};