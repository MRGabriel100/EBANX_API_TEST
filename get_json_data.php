<?php 

function getData(){
    
$jsonFile = 'data.json';
if (!file_exists($jsonFile)) {
    http_response_code(404);
    echo json_encode(['error' => 'JSON File not Found']);
    exit;
}

// read JSON File
$jsonData = file_get_contents($jsonFile);

// Converts JSON to ARRAY
$data = json_decode($jsonData, true);

// Check Decode
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode(['error' => 'Error decoding JSON']);
    exit;
}

return $data;

}

//Check if the Account Exists, return the data of the account if found or null if not
function checkAccount($account_id){

    $data = getData();

    $isFound = null;
    foreach($data['accounts'] as $index => $account){

        if($account_id === $account['id']){
            $isFound = $account;
                 
            return [
                "index" => $index,
                "account" => $isFound
            ];
        } 

}

return null;

}

