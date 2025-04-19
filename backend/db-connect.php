<?php

include(server-config.php);
$connection = new mysqli($config['db_host'], $config['db_user'], $config['db_pwd'], $config['db_name']);

?>