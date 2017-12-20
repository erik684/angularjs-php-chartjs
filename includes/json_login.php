<?php 

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
$usuario = $request['username'];
$senha = $request['password'];

header("Content-type: application/json");

if (isset($usuario)) {

	$dbconnection = mysqli_connect("localhost", "root", "", "hospitais");
	$sql = "SELECT usuario FROM usuario WHERE
			usuario = '$usuario' AND
			senha = '$senha'";
			
	if ($result = mysqli_query($dbconnection, $sql)) {	

		header("Content-type: application/json");	
		$auxjson = array();
		while ($row = mysqli_fetch_array($result)) {
		$auxjson[] = $row;

		}	
		
		echo json_encode($auxjson);

	};
}
?>