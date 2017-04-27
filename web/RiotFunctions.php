<?php
require_once 'common.php';
require_once 'query.php';

class RiotFunctions {
  const RIOT_API_KEY = 'to do';

  var $riotAPI;

  function __construct(){
    $this->riotAPI = new RiotAPI(self::RIOT_API_KEY);
  }

  function getSummonerByName($tempName){
    $response = $this->riotAPI->get('/api/lol/oce/v1.4/summoner/by-name/'.rawurlencode($tempName));
    return $response;
  }

  function getSummonerById($tempId){
    $response = $this->riotAPI->get('/api/lol/oce/v1.4/summoner/'.$tempId);
    return $response;
  }

  /**
   * TODO: Allow up to 10 summoner IDs.
   * @param: $sumId3,$sumId4,$sumId5,$sumId6,$sumId7,$sumId8,$sumId9,$sumId10
   */
  function getSummonersById($sumId1,$sumId2){
    $response = $this->riotAPI->get('/api/lol/oce/v1.4/summoner/'.$sumId1.','.$sumId2.'/name');
    return $response;
  }

  function getSummonerMasteries($sumId1){
    $response = $this->riotAPI->get('/api/lol/oce/v1.4/summoner/'.$sumId1.'/masteries');
    return $response;
  }

  function getSummonerRunes($sumId1){
    $response = $this->riotAPI->get('/api/lol/oce/v1.4/summoner/'.$sumId1.'/runes');
    return $response;
  }

  function getSummonerCurrentGame($platformId, $sumId1){
    $response = $this->riotAPI->get('/observer-mode/rest/consumer/getSpectatorGameInfo/'.$platformId.'/'.$sumId1);
    return $response;
  }

  function getSummonerAllChampMastery($location, $sumId1){
    $response = $this->riotAPI->get('/championmastery/location/'.$location.'/player/'.$sumId1.'/champions');
    return $response;
  }

  function getChampById($champId1){
    $response = $this->riotAPI->get('/api/lol/static-data/oce/v1.2/champion/'.$champId1);
    return $response;
  }

  function getSummonerStatsById($sumId1){
    $response = $this->riotAPI->get('/api/lol/oce/v1.3/stats/by-summoner/'.$sumId1.'/summary');
    return $response;
  }

  function getListOfChamps(){
      $response = $this->riotAPI->get('/api/lol/static-data/oce/v1.2/champion');
      return $response;
  }
  function getMasteryById($masteryId){
      $response = $this->riotAPI->get('/api/lol/static-data/oce/v1.2/mastery/'.$masteryId);
      return $response;
  }
  function getRuneById($runeId){
      $response = $this->riotAPI->get('/api/lol/static-data/oce/v1.2/rune/'.$runeId);
      return $response;
  }

  function getSummonerMasteriesByName($tempName){
    $getId = $this->getSummonerByName($tempName);
    $data = json_decode($getId, true);
    $sumId = $data[$tempName]['id'];
    $masteries = $this->getSummonerMasteries($sumId);
    $response = json_decode($masteries, true);
    return $response;
  }
}

/*
$riotFunctions = new RiotFunctions();
$response = $riotFunctions->getSummonerMasteriesByName('2000jester');
print_r($response);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Riot API Functions</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
</html>
*/
