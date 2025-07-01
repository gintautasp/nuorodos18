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
		#zymu_sarasas {
			float: right;
			width: 28%;
			padding: 12px;
			margin-right: 20px;
			/* border: 1px solid grey; */
			margin-top: 12px;
		}
		label {
			display: block;
		}
		input[type=url], input[type=text] {
			width: 79%;
			margin-bottom: 17px;
			margin-top: 3px;
			padding: 7px 4px;
		}
		#saugoti {
			float: right;
			width: 16%;
			margin-top: 20px;
			padding-top:  80px;
			padding-bottom: 80px;
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
	</style>
</head>
<body>
<div id="zymu_sarasas">
	<h3>Žymų sarašas</h3>
	<a href="?zyma=visos">visos</a>
</div>
<div id="nuorodu_forma">
<input type="submit" name="saugoti" id="saugoti" value="Saugoti">
<label>Nuoroda</label>
<input type="url" name="nuoroda" id="nuoroda">
<label>Pavadinimas</label>
<input type="text" name="pav" id="pav">
<label>Žymos</label>
<input type="text" name="zymos" id="zymos">
</div>
<div id="nuorodu_sarasas">
	<ul>
		<li><input type="button" value="&#10006;"> <input type="button" value="&#9998;"> <a href="https://wwv.mp3juice.vet/convert">mp3 atsisiuntimo svetainė</a><span class="data">2025-05-23</span></li>
		<li><input type="button" value="&#10006;"> <input type="button" value="&#9998;"> <a href="https://meteofor.lt/weather-kaunas-4202/">orai Kaune</a><span class="data">2025-03-11</span></li>
	</ul>
</div>
</body>
</html>