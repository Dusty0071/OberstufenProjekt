<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

$settings = new clsSettings();
switch($settings->action) {
    case "Übernehmen":
        echo 'Übernehmen';
        break;
    case "PDF Drucken":
        echo 'PDF Drucken';
        break;
    case "":
        echo 'Nothing';
    default:
        echo 'Error: Not Implementet';
        break;
}
if($settings->protokollId !== 0) {
    /* highlight_string("<?php\n\getProtokoll($settings->protokollId) =\n" . var_export(getProtokoll($settings->protokollId), true) . ";\n?>"); */
    writeProtokollForm(getProtokoll($settings->protokollId), false);

} else {
    //TODO Neues Protokoll
}

writeFoot();
?>