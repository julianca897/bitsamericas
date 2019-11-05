<?php

namespace Drupal\spotify_releases\Service;


use Psr\Log\LoggerInterface;
use Drupal\spotify_releases\Service\SpotifyArtistRelatedInterface;

use SpotifyWebAPI;

/**
 * Class SpotifyReleasesServices.
 */
class SpotifyReleasesServices implements SpotifyReleasesInterface {



  /**
   * @var \Psr\Log\LoggerInterface
   */
  private $logger;

  /**
   * @var \Drupal\spotify_releases\Service\SpotifyArtistRelatedInterface
   */
  private $artistRelated;


  /**
   * Constructs a new SpotifyReleasesServices object.
   */
  public function __construct(LoggerInterface $logger, SpotifyArtistRelatedInterface $artistRelated) {

    $this->logger = $logger;
    $this->artistRelated = $artistRelated;
  }

  public function getReleases($token) {
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    if (isset($_GET['code'])) {
      $api->setAccessToken($token);
    }
    $dataReleases = $this->formatReleases($token, $api->getNewReleases());

    return $dataReleases;
  }

  public function formatReleases($token, $dataReleases) {
    $arrData = [];
    foreach ($dataReleases->albums->items as $key => $value) {
      $dataArtistRelated = $this->getArtistRelated($token, $value->artists[0]->id);
      array_push($arrData, [
        'albumname' => $value->name,
        'image' => $value->images[0]->url,
        'artistname' => $value->artists[0]->name,
        'artistid' => $value->artists[0]->id,
        'artist_related' => $dataArtistRelated,
      ]);
    }
    return $arrData;
  }

  public function getArtistRelated($token, $artistid) {

    $objArtistRelated = $this->artistRelated->getIdArtist($token, $artistid);
    return $objArtistRelated;
  }

}
