<?php
session_start();
require_once 'RiotFunctions.php';
$riotAPI = new RiotFunctions();
require_once 'query.php';
$_query = new _query();

$htmlToShow = "";

$fourOfourResult = $riotAPI->getSummonerByName($_POST['summonerName']);
if(empty($fourOfourResult)){

    print_r('what are you doin? you think ur funny? huh?');
    $htmlToShow = '<head>
    <title>Summoner</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<h3>
    <br>
    <a class="multiple" href="login.php">Back to Login</a>
</h3>';

} else {

$query = "SELECT SummonerName FROM Users WHERE Username = ? ";
$statementObj = $_query->connection->prepare($query);

$statementObj->bind_param("s", $_SESSION['username']);
$statementObj->execute();
$result = $statementObj->get_result();
$assocSummonerName = $result->fetch_assoc();
$exploded = explode(",", $assocSummonerName['SummonerName']);
$exploded[] = $_POST['summonerName'];
//print_r($exploded);
$toEnterSummonerName = implode(",", $exploded);
print_r($toEnterSummonerName);

$query = "UPDATE Users SET SummonerName = ? WHERE Username = ?";
$statementObj = $_query->connection->prepare($query);

$statementObj->bind_param("ss", $toEnterSummonerName, $_SESSION['username'] );
$statementObj->execute();

$htmlToShow = '<head>
    <title>Summoner</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<h3>
    Creation successful<br>
    <a class="multiple" href="login.php">Back to Login</a>
</h3>'
?>
<?php }; ?>
<!DOCTYPE html>
<html>
<?=$htmlToShow?>
</html>
