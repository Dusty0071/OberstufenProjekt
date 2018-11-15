<?php
include "phpBasic.php";

class Lehrer {
    public $ID = 0;
    public $Vorname = "";
    public $Nachname = "";
    public $EMail = "";

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
    public $KonferenzDatum; //DateTime
    public $LastEditUser = "";
    public $LastEditDate; //DateTime
    public $CreateDate; //DateTime
    public $TOPs = []; //Array(TOP)
    public $ProtokollLehrer = []; //Array(ProtokollLehrer)
    
    function __construct($row = null) {
        $this->KonferenzDatum = new DateTime("0000-01-01");
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
        echo '<tr class="clickable">';
        foreach ($this as $key => $value) {
            $sValue = getString($value);
            if($sValue !== null) {
                echo '<td>'. getString($value) . '</td>';
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

function GetProtokolle(){
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $protokolle = [];
        if($result = $mysqli->query("SELECT * FROM Protokolle")) {
            $i = 0;
            while ($row = $result->fetch_object()){
                $protokolle[$i] = new Protokoll($row);
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
    echo '<table id="linkTable">';

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
                $protokoll->$TOPs[$i] = new TOP($row);
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM Protokolle WHERE ID = ' . $ID . '\n';
            return false;
        }

        return $protokoll;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function SaveLehrer($lehrer){
    try {
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);
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
            echo '<p>Lehrer gespeichert.</p>';
        } else {
            echo 'ERROR at: ' . $query . '\n';

        }

    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function SaveGruppe($gruppe){
    
}

?>