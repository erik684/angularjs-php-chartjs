<?php //FUNÇÃO QUE VERIFICA OPÇÃO SELECIONADA PELO USUÁRIO E FILTRA AS INFORMAÇÕES ESCOLHIDAS.
$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");

	function resultadoFiltro($dbconnection) {

			if (isset($_GET['selectAno']) && isset($_GET['selectAno'])) {

			if (($_GET['selectAno'] == "todos") && ($_GET['selectMes'] == "todos")) {

				$sql = "SELECT id, ano, mes, SUM(valor) AS valor_total FROM consultas  
				GROUP BY ano, mes";

				$result = mysqli_query($dbconnection, $sql);

				return $result;			
			}

			if (($_GET['selectAno'] != "todos") && ($_GET['selectMes'] != "todos")) {
				$ano = $_GET['selectAno'];
				$mes = $_GET['selectMes'];

				$sql = "SELECT id, ano, mes, SUM(valor) AS valor_total FROM consultas  
				WHERE ano = $ano AND mes = $mes
				GROUP BY ano, mes";

				$result = mysqli_query($dbconnection, $sql);

				return $result;
			}

			if (($_GET['selectAno'] != "todos")) {
				$ano = $_GET['selectAno'];
				$mes = $_GET['selectMes'];

				$sql = "SELECT id, ano, mes, SUM(valor) AS valor_total FROM consultas
				WHERE ano = $ano 
				GROUP BY ano, mes";

				$result = mysqli_query($dbconnection, $sql);

				return $result;
			}

			if (($_GET['selectMes'] != "todos")) {
				$mes = $_GET['selectMes'];

				$sql = "SELECT id, ano, mes, SUM(valor) AS valor_total FROM consultas 
				WHERE mes = $mes
				GROUP BY ano, mes";	

				$result = mysqli_query($dbconnection, $sql);

				return $result;
			}
		}
		else {
			exit();
		}
}
$result = resultadoFiltro($dbconnection);

$auxjson = array();

while ($row = mysqli_fetch_array($result)) {
	$auxjson[] = $row;
}

header("Content-type: application/json");
echo json_encode($auxjson);
?>