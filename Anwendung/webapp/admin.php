<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

echo '<h1>Admin Tools</h1>';

if(isset($_POST['pushLehrer'])){
    
    echo"<p>Lehrer angelegt</p>";
}
else{
    writeAdminForm();
}

writeFoot();
?>