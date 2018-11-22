<?php
    require('fpdf/fpdf.php');
    include 'DBAccess.php';

    if(isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'BeschluesseDrucken':
                PrintBeschluesse();
                break;
            case 'TopsDrucken':
                PrintTops();
                break;
            case 'ProtokollDrucken':
                if(isset($_GET['id'])){
                    PrintProtokoll($_GET['id']);
                }
                else{
                    echo 'Fehler';
                }
                break;
            default:
                echo 'Fehler';
                break;
        }
    }

    function PrintProtokoll($id){
        $protokoll = getProtokoll($id);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',18);
        $pdf->Cell(50,10,utf('Protokoll #'.$protokoll->ID));
        $pdf->ln();
        $pdf->SetFont('Arial','',12);
        $pdf-> Cell(50,10,utf('Typ'));
        $pdf-> Cell(50,10,utf($protokoll->Typ));
        $pdf->ln();
        $pdf-> Cell(50,10,utf('Raum'));
        $pdf-> Cell(50,10,utf($protokoll->Raum));
        $pdf->ln();
        $pdf-> Cell(50,10,utf('Konferenz Datum'));
        // $pdf-> Cell(40,10,$protokoll->KonferenzDate);
        $pdf->ln();
        $pdf-> Cell(50,10,utf('Letzte Änderung durch'));
        $pdf-> Cell(50,10,utf($protokoll->LastEditUser));
        $pdf->ln();
        $pdf-> Cell(50,10,utf('Letzte Änderung'));
        // $pdf-> Cell(40,10,$protokoll->LastEditDate);
        $pdf->ln();
        $pdf-> Cell(50,10,utf('Erstellt'));
        // $pdf-> Cell(40,10,$protokoll->CreateDate);
        $pdf->ln();
        $pdf-> Cell(50,10,utf('GruppenID'));
        $pdf-> Cell(50,10,$protokoll->GruppenID);
        $pdf->ln();

        // public $ID = 0;
        // public $Typ = "";
        // public $Raum = "";
        // public $KonferenzDate; //DateTime
        // public $LastEditUser = "";
        // public $LastEditDate; //DateTime
        // public $CreateDate; //DateTime
        // public $TOPs = []; //Array(TOP)
        // public $ProtokollLehrer = []; //Array(ProtokollLehrer)
        // public $GruppenID = 0;
        $pdf->Output();
    }

    function PrintTops(){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',18);
        $pdf->Cell(40,10,utf('Liste aller Topics'));
        $pdf->ln();
        $tops = GetTops();
        for ($i=0; $i < sizeof($tops); $i++) { 
            $pdf->ln();
            $pdf->SetFont('Arial','b',12);
            $pdf-> Cell(40,10,utf($tops[$i]->Name.':'));
            $pdf->ln();
            $pdf->SetFont('Arial','',12);
            $pdf-> Cell(40,10,utf($tops[$i]->Beschreibung));
            
            if(!empty($tops[$i]->Beschluss)){
                $pdf->ln();
                $pdf-> Cell(40,10,utf($tops[$i]->Beschluss));
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
            
        }

        $pdf->Output();
    }

    function PrintBeschluesse(){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',18);
        $pdf->Cell(40,10,utf('Liste der Beschlüsse'));
        $pdf->ln();
        $tops = GetTops();
        for ($i=0; $i < sizeof($tops); $i++) { 
            if(!empty($tops[$i]->Beschluss)){
                $pdf->ln();
                $pdf->SetFont('Arial','b',12);
                $pdf-> Cell(40,10,utf($tops[$i]->Name.':'));
                $pdf->ln();
                $pdf->SetFont('Arial','',12);
                $pdf-> Cell(40,10,utf($tops[$i]->Beschluss));
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
            
        }

        $pdf->Output();
    }


    function utf($str){
        return iconv('UTF-8', 'windows-1252', $str);
    }
?>