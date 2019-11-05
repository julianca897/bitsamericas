<?php

namespace Drupal\spotify_releases\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\spotify_releases\Service\ArtistsInterface;
use Drupal\spotify_releases\Traits\GetTokenTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class ArtistsController.
 */
class ArtistsController extends ControllerBase {

  /**
   * @var \Drupal\spotify_releases\Service\ArtistsInterface
   */
  private $artists;

  public function __construct(ArtistsInterface $artists) {
    $this->artists = $artists;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('spotify_releases.artist'));
  }


  /**
   * Getartists.
   *
   * @return string
   *   Return Hello string.
   */
  public function getArtists($idartist) {

      $dataInfo = $this->artists->getInfoArtist();

      return [
        '#theme' => 'artist_block',
        '#data' => $dataInfo,
      ];



  }

}
