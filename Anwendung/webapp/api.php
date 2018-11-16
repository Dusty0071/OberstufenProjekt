<?php
    include 'DBAccess.php';

    header('Content-Type: application/json');


    if(isset($_POST['action'])){
        switch ($_POST['action']) {
            case 'deleteLehrer':
                    if(is_numeric($_POST['lehrerId'])){
                        deleteLehrer($_POST['lehrerId']);
                    }
                    else{
                        returnError("Invalid value.");
                    }
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
    function deleteLehrer($id){

    }


?>