<?php
 require('mysql.php');
 require('fpdf/fpdf.php');
 class PDF extends FPDF
 {
     protected $B = 0;
     protected $I = 0;
     protected $U = 0;
     protected $HREF = '';
     protected $col = 0; // Columna actual
    protected $y0;      // Ordenada de comienzo de la columna
    public function WriteHTML($html)
    {
        // Intérprete de HTML
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                // Text
                if ($this->HREF) {
                    $this->PutLink($this->HREF, $e);
                } else {
                    $this->Write(5, utf8_decode($e));
                }
            } else {
                // Etiqueta
                if ($e[0] == '/') {
                    $this->CloseTag(strtoupper(substr($e, 1)));
                } else {
                    // Extraer atributos
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3)) {
                            $attr[strtoupper($a3[1])] = $a3[2];
                        }
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }
     public function OpenTag($tag, $attr)
     {
         // Etiqueta de apertura
         if ($tag == 'B' || $tag == 'I' || $tag == 'U') {
             $this->SetStyle($tag, true);
         }
         if ($tag == 'A') {
             $this->HREF = $attr['HREF'];
         }
         if ($tag == 'BR') {
             $this->Ln(5);
         }
     }
     public function CloseTag($tag)
     {
         // Etiqueta de cierre
         if ($tag == 'B' || $tag == 'I' || $tag == 'U') {
             $this->SetStyle($tag, false);
         }
         if ($tag == 'A') {
             $this->HREF = '';
         }
     }
     public function SetStyle($tag, $enable)
     {
         // Modificar estilo y escoger la fuente correspondiente
         $this->$tag += ($enable ? 1 : -1);
         $style = '';
         foreach (array('B', 'I', 'U') as $s) {
             if ($this->$s > 0) {
                 $style .= $s;
             }
         }
         $this->SetFont('', $style);
     }
     public function PutLink($URL, $txt)
     {
         // Escribir un hiper-enlace
         $this->SetTextColor(0, 0, 255);
         $this->SetStyle('U', true);
         $this->Write(5, $txt, $URL);
         $this->SetStyle('U', false);
         $this->SetTextColor(0);
     }

     public function Header()
     {
         global $title;
         $this->SetFont('Arial', 'B', 15);
         $w = $this->GetStringWidth('Comprobante de asistencia') + 6;
         $this->SetX((210 - $w) / 2);
         $this->Cell($w, 10, utf8_decode('Comprobante de asistencia'), 0, 0, 'C');

         $this->Ln(10);
         $this->SetFont('Arial', 'B', 15);
         $w = $this->GetStringWidth($title) + 6;
         $this->SetX((210 - $w) / 2);
         $this->SetDrawColor(0, 80, 180);
         //$this->SetFillColor(230, 230, 0);
         $this->SetFillColor(230, 230, 230);
         $this->SetTextColor(220, 50, 50);
         $this->SetLineWidth(1);
         $this->Cell($w, 9, $title, 1, 1, 'C', true);
         $this->Ln(5);
         // Guardar ordenada
         $this->y0 = $this->GetY();

         $this->SetTextColor(0, 0, 0);
         $this->Cell(15);
         $this->Cell(10, 10, utf8_decode('Fecha: ') . date("d/m/Y"));
         $this->Cell(45);
         $this->Image('images/budh-light_30x64.png', 170, 8, 33);
         $this->Ln(10);
     }
     public function Footer()
     {
         $this->SetY(-15);
         $this->SetFont('Arial', 'I', 8);
         $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . '/{nb}'), 0, 0, 'C');
         //$this->Cell(0, 10, date(YYddmm));
     }
 }
     $Type = $_REQUEST['pettype'];
     $SelectUsersQry = "SELECT `U`.`ID` `ID`, `U`.`Name` `Name` FROM `Users` `U` INNER JOIN `Users_has_Pets` `UhP` ON `U`.`ID` = `UhP`.`Users_ID` INNER JOIN `Pets` `P` ON `UhP`.`Pets_ID` = `P`.`ID` WHERE `P`.`Type` = ?";
     $db = new MySQL();
     $stmt = $db->prepare($SelectUsersQry);
     $stmt->bind_param('i', $Type);
     $stmt->execute();
     $result = $stmt->get_result();
     $pdf = new PDF();
     $pdf->SetTitle('Adoptantes');
     $pdf->setAuthor('Budh');
     $pdf->AliasNbPages();
     $pdf->AddPage();
     $pdf->SetFont('Helvetica');
     //$pdf->Write(5,utf8_decode('Para más información acerca de la evaluación, presione '));
     //$pdf->SetFont('','U');
     //$link = $pdf->AddLink();
     //$pdf->Write(5,utf8_decode('aquí'),$link);
     //$pdf->SetFont('');
     // Segunda página
     //$pdf->AddPage();
     //$pdf->SetLink($link);
     //$pdf->Image('logo.png',10,12,30,0,'','http://www.fpdf.org');
     $pdf->SetLeftMargin(25);
     $pdf->SetRightMargin(25);
     $pdf->SetTopMargin(25);
     $pdf->SetFontSize(10);
     $i = 0;
     while ($User = $result->fetch_assoc()) {
         $pdf->Write(5 + $i, $User['ID'].' '.$User['Name']);
         $i++;
     }
     $pdf->Output('I', 'adoptantes.pdf');
     $pdf->Close();
     $result->free();
     $stmt->close();
 //header('Location: '.$header);
 die();
