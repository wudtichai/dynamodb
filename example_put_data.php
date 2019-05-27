<?php

require 'vendor/autoload.php';

date_default_timezone_set('Asia/Bangkok');

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$sdk = new Aws\Sdk([
    'region'   => 'ap-southeast-1',
    'version'  => 'latest'
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();

$tableName = 'RawData';
$htmlInput = "<html>Hello World!</html>";

$json = json_encode([
    'html' => $htmlInput,
    'id' => 2
]);

$params = [
    'TableName' => $tableName,
    'Item' => $marshaler->marshalJson($json)
];

try {
    $result = $dynamodb->putItem($params);
    echo "Added html id: " . $id . "\n";
} catch (DynamoDbException $e) {
    echo "Unable to add html:\n";
    echo $e->getMessage() . "\n";
}

?>