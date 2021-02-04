<?php
$nom=$_REQUEST['nombre'];
$mat=$_REQUEST['matricula'];
$car=$_REQUEST['carrera'];
$fot=$_FILES['foto']['name'];
echo $nom.'<br>'.$mat.'<br>'.$car.'<br>';
foreach($_REQUEST['recursos'] as $rec)
 print("$rec<br>");
$img_path="img/".$fot;
if(is_uploaded_file($_FILES['foto']['tmp_name']))
{
 copy($_FILES['foto']['tmp_name'], $img_path);
 echo $_FILES['foto']['tmp_name'].' '.$img_path.'<br>';
 echo "<img src=$img_path width='80' height='80'/>";
}
else
 echo 'Error';
?>