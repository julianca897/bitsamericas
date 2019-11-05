<?php


namespace Drupal\spotify_releases\Traits;

use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;
use SpotifyWebAPI;

trait GetTokenTrait {

  static public function getToken($url){
    $config = \Drupal::config('spotify_releases.apikeys');
    $clientId = $config->get('clientid');
    $clientSecret = $config->get('secretkey');
    $redirectUrl = "http://bitsamericas.docksal$url";
    $session = new SpotifyWebAPI\Session(
      $clientId, $clientSecret, $redirectUrl
    );


    $api = new SpotifyWebAPI\SpotifyWebAPI();

    if (isset($_GET['code'])) {
      $session->requestAccessToken($_GET['code']);
      $api->setAccessToken($session->getAccessToken());

//      return $api->getNewReleases();
      return $session->getAccessToken();
    } else {
      $options = [
        'scope' => [
          'user-read-email',
        ],
      ];

      header('Location: ' . $session->getAuthorizeUrl($options));

      die();

    }

  }

}