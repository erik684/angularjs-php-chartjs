<?php //FUNÇÃO QUE VERIFICA OPÇÃO SELECIONADA PELO USUÁRIO E FILTRA AS INFORMAÇÕES ESCOLHIDAS.
$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");

function resultadoFiltro($dbconnection) {
	$sql = "SELECT DISTINCT ano FROM consultas";
	$result = mysqli_query($dbconnection, $sql);	

	return $result;
}

$result = resultadoFiltro($dbconnection);

$auxjson = array();

while ($row = mysqli_fetch_array($result)) {
	$auxjson[] = $row;
}

header("Content-type: application/json");
echo json_encode($auxjson);
?>