<?php


namespace Drupal\spotify_releases\Traits;

use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;
use SpotifyWebAPI;

trait GetArtistRelatedTrait {

  static public function getArtist($token){
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    if (isset($_GET['code'])) {
      $api->setAccessToken($token);
    }

    return $api->getNewReleases();

  }

}