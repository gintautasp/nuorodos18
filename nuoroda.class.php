<?php

	class Nuoroda {
	
		public $id,	$pav, $url, $zymos, $db;	

		function __construct( $pav, $url, $zymos, $id = 0 ) {
		
			global $db;
		
			$this -> db = $db;	
			
			$this -> id =$this -> db -> real_escape_string ( $id );
			$this -> pav = $this -> db -> real_escape_string ( $pav );
			$this -> url = $this -> db ->  real_escape_string ( $url );
			$this -> zymos = $this -> db -> real_escape_string ( $zymos );
			// print_r ( $this );
		}
		
		public function pakeistiDuomenis() {
		
			$qw_pakeisti_duomenis =
					"
				UPDATE `nuorodos`
				SET
					`url`='" . $this -> url . "'
					, `pav`='" . $this -> pav . "'				
					, `zymos`='" . $this -> zymos . "'
				WHERE
					`id`=" . $this -> id . "
					";
																																	//	echo $qw_pakeisti_duomenis;
			$this -> db -> query ( $qw_pakeisti_duomenis );
		}		
	
		public function issaugotiNauja() {

			$qw_saugoti = 
					"
				INSERT INTO `nuorodos` ( `pav`, `url`, `zymos`)
				VALUES ( '" . $this -> pav  . "',  '" . $this -> url  . "',  '" . $this -> zymos  . "' )
					";				
																																	// echo $qw_saugoti; exit;
			$this -> db -> query ( $qw_saugoti );
		}	
		
		public function pasiimtiDuomenis() {

			$qw_gauti_nuoroda =
					"
				SELECT 
					*
				FROM
					`nuorodos`
				WHERE
					`id`= " . $this -> id . "
					";
			$rs_list = $this -> db -> query ( $qw_gauti_nuoroda );
			
			if ( $row = $rs_list -> fetch_assoc() ) {
			
				$this -> url = $row [ 'url' ];
				$this -> pav = $row [ 'pav' ];
				$this -> zymos = $row [ 'zymos' ];				
			}
		}		

		public function pasalinti() {
		
			$qw_pasalinti =
					"
				DELETE FROM `nuorodos`
				WHERE
					`id`=" . $this -> id . "
					";
																																	//	echo $qw_issaugoti_nauja;
			$this -> db -> query ( $qw_pasalinti );		
		}		
	}