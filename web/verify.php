<?php
require_once 'RiotFunctions.php';
require_once 'query.php';
$_query = new _query();
$query;
$riotAPI = new RiotFunctions();

//$_SESSION['formPostData'] = $_POST;
//print_r($_POST);
unset($_SESSION);
//session_start();
$htmlToShow;
$htmlToShowTwo;
$htmlToShowThree;
$summonerName;
$result;
$summonerData;
$summonerName;
$login;


//if//catch for incorrect form submission
if($_POST['action'] == 'login'){
  if($_POST['username'] == '' || $_POST['password'] == ''){
    header('location: login.php');
  }
} else if($_POST['action'] == 'register'){
  if($_POST['name'] == '' || $_POST['username'] == '' || $_POST['summonerName'] == '' || $_POST['password'] == ''){
    header('location: login.php');
  }
}

function login($nameTemp, $passTemp)
{
    global $_query;
    global $htmlToShowTwo;
    global $htmlToShowThree;
    global $result;
    global $riotAPI;
    global $summonerData;
    global $summonerName;
    global $login;


    $tempFirstName = $nameTemp;
    $tempPassword = $passTemp;

    $query = "SELECT id, Username, `Name`, SummonerName FROM Users WHERE Username = ? and Password = ?";
    $statementObj = $_query->connection->prepare($query);

    $statementObj->bind_param("ss", $tempFirstName, $tempPassword);
    $statementObj->execute();
    $result = $statementObj->get_result();
    //print_r($result);
    //$user = $result->fetch_assoc();
    //$summonerJSONData = $riotAPI->getSummonerByName($user['SummonerName']);
    //$summonerName = $user['SummonerName'];
    //$summonerData = json_decode($summonerJSONData,true);
    //$summonerDataKeys = array_keys($summonerData);
    //$summonerName = $summonerDataKeys[0];
    //print_r($statementObj->num_rows);
    if ($result->num_rows > 0 ) {
        $htmlToShowTwo = 'Login Successful';
        $htmlToShowThree = '<a class="multiple" href="pickSummoner.php">Proceed</a>';
        $login = true;
    } else {
        header('location: login.php');
    }
}

function register($name, $username, $password, $summonerName){
  global $_query;
  global $htmlToShowTwo;
  global $htmlToShowThree;

    $query = "SELECT Username FROM Users WHERE Username = ?";
    $statementObj = $_query->connection->prepare($query);

    $statementObj->bind_param("s", $username);
    $statementObj->execute();
    $statementObj->store_result();

    if($statementObj->num_rows == 0){
        $query = "INSERT INTO Users (`Name`, Username, Password, SummonerName) VALUES (?, ?, ?, ?)";
        $statementObj = $_query->connection->prepare($query);

	    $statementObj->bind_param("ssss", $name, $username, $password, $summonerName);
	    $statementObj->execute();
	    $htmlToShowTwo = 'User created';

    } else {
        $htmlToShowTwo = 'user already exists';
    }
}

if($_POST['action'] == 'login'){
  login($_POST['username'], $_POST['password']);
    session_start();

    $_SESSION['login'] = $login;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['summonerName'] = $summonerName;
    $_SESSION['summonerId'] = $summonerData[$summonerName]['id'];
} else if($_POST['action'] == 'register'){
  register($_POST['name'], $_POST['username'], $_POST['password'], $_POST['summonerName']);
}


//print_r($id['2000jester']['id']);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Verify</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
  <h2>
    <?php echo $htmlToShowTwo; ?><br>
        <br>
    <?php echo $htmlToShowThree; ?>
      <br><a class="multiple" href="login.php">Back to Login</a>
  </h2>
  </body>
</html>
