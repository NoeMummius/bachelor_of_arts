<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BAM</title>
</head>

<body>
    <h1>Memoria Asociativa Bidireccional</h1>
    <h2>Demo</h2>
    <?php
     require('bam.php');
     $bam = new BAM();
     $Inputs = array(array());
     $Targets = array(array());
     for($i = 0; $i - 2 < 0; $i++)
     {
         echo 'A'.$i.': ';
         for($j = 0; $j - 5  < 0; $j++)
         {
             $Inputs[$i][$j] = rand(0, 1);
             echo $Inputs[$i][$j].', ';
         }
         echo '<br>';
     }
     for($i = 0; $i - 2 < 0; $i++)
     {
         echo 'B'.$i.': ';
         for($j = 0; $j - 2  < 0; $j++)
         {
             $Targets[$i][$j] = rand(0, 1);
             echo $Targets[$i][$j].', ';
         }
         echo '<br>';
     }/*
     $Inputs = [[1, 0, 1, 0, 1, 0], [1, 1, 1, 0, 0, 0]];
     $Targets = [[1, 1, 1, 0], [1, 0, 1, 0]];*/
     $bam->initSets($Inputs, $Targets);
     $Weights = $bam->getWeights();
     echo 'Weights<br>';
     foreach($Weights as $Weight)
     {
         for($j = 0; $j - sizeof($Weight) < 0; $j++)
         {
             echo $Weight[$j].', ';
         }
         echo '<br>';
     }
     $Inputs = $bam->getinputs();
     echo 'A0: ';
     for($j = 0; $j - sizeof($Inputs[0]) < 0; $j++)
      echo $Inputs[0][$j].', ';
     echo '<br>';
     $Output = $bam->recall($Inputs[0]);
     echo 'Output B0: ';
     foreach($Output as $output)
     {
         print $output.', ';
     }
     echo '<br>';
     echo 'A1: ';
     for($j = 0; $j - sizeof($Inputs[1]) < 0; $j++)
      echo $Inputs[1][$j].', ';
     echo '<br>';
     $Output = $bam->recall($Inputs[1]);
     echo 'Output B1: ';
     foreach($Output as $output)
     {
         print $output.', ';
     }
    ?>
    <h2>Periodic Table</h2>
    <form action="index.php" method="POST">
    <label>Element Symbol: </label>
    <select name="Symbol">
        <?php
         $src = fopen("chemical_elements.txt", "r");
         while(!feof($src))
         {
             $line = fgets($src);
             $Data = explode(" ", $line);
             echo '<option selected value="'.$Data[0].'">'.$Data[0].'</option>';
             fflush($src);
         }
         fclose($src);
        ?>
    </select><br>
    <input type="submit" value="Calcular">
    </form>
    <?php
     require('chemelement.php');
     //require('bam.php');
     if(isset($_POST['Symbol']))
     {
         $Symbol = $_REQUEST['Symbol'];
         $Name;
         $name_len = 1;
         $i = 0;
         $pos = 0;
         $Symbols = array(array());
         $Names = array(array());
         $element = new Chemelement();
         $table = new BAM();
         $src = fopen("chemical_elements.txt", "r");
         while(!feof($src))
         {
             $line = fgets($src);
             $Data = explode(" ", $line);
             if($name_len - strlen($Data[1]) < 0)
             {
                 $name_len = strlen($Data[1]);
             }
             fflush($src);
         }
         fclose($src);
         $i = 0;
         $src = fopen("chemical_elements.txt", "r");
         while(!feof($src))
         {
             $line = fgets($src);
             $Data = explode(" ", $line);
             $element->setElement($Data[0], $Data[1]);
             $Symbols[$i] = $element->binSymbol();
             $Names[$i] = $element->binName($name_len);
             if(strcmp($Data[0], $Symbol) == 0)
             {
                 $Name = $Data[1];
                 $pos = $i;
             }
             $i++;
             fflush($src);
         }
         fclose($src);
         echo 'A'.$pos.': ';
         $element->setElement($Symbol, $Name);
         foreach($element->binSymbol() as $bit)
         {
             echo $bit.', ';
         }
         echo '<br>';
         echo 'B'.$pos.'('.$element->binaryToString($element->binName($name_len)).'): ';
         foreach($element->binName($name_len) as $bit)
         {
             echo $bit.', ';
         }
         echo '<br>';
         $table->initSets($Symbols, $Names);
         $Inputs = $table->getInputs();
         $Targets = $table->getTargets();
         echo 'A'.$pos.': ';
         for($i = 0; $i - sizeof($Inputs[$pos]) < 0; $i++)
         {
             echo $Inputs[$pos][$i].', ';
         }
         echo '<br>';
         echo 'B'.$pos.': ';
         for($i = 0; $i - sizeof($Targets[$pos]) < 0; $i++)
         {
             echo $Targets[$pos][$i].', ';
         }
         echo '<br>';
         $Weights = $table->getWeights();
         echo 'Weights:<br>[';
         foreach($Weights as $Weight)
         {
             echo '[';
             foreach($Weight as $cell)
             {
                 echo $cell.' ';
             }
             echo ']<br>';
         }
         echo ']<br>';
         echo 'A'.$pos.': '.$element->binaryToString($element->binSymbol()).'<br>';
         $Output = $table->recall($Symbols[$pos]);
         echo 'Output B'.$pos.' ('.$element->binaryToString($Output).'): ';
         foreach($Output as $bit)
         {
             echo $bit.', ';
         }
         echo '<br>';
     }
    ?>
</body>

</html>