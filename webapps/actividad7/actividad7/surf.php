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
					<h1><a href="index.html">Generador de Constancias de Eventos</a></h1>
				</div>
				<div class="clr"></div>
			</div>
			<form class="content" name="dashboard" method="post">
				<ul id="menu">
					<li><button type="submit" class="link" name="new" value="register" formaction="attachment.php">Registrar Evento</button></li>
				</ul>
				<div id="pitch">
					<h1>Gestion de la publicación, actualización y eliminación de distintos tipos de eventos.</h1>
					<p><em>Congresos, seminarios, talleres, etc. Así como la asistencia o inasistencia de los participantes.</em></p>
				</div>
				<?php
				 $db = new MySQL();
				 $SelectAttachmentsQry = "SELECT `ID`, `Name`, `Type` FROM `Attachments`";
				 $aresult = $db->query($SelectAttachmentsQry);
                 while ($Attachment = $aresult->fetch_assoc()) {
                     ?>
				<div class="col">
					<h2><input type="radio" name="attachment" value="<?php echo $Attachment['ID'];?>"> <?php echo $Attachment['Name'];?></h2>
					<p><?php echo $Attachment['Type'];?></p>
					<button type="submit" class="link" name="existing" value="manage" formaction="attachment.php">MORE</button>
				</div>
				<?php
                 }
				?>
				<div class="col last">
					<h2>Evento 3</h2>
					<p>About event.</p>
					<a class="link" href="#">MORE</a>
				</div>
				<div class="clr"></div>
				</form>
		</div>
	</body>
</html>