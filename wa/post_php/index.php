<html>
 <head>
  <title>Formulario 1</title>
 </head>
 <body>
  <h1>POST</h1>
  <h2>Sumatoria</h2>
  <form action="recibir.php" method="POST">
   Introduce el valor inicial de la sumatoria:
   <input type="text" name="inicio" required>
   <br>
   Introduce el valor final (mayor a l inicial) de la sumatoria:
   <input type="text" name="final" required>
   <br><br>
   <input type="submit" name="enviar" value="Enviar datos">
  </form>
 </body>
</html>