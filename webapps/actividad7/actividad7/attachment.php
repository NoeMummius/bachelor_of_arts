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
					<h1>Actualizar evento</h1>
				</div>
				<div class="clr"></div>
			</div>
			<form name="attachment" method="post">
				<ul id="menu">
					<li><input type="text" name="name" placeholder="Nombre"></li>
					<li><input type="text" name="type" placeholder="Tipo"></li>
					<li><input type="date" name="sdate" placeholder="<?php echo date('mm / dd / yyyy');?>"></li>
					<li><input type="time" name="shour" placeholder="<?php echo localtime();?>"></li>
					<li><input type="date" name="edate" placeholder="<?php echo date('mm / dd / yyyy');?>"></li>
					<li><input type="time" name="ehour" placeholder="<?php echo localtime();?>"></li>
					<li><textarea name="desc" placeholder="Descripción"></textarea></li>
				</ul>
				<div class="buttons-container">
					<ul>
						<li><button type="submit" value="approve" formaction="update.php" class="approve"></button></li>
						<li><button type="submit" value="dismiss" formaction="dashboard.php" class="dismiss"></button><li>
					</ul>
				</div>
				<div class="clr"></div>
			</form>
		</div>
	</body>
</html>