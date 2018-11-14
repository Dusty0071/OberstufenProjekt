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

class Protokolle {
    public $ID = 0;
    public $Typ = "";
    public $Raum = "";
    public $KonferenzDatum; //DateTime
    public $LastEditUser = "";
    public $LastEditDate; //DateTime
    public $CreateDate; //DateTime
    
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
        echo '<tr>';
        foreach ($this as $key => $value) {
            echo '<td>'. getString($value) . '</td>';
        }
        echo '</tr>';
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



function Conn(){
    try {
        //connect to Database
        $mysqli = new mysqli(DBAdress,DBUser,DBPW,DBName);

        //check connection
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            return false;
        }

        $Lehrer = [];
        if($result = $mysqli->query("SELECT * FROM Protokolle")) {
            $i = 0;
            while ($row = $result->fetch_object()){
                $Lehrer[$i] = new Protokolle($row);
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM Lehrer\n';
            return false;
        }

        printProtokoll($Lehrer);

        return true;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}

function printProtokoll($protokoll) {
    echo '<table class="LinkTable">';
    foreach($protokoll as $protokollObj => $value) {
        $value->printTable();
    }
    echo '</table>';
}




?>