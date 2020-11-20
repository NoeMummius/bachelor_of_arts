<?php
 include('sessions.php');
 require('mysql.php');
 require('cryptex.php');
 $User = Cryptex::decrypt($_SESSION['Username']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/screen.css" media="screen" />
		<title>Constancias Eventos</title>
	</head>
	<body>
		<?php
         if (isset($_POST['register'])) {
        ?>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<h1>Crear evento</h1>
				</div>
				<div class="clr"></div>
			</div>
			<form class="form" name="new_attachment" method="post">
				<ul id="menu">
					<li><input type="text" name="name" placeholder="Nombre"></li>
					<li><input type="text" name="type" placeholder="Tipo"></li>
					<li><input type="date" name="sdate" placeholder="Fecha de inicio"></li>
					<li><input type="time" name="stime" placeholder="Hora de inicio"></li>
					<li><input type="date" name="edate" placeholder="Fecha de término"></li>
					<li><input type="time" name="etime" placeholder="Hora de término"></li>
					<li><textarea name="desc" placeholder="Descripción"></textarea></li>
				</ul>
				<div class="buttons-container">
					<ul>
						<li><button type="submit" value="approve" formaction="upload.php" class="approve"></button></li>
						<li><button type="submit" value="dismiss" formaction="dashboard.php" class="dismiss"></button></li>
					</ul>
				</div>
				<div class="clr"></div>
			</form>
		</div>
		<?php
		 }
		 elseif (isset($_POST['manage'])) {
			$db = new MySQL();
			$SelectAttachmentQry = "SELECT * FROM `Attachments` WHERE `ID` = ?";
			$stmt1 = $db->prepare($SelectAttachmentQry);
			$stmt1->bind_param('i', $_POST['manage']);
			$stmt1->execute();
			$eresult = $stmt1->get_result();
			$Attachment = $eresult->fetch_assoc();
        ?>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<h1>Actualizar evento</h1>
				</div>
				<div class="clr"></div>
			</div>
			<form class="form" name="manage_attachment" method="post">
				<ul id="menu">
					<li><input type="text" name="id" value="<?php echo $Attachment['ID'];?>" readonly></li>
					<li><input type="text" name="name" value="<?php echo $Attachment['Name'];?>"></li>
					<li><input type="text" name="type" value="<?php echo $Attachment['Type'];?>"></li>
					<li><input type="date" name="sdate" value="<?php echo $Attachment['S_date'];?>"></li>
					<li><input type="time" name="stime" value="<?php echo $Attachment['S_time'];?>"></li>
					<li><input type="date" name="edate" value="<?php echo $Attachment['E_date'];?>"></li>
					<li><input type="time" name="etime" value="<?php echo $Attachment['E_time'];?>"></li>
					<li><textarea name="desc" placeholder="Descripción"><?php echo $Attachment['Desc'];?></textarea></li>
				</ul>
				<div class="buttons-container">
					<ul>
						<li><button type="submit" value="approve" formaction="update.php" class="approve"></button></li>
						<li><button type="submit" value="dismiss" formaction="dashboard.php" class="dismiss"></button></li>
					</ul>
				</div>
				<div class="clr"></div>
			</form>
		</div>
		<?php
			 $stmt1->close();
			 $db->close();
         }
		 elseif (isset($_POST['attend'])) {
			$db = new MySQL();
			$SelectAttachmentQry = "SELECT * FROM `Attachments` WHERE `ID` = ?";
			$stmt1 = $db->prepare($SelectAttachmentQry);
			$stmt1->bind_param('i', $_POST['attend']);
			$stmt1->execute();
			$eresult = $stmt1->get_result();
			$Attachment = $eresult->fetch_assoc();
			 $SelectAttendantQry="SELECT CONCAT(`Lastnames`, ', ', `Names`) `Birthname` FROM `Users` WHERE `ID` = ?";
			 $stmt2 = $db->prepare($SelectAttendantQry);
			 $stmt2->bind_param('s', $User);
			 $stmt2->execute();
			 $uresult = $stmt2->get_result();
			 $Attendant = $uresult->fetch_assoc();
			?>
			<div id="wrapper">
				<div id="header">
					<div id="logo">
						<h1>Suscribir evento</h1>
					</div>
					<div class="clr"></div>
				</div>
				<form class="form" name="attend_attachment" method="post">
					<ul id="menu">
					<li><input type="text" class="field" name="attachment" value="<?php echo $Attachment['ID'];?>" visible="false"></li>
					<li><label class="field" name="name"><?php echo $Attachment['Name'];?></label></li>
					<li><label class="field" name="type"><?php echo $Attachment['Type'];?></label></li>
					<li><label class="field" name="sdate"><?php echo $Attachment['S_date'];?></label></li>
					<li><label class="field" name="shour"><?php echo $Attachment['S_time'];?></label></li>
					<li><label class="field" name="edate"><?php echo $Attachment['E_date'];?></label></li>
					<li><label class="field" name="ehour"><?php echo $Attachment['E_time'];?></label></li>
					<li><textarea name="desc" placeholder="Descripción" readonly><?php echo $Attachment['Desc'];?></textarea></li>
					<li><input type="text" class="field" name="attendant" value="<?php echo $User;?>" visible="false"></li>
					<li><label class="field" name="name"><?php echo $Attendant['Birthname'];?></label></li>
					</ul>
					<div class="buttons-container">
						<ul>
							<li><button type="submit" value="approve" formaction="attend.php" class="approve"></button></li>
							<li><button type="submit" value="dismiss" formaction="surf.php" class="dismiss"></button></li>
						</ul>
					</div>
					<div class="clr"></div>
				</form>
			</div>
			<?php
			 $eresult->free();
			 $uresult->free();
			 $stmt1->close();
			 $stmt2->close();
			 $db->close();
			 }
			?>
	</body>
</html>