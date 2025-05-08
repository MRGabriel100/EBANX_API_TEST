<?php 

function getData(){
    
$jsonFile = 'data.json';
if (!file_exists($jsonFile)) {
    http_response_code(404);
    echo json_encode(['error' => 'Arquivo de dados não encontrado']);
    exit;
}

// Lê o conteúdo do arquivo JSON
$jsonData = file_get_contents($jsonFile);

// Converte o JSON para array associativo
$data = json_decode($jsonData, true);

// Verifica se a decodificação foi bem-sucedida
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao decodificar o JSON']);
    exit;
}

return $data;

}

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

