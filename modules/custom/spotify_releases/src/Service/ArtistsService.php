<?php

namespace Drupal\spotify_releases\Service;

use Psr\Log\LoggerInterface;
use SpotifyWebAPI;

/**
 * Class ArtistsService.
 */
class ArtistsService implements ArtistsInterface {

  /**
   * @var \Psr\Log\LoggerInterface
   */
  private $logger;

  /**
   * Constructs a new ArtistsService object.
   */
  public function __construct(LoggerInterface $logger) {

    $this->logger = $logger;
  }

  public function getInfoArtist() {
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    if (isset($_GET['code'])) {
      $api->setAccessToken($_GET['code']);
    }
    $current_path = \Drupal::service('path.current')->getPath();
    $result = \Drupal::service('path.alias_manager')->getAliasByPath($current_path);
    $idArtist = explode('/', $result);
    $artistData = $api->getArtists($idArtist[2]);
    $artistimage = $artistData->artists[0]->images[0]->url;
    $artistname = $artistData->artists[0]->name;
    $dataReleases = $api->getArtistTopTracks($idArtist[2], ['country' => 'US']);

    return $this->formatDataArtists($dataReleases, $artistimage, $artistname);

  }

  public function formatDataArtists($data, $artistimage, $artistname) {
    $arrsongs = [];
    foreach ($data->tracks as $key => $value) {
      array_push($arrsongs, [
        'albumimage' => $value->album->images[0]->url,
        'albumname' => $value->album->name,
        'songname' => $value->name,
      ]);
    }
    $arrData = ['artistname' => $artistname, 'artistimage' => $artistimage, 'songs' => $arrsongs];

    return $arrData;
  }



}
