<?php
$htmlToShow = "error";
session_start();


if($_SESSION['login'] == true){
    //print_r('test');
    $htmlToShow = '
    
        <form method="post" action="summonerFunction.php">
            <div class="multiple">
                    <select name="summonerAction">
                        <option value="blank"></option>
                        <option value="view">Proceed</option>
                        <option value="add">Add a summoner</option>
                        <option value="delete">Delete a summoner</option>
                    </select><br>
                    <br>
                <input type="submit" name="submit" value="Proceed">
          </div><br>
        </form>
    
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
<h3>
    View all linked summoners, add summoners or delete summoners
</h3><br>
<?= $htmlToShow ?><br>
<div class="multiple">
<a class="multiple" href="login.php">Back</a><br>
    <a class="multiple" href="login.php">Back to Login</a>
</div>
</body>
</html>