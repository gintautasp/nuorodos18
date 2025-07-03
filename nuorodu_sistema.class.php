<?php

	class NuoroduSistema {
	
		public 
			$ar_atsiusta_nauja_nuoroda = false
			, $ar_atsiusti_pakeisti_nuorodos_duomenys = false
			, $nuorodos, $zymos, 	$pasirinkta_zyma = '', $paieskos_fraze = ''	;
		
		public function __construct() {
		
			$this -> zymos = new Zymos();
		}
	
		public function tikrintiUzklausosDuomenis() {
		
			if ( isset ( $_POST [ 'saugoti' ] ) && (  $_POST [ 'saugoti' ] == 'Saugoti' ) ) {
			
				if ( intval ( $_POST [ 'id_nuorodos' ]  ) > 0 ) {
				
					$this -> ar_atsiusti_pakeisti_nuorodos_duomenys = true;
	
				} else {
				
					$this -> ar_atsiusta_nauja_nuoroda  = true;			
				}
			}		
			// echo $this -> ar_atsiusta_nauja_nuoroda . '?';
			
			if ( isset ( $_GET [ 'zyma' ] ) && ( $_GET [ 'zyma' ] != 'visos' ) ) {
			
				$this -> pasirinkta_zyma = $_GET [ 'zyma' ];
			}
		}
	
		public function arGautaNaujaNuoroda() {
		
			return $this -> ar_atsiusta_nauja_nuoroda ;
		}
		
		public function issaugokNaujaNuoroda() {

			$nuoroda  = new Nuoroda ( $_POST [ 'pav' ], $_POST [ 'url' ], $_POST [ 'zymos' ] );
			$nuoroda -> issaugotiNauja();
			$this -> zymos -> atnaujintiZymas( $_POST [ 'zymos' ] ); 
		}
		
		public function arGautaPakeistaNuoroda() {
		
			return false;
		}
		
		public function  issaugokPakeistaNuoroda() {
		
		}
		
		public function  arNurodytaSalintiNuoroda() {
		
		}
	
		public function  pasalinkNuoroda() {
		
		}

		public function  gautiDuomenis() {

			$this -> nuorodos = new Nuorodos( $this -> pasirinkta_zyma, $this -> paieskos_fraze  );		
		
			$this -> nuorodos -> gautiSarasaIsDuomenuBazes();
			$this -> zymos -> gautiSarasaIsDuomenuBazes();
		}
	}
