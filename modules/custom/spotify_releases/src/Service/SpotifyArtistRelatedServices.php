<?php

namespace Drupal\spotify_releases\Service;


use Psr\Log\LoggerInterface;

use SpotifyWebAPI;

/**
 * Class SpotifyArtistRelatedServices.
 */
class SpotifyArtistRelatedServices implements SpotifyArtistRelatedInterface {

  /**
   * @var \Psr\Log\LoggerInterface
   */
  private $logger;


  /**
   * Constructs a new SpotifyArtistRelatedServices object.
   */
  public function __construct(LoggerInterface $logger) {

    $this->logger = $logger;


  }

  public function getIdArtist($token, $idart) {
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    if (isset($_GET['code'])) {
      $api->setAccessToken($token);
    }
    $objReleases = $api->getArtistRelatedArtists($idart);

    $arrArtist = [];

    foreach ($objReleases->artists as $key => $value) {
      array_push($arrArtist, $value->name);
    }
    return $arrArtist;
  }



}
