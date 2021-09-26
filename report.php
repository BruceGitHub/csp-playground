<?php
$log_file = dirname(__FILE__) . '/csp-violations.log';
$log_file_size_limit = 1000000;

$json_data = file_get_contents('php://input');

//$json_data = file_get_contents('prova.json');

if ($json_data = json_decode($json_data)) 
{
    $json_dataNode = $json_data->{"csp-report"};
    // var_dump($json_data1);
    $json_dataNode = json_encode($json_dataNode, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($log_file, $json_dataNode.PHP_EOL.'##'.PHP_EOL, FILE_APPEND | LOCK_EX);
}
