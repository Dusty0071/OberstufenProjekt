<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

/* highlight_string("<?php\n\GetProtokolle() =\n" . var_export(GetProtokolle(), true) . ";\n?>"); */
echo '<h1>Protokoll Übersicht</h1>';
printProtokolle(GetProtokolle(), true);
echo '<a href="/PDFdruck.php?action=BeschluesseDrucken" target="_blank" class="button">Alle Beschlüsse drucken</a>';
echo '<a href="/PDFdruck.php?action=TopsDrucken" target="_blank" style="margin-left:10px;" class="button">Alle Topics drucken</a>';

writeFoot();
?>




