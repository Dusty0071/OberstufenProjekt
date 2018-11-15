<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

$settings = new clsSettings();

if($settings->protokollId !== 0) {
    highlight_string("<?php\n\getProtokoll($settings->protokollId) =\n" . var_export(getProtokoll($settings->protokollId), true) . ";\n?>");
    writeProtokollForm();
}

writeFoot();
?>