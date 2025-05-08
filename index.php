<?php

require_once 'balance.php';
require_once 'events.php';

$url = $_GET['url'];
$routes = explode('/', $url);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if ($routes[0] === 'balance') {
        $accountId = $_GET['account_id'] ?? null;

            getBalance($accountId);
       
    } else {
      //If a non-existent route is requested
        http_response_code(404);
        echo 'Route Not Found';
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST'){


    if($url === 'reset'){
        resetData();
    } else if ($url === 'event'){

        //Get the POST data
        $data = json_decode(file_get_contents('php://input'), true);

        $type = $data['type'];
        switch($type){
    
            case 'deposit': newDeposit($data);
            break;

            case 'withdraw': withdraw($data);
            break;

            case 'transfer': transfer($data);
            break;

            default: http_response_code(404);
            echo 'Route Not Found';
            break;
        }
    }
   
  
}