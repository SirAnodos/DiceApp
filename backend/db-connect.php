<!-- connect to database -->

<?php
function dbConnect() {
    include('server-config.php');
    return new mysqli($config['db_host'], $config['db_user'], $config['db_pwd'], $config['db_name']);
}
?>