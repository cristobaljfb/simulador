<?php

// Funcion que se utiliza para llenar la malla por primera vez.
function generar_data($carrera, $mysqli)
{
	$stmt = $mysqli->prepare("SELECT creditosNodo, codigoNodo, nombreNodo, semestreMalla, columnaMalla,
			 pre_1, pre_2, pre_3, pre_4 FROM ramos WHERE nombreMalla = ? ORDER BY nodoId ASC");
	$stmt->bind_param('s', $carrera);  // Bind "$carrera" to parameter.
	$stmt->execute();    // Execute the prepared query.
	$stmt->store_result();
	
	$stmt->bind_result($creditosNodo, $codigoNodo, $nombreNodo, $semestreMalla, $columnaMalla, $pre_1, $pre_2, $pre_3, $pre_4);
	while($stmt->fetch())
	{
		echo "{'codigo':'".$codigoNodo."', 'name':'".$nombreNodo."', 'creditos':'".$creditosNodo."', 'pre1':'".$pre_1."', 'pre2':'".$pre_2."',
 					'pre3':'".$pre_3."', 'pre4':'".$pre_4."', 'status':'ok', 'col':".$semestreMalla.",
 							'row':".$columnaMalla.",	'size_x': 1,	'size_y': 1},";
	}
}

// Se genera un arreglo con los códigos de cada carrera para ver su posición(id) cuando se realiza la validación.

function generar_array($carrera, $mysqli)
{
	$stmt = $mysqli->prepare("SELECT codigoNodo FROM ramos WHERE nombreMalla = ? ORDER BY nodoId ASC");
	$stmt->bind_param('s', $carrera);  // Bind "$carrera" to parameter.
	$stmt->execute();    // Execute the prepared query.
	$stmt->store_result();
	
	$stmt->bind_result($codigoNodo);
	while($stmt->fetch())
	{
		echo ' "'.$codigoNodo.'" , ';
	}
	
}