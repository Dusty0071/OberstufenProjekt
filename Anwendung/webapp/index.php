<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

echo '<h1>Protokoll Übersicht</h1>';
printProtokolle(GetProtokolle(), true);

writeFoot();
?>




