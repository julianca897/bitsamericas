<?php

namespace Drupal\spotify_releases\Service;

/**
 * Interface SpotifyReleasesInterface.
 */
interface SpotifyReleasesInterface {
  public function getReleases($token);
  public function formatReleases($token, $dataReleases);
}
