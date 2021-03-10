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

$host = '127.0.0.1';
$db   = 'pddb';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
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