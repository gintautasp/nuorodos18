<?php

	class NuoroduSistema {
	
		public 
			$ar_atsiusta_nauja_nuoroda = false
			, $ar_atsiusti_pakeisti_nuorodos_duomenys = false
			, $ar_nurodyta_salinti_nuoroda = false
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
			
			if ( isset ( $_POST [ 'veiksmas' ] ) && (  $_POST [ 'veiksmas' ] == 'salinti' ) ) {
			
				$this -> ar_nurodyta_salinti_nuoroda = true;
			}
			
			if ( isset ( $_POST [ 'ieskoti' ] ) && (  $_POST [ 'ieskoti' ] == 'Ieškoti' ) ) {
			
				$this -> paieskos_fraze = $_POST [ 'paieskos_fraze' ];
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
		
			return $this -> ar_atsiusti_pakeisti_nuorodos_duomenys;
		}
		
		public function  issaugokPakeistaNuoroda() {
		
			$nuoroda_sena = new Nuoroda ( '', '', '', $_POST [ 'id_nuorodos'] );
			$nuoroda_sena -> pasiimtiDuomenis();
			
			$this -> zymos -> mazintiZymuKartojimosiKieki ( $nuoroda_sena ->zymos );
		
			$nuoroda  = new Nuoroda ( $_POST [ 'pav' ], $_POST [ 'url' ], $_POST [ 'zymos' ], $_POST [ 'id_nuorodos'] );
			$nuoroda -> pakeistiDuomenis();
			
			$this -> zymos -> atnaujintiZymas( $_POST [ 'zymos' ] ); 
		}
		
		public function  arNurodytaSalintiNuoroda() {
		
			return $this -> ar_nurodyta_salinti_nuoroda;
		}
	
		public function  pasalinkNuoroda() {
		
			// echo 'salinsim : ' . $_POST [ 'id_nuorodos_salinamos' ]; exit;
			$nuoroda_salinama = new Nuoroda ( '', '', '', $_POST [ 'id_nuorodos_salinamos' ] );
			$nuoroda_salinama -> pasalinti();
		}

		public function  gautiDuomenis() {

			$this -> nuorodos = new Nuorodos( $this -> pasirinkta_zyma, $this -> paieskos_fraze  );		
		
			$this -> nuorodos -> gautiSarasaIsDuomenuBazes();
			$this -> zymos -> gautiSarasaIsDuomenuBazes();
		}
	}
