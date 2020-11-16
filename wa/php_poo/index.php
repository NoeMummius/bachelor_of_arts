<html>
 <head>
  <title>Círculo</title>
 </head>
 <body>
 <h1>PHP Orientado a objetos</h1>
 <h2>Superficie del círculo</h2>
 <form action="index.php" method="POST">
  Ingresa el valor del radio
  <input type="text" name="radio">
  <input type="submit" name="enviar" value="enviar radio">
 </form>
 <div class="respuestas">
  <?php
   require("circulo.php");
   if(isset($_POST['radio']))
   {
    $r=$_REQUEST['radio'];
    $c = new Circulo($r);
    $s = $c->surface();
    echo "Para el círculo con el radio = ".$c->getRadio()." la superficie es: $s<br>";
   }
  ?>
 </div>
 </body>
</html>