<?php
define("DBAdress", "localhost", true);
define("DBUser", "fia63kaden_Oli", true);
define("DBPW", "294526", true);
define("DBName", "fia63kaden_Protokoll", true);
define("DBPort", "", true);
define("DateFormat", "d.m.Y H:i", true);
define("HTMLDateFormat", "Y-m-d\TH:i", true);

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

    function __construct() {
        foreach (get_object_vars($this) as $key => $value) {
            if(isset($_REQUEST[$key])) {
                $this->$key = $_REQUEST[$key];
            }
        }
    }
}
?>