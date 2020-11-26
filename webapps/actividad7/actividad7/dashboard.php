<?php
 include('sessions.php');
 require('mysql.php');
 require('cryptex.php');
 if(isset($_GET['upload']))
 {
	 $upload = $_GET['upload'];
	 if($upload == true)
	 {
		 echo '<script type="text/javascript">alert("Registro exitoso");</script>';
	 }
	 else{
		 echo '<script type="text/javascript">alert("Hubo un error durante la carga. Vuela a intentarlo");</script>';
	 }
 }
 if(isset($_GET['delete']))
 {
	 $delete = $_GET['delete'];
	 if($delete == true)
	 {
		 echo '<script type="text/javascript">alert("Eliminación exitosa");</script>';
	 }
	 else{
		 echo '<script type="text/javascript">alert("Hubo un error durante la carga. Vuela a intentarlo");</script>';
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
			<form class="content" name="dashboard" method="post">
				<ul id="menu">
					<li><button type="submit" class="link" name="register" value="new" formaction="attachment.php">Registrar Evento</button></li>
					<li><button type="submit" class="signin" name="logout" value="logout" formaction="logout.php">Salir</button></li>
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
					<button type="submit" class="signup" name="manage" formaction="attachment.php" value="<?php echo $Attachment['ID'];?>"><span><?php echo $Attachment['Name']; ?>
					<p><?php echo $Attachment['Type'];?></p></span></button>
				</div>
				<?php
				 }
				 $aresult->free();
				 $db->close();
				?>
				</form>
		</div>
	</body>
</html>