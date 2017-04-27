<?php
session_start();
$_SESSION['selectedSummoner'] = $_POST['chosenSummoner'];
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_SESSION['username']?></title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h2>
<form method="post" action="result.php">
    <div>
        <h3>Hit up the api <?= $_SESSION['selectedSummoner'] ?></h3>
        <select name="action">
            <option value="blank"></option>
            <option value="getSummonerById">Get Summoner Info</option>
            <!--<option value="getSummoner"><-->
            <option value="getSummonerMasteries">Get Summoner Masteries</option>
            <option value="getSummonerRunes">Get Summoner Runes</option>
            <option value="getSummonerCurrentGame">Get Summoner Current Game</option>
            <option value="getSummonerAllChampMastery">Get Summoner All Champ Mastery</option>
            <option value="getListOfChamps">Get List of Champions</option>
            <option value="getSummonerStatsById">Get Summoner Stats</option>
        </select><br>
    </div>
    <br>
    <input type="submit" name="submit" value="Proceed"><br>
    <a class="multiple" href="pickSummoner.php">Back</a><br>
    <a class="multiple" href="login.php">Back to Login</a>
</form>
</h2>
</body>
</html>

