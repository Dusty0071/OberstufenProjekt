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
        $protokoll = new Protokoll((object) $settings);
        $protokoll->ID = $settings->protokollID;
        $settings->protokollID = saveProtokoll($protokoll);

        foreach($settings->ProtokollLehrer as $key => $value) {
            saveProtokollLehrer($value);
        }
        
        foreach($settings->Topic as $key => $value) {
            saveTopic($value, $settings->protokollID);
        }
        break;
    case "addTop":
        $emptyTop = true;
        break;
    case "":
        //Kein Knopf gedrückt
        break;
    default:
        echo 'Error: Not Implementet';
        break;
}

if($settings->protokollID !== 0 && $settings->protokollID !== " ") {
    /* highlight_string("<?php\n\getProtokoll($settings->protokollID) =\n" . var_export(getProtokoll($settings->protokollID), true) . ";\n?>"); */
    writeProtokollForm(getProtokoll($settings->protokollID), false, false, $emptyTop);

} else {
    writeProtokollForm(null, false, true, true);
}

writeFoot();
?>