<?php 

header("Content-type: application/json");
$auxjson = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['PATH_INFO'] == "/graph") { //post graph data to Register
	

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata, true);	

	$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");

	if (isset($request['idade']) && isset($request['valor']) && isset($request['mes']) && isset($request['ano'])) {
		//checar os parametros
		$ano = $request['ano'];
		$mes = $request['mes'];
		$valor = $request['valor'];
		$idade = $request['idade'];		

		$sql = "INSERT INTO consultas (ano, mes, valor, idade)
				VALUES ($ano, $mes, $valor, $idade)";

		if ($result = mysqli_query($dbconnection, $sql)) {
			$auxjson['status'] = "Registred";
		} else {
			$auxjson['status'] = "Error: " + mysqli_error($dbconnection);
		}	

		echo json_encode($auxjson);
	}

	else {

		$auxjson['status'] = "Error: Params not given";
		echo json_encode($auxjson);
	}

} else if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['PATH_INFO'] == "/graph") { //get graph data
	
	$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");

	$sql = "SELECT id, ano, mes, SUM(valor) AS valor_total FROM consultas  
	GROUP BY ano, mes";

	if ($result = mysqli_query($dbconnection, $sql)) {

		while ($row = mysqli_fetch_array($result)) {
			$auxjson[] = $row;
		}
		
		echo json_encode($auxjson);
	}


} else {
	http_response_code(404);
}

?>