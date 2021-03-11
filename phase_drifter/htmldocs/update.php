<?php

//Load Cookies and Set variables from cookie
if($_COOKIE) {
	foreach ($_COOKIE as $key=>$val)
	{
		if ($key =='newName'){
			$newName = $val;
		}
		else if ($key =='newScore'){
			$newScore = $val;
		}
		else if ($key =='showScore'){
			$showScorePage = $val;
		}

	}
}
else
{
	echo "No Cookies are Set";    
}

$newDate = date('Y-m-d H:i:s');

//echo($newName."<br>".$newScore."<br>".$showScorePage);

//Load credentials config file from remote folder
$configfile = require '../../../config/config.php';
$config= $configfile['hsdb'];

$dsn = "mysql:host=".$config['host'].";dbname=".$config['db'].";charset=".$config['charset'];
echo $dsn."<br>";

try {
     $pdo = new PDO($dsn, $config['user'], $config['pass'], $config['options']);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$sql = "INSERT INTO highscores (hs_score,hs_initials,hs_date) VALUES (?,?,?)"; 
$pdo->prepare($sql)->execute([$newScore,$newName,$newDate]);

//Close the connection
$conn = null;

if($showScorePage=="yes"){
	header("Location: highscores.php");
}
else{
	header("Location: index.html");
}
?>