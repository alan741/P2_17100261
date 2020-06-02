<?php

error_reporting(0);
header('Content-type: application/json; charset=utf-8');

$conexion = new mysqli('localhost', 'root', '', 'empresa');

if($conexion->connect_errno){
	$respuesta = [
		'error' => true
	];
} else {
	$conexion->set_charset("utf8");
	$statement = $conexion->prepare("SELECT * FROM empleado");
	$statement->execute();
	$resultados = $statement->get_result();
	
	$respuesta = [];
	
	while($fila = $resultados->fetch_assoc()){
		$usuario = [
			'id' 		=> $fila['id'],
			'nombre' 	=> $fila['Nombre'],
			'apellido'		=> $fila['Apellido'],
                        'puesto'		=> $fila['Puesto'],
		];
		array_push($respuesta, $usuario);
	}
}

echo json_encode($respuesta);
?>
