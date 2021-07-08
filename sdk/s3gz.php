<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region' => 'us-east-1'
]);

$s3->putObject([
    'Bucket' => 'example-bucket-name',
    'Key' => 'hello.txt',
    'Body' => gzencode('Hello World!',9),	// gzip content
    'ContentEncoding' => 'gzip',		// specify gzip encoding
    'ContentType' => 'text/plain',		// specify content type
]);

$result = $s3->getObject([
    'Bucket' => 'example-bucket-name',
    'Key' => 'hello.txt'
]);

// Print the body of the result by indexing into the result object.
echo $result['Body'] . PHP_EOL;
