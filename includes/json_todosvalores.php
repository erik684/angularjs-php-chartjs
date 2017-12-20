<?php
include_once("conexao_bd.php");

$sql = "SELECT idade, valor, ano, mes FROM consultas";

$result = mysqli_query($dbconnection, $sql);

$auxjson = array();

while ($row = mysqli_fetch_array($result)) {
	$auxjson[] = $row;
}

header("Content-type: application/json");
echo json_encode($auxjson);
?>