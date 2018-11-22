<?php
    require('fpdf/fpdf.php');
    include 'DBAccess.php';

    if(isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'BeschluesseDrucken':
                PrintBeschluesse(-1);
                break;
            
            default:
                echo 'Fehler';
                break;
        }
    }


    function PrintBeschluesse($max){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',18);
        $pdf->Cell(40,10,utf('Liste der Beschlüsse'));
        $pdf->ln();
        $tops = GetTops();
        for ($i=0; $i < sizeof($tops); $i++) { 
            $pdf->ln();
            $pdf->SetFont('Arial','b',12);
            $pdf-> Cell(40,10,utf($tops[$i]->Name.':'));
            $pdf->ln();
            $pdf->SetFont('Arial','',12);
            $pdf-> Cell(40,10,utf($tops[$i]->Beschreibung));
            $pdf->ln();
            $pdf-> Cell(40,10,utf('Dafür:'));
            $pdf-> Cell(40,10,utf($tops[$i]->Dafuer));
            $pdf->ln();
            $pdf-> Cell(40,10,utf('Dagegen:'));
            $pdf-> Cell(40,10,utf($tops[$i]->Dagegen));
            $pdf->ln();
            $pdf-> Cell(40,10,utf('Enthalten:'));
            $pdf-> Cell(40,10,utf($tops[$i]->Enthalten));
            $pdf->ln();
        }

        $pdf->Output();
    }


    function utf($str){
        return iconv('UTF-8', 'windows-1252', $str);
    }
?>