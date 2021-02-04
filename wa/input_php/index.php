<html>
<head>
 <tilte>Formulario</title>
</head>
<body>
 <h1>Formulario</h1>
 <label>Introduce tus tados</label>
 <br>
 <form action="procesar.php" method="POST" enctype="multipart/form-data">
  <label>Nombre: </label>
  <input type="text" name="nombre" required>
  <br>
  <label>Matrícula: </label>
  <input type="text" name="matricula" required>
  <br>
  <label>Selecciona tu carrera: </label><br>
  <input type="radio" name="carrera" value="ICC" checked>Ing. En Cs. De la Comp.<br>
  <input type="radio" name="carrera" value="LCC">Lic. En Cs. De la Comp.<br>
  <input type="radio" name="carrera" value="ITI">Ing. En Tec. De la Inf.<br>
  <input type="radio" name="carrera" value="IM">Ing. En Mecatrónica.<br>
  <br>
  <label>Selecciona qué recursos utilizas para tus clases en línea: </label><br>
  <input type="checkbox" name="recursos[]" value="GM">Google Meet<br>
  <input type="checkbox" name="recursos[]" value="Zm">Zoom<br>
  <input type="checkbox" name="recursos[]" value="Bb">Blackboard<br>
  <input type="checkbox" name="recursos[]" value="Mo">MOODLE<br>
  <input type="checkbox" name="recursos[]" value="CR">Classroom<br>
  <input type="checkbox" name="recursos[]" value="WA">WhatsApp<br>
  <br>
  <label>Sube tu foto</label>
  <input type="file" name="foto">
  <br>
  <input type="submit" value="Enviar">
 </form>
</body>
</html>