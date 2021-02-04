<?php
 include('sessions.php');
 require('mysql.php');
 require('cryptex.php');
 $User = Cryptex::decrypt($_SESSION['Username']);
 if (isset($_GET['result'])) {
     if ($_GET['result']) {
         echo '<script type="text/javascript">alert("Actualización exitosa");</script>';
     } else {
         echo '<script type="text/javascript">alert("Ocurrió un error durante la carga.");</script>';
     }
 }
 if (isset($_GET['cancel'])) {
     if ($_GET['cancel']) {
         echo '<script type="text/javascript">alert("Cancelación exitosa");</script>';
     } else {
         echo '<script type="text/javascript">alert("Ocurrió un error durante la carga.");</script>';
     }
 }
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
				<form class="content" name="appointments" method="post">
				<ul id="menu">
					<li><label class="username" name="username"><?php echo utf8_decode(Cryptex::decrypt($_SESSION['Username'])).' '.utf8_decode(Cryptex::decrypt($_SESSION['Birthname']));?></label></li>
					<li><button type="submit" class="signin" name="logout" value="logout" formaction="logout.php">Salir</button></li>
				</ul>
				<div id="pitch">
					<h1>Gestion de la publicación, actualización y eliminación de distintos tipos de eventos.</h1>
					<p><em>Congresos, seminarios, talleres, etc. Así como la asistencia o inasistencia de los participantes.</em></p>
				</div>
				<h3>Eventos a los que asistirás</h3>
				<?php
                 $db = new MySQL();
                 $SelectAttppointmentsQry = "SELECT `A`.`ID`, `A`.`Name`, `A`.`Type` FROM `Attachments` `A` LEFT JOIN `Tickets` `T` ON `T`.`Attachment` = `A`.`ID` WHERE `T`.`Attendant` = ?";
                 $stmt = $db->prepare($SelectAttppointmentsQry);
                 $stmt->bind_param('s', $User);
                 $stmt->execute();
                 $aresult = $stmt->get_result();
                 while ($Attachment = $aresult->fetch_assoc()) {
                     ?>
				<div class="col">
					<button class="appointment" type="submit" name="attend" formaction="attachment.php" value="<?php echo $Attachment['ID']; ?>"> <?php echo $Attachment['Name']; ?>
					<p><?php echo $Attachment['Type']; ?></p></button>
				</div>
				<?php
                 }
                 $db->close();
                ?>
				</form>
			<form class="col last" name="surf" method="post">
				<h3>Eventos disponibles</h3>
				<?php
                 $db = new MySQL();
                 $SelectAttachmentsQry = "SELECT `ID`, `Name`, `Type` FROM `Attachments`";
                 $aresult = $db->query($SelectAttachmentsQry);
                 while ($Attachment = $aresult->fetch_assoc()) {
                     ?>
				<div class="col">
					<button class="appointment" type="submit" name="attend" formaction="attachment.php" value="<?php echo $Attachment['ID']; ?>"> <?php echo $Attachment['Name']; ?>
					<p><?php echo $Attachment['Type']; ?></p></button>
				</div>
				<?php
                 }
                 $db->close();
                ?>
				</form>
		</div>
	</body>
</html>