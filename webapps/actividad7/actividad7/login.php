<?php
 require('mysql.php');
 require('cryptex.php');
 $header = "#";
  if (isset($_POST['username']) && isset($_POST['password'])) {
      $Username = $_REQUEST['username'];
      $Password = $_REQUEST['password'];
      $db = new MySQL();
      $Cryptkey = $db->getCryptkey();
      $SelectUserQry = "SELECT `U`.`ID` `ID`, CONCAT(`U`.`Lastnames`, ', ', `U`.`Names`) `Birthname`, `U`.`Role` `Role` FROM `Users` `U` WHERE `U`.`ID` = ? AND `U`.`Password` = AES_ENCRYPT(?, ?)";
      $SelectOwnerQry = "SELECT `O`.`ID` `ID`, `O`.`Name` `Birthname` FROM `Owners` `O` WHERE `O`.`ID` = ? AND `O`.`Password` = AES_ENCRYPT(?, ?)";
      $stmt = $db->prepare($SelectOwnerQry);
      $stmt->bind_param('sss', $Username, $Password, $Cryptkey);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($Qrow = $result->fetch_assoc()) {
          $header = 'Location: dashboard.php?User='.Cryptex::encrypt(utf8_decode($Qrow['ID'])).'Birthname='.Cryptex::encrypt(utf8_encode($Qrow['Birthname']));
      } else {
          $stmt->free_result();
          $stmt->close();
          $stmt = $db->prepare($SelectUserQry);
          $stmt->bind_param('sss', $Username, $Password, $Cryptkey);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($Qrow = $result->fetch_assoc()) {
              session_start();
              $_SESSION['Username'] = Cryptex::encrypt($Qrow['ID']);
              $_SESSION['Role'] = Cryptex::encrypt($Qrow['Role']);
              $_SESSION['Birthname'] = Cryptex::encrypt(utf8_encode($Qrow['Birthname']));
              if (strcmp($Qrow['Role'], 'Pollster') == 0) {
                  $header = 'Location: index.php';
              }
          } else {
              $header = 'Location: '.$_SERVER['HTTP_REFERER'];
          }
          $stmt->free_result();
          $stmt->close();
      }
      $db->close();
      header($header);
      die();
  } else {
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
                  <div class="content">
                      <ul id="menu">
                          <li><a class="current" href="#">Registrarse</a></li>
                          <li><a href="#">Registrar Evento</a></li>
                          <li><a href="#">Actualizar Evento</a></li>
                          <li><a href="#">Eliminar Evento</a></li>
                          <li><a href="#">Eliminar Participante</a></li>
                      </ul>
                      <div id="pitch">
                          <h1>Gestion de la publicación, actualización y eliminación de distintos tipos de eventos.</h1>
                          <p><em>Pueden ser: congresos, seminarios, talleres, etc. Así como la asistencia o inasistencia de los participantes.</em></p>
                      </div>
                      <div class="col">
                          <h2>Evento 1</h2>
                          <p>About event 1.</p>
                          <a class="link" href="#">MORE</a>
                      </div>
                      <div class="col">
                          <h2>Evento 2</h2>
                          <p>About event 2.</p>
                          <a class="link" href="#">MORE</a>
                      </div>
                      <div class="col last">
                          <h2>Evento 3</h2>
                          <p>About event.</p>
                          <a class="link" href="#">MORE</a>
                      </div>
                      <div class="clr"></div>
                  </div>
                  
                      <div class="col last">
                          <h3>Informacion de eventos</h3>
                          <div class="case">
                              <img src="images/thumb.gif" alt="Case Thumb" />
                              <p><a href="http://www.vizua.net">Eventos Recientes</a><br />
                              Eventos que pasaron recientemente </p>
                          </div>
                          <div class="case">
                              <img src="images/thumb.gif" alt="Case Thumb" />
                              <p><a href="#"><br /><br /><br />Proximos Eventos</a><br />
                              Muestra los eventos próximos </p>
                          </div>
                          <div class="case">
                              <img src="images/thumb.gif" alt="Case Thumb" />
                              <p><a href="#"><br /><br /><br />Eventos Eliminados</a><br />
                              Muestralos eventos recientemente eliminados</p>
                          </div>
                      </div>
                      <div class="clr"></div>
                  </div>
                  <div id="footer">
                      <p id="links">
                          <a href="#">Privacy Policy</a>
                          <a href="#">Terms of Use</a>
                      </p>
                      <p>
                          <a href="#">Home</a>
                          <a href="#">Proximamente</a>
                          <a href="#">Participantes</a>
                          <a href="#">Eventos</a>
                          <a href="#">News</a>
                          <a href="#">About Us</a>
                          <a href="#">Contact Us</a>
                      </p>
                  </div>
              </div>
          </body>
      </html>
<?php
  }
?>