<?php 

require_once 'get_json_data.php';

    //Get the balance of the Account
    function getBalance($account_id){
    $isFound = checkAccount($account_id);
    if($isFound){
        http_response_code(200);
        echo($isFound['account']['balance']);
    } else {
        http_response_code(404);
        echo (0);
        exit;
    }}
