<div class="container">
<hr>
	<form ng-submit="addData()" class="form-group">
		<div class="row">
			<div class="col-md-3 form-group" ng-show="graphView.addData">
				<input class="form-control" type="number" placeholder="Idade" ng-model="graphAdd.idade">
			</div>

			<div class="col-md-3 form-group" ng-show="graphView.addData">
				<input class="form-control" type="number" placeholder="Valor" ng-model="graphAdd.valor">
			</div>

			<div class="col-md-3 form-group" ng-show="graphView.addData">
				<input class="form-control" type="text" placeholder="Mes" ng-model="graphAdd.mes">			
			</div>
			<div class="col-md-3 form-group" ng-show="graphView.addData">
				<input class="form-control" type="text" placeholder="Ano" ng-model="graphAdd.ano">
			</div>	
			<div class="col-md-12 form-group" ng-show="graphView.addDataBtn">
				<button id="btn_add" name="btn_add" class="btn btn-success" type="submit">Adicionar</button>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 form-group">
				<button class="btn btn-primary" ng-click="setGraphView()" type="button"><span class="fa fa-cog"> Opções</span></button>
			</div>
		</div>
	</form>
</div>


<!-- CONTAINER CANVAS-CHARTJS -->
<div class="container"> 

<form action="">
	<label for="">Escolha o tipo de gráfico: </label><br>
	<input type="radio" name="type" ng-click="graphChange('line')" checked> Line
	<input type="radio" name="type" ng-click="graphChange('bar')"> Bar
	<input type="radio" name="type" ng-click="graphChange('polarArea')">	Polar Area 
	<input type="radio" name="type" ng-click="graphChange('radar')"> Radar 
	<input type="radio" name="type" ng-click="graphChange('doughnut')"> Doughnut
</form>

	<canvas id="base" class="chart chart-base"
	chart-type="graphType"
	chart-data="valor_total"
	chart-labels="meses"
	chart-series="series"
	chart-options="options">
	</canvas>

</div>

