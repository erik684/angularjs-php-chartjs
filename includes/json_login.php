<?php 

$auxjson = [];



if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SERVER['PATH_INFO'] == "/userloggin") { //user login
	$auxjson = array();

		if (isset($request['username'])) {

		$usuario = $request['username'];
		$senha = $request['password'];


		$sql = "SELECT usuario FROM usuario WHERE
				usuario = '$usuario' AND
				senha = '$senha'";
				
		if ($result = mysqli_query($dbconnection, $sql)) {	

			while ($row = mysqli_fetch_array($result)) {
			$auxjson[] = $row;
			}	
			
			echo json_encode($auxjson);

		} else {
			echo 'teste';
			$auxjson[] = "Not found";
			echo json_encode($auxjson);

		};
	};
}

else if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SERVER['PATH_INFO'] == "/usuario") { //user singin

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

	if (isset($request['username'])) {

		header("Content-type: application/json");
		
		$usuario = $request['username'];
		$senha = $request['password'];

		if (checkUser($usuario) == true) {
			echo json_encode("User already exists");
		} else {
			$sql = "INSERT INTO usuario (usuario, senha) VALUES ('$usuario', '$senha')";

			$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");
			if ($result = mysqli_query($dbconnection, $sql)) {
				echo json_encode("User registred");
				http_response_code(200);

			} else {
				echo json_encode(mysqli_error($dbconnection));
				http_response_code(400);
			}
		}

	} else {
		echo json_encode("Params not given, NEED 'username' and 'password'");
	}
}

function checkUser($usuario){
	$sql = "SELECT usuario FROM usuario WHERE
	usuario = '$usuario'";

	$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");
	$result = mysqli_query($dbconnection, $sql);
	$row = mysqli_fetch_array($result);

	if (!empty($row)) { //verifica se o existe usuário no banco
		return true;
	} else {
		return false;
	}
}
?>