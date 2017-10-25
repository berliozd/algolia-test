<?php


require 'vendor/autoload.php';

use \AlgoliaSearch\Client;


$data = file_get_contents('data/data.json');

/** @var Client $algoliaClient */
$algoliaClient = new Client('145VSOMR9Y', '47f3053a4b4048c6baf479dbd0e8fb41');

/** @var \AlgoliaSearch\Index $algoliaIndex */
$algoliaIndex = $algoliaClient->initIndex('appStore');

$algoliaIndex->addObjects(json_decode($data));


