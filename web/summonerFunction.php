<?php
session_start();
$htmlToShow = "";
require_once 'RiotFunctions.php';
require_once 'query.php';
$_query = new _query();
$count = 0;
$summonerNames = array();

//print_r($_SESSION['username']);
if($_POST['summonerAction'] == 'blank'){
    header('location: pickSummoner.php');
} else if ($_POST['summonerAction'] == 'view' || $_POST['summonerAction'] == 'delete'){
    global $count;
    //prepares and executes query
    $query = "SELECT SummonerName FROM Users WHERE Username = ?";
    $statementObj = $_query->connection->prepare($query);

    $statementObj->bind_param("s", $_SESSION['username']);
    $statementObj->execute();

    //interprets results from query
    $result = $statementObj->get_result();
    $summoner = $result->fetch_assoc();
    $summonerNames = explode(",", $summoner['SummonerName']);
    //print_r($exploded);
    $count = count($summonerNames);

    //gives user list of summoners
    /*for($i=0;$i<$count;$i++)
    {
        print_r($exploded[$i] . "<br>");
    }*/

    $_SESSION['viewSummoner'] = $summonerNames;
    $_SESSION['countSummoner'] = $count;
    $_SESSION['viewed'] = true;


} else if($_POST['summonerAction'] == 'add'){
    $htmlToShow = '
<h3>
<div class=""multiple>
    <form method="post" action="confirmCreation.php">
        <input type="text" name="summonerName"><br>
      <input type="submit" name="submitNewSummonerName" value="confirm"><br>
      </form>
</div>
</h3>
';
}




?>
<!DOCTYPE html>
<html>
<head>
    <title>Summoner</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?= $htmlToShow ?><br>
<div class="multiple">

    <!-- PHP IF VIEW -->
    <?php if($_POST['summonerAction'] == 'view'){?>
       <form method="post" action="proceed.php">
        <select name="chosenSummoner" id="summonerNameSelection">
            <?php
            for($i=0;$i<$count;$i++)
            {
                echo "<option value='" . $summonerNames[$i] . "'>" . $summonerNames[$i] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" name="submit" value="Proceed"><br>
    </form>
        <?php
        } else if ($_POST['summonerAction'] == 'delete'){
        ?>
        <form method="post" action="deleteConfirm.php">
            <select name="chosenSummoner" id="summonerNameSelection">
                <?php
                for($i=0;$i<$count;$i++)
                {
                    echo "<option value='" . $summonerNames[$i] . "'>" . $summonerNames[$i] . "</option>";
                }
                ?>
            </select>
            <br>
            <input type="submit" name="submit" value="Proceed"><br>
        </form>
        <?php
        }
        ?>
        <!--<label for="summonerNameSelection">Select SUmmoner</label>-->

    <a class="multiple" href="pickSummoner.php">Back</a><br>
    <a class="multiple" href="login.php">Back to Login</a>
</div>
</body>
</html>
