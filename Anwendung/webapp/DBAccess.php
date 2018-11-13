<?php
include "phpBasic.php";

Conn();

class Lehrer {
    public $ID = "";
    public $Vorname = "";
    public $Nachname = "";
    public $EMail = "";
    function __construct($row = null) {
        foreach (get_object_vars($this) as $key => $value) {
            $this->$key = $row->$key;
        }
    }

    public function print() {
        foreach ($this as $key => $value) {
            echo $key . '= ' . $value . '<br>';
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
        if($result = $mysqli->query("SELECT * FROM Lehrer")) {
            $i = 0;
            while ($row = $result->fetch_object()){
                $Lehrer[$i] = new Lehrer($row);
                $i++;
            }
        } else {
            echo 'ERROR at: SELECT * FROM Lehrer\n';
            return false;
        }

        foreach($Lehrer as $LehrerObj => $value) {
            $value->print();
        }

        return true;
    } catch(Exception $e) {
        echo 'Unahndled Exception:\n' . $e;
    } finally {
        $mysqli->close();
    }
}
?>