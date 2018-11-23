<?php
define("DBAdress", "localhost", true);
define("DBUser", "fia63kaden_Oli", true);
define("DBPW", "294526", true);
define("DBName", "fia63kaden_Protokoll", true);
define("DBPort", "", true);
define("DateFormat", "d.m.Y H:i", true);
define("HTMLDateFormat", "Y-m-d\TH:i", true);
define("MYSQLDateFormat", "Y-m-d H:i:s", true);

class clsLang { 
    public $ID = "Nummer";
    public $Typ = "Konferenz Typ";
    public $Raum = "Raum";
    public $KonferenzDate = "Konferenz Datum";
    public $LastEditUser = "Zuletzt bearbeitet von";
    public $LastEditDate = "Änderungsdatum";
    public $CreateDate = "Erstellungsdatum";
    public $GruppenID = "Gruppen ID";
}

class clsSettings {
    public $protokollID = "0";
    public $action = "";
    public $Name = "";
    public $Beschreibung = "";
    public $Beschluss = "";
    public $Dafuer = 0;
    public $Dagegen = 0;
    public $Enthalten = 0;
    public $Topic = [];

    public $Typ = "";
    public $Raum = "";
    public $KonferenzDate; //DateTime
    public $LastEditUser = "";
    public $LastEditDate; //DateTime
    public $CreateDate; //DateTime
    public $ProtokollLehrer = []; //Array(ProtokollLehrer)
    public $GruppenID = 0;

    function __construct() {
        var_dump($_REQUEST);
        foreach (get_object_vars($this) as $key => $value) {
            if(isset($_REQUEST[$key])) {
                switch ($key) {
                    case "Topic":
                        foreach($_REQUEST[$key] as $tKey => $tValue) {
                            $this->$key[count($this->$key)] = new Top((object) $tValue);
                        }
                        break;
                    default:
                        $this->$key = $_REQUEST[$key];
                        break;

                }
                
            }
        }
    }
}
?>