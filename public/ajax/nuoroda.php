<?php
	
	include '../../../projects/grupe18/config.php';
	
	$nuoroda = 'klaida: nuoroda nesurasta';

	$id_nuorodos = intval ( $_GET [ 'id' ] );
	
	if ( $id_nuorodos > 0 ) {
	
		$gw_gauti_nuoroda =
				"
			SELECT 
				*
			FROM 
				`nuorodos`
			WHERE
				`id`= " . $id_nuorodos . "
				";

		$rs_nuoroda = $db -> query ( $gw_gauti_nuoroda );
		
		if ( $rs_nuoroda ) {
		
			$nuoroda = $rs_nuoroda -> fetch_assoc();
		}
	}
	
	echo json_encode ( $nuoroda );