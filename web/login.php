<?php

require_once 'query.php';
session_start();
session_unset();

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="Header">
      <h2>
      League Of Legends Info
      </h2>
    </div>
    <div id="Body">
      <form method="post" action="verify.php">
        <div class="multiple">
          <h3>
            If Logging In
          </h3>
          <br>
          <label class="login">Username :</label><input type="text" name="username" value="ruben2">
          <br>
            <label class="login">Password :</label><input type="password" name="password" value="password">
          <br>
          <br>
          <input type="hidden" name="action" value="login">
          <input type="submit" name="submit" value="Login">
        </div>
      </form>
      <form method="post" action="verify.php">
        <div class="multiple">
          <h3>
            If Registering
          </h3>
          <br>
            <label class="login">Name :</label><input type="text" name="name"><br>
            <label class="login">Username :</label><input type="text" name="username"><br>
            <label class="login">Summoner Name :</label><input type="text" name="summonerName"><br>
            <label class="login">Password :</label><input type="password" name="password"><br>
            <br>
            <br>
            <input type="hidden" name="action" value="register">
            <input type="submit" name="submit" value="Register">
            <small>
              <br>
              <br>
              <br>
            Developed by 2000jester and ARG2009<br>
            *if a page wont let you proceed or you are being redirected to the previous page it is likely that a field or option has not been filled in correctly if at all*
          </small>
        </div>
      </form>
    </div>
  </body>
</html>
