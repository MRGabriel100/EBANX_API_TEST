<?php 
require_once 'get_json_data.php';

//Resets the data.json values
function resetData(){

    $data = [
        "accounts" => [
            [
                "id" => "300",
                "balance" => 0
            ]
        ]
    ];

    $json = json_encode($data, JSON_PRETTY_PRINT);

    if (file_put_contents('data.json', $json) === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Error reseting JSON File']);
        exit;
    }

    http_response_code(200);
    echo "OK";
}

//Create a new deposit and a new account if it doenst exist
function newDeposit($data){

    $jsonData = getData();
    $accountExist = checkAccount($data['destination']);
    $msg = '';
    if(!$accountExist){

        $new = [
            "id" => $data['destination'],
            "balance" => $data['amount']
        ];
        $jsonData['accounts'][] = $new; 
        $msg = [
            'destination' => 
                $new
            ];

    } else {
        $index = $accountExist['index'];
         $jsonData['accounts'][$index]['balance'] += $data['amount'];
        $msg = [
            'destination' => $jsonData['accounts'][$index]
        ];
    }

    saveData($jsonData, $msg);

}

//Withdraw from the account, and check if the account have suficient funds
function withdraw($data){
    $account = checkAccount($data['origin']);
    $jsonData = getData();

    if(!$account){
      returnError();
    } else {

        $index = $account['index'];
        $jsonData['accounts'][$index]['balance'] -= $data['amount'];
        $msg = [
            'origin' => $jsonData['accounts'][$index]
        ];

        if($jsonData['accounts'][$index]['balance'] < 0){
            http_response_code(402);
            echo 'Insufficient Funds';
        } else {
        saveData($jsonData, $msg);
    }
}
}

//Transfer if the origin account have sufficient funds
function transfer($data){

    $accountOrigin = checkAccount($data['origin']);
    $accountDestination = checkAccount($data['destination']);

    $jsonData = getData();

    if(!$accountOrigin || !$accountDestination){
       returnError();
    } else {

        $originIndex = $accountOrigin['index'];
        $destinationIndex = $accountDestination['index'];

        $jsonData['accounts'][$originIndex]['balance'] -= $data['amount'];
        $jsonData['accounts'][$destinationIndex]['balance'] += $data['amount'];
        $msg = [
            'origin' => $jsonData['accounts'][$originIndex],
            'destination' => $jsonData['accounts'][$destinationIndex]
        ];

        
        if($jsonData['accounts'][$originIndex]['balance'] < 0){
            http_response_code(402);
            echo 'Insufficient Funds';
        } else {
        saveData($jsonData, $msg);
    }
    }
}
function saveData($data, $msg)  {

    
    $jsonFile = 'data.json';
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    if(file_put_contents($jsonFile, $jsonData) === false){

        http_response_code(500);
        echo 'ERROR Saving Data';
    } else {

        http_response_code(201);
        echo json_encode($msg);
    }

}

function returnError(){
    http_response_code(404);
    echo(0);

}