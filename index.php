<?php

require_once 'balance.php';
require_once 'events.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $url = $_GET['url'] ?? 'home';
    $routes = explode('/', $url);

    if ($routes[0] === 'balance') {
        $accountId = $_GET['account_id'] ?? null;

        if ($accountId) {
            getBalance($accountId);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Account ID não informado'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Rota não encontrada'
        ]);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $url = $_GET['url'] ?? 'home';
    $routes = explode('/', $url);

    if($url === 'reset'){
        resetData();
    } else if ($url === 'event'){

        $data = json_decode(file_get_contents('php://input'), true);

        $type = $data['type'];
        switch($type){
    
            case 'deposit': newDeposit($data);
            break;
        }
    }
   
  
}