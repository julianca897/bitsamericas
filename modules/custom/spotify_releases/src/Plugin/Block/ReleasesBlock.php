<?php

namespace Drupal\spotify_releases\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\spotify_releases\Service\SpotifyReleasesInterface;
use Drupal\spotify_releases\Service\SpotifyArtistRelatedInterface;
use Drupal\spotify_releases\Traits\GetTokenTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'ReleasesBlock' block.
 *
 * @Block(
 *  id = "spotify_releases_block",
 *  admin_label = @Translation("Spotify releases block"),
 * )
 */
class ReleasesBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\spotify_releases\Service\SpotifyReleasesInterface
   */
  private $spotifyAuth;

  /**
   * @var \Drupal\spotify_releases\Service\SpotifyArtistRelatedInterface
   */
  private $artistRelated;

  public function __construct(array $configuration, $plugin_id, $plugin_definition,
                              SpotifyReleasesInterface $spotifyAuth,
                              SpotifyArtistRelatedInterface $artistRelated) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->spotifyAuth = $spotifyAuth;
    $this->artistRelated = $artistRelated;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    // TODO: Implement create() method.
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('spotify.access'),
      $container->get('spotify.artist')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function build() {


    $token = GetTokenTrait::getToken("/lanzamientos");

    $releases = $this->spotifyAuth->getReleases($token);


    $build = [
      "#theme" => "spotify_releases_block",
      "#data" => $releases,
      "#code" => $token,

    ];

    $build['spotify_releases_block']['#markup'] = 'Implement ReleasesBlock.';
    $build['#cache'] = ['max-age' => 0];


    return $build;
  }

}
