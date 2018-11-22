<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

$settings = new clsSettings();
switch($settings->action) {
    case "save":
        echo 'Übernehmen';
        foreach($settings->Topic as $key => $value) {
            saveTopic($value, $settings->protokollID);
        }
        break;
    case "pdf":
        echo 'PDF Drucken';
        break;
    case "":
        echo 'Nothing';
        break;
    default:
        echo 'Error: Not Implementet';
        break;
}

if($settings->protokollID !== 0) {
    /* highlight_string("<?php\n\getProtokoll($settings->protokollID) =\n" . var_export(getProtokoll($settings->protokollID), true) . ";\n?>"); */
    writeProtokollForm(getProtokoll($settings->protokollID), false);

} else {
    //TODO Neues Protokoll
}

writeFoot();
?>