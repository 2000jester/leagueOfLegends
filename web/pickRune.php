<?php
session_start();
require_once 'RiotFunctions.php';
$riotAPI = new RiotFunctions();

$runePageNumber = $_POST['chosenRune'];
$pageToBeShown = $_SESSION['summonerRuneInfo'][$runePageNumber];
$runesToBeShown = $pageToBeShown['slots'];
//$test = count($runesToBeShown);
//print_r($test);
?>
<!DOCTYPE html>
<html>
<head>
    <title>this page is bad</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
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
<h3><?=$_SESSION['summonerRuneInfo'][$runePageNumber]['name']?></h3>
<?php
echo "<table>
                <tr>
                    <th>Slot Id</th>
                    <th>Rune Id</th>
                    <th>Rune Name</th>
                    <th>Rune Effect</th>
                    <th>Teir</th>
                    <th>Type</th>
                </tr>";
for($i=0;$i < count($runesToBeShown);$i++){
    $before = microtime(true);
    $response = $riotAPI->getRuneById($runesToBeShown[$i]['runeId']);
    $after = microtime(true);
    $difference = $after - $before;
    $decodeResponse = json_decode($response, true);
    echo "<tr>";
    echo "<td>" . $runesToBeShown[$i]['runeSlotId'] . "</td>";
    echo "<td>" . $decodeResponse['id'] . "</td>";
    echo "<td>" . $decodeResponse['name'] . "</td>";
    echo "<td>" . $decodeResponse['description'] . "</td>";
    echo "<td>" . $decodeResponse['rune']['tier'] . "</td>";
    echo "<td>" . $decodeResponse['rune']['type'] . "</td>";
    echo "</tr>";
    usleep(1 - $difference);
}

echo "</table>";

?>
<h3>
    <a class="multiple" href="pickSummoner.php">Back</a><br>
</h3>
</body>
</html>
