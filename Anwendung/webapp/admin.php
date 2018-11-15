<?php
include 'writeHtml.php';
include 'DBAccess.php';

easterEgg();
wirteHead();
writeLogin();
writeHeadEnd();

echo '<h1>Admin Tools</h1>';

if(isset($_POST['pushLehrer'])){

    // echo"<p>Lehrer angelegt</p>";
    if(isset($_POST['vNameLehrer']) && isset($_POST['nNameLehrer']) && isset($_POST['emailLehrer'])){
        $lehrer = new Lehrer();
        $lehrer -> ID = -1;
        $lehrer -> Vorname = $_POST['vNameLehrer'];
        $lehrer -> Nachname = $_POST['nNameLehrer'];
        $lehrer -> EMail = $_POST['emailLehrer'];
        SaveLehrer($lehrer);
    }
}
else if(isset($_POST['pushGruppe'])){
    if(isset($_POST['nameGruppe'])){
        $gruppe = new Gruppe();
        $gruppe -> ID = -1;
        $gruppe -> Name = $_POST['nameGruppe'];
        SaveGruppe($gruppe);
    }
}

$gruppen = GetGruppen();
$lehrer = getAllLehrer();
writeAdminForm($gruppen,$lehrer);


writeFoot();
?>