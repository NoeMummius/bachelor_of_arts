<html>
<head>
<title> Archivo </title>
</head>
<body>
<h1> Lee un archivo </h1>
<hr>
<?PHP
$fp = fopen("edades.txt","r");
$suma=0;
$n=0;
while(!feof($fp))
{
  $linea=fgets($fp);
  $partes=explode(" ",$linea); 
  echo "$partes[0] $partes[1] <br>";
  $suma=$suma+$partes[1];
 $n++;
}

$promedio=$suma/$n;
echo "<br> El promedio de edades = $promedio<br>";
fclose($fp);
?>
</body>
</html>