<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuorodų sistema</title>
	<style>
		#nuorodu_forma {
			width: 63%;
			padding: 12px;
		}
		#zymu_sarasas, #paieska {
			float: right;
			width: 28%;
			padding: 12px;
			margin-right: 20px;
			/* border: 1px solid grey; */
			margin-top: 12px;
			clear: right;
		}
		label {
			display: block;
		}
		input[type=url], input[type=text], input[type=search]  {
			width: 79%;
			margin-bottom: 17px;
			margin-top: 3px;
			padding: 7px 4px;
		}
		#saugoti {
			float: right;
			width: 16%;
			margin-top: -60px;
			padding-top:  80px;
			padding-bottom: 80px;
		}
		#ieskoti {
			width: 16%;		
			padding-top:  12px;
			padding-bottom: 12px;			
		}
		ul {
			list-style-type: none;
		}
		ul li {
			padding-top: 7px;
		}
		.data {
			float: right;
			margin-right: 40%;
			font-size: 85%;
			color: grey;
		}
		a {
			color: DarkGreen;
			text-decoration: none;
		}
		a:hover {
			text-decoration: underline;
		}
		#pasirinkta_zyma {
		
			background-color: yellow;
		}
	</style>
	<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
	<script>
		$( document ).ready ( function() {
		
			function duomenys_formai ( id_nuorodos, url, pav, zymos ) {
			
				$( '#id_nuorodos' ).val ( id_nuorodos );
				$( '#url' ).val ( url );
				$( '#pav' ).val ( pav );
				$( '#zymos' ).val ( zymos );
			}
		
			$( '.redaguoti_nuoroda' ).each ( function() {
			
				$( this ).click ( function() {
					
					id_nuorodos = $( this ).data( 'id_nuorodos' );

					$.get( 'ajax/nuoroda.php?id=' + id_nuorodos, function( data ) {
			
						if ( data.substring( 0, 7 ) == 'klaida:' ) { 
				
							$( '#result' ).html( data );
						
						} else {
					
							nuoroda = JSON.parse ( data );
							duomenys_formai ( nuoroda.id, nuoroda.url, nuoroda.pav, nuoroda.zymos );
						}
					});
				});
			});

			$( '.salinti_nuoroda' ).each ( function() {
			
				$( this ).click ( function() {
					
					id_nuorodos = $( this ).data( 'id_nuorodos' );
				
					$.get( 'ajax/nuoroda.php?id=' + id_nuorodos, function( data ) {
			
						if ( data.substring( 0, 7 ) == 'klaida:' ) { 
				
							$( '#result' ).html( data );
						
						} else {
				
							nuoroda = JSON.parse ( data );
							if  ( confirm( 'Ar tikrai norite pašalinti nuorodą?\n\n' + nuoroda.pav + '\n' + nuoroda.url  ) == true ) {
					
								$( '#salinti' ).val ( 'salinti' );
								$( '#id_nuorodos_salinamos' ).val ( nuoroda.id );
								$( '#salinimo_forma' ).submit();
							}
						}
					});
				});
			});
				
/*		
			$( '#ajax_testas' ).click ( function() {
		
				$.get( 'ajax/nuoroda.php?id=7', function( data ) {
				
					$( '#result' ).html( data );
				});
			});		
		
			$( '#ajax_testas' ).click ( function() {
		
				$.get( 'ajax/test.html', function( data ) {
				
					$( '#result' ).html( data );
					alert( "Load was performed." ); 
					});
			});
*/
		});
	</script>
</head>
<body>
<div id="paieska">
	<form method="POST" action="">
		<input type="search" name="paieskos_fraze" id="paieskos_fraze">
		<input type="submit" name="ieskoti" id="ieskoti" value="Ieškoti">
	</form>
</div>
<div id="zymu_sarasas">
<?php
	$pasirinkta_zyma = 'visos';
	
	if ( isset ( $_GET [ 'zyma' ] ) ) {
		
		$pasirinkta_zyma = $_GET [ 'zyma' ];
	}
?>
	<h3>Žymų sarašas</h3>
	<a href="?zyma=visos"<?= ( $pasirinkta_zyma == 'visos' ) ?  ' id="pasirinkta_zyma"' : '' ?>>visos</a>
<?php
	foreach ( $nuorodu_sistema -> zymos -> sarasas as $zyma ) {
?>
	<a href="?zyma=<?= $zyma [ 'zyma' ] ?>"<?= ( $pasirinkta_zyma == $zyma [ 'zyma' ]  ) ?  ' id="pasirinkta_zyma"' : '' ?>><?= $zyma [ 'zyma' ] ?></a>	
<?php
	}
?>
</div>
<div id="nuorodu_forma">
<form method="POST" action="">
<input type="submit" name="saugoti" id="saugoti" value="Saugoti">
<label>Nuoroda</label>
<input type="url" name="url" id="url">
<label>Pavadinimas</label>
<input type="text" name="pav" id="pav">
<label>Žymos</label>
<input type="text" name="zymos" id="zymos">
<input type="hidden" name="id_nuorodos" id="id_nuorodos" value="0">
</form>
</div>
<div id="nuorodu_sarasas">
	<ul>
<?php

		foreach ( $nuorodu_sistema -> nuorodos -> sarasas as $nuoroda ) {
?>
		<li>
			<input type="button" value="&#10006;"  data-id_nuorodos="<?= $nuoroda [ 'id' ]  ?>" class="salinti_nuoroda"> 
			<input type="button" value="&#9998;" data-id_nuorodos="<?= $nuoroda [ 'id' ]  ?>" class="redaguoti_nuoroda"> 
			<a href="<?= $nuoroda [ 'url' ] ?>" target="blank"><?= $nuoroda [ 'pav' ] ?></a><span class="data"><?= $nuoroda ['data' ] ?></span>
		</li>
<?php
		}
?>
	</ul>
	<!-- input type="button" value="ajax textas" id="ajax_testas" -->
	<div id="result">
	</div>
</div>
<form method="POST" action="" id="salinimo_forma">
<input type="hidden" name="id_nuorodos_salinamos" id="id_nuorodos_salinamos" value="0">
<input type="hidden" name="veiksmas" id="salinti" value="nesalinti">	
</form>
</body>
</html>