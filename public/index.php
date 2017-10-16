<?php

// When executed in php built ib server, index.php is the router script and should give all away other requests
if (preg_match('/\.(?:png|jpg|jpeg|gif|html|css|js|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

const ROOT = '../';

require ROOT . 'vendor/autoload.php';

require ROOT . 'src/bootstrap.php';
