<?php 
require_once 'get_json_data.php';
function resetData(){

    $data = [
        "accounts" => [
            [
                "id" => "300",
                "balance" => 5000.00
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