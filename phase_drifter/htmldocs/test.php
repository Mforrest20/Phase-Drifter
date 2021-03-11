<?php

echo "testing!";
require '../../../config/test1.php';
$configvar = require '../../../config/config.php';
$config= $configvar['hsdb'];

echo $config['host']."<br>";
echo $config['db']."<br>";
echo $config['user']."<br>";
echo $config['pass']."<br>";
echo $config['charset']."<br>";
$dsn = "mysql:host=".$config['host'].";dbname=".$config['db'].";charset=".$config['charset'];
echo $dsn."<br>";


?>