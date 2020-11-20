<?php
 include('sessions.php');
 require('mysql.php');
 require('cryptex.php');
 $db = new MySQL();
 $Cryptkey = $db->getCryptkey();
 $Username = Cryptex::decrypt($_SESSION['Username']);
 $Birthname = Cryptex::decrypt($_SESSION['Birthname']);
 $SelectUserQry = "SELECT `Birthdate` FROM `Users` WHERE `ID` = ?";
 $UpdateUserQry = "UPDATE `Users` SET `ID` = ?, `Password` = AES_ENCRYPT(?, ?) WHERE `ID` = ?";
 $stmt = $db->prepare($SelectUserQry);
 $stmt->bind_param('s', $Username);
 $stmt->execute();
 $sresult = $stmt->get_result();
 $Attendant = $sresult->fetch_assoc();
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
			<form class="form" name="attachment" method="post">
				<ul id="menu">
					<li><input type="text" name="username" placeholder="Nombre de usuario" value="<?php echo $Username;?>"></li>
					<li><input type="text" name="password" placeholder="Contraseña" required></li>
					<li><label type="text" name="names" placeholder="Nombre de pila"><?php echo $Birthname?></label</li>
					<li><label type="date" name="birthdate" placeholder="<?php echo date('mm / dd / yyyy');?>" value="<?php echo $User['Birthdate'];?>"></li>
				</ul>
				<div class="buttons-container">
					<ul>
						<li><button type="submit" value="approve" formaction="updateprofile.php" class="approve"></button></li>
						<li><button type="submit" value="dismiss" formaction="surf.php" class="dismiss"></button><li>
					</ul>
				</div>
				<div class="clr"></div>
			</form>
		</div>
	</body>
</html>