<?php

namespace Drupal\spotify_releases\Service;

/**
 * Interface ArtistsInterface.
 */
interface ArtistsInterface {

  public function getInfoArtist();
  public function formatDataArtists($data, $artistimage, $artistname);
}
