<?php


namespace Drupal\spotify_releases\Traits;

use SpotifyWebAPI;

trait RequestSpotTrait {

  static public function getReleases($token) {
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    if (isset($_GET['code'])) {
      $api->setAccessToken($token);
    }

    return $api->getNewReleases();
  }

}