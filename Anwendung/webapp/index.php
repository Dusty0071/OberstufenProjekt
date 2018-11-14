<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

echo '<h1>Prtokoll Übersicht</h1>';
printProtokolle(GetProtokolle(), true);

writeFoot();
?>




