<?php
    include 'DBAccess.php';

    header('Content-Type: application/json');


    if(isset($_POST['action'])){
        switch ($_POST['action']) {
            case 'deleteLehrer':
                    if(is_numeric($_POST['lehrerId'])){
                        triggerDeleteLehrer($_POST['lehrerId']);
                    }
                    else{
                        returnError("Invalid value.");
                    }
                break;

            case 'deleteGruppe':
                if(is_numeric($_POST['gruppeId'])){
                    triggerDeleteGruppe($_POST['gruppeId']);
                }
                else{
                    returnError("Invalid value.");
                }
                break;

            case 'deleteLehrerGruppe':
                if(is_numeric($_POST['gruppeId'])&& is_numeric($_POST['lehrerId'])){
                    triggerDeleteLehrerGruppe($_POST['lehrerId'],$_POST['gruppeId']);
                }
                else{
                    returnError("Invalid value.");
                }
                break;

            case 'getLehrerGruppe':
                echo json_encode(GetLehrerGruppen());
                break;

            case 'getLehrer':
                echo json_encode(getAllLehrer());
                break;
            
            default:
                returnError("Acttion not implemented.");
                break;
        }
    }
    else{
        returnError("Action not set.");
    }

    function returnError($message){
        returnResult(false,$message);
    }
    function returnSuccess($message){
        returnResult(true,$message);
    }
    function returnResult($ok,$message){
        echo json_encode(array('ok'=>$ok,'message'=>$message,'timestamp'=>time()));
    }
    function triggerDeleteLehrer($id){
        $result = DeleteLehrer($id);
        if($result){
            returnSuccess("Lehrer gelöscht");
        }
        else{
            returnError("Lehrer konnte nicht gelöscht werden.");
        }
    }
    function triggerDeleteGruppe($id){
        $result = DeleteGruppe($id);
        if($result){
            returnSuccess("Gruppe gelöscht");
        }
        else{
            returnError("Gruppe konnte nicht gelöscht werden.");
        }
    }

    function triggerDeleteLehrerGruppe($lehrerId,$gruppeId){
        $result = DeleteLehrerGruppe($lehrerId,$gruppeId);
        if($result){
            returnSuccess("Verbindung gelöscht");
        }
        else{
            returnError("Verbindung konnte nicht gelöscht werden.");
        }
    }


?>