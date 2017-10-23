<?php

// When executed in php built ib server, index.php is the router script and should give all away other requests
if (preg_match('/\.(?:png|jpg|jpeg|gif|html|css|js|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

function get_root()
{
    return is_dir('vendor') ? '' : '../';
}

require get_root() . 'vendor/autoload.php';

require get_root() . 'src/bootstrap.php';
