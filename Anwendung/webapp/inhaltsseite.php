<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

$settings = new clsSettings();
$emptyTop = false;

switch($settings->action) {
    case "save":
        echo 'Übernehmen';
        $protokoll = new Top($settings);
        $protokoll->ID = $settings->protokollID;
        saveProtokoll($protokoll);
        foreach($settings->Topic as $key => $value) {
            saveTopic($value, $settings->protokollID);
        }
        break;
    case "pdf":
        echo 'PDF Drucken';
        break;
    case "addTop":
        echo 'Add Topic';
        $emptyTop = true;
        break;
    case "":
        //Kein Knopf gedrückt
        break;
    default:
        echo 'Error: Not Implementet';
        break;
}

if($settings->protokollID !== 0) {
    /* highlight_string("<?php\n\getProtokoll($settings->protokollID) =\n" . var_export(getProtokoll($settings->protokollID), true) . ";\n?>"); */
    writeProtokollForm(getProtokoll($settings->protokollID), false, false, $emptyTop);

} else {
    //TODO Neues Protokoll
}

writeFoot();
?>