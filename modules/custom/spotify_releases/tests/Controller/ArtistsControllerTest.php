<?php

namespace Drupal\spotify_releases\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the spotify_releases module.
 */
class ArtistsControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "spotify_releases ArtistsController's controller functionality",
      'description' => 'Test Unit for module spotify_releases and controller ArtistsController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests spotify_releases functionality.
   */
  public function testArtistsController() {
    // Check that the basic functions of module spotify_releases.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
