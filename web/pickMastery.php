<?php
session_start();
require_once 'RiotFunctions.php';
$riotAPI = new RiotFunctions();

$masteryPageNumber = $_POST['chosenMastery'];
$pageToBeShown = $_SESSION['summonerMasteryInfo'][$masteryPageNumber];
$masteriesToBeShown = $pageToBeShown['masteries'];
//print_r($masteriesToBeShown);
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
    <h3><?=$_SESSION['summonerMasteryInfo'][$masteryPageNumber]['name']?></h3>
    <?php
        echo "<table>
                <tr>
                    <th>Id</th>
                    <th>Mastery Name</th>
                    <th>Rank</th>
                    <th>Effect</th>
                </tr>";

        for($i=0;$i < count($masteriesToBeShown);$i++){
            $before = microtime(true);
            $response = $riotAPI->getMasteryById($masteriesToBeShown[$i]['id']);
            $after = microtime(true);
            $difference = $after - $before;
            $decodeResponse = json_decode($response, true);
            echo "<tr>";
            echo "<td>" . $masteriesToBeShown[$i]['id'] . "</td>";
            echo "<td>" . $decodeResponse['name'] . "</td>";
            echo "<td>" . $masteriesToBeShown[$i]['rank'] . "</td>";
            echo "<td>" . implode("<br />",$decodeResponse['description']) . "</td>";
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
