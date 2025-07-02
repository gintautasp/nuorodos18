<?php

	class Zymos {
	
		public $sarasas, $db;
	
		public function __construct() {
		
			global $db;
		
			$this -> db = $db;
		}
		
		public function gautiZymuSarasa ( $zymos ) {
		
			$lst_zymos = explode ( ',', $zymos );
			
			$i = 0;
			foreach ( $lst_zymos as $zyma ) {
			
				$lst_zymos [ $i ] = trim ( $zyma );
				$i++;
			}
			return $lst_zymos;
		}
		
		public function atnaujintiZymas ( $zymos ) {
		
			$lst_zymos = $this -> gautiZymuSarasa ( $zymos );
			
			if ( ( $lst_zymos ) && ( $lst_zymos [ 0 ] != '' ) ) {
			
				$qw_iterpti_zymas =
						"
					INSERT INTO `zymos` ( `zyma` )
					VALUES (
						'" . implode ( "' ), ( '", $lst_zymos ) . "'
					)
					ON DUPLICATE KEY UPDATE `kiek_kartojasi`=`kiek_kartojasi`+1
						";
																																			// echo $qw_iterpti_zymas; exit;						
				$this -> db -> query ( $qw_iterpti_zymas );
			}
		}
		
		public function mazintiZymuKartojimosiKieki ( $zymos ) {
		
			$lst_zymos = $this -> gautiZymuSarasa ( $zymos );
			
				$qw_mazinti_zymu_pasikartojimo_kieki =
						"
					UPDATE `zymos`
					SET `kiek_kartojasi`=`kiek_kartojasi`-1
					WHERE
						`zyma` IN('" . implode ( "', '", $lst_zymos ) . "')
						";
				$this -> db -> query ( $qw_mazinti_zymu_pasikartojimo_kieki );
																																// echo $qw_mazinti_zymu_pasikartojimo_kieki;
		}
		
		public function gautiSarasaIsDuomenuBazes() {

			$gw_gauti_sarasa =
					"
				SELECT 
					*
				FROM 
					`zymos`
				WHERE
					`kiek_kartojasi`>0
				ORDER BY
					`kiek_kartojasi` DESC
					";
			/*
			print_r( $_POST );
			echo $gw_gauti_sarasa;
			*/
			$rs_list = $this -> db -> query ( $gw_gauti_sarasa );
			
			while ( $row = $rs_list -> fetch_assoc() ) {
					
				$this -> sarasas[] = $row;
			}
		}		
	}