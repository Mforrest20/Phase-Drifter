
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- PHP code starts with forced HTTPS check -->
<?php
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

//Fetch all 10 possible entries
$scores = $pdo->query('SELECT * from highscores ORDER BY hs_score DESC LIMIT 10')->fetchAll();
if($scores){
	//iterate through each entry
	foreach ($scores as $row)
	{
		$namesTemp .= "<li>".$row['hs_initials']."</li>";
		$scoresTemp .= "<li>".$row['hs_score']."</li>";
	}
}
//If no entries found
else{
	$namesTemp = "0 results";
	$scoreTemp = "0 results";
}
//Close the connection
$conn = null;
?>






<head>
	<title>Phaser Drifter | About Us</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mansalva">
	<link rel="stylesheet" type="text/css" href="../styles/mainpage.css" title="style" />
</head>


<body>

<div class="logoNavbar">
	<div class="logo">
	<img src="../assets/final_logo.jpg" alt="Phaser Drifter Logo" height="125">
	</div>
	
	<div class="navContain">
		<div><a href="index.html"><button class="button w3-mansalva">Game</button></a></div>
		<div><a href="highscores.php"><button class="button w3-mansalva">Highscores</button></a></div>
		<div><a href="https://www.youtube.com/watch?v=V5hyo21Zl9k"><button class="button w3-mansalva">Youtube</button></a></div>
	</div>
</div>

<div class="w3-mansalva logoNavbar">
	<h1>High Scores</h1>
</div>

<div class="w3-mansalva highScoreContainer">
	<div class="name">
		<h3>Name:</h3>
		<ol style="margin-left: 14px;">
		<?php   if (isset($namesTemp)) echo $namesTemp; ?>
		</ol>
	</div>
	<div class="score">
		<h3>Score:</h3>
		<ul style="list-style-type:none;">
		<?php   if (isset($scoresTemp)) echo $scoresTemp; ?>
		</ul>
	</div>
</div>
</body>

</html>