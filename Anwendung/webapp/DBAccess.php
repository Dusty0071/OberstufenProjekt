<?php
include "phpBasic.php";

class Lehrer {
    public $ID = 0;
    public $Vorname = "";
    public $Nachname = "";
    public $EMail = "";
    public $Benutzername = "";
    public $Passwort = "";
    public $isAdmin = "";
    public $isAktiv = "";


    function __construct($row = null) {
        fillObj($this, $row);
    }

    public function print() {
        foreach ($this as $key => $value) {
            echo $key . '= ' . $value . '<br>';
        }
    }
}

class Protokoll {
    public $ID = 0;
    public $Typ = "";
    public $Raum = "";
    public $KonferenzDate; //DateTime
    public $LastEditUser = "";
    public $LastEditDate; //DateTime
    public $CreateDate; //DateTime
    public $TOPs = []; //Array(TOP)
    public $ProtokollLehrer = []; //Array(ProtokollLehrer)
    public $GruppenID = 0;
    
    function __construct($row = null) {
        $this->KonferenzDate = new DateTime("0000-01-01");
        $this->LastEditDate = new DateTime("0000-01-01");
        $this->CreateDate = new DateTime("0000-01-01");

        fillObj($this, $row);
    }

    public function print() {
        foreach ($this as $key => $value) {
            echo $key . '= ' . getString($value) . '<br>';
        }
    }

    public function printTable() {
        $lang = new clsLang();
        echo '<tr class="clickable fancy_table">';
        foreach ($this as $key => $value) {
            if($lang->$key) {
                $sValue = getString($value);
                if($sValue !== null) {
                    echo '<td>'. getString($value) . '</td>';
                }
            }
        }
        echo '</tr>';
    }
}

class TOP {
    public $ID = 0;
    public $Name = "";
    public $Beschreibung = "";
    public $Beschluss = "";
    public $Dafuer = 0;
    public $Dagegen = 0;
    public $Enthalten = 0;

    function __construct($row = null) {
        fillObj($this, $row);
    }

    public function print() {
        foreach ($this as $key => $value) {
            echo $key . '= ' . $value . '<br>';
        }
    }
}

class ProtokollLehrer {
    public $ProtokollID = 0;
    public $LehrerID = 0;
    public $istModerator = false;
    public $istProtokollant = false;
    public $istAnwesend = false;
    public $Lehrer; //Lehrer

    function __construct($row = null) {
        fillObj($this, $row);
    }

    public function print() {
        foreach ($this as $key => $value) {
            echo $key . '= ' . $value . '<br>';
        }
    }
}

class Gruppe {
    public $ID = 0;
    public $Name = "";
    public $VerteilerMail = "";

    function __construct($row = null) {
        fillObj($this, $row);
    }

    public function print() {
        foreach ($this as $key => $value) {
            echo $key . '= ' . $value . '<br>';
        }
    }
}

class LehrerGruppe {
    public $GruppenID = 0;
    public $LehrerID = 0;
    public $Lehrer; //Lehrer
    public $Gruppe; // Gruppe

    function __construct($row = null) {
        fillObj($this, $row);
    }

    public function print() {
        foreach ($this as $key => $value) {
            echo $key . '= ' . $value . '<br>';
        }
    }
}

function getString($val) {
    if(isset($val)) {
        switch (gettype($val)) {
            case "boolean":
            case "integer":
            //auch float
            case "double":
            case "string":
                return strval($val);
            case "object":
                switch(get_class($val)) {
                    case 'DateTime':
                        return $val->format(DateFormat);
                    default:
                        return strval($val);
                }
                break;
            case "array":
                return null;
            case "resource":
            // von PHP 7.2.0 an
            case "resource (closed)":
            case "NULL":
            case "unknown type":
            default:
                return '###Error: Can\'t convert to string!';
        }
    }
}

function fillObj(&$obj, $row) {
    if($row !== null) {
        foreach (get_object_vars($obj) as $key => $value) {
            if(isset($row->$key)) {
                switch (gettype($obj->$key)) {
                    case "boolean":
                        $obj->$key = boolval($row->$key);
                        break;
                    case "integer":
                        $obj->$key = intval($row->$key);
                        break;
                    //auch float
                    case "double":
                        $obj->$key = floatval($row->$key);
                        break;
                    case "string":
                        $obj->$key = strval($row->$key);
                        break;
                    case "object":
                        switch(get_class($obj->$key)) {
                            case 'DateTime':
                                $obj->$key = new DateTime($row->$key);
                                break;
                            default:
                                $obj->$key = $row->$key;
                                break;
                        }
                        break;
                    case "array":
                    case "resource":
                    // von PHP 7.2.0 an
                    case "resource (closed)":
                    case "NULL":
                        $obj->$key = $row->$key;
                        break;
                    case "unknown type":
                    default:
                        echo 'Error: Unkown type!';
                        break;
                }
            }
        }
    }
}

function GetLehrerGruppen() {
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $LehrerGruppe = [];
        if($result = $mysqli->query("SELECT * FROM lehrerGruppen ORDER BY (SELECT Nachname FROM Lehrer WHERE id = lehrerGruppen.lehrerID) ASC")) {
            $i = 0;
            while ($row = $result->fetch_object()){
                $LehrerGruppe[$i] = new LehrerGruppe($row);
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM lehrerGruppen\n';
            return false;
        }

        return $LehrerGruppe;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function GetGruppe($ID) {
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $Gruppen = [];
        if($result = $mysqli->query("SELECT * FROM Gruppen WHERE ID =".$ID)) {
            $i = 0;
            while ($row = $result->fetch_object()){
                $Gruppen[$i] = new Gruppe($row);
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM Gruppen\n';
            return false;
        }

        return $Gruppen;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function GetGruppen() {
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $Gruppen = [];
        if($result = $mysqli->query("SELECT * FROM Gruppen")) {
            $i = 0;
            while ($row = $result->fetch_object()){
                $Gruppen[$i] = new Gruppe($row);
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM Gruppen\n';
            return false;
        }

        return $Gruppen;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function GetTops() {
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $TOPs = [];
        $query="SELECT * FROM TOPs";
        if($result = $mysqli->query($query)) {
            $i = 0;
            while ($row = $result->fetch_object()){
                $TOPs[$i] = new TOP($row);
                $i++;
            }
        } else {
            echo 'ERROR at: '.$query.'\n';
            return false;
        }

        return $TOPs;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function GetProtokolle(){
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $protokolle = [];
        if($result = $mysqli->query("SELECT * FROM Protokolle")) {
            $i = 0;
            while ($row = $result->fetch_object()){
                $protokolle[$i] = getProtokoll($row->ID);
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM Protokolle\n';
            return false;
        }

        return $protokolle;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function printProtokolle($protokolle, $newLine = false) {
    $first = true;
    $count = 0;
    $lang = new clsLang();
    echo '<table id="linkTable" class="fancy_table">';

    foreach($protokolle as $protokollObj => $value) {
        if($first) {
            $first = false;
            echo '<tr>';
            foreach ($value as $key => $pValue) {
                if(isset($lang->$key)) {
                    echo '<th>'. $lang->$key . '</th>';
                    $count++;
                }
            }
            echo '</tr>';
        }
        $value->printTable();
    }
    if($newLine) {
        echo '<tr class="clickable"><td colspan="' . $count . '" class="center">+</td></tr>';
    }
    echo '</table>';
}

function getProtokoll($ID) {
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        if($result = $mysqli->query("SELECT * FROM Protokolle  WHERE ID = " . $ID . "")) {
            while ($row = $result->fetch_object()){
                $protokoll = new Protokoll($row);
            }
        } else {
            echo 'ERROR at: SELECT * FROM Protokolle WHERE ID = ' . $ID . '\n';
            return false;
        }

        $i = 0;
        if($result = $mysqli->query("SELECT * FROM TOPs  WHERE ProtokollID = " . $ID . "")) {
            while ($row = $result->fetch_object()){
                $protokoll->TOPs[$i] = new TOP($row);
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM TOPs WHERE ProtokollID = ' . $ID . '\n';
            return false;
        }

        if($result = $mysqli->query("SELECT * FROM protokollLehrer  WHERE ProtokollID = " . $ID . "")) {
            while ($row = $result->fetch_object()){
                $protokoll->ProtokollLehrer[$i] = new ProtokollLehrer($row);
                if($resultLehrer = $mysqli->query("SELECT * FROM Lehrer  WHERE ID = " . $protokoll->ProtokollLehrer[$i]->LehrerID . "")) {
                    $j = 0;
                    while ($rowLehrer = $resultLehrer->fetch_object()){
                        $protokoll->ProtokollLehrer[$i]->Lehrer[$j] = new Lehrer($rowLehrer);
                        $j++;
                    }
                } else {
                    echo 'ERROR at: SELECT * FROM Lehrer WHERE ID = ' . $protokoll->ProtokollLehrer[$i]->LehrerID . '\n';
                    return false;
                }
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM protokollLehrer WHERE ProtokollID = ' . $ID . '\n';
            return false;
        }

        return $protokoll;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function getAllLehrer() {
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $Lehrer = [];
        if($resultLehrer = $mysqli->query("SELECT * FROM Lehrer ORDER BY Nachname ASC")) {
            $j = 0;
            while ($rowLehrer = $resultLehrer->fetch_object()){
                $Lehrer[$j] = new Lehrer($rowLehrer);
                $j++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM Lehrer ORDER BY Nachname ASC\n';
            return false;
        }

        return $Lehrer;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function GetLehrer($ID){
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $Lehrer = [];
        if($resultLehrer = $mysqli->query("SELECT * FROM Lehrer  WHERE ID = " . $ID . "")) {
            $j = 0;
            while ($rowLehrer = $resultLehrer->fetch_object()){
                $Lehrer[$j] = new Lehrer($rowLehrer);
                $j++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM Lehrer WHERE ID = ' . $ID . '\n';
            return false;
        }

        return $Lehrer;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function SaveLehrer($lehrer){
    try {
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");
        $query;

        if($lehrer->ID > 0){
            $query ="UPDATE Lehrer SET Vorname='".$lehrer->Vorname."', Nachname='".$lehrer->Nachname."',EMail='".$lehrer->EMail."' WHERE ID = ".$lehrer->ID;
        }
        else{
            $query ="INSERT INTO Lehrer (Vorname,Nachname,EMail) VALUES('".$lehrer->Vorname."','".$lehrer->Nachname."','".$lehrer->EMail."')";
        }

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
        }
        if($result = $mysqli->query($query)) {
            //echo '<p class="success-message">Lehrer gespeichert.</p>';
        } else {
            echo 'ERROR at: ' . $query . '\n';

        }

    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function SaveLehrerGruppe($lehrerGruppe){
    try {
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");
        $query ="INSERT INTO lehrerGruppen (LehrerID,GruppenID) VALUES(".$lehrerGruppe->LehrerID.",".$lehrerGruppe->GruppenID.")";
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
        }
        if($result = $mysqli->query($query)) {
            //echo '<p class="success-message">Zuordnung gespeichert.</p>';
        } else {
            echo 'ERROR at: ' . $query . '\n';
        }
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function DeleteLehrer($id){
    $result=DELETE("DELETE FROM Lehrer WHERE ID = ".$id);
    return $result;
}

function DeleteGruppe($id){
    $result=DELETE("DELETE FROM Gruppen WHERE ID = ".$id);
    return $result;
}

function DeleteLehrerGruppe($lehrerId,$gruppeId){
    $result=DELETE("DELETE FROM lehrerGruppen WHERE LehrerID = ".$lehrerId." AND GruppenID = ".$gruppeId);
    return $result;
}

function DELETE($query){
    $result=false;
    try {
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");
           
        if ($mysqli->connect_errno) {
            $result=false;
        }
        if($result = $mysqli->query($query)) {
            $result=true;
        }

    } catch(Exception $e) {
        $result=false;
    } finally {
        $mysqli->close();
        return $result;
    }
}

function SaveGruppe($gruppe){
    try {
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");
        $query;

        if($lehrer->ID > 0){
            $query ="UPDATE Gruppen SET Name='".$gruppe->Name."' WHERE ID = ".$gruppe->ID;
        }
        else{
            $query ="INSERT INTO Gruppen (Name,VerteilerMail) VALUES('".$gruppe->Name."','".$gruppe->VerteilerMail."')";
        }

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
        }
        if($result = $mysqli->query($query)) {
            //echo '<p class="success-message">Gruppe gespeichert.</p>';
        } else {
            echo 'ERROR at: ' . $query . '\n';

        }

    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function saveTopic($topic, $protokollID) {
    try {
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");
        $query;

        if($topic->ID == 0) {
            //Insert
            $query ="INSERT INTO TOPs (Name, Beschreibung, Beschluss, Dafuer, Dagegen, Enthalten, ProtokollID) VALUES('".$topic->Name."','".$topic->Beschreibung."','".$topic->Beschluss."',".intval($topic->Dafuer).",".intval($topic->Dagegen).",".intval($topic->Enthalten).",".intval($protokollID).")";
        } else {
            //Update
            $query ="UPDATE TOPs SET Name='".$topic->Name."', Beschreibung='".$topic->Beschreibung."', Beschluss='".$topic->Beschluss."', Dafuer=".intval($topic->Dafuer).", Dagegen=".intval($topic->Dagegen).", Enthalten=".intval($topic->Enthalten).", ProtokollID=".intval($protokollID)." WHERE ID = ".intval($topic->ID);  
        }

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
        }
        if($result = $mysqli->query($query)) {
            //echo '<p class="success-message">Topic "'.$topic->Name.'" gespeichert.</p>';
        } else {
            echo 'ERROR at: ' . $query . '\n';

        }

    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function saveProtokoll($protokoll) {
    try {
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");
        $query;

        if($protokoll->ID == 0) {
            //Insert
            $query ="INSERT INTO Protokolle (Typ, Raum, KonferenzDate, LastEditUser, LastEditDate, CreateDate, GruppenID) VALUES('".$protokoll->Typ."','".$protokoll->Raum."','".$protokoll->KonferenzDate->format(MYSQLDateFormat)."','".$protokoll->LastEditUser."','".date(MYSQLDateFormat)."','".date(MYSQLDateFormat)."',".$protokoll->GruppenID.")";
        } else {
            //Update
            $query ="UPDATE Protokolle SET Typ='".$protokoll->Typ."', Raum='".$protokoll->Raum."', KonferenzDate='".$protokoll->KonferenzDate->format(MYSQLDateFormat)."', LastEditUser='".$protokoll->LastEditUser."', LastEditDate='".date(MYSQLDateFormat)."', CreateDate='".$protokoll->CreateDate->format(MYSQLDateFormat)."', GruppenID=".$protokoll->GruppenID." WHERE ID = ".$protokoll->ID;  
        }

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
        }
        if($result = $mysqli->query($query)) {
            //echo '<p class="success-message">Protokoll "'.$protokoll->Typ.'" gespeichert.</p>';
        } else {
            echo 'ERROR at: ' . $query . '\n';

        }
        if($protokoll->ID == 0) {
            return mysqli_insert_id($mysqli);
        } else {
            return $protokoll->ID;
        }
    
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function saveProtokollLehrer($protokollLehrer, $pID) {
    try {
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
        $mysqli->set_charset("utf8");
        $query;

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
        }

        $query="SELECT * FROM protokollLehrer WHERE ProtokollID=".$pID." AND LehrerID=".$protokollLehrer->LehrerID."";

        if($result = $mysqli->query($query)) {
        } else {
            echo 'ERROR at: ' . $query . '\n';
        }

        if($result->fetch_array() === null) {
            //Insert
            $query ="INSERT INTO protokollLehrer (ProtokollID, LehrerID, istModerator, istProtokollant, istAnwesend) VALUES('".$pID."','".$protokollLehrer->LehrerID."',".intval($protokollLehrer->istModerator).",".intval($protokollLehrer->istProtokollant).",".intval($protokollLehrer->istAnwesend).")";
        } else {
            //Update
            $query ="UPDATE protokollLehrer SET istModerator=".intval($protokollLehrer->istModerator).", istProtokollant=".intval($protokollLehrer->istProtokollant).", istAnwesend=".intval($protokollLehrer->istAnwesend)." WHERE  ProtokollID=".$pID." AND LehrerID=".$protokollLehrer->LehrerID."";  
        }

        if($result = $mysqli->query($query)) {
        } else {
            echo 'ERROR at: ' . $query . '\n';

        }

    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}
?>