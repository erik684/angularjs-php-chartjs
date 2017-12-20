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

