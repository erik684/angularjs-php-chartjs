<?php 

// header("Content-type: application/json");
$auxjson = [];

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SERVER['PATH_INFO'] == "/usuariologgin") { //user login

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata, true);

		if (isset($request['username']) && isset($request['password'])) {		

		$usuario = $request['username'];
		$senha = md5($request['password']);

		if(checkUser($usuario) != true) { //verificar se usuário ja existe no banco

			$auxjson["status"] = "Wrong username or password or user doesn't exist";
			echo json_encode($auxjson);

		} else {

			$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");
			$sql = "SELECT usuario FROM usuario WHERE
					usuario = '$usuario' AND
					senha = '$senha'";
					
			if ($result = mysqli_query($dbconnection, $sql)) {
				//usuário login
				$row = [];
				$row = mysqli_fetch_assoc($result);
				if ($row['usuario'] == $usuario) {
					session_start();
					$_SESSION['usuario'] = $row['usuario'];
					// $_SESSION['session_id'] = hash(5);
					$auxjson["status"] = "User logged in";
					$auxjson["username"] = $row['usuario'];
					echo json_encode($auxjson);
				} else {
					$auxjson["status"] = "Wrong username or password or user doesn't exist";
					echo json_encode($auxjson);
				}

			} else {

				$auxjson["status"] = "Error while trying to loggin";
				echo json_encode($auxjson);

			};
		}
	};
}

else if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SERVER['PATH_INFO'] == "/usuario") { //user singin

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata, true);

		if (isset($request['username'])) {

			header("Content-type: application/json");
			
			$usuario = $request['username'];
			$senha = md5($request['password']);

			if (checkUser($usuario) == true) {
				$auxjson['status'] = "User already exists";
				echo json_encode($auxjson);
			} else {

				$sql = "INSERT INTO usuario (usuario, senha) VALUES ('$usuario', '$senha')";

				$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");
				if ($result = mysqli_query($dbconnection, $sql)) {
					$auxjson['status'] = "User registred";
					echo json_encode($auxjson);
					http_response_code(200);

				} else {
					$auxjson['status'] = mysqli_error($dbconnection);
					echo json_encode($auxjson);
					http_response_code(400);
				};
			};

		} else {
			$auxjson['status'] = "Params not given, NEED 'username' and 'password'";
			echo json_encode("Params not given, NEED 'username' and 'password'");
		};
};

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