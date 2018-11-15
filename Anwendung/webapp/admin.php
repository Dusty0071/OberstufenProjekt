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
    if(!empty($_POST['vNameLehrer']) && !empty($_POST['nNameLehrer']) && !empty($_POST['emailLehrer'])){
        $lehrer = new Lehrer();
        $lehrer -> ID = -1;
        $lehrer -> Vorname = $_POST['vNameLehrer'];
        $lehrer -> Nachname = $_POST['nNameLehrer'];
        $lehrer -> EMail = $_POST['emailLehrer'];
        SaveLehrer($lehrer);
    }
}
else if(isset($_POST['pushGruppe'])){
    if(!empty($_POST['nameGruppe'])){
        $gruppe = new Gruppe();
        $gruppe -> ID = -1;
        $gruppe -> Name = $_POST['nameGruppe'];
        SaveGruppe($gruppe);
    }
}
else if(isset($_POST['pushLehrerGruppe'])){
    $lehrerGruppe= new LehrerGruppe();
    $lehrerGruppe -> GruppenID = $_POST['gruppeList'];
    $lehrerGruppe -> LehrerID = $_POST['lehrerList'];
}

$gruppen = GetGruppen();
$lehrer = getAllLehrer();
writeAdminForm($gruppen,$lehrer);


writeFoot();
?>