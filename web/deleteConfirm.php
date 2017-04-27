<?php
session_start();
require_once 'query.php';
$_query = new _query();
$count = 0;
$deleted = "";

$query = "SELECT SummonerName FROM Users WHERE Username = ? ";
$statementObj = $_query->connection->prepare($query);

$statementObj->bind_param("s", $_SESSION['username']);
$statementObj->execute();
$result = $statementObj->get_result();
$assocSummonerName = $result->fetch_assoc();
$exploded = explode(",", $assocSummonerName['SummonerName']);
//print_r($exploded);
$count = count($exploded);

for($i=0;$i<$count;$i++){
    if($exploded[$i] == $_POST['chosenSummoner']){
        $deleted = $exploded[$i];
        unset($exploded[$i]);
    }
}

$toEnterSummonerName = implode(",", $exploded);
//print_r($toEnterSummonerName);

$query = "UPDATE Users SET SummonerName = ? WHERE Username = ?";
$statementObj = $_query->connection->prepare($query);

$statementObj->bind_param("ss", $toEnterSummonerName, $_SESSION['username'] );
$statementObj->execute();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Summoner</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<h3>
    <?php if($deleted == ""){
        ?>
    Not Deleted <br>
    <?php
    } else {
    ?>
    <?= $deleted ?> Deleted<br>
    <?php }
    ?>
    <a class="multiple" href="login.php">Back to Login</a>
</h3>
</html>
