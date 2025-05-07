<?php 

require_once 'get_json_data.php';
if($_SERVER['REQUEST_METHOD'] === 'GET'){

    function getBalance($account_id){
    $data = getData();
    $isFound = null;
    foreach($data['accounts'] as $account){

        if($account_id === $account['id']){
            $isFound = $account;
           
            break;
        } 
    } 
    if($isFound){

        echo json_encode(['status' => '200', 'balance' => $isFound['balance']]);
    } else {
        echo json_encode(['status' => '404', 'balance' => 0]);
    }}
}