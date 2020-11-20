<?php
 include('sessions.php');
 require('mysql.php');
 require('cryptex.php');
 $User = $_SESSION['Username'];
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
		 $db = new MySQL();
		 $SelectAttachmentQry ="SELECT * FROM `Attachments` WHERE `ID` = ?";
		 $stmt1 = $db->prepare($SelectAttachmentQry);
		 $stmt1->bind_param('i', $_POST['ID']);
		 $stmt1->execute();
		 $eresult = $stmt1->get_result();
		 $Attachment = $eresult->fetch_assoc();
         if (isset($_POST['register']) || $upload == false) {
        ?>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<h1>Actualizar evento</h1>
				</div>
				<div class="clr"></div>
			</div>
			<form class="form" name="attachment" method="post">
				<ul id="menu">
					<li><input type="text" name="name" placeholder="Nombre"></li>
					<li><input type="text" name="type" placeholder="Tipo"></li>
					<li><input type="date" name="sdate" placeholder="<?php echo date('mm / dd / yyyy'); ?>"></li>
					<li><input type="time" name="shour" placeholder="<?php echo localtime(); ?>"></li>
					<li><input type="date" name="edate" placeholder="<?php echo date('mm / dd / yyyy'); ?>"></li>
					<li><input type="time" name="ehour" placeholder="<?php echo localtime(); ?>"></li>
					<li><textarea name="desc" placeholder="Descripción"></textarea></li>
				</ul>
				<div class="buttons-container">
					<ul>
						<li><button type="submit" value="approve" formaction="upload.php" class="approve"></button></li>
						<li><button type="submit" value="dismiss" formaction="dashboard.php" class="dismiss"></button><li>
					</ul>
				</div>
				<div class="clr"></div>
			</form>
		</div>
		<?php
		 }
		 elseif (isset($_POST['update']) || $upload == false) {
        ?>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<h1>Actualizar evento</h1>
				</div>
				<div class="clr"></div>
			</div>
			<form class="form" name="attachment" method="post">
				<ul id="menu">
					<li><input type="text" name="id" placeholder="<?php $Attachment['ID'];?>" readonly></li>
					<li><input type="text" name="name" placeholder="<?php $Attachment['Name'];?>"></li>
					<li><input type="text" name="type" placeholder="<?php $Attachment['Type'];?>"></li>
					<li><input type="date" name="sdate" placeholder="<?php $Attachment['S_date'];?>"></li>
					<li><input type="time" name="shour" placeholder="<?php $Attachment['S_time'];?>"></li>
					<li><input type="date" name="edate" placeholder="<?php $Attachment['E_date'];?>"></li>
					<li><input type="time" name="ehour" placeholder="<?php $Attachment['E_time'];?>"></li>
					<li><textarea name="desc" placeholder="Descripción"><?php $Attachment['Desc'];?></textarea></li>
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
		<?php
         }
		 elseif (isset($_POST['attend'])) {
			 $SelectAttendantQry="SELECT CONCAT(`Lastnames`, ', ', `Names`) `Birthname` FROM `Users` WHERE `ID` = ?";
			 $stmt2 = $db->prepare($SelectAttendantQry);
			 $stmt2->bind_param('s', $User);
			 $stmt2->execute();
			 $result = $stmt2->get_result();
			 $Attendant = $uresult->fetch_assoc();
			?>
			<div id="wrapper">
				<div id="header">
					<div id="logo">
						<h1>Actualizar evento</h1>
					</div>
					<div class="clr"></div>
				</div>
				<form class="form" name="attachment" method="post">
					<ul id="menu">
					<li><input class="text" name="id" placeholder="<?php $Attachment['ID'];?>" visible="false"></li>
					<li><label class="text" name="name" placeholder="<?php $Attachment['Name'];?>"></li>
					<li><label class="text" name="type" placeholder="<?php $Attachment['Type'];?>"></li>
					<li><label class="date" name="sdate" placeholder="<?php $Attachment['S_date'];?>"></li>
					<li><label class="time" name="shour" placeholder="<?php $Attachment['S_time'];?>"></li>
					<li><label class="date" name="edate" placeholder="<?php $Attachment['E_date'];?>"></li>
					<li><label class="time" name="ehour" placeholder="<?php $Attachment['E_time'];?>"></li>
					<li><textarea name="desc" placeholder="Descripción" readonly><?php $Attachment['Desc'];?></textarea></li>
					<li><input class="text" name="id" placeholder="<?php $User;?>" visible="false"></li>
					<li><label class="text" name="name" placeholder="<?php $Attendant['Birthname'];?>"></li>
					</ul>
					<div class="buttons-container">
						<ul>
							<li><button type="submit" value="approve" formaction="attend.php" class="approve"></button></li>
							<li><button type="submit" value="dismiss" formaction="surf.php" class="dismiss"></button><li>
						</ul>
					</div>
					<div class="clr"></div>
				</form>
			</div>
			<?php
			 $eresult->free();
			 $uresult->free();
			 $stmt2->close();
			 }
			?>
	</body>
</html>