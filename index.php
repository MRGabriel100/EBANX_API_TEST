<?php

require_once 'balance.php';

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

    if($routes[0] === 'reset'){
        http_response_code(200);
        echo "OK";
    };
}