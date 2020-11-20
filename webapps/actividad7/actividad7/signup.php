<?php
 //include('sessions.php');
 require('mysql.php');
 require('cryptex.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/screen.css" media="screen" />
		<title>Constancias Eventos</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<h1>Actualizar perfil</h1>
				</div>
				<div class="clr"></div>
			</div>
			<form name="attachment" method="post">
				<ul id="menu">
					<li><input type="text" name="username" placeholder="Nombre"></li>
					<li><input type="text" name="password" placeholder="Tipo"></li>
					<li><input type="text" name="names" placeholder="Nombres"></li>
					<li><input type="text" name="lastnames" placeholder="Apellidos"></li>
					<li><input type="date" name="birthdate" placeholder="<?php echo date('mm / dd / yyyy');?>"></li>
				</ul>
				<div class="buttons-container">
					<ul>
						<li><button type="submit" value="approve" formaction="update.php" class="approve"></button></li>
						<li><button type="submit" value="dismiss" formaction="surf.php" class="dismiss"></button><li>
					</ul>
				</div>
				<div class="clr"></div>
			</form>
		</div>
	</body>
</html>