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

writeFoot();
?>




