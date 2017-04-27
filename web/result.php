<?php
require_once 'RiotFunctions.php';
$riotAPI = new RiotFunctions();
session_start();

$summonerInfo = $riotAPI->getSummonerByName($_SESSION['selectedSummoner']);
$summonerInfoDecode = json_decode($summonerInfo, true);
$summonerInfoDecodeKeys = array_keys($summonerInfoDecode);
//print_r($summonerInfoDecode);
$summonerName = $summonerInfoDecodeKeys[0];
$summonerId = $summonerInfoDecode[$summonerName]['id'];
//print_r($summonerId);

$masteryInfo;
$runeInfo;
$info;
$htmlToShow = "";
$numberOfMasteryPages = 0;
$numberOfRunePages = 0;
$summonerMasteryPages = [];
$summonerRunePages = [];
$i = 0;
$champListArray = [];


require_once 'RiotFunctions.php';
$riotAPI = new RiotFunctions();

if($_POST['action'] == "blank"){
    header('location: pickSummoner.php');
} else if ($_POST['action'] == "getSummonerById"){
    global $masteryInfo;
    if($masteryInfo == "") {
        $masteryInfo = $riotAPI->getSummonerById($summonerId);
        $infoDecode = json_decode($masteryInfo, true);
        $summoner = $infoDecode[$summonerId];
    }
    $htmlToShow = '
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        background: #e6d29d;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }
</style>
<h2>
<table>
  <tr>
    <th>Id</th>
    <th>Summoner Name</th>
    <th>Summoner Level</th>
  </tr>
  <tr>
    <td>' . $summoner["id"]. '</td>
    <td>' . $summoner["name"]. '</td>
    <td>' . $summoner["summonerLevel"]. '</td>
  </tr>
</table>
<br>

<a class="multiple" href="pickSummoner.php">Back</a>
</h2>';
} else if ($_POST['action'] == "getSummonerMasteries"){
    global $masteryInfo;
    global $numberOfMasteryPages;
    global $summonerMasteryPages;

    if($masteryInfo == "") {
        $masteryInfo = $riotAPI->getSummonerMasteries($summonerId);
        $masteryInfoDecode = json_decode($masteryInfo, true);
        $summonerMasteryInfo = $masteryInfoDecode[$summonerId];
        $summonerMasteryPages = $summonerMasteryInfo['pages'];
        $numberOfMasteryPages = count($summonerMasteryInfo['pages']);
    }
    $htmlToShow = '<a class="multiple" href="pickSummoner.php">Back</a>';
} else if ($_POST['action'] == "getSummonerRunes"){
    global $runeInfo;
    global $numberOfRunePages;
    global $summonerRunePages;

    if($runeInfo == "") {
        $runeInfo = $riotAPI->getSummonerRunes($summonerId);
        $runeInfoDecode = json_decode($runeInfo, true);
        $summonerRuneInfo = $runeInfoDecode[$summonerId];
        $summonerRunePages = $summonerRuneInfo['pages'];
        $numberOfRunePages = count($summonerRuneInfo['pages']);
    }
    $htmlToShow = '<a class="multiple" href="pickSummoner.php">Back</a>';
} else if ($_POST['action'] == "getSummonerCurrentGame"){
    global $masteryInfo;
    if($masteryInfo == "") {
        $masteryInfo = $riotAPI->getSummonerCurrentGame('OC1', $summonerId);
        $infoDecode = json_decode($masteryInfo, true);
        print_r($infoDecode);
    }
    $htmlToShow = '<a class="multiple" href="pickSummoner.php">Back</a>';
} else if ($_POST['action'] == "getSummonerAllChampMastery"){
    global $masteryInfo;
    if($masteryInfo == "") {
        $masteryInfo = $riotAPI->getSummonerAllChampMastery('OC1', $summonerId);
        $infoDecode = json_decode($masteryInfo, true);
        print_r($infoDecode);
    }
    $htmlToShow = '<a class="multiple" href="pickSummoner.php">Back</a>';
} else if ($_POST['action'] == "getSummonerStatsById"){
    global $masteryInfo;
    if($masteryInfo == "") {
        $masteryInfo = $riotAPI->getSummonerStatsById($summonerId);
        $infoDecode = json_decode($masteryInfo, true);
        print_r($infoDecode);
    }
    $htmlToShow = '<a class="multiple" href="pickSummoner.php">Back</a>';
} else if ($_POST['action'] == "getChampByName"){
    global $info;
    global $champListArray;

    if($info == "") {
        $listOfChamps = $riotAPI->getListOfChamps();
        $decodeList = json_decode($listOfChamps, true);
        $champListArray = $decodeList;
    }
    $htmlToShow = '<a class="multiple" href="pickSummoner.php">Back</a>';
} else {
    header('location: proceed.php');
}
//print_r($htmlToShow);\
if($_POST['action'] == 'getSummonerMasteries'){
$_SESSION['summonerMasteryInfo'] = $summonerMasteryPages;
} else if($_POST['action'] == 'getSummonerRunes'){
    $_SESSION['summonerRuneInfo'] = $summonerRunePages;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_SESSION['username']." is bad at league"?></title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<?php //print_r($summonerMasteryPages) ?>
<?php if($_POST['action'] == 'getSummonerMasteries'){ global $i;?>
    <h3>
    <form method="post" action="pickMastery.php">
        <select name="chosenMastery" id="masterySelection">
            <?php for($i=0; $i < $numberOfMasteryPages; $i++){
                echo "<option value='" . $i . "'>" . ($i + 1) . " - " . $summonerMasteryPages[$i]['name'] . "</option>";
            } ?>
        </select>
            <br>
            <br><input type="submit" name="submit" value="Proceed">
    </form>
        <br>
        <a class="multiple" href="pickSummoner.php">Back</a><br>
    <small>
        note this may take time
    </small>
    </h3>
<?php } else if($_POST['action'] == 'getSummonerRunes'){; ?>
    <h3>
        <form method="post" action="pickRune.php">
            <select name="chosenRune" id="runeSelection">
                <?php for($i=0; $i < $numberOfRunePages; $i++){
                    echo "<option value='" . $i . "'>" . ($i + 1) . " - " . $summonerRunePages[$i]['name'] . "</option>";
                } ?>
            </select>
            <br>
            <br><input type="submit" name="submit" value="Proceed">
        </form>
        <br>
        <a class="multiple" href="pickSummoner.php">Back</a><br>
        <small>
            note this may take time
        </small>
    </h3>
<?php } else if($_POST['action'] == 'getListOfChamps'){
    ?>
    <head>
    <style>
    table, th, td {
        border: 1px solid black;
            border-collapse: collapse;
            background: #e6d29d;
        }
        th, td {
        padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
<?php//print_r($_SESSION['pageName'])?>
    <h3>List of Champions</h3>
    <?php
echo "<table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Title</th>
                </tr>";

    print_r($champListArray);
foreach($champListArray['data'] as $champion){
    echo "<tr>";
    echo "<td>" . $champion['id'] . "</td>";
    echo "<td>" . $champion['name'] . "</td>";
    echo "<td>" . $champion['title'] . "</td>";
    echo "</tr>";
}

echo "</table>";

?>
<?php } else {; ?>
    <body>
    <?= $htmlToShow ?>
    <h3>
        <br><a class="multiple" href="login.php">Back to Login</a>
    </h3>
    </body>
<?php }; ?>
</html>


