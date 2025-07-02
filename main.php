<?php

	include 'config.php';

	include 'zymos.class.php';
	include 'nuoroda.class.php';
	include 'nuorodos.class.php';
	include 'nuorodu_sistema.class.php';

	$nuorodu_sistema = new NuoroduSistema();

	$nuorodu_sistema -> tikrintiUzklausosDuomenis();
	
	if ( $nuorodu_sistema -> arGautaNaujaNuoroda() ) {
	
		$nuorodu_sistema -> issaugokNaujaNuoroda();
	}
		
	if ( $nuorodu_sistema -> arGautaPakeistaNuoroda() ) {
	
		$nuorodu_sistema -> issaugokPakeistaNuoroda();
	}
		
	if ( $nuorodu_sistema -> arNurodytaSalintiNuoroda() ) {
	
		$nuorodu_sistema -> pasalinkNuoroda();
	}
	$nuorodu_sistema -> gautiDuomenis();

	include 'main.html.php';