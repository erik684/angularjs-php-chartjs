<?php 

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
$usuario = $request['username'];
$senha = $request['password'];

// header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SERVER['PATH_INFO'] == "/userloggin") {
	$auxjson = array();

		if (isset($usuario)) {

		$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");
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
else if ($_SERVER['REQUEST_METHOD'] == "GET" && $_SERVER['PATH_INFO'] == "/userloggin") {
	echo 'tsete';
}
?>