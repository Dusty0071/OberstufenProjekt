<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

$settings = new clsSettings();

if($settings->protokollId !== 0) {
    printProtokolle([getProtokoll($settings->protokollId)]);
    writeProtokollForm();
}

writeFoot();
?>