<?php

class RiotAPI {

  var $PROTOCOL;
  var $SERVER_NAME;
  var $API_KEY;

  function __construct($api_key, $protocol = 'https', $serverName = 'oce.api.pvp.net'){
    $this->API_KEY = $api_key;
    $this->PROTOCOL = $protocol;
    $this->SERVER_NAME = $serverName;
  }

  function get($api_url){
      ini_set('display_errors', 'off');
      $response = file_get_contents($this->PROTOCOL . '://' . $this->SERVER_NAME . $api_url . '?api_key=' . $this->API_KEY);
      ini_set('display_errors', 'on');
      return $response;
  }
}
