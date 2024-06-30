<?php

namespace Drupal\ui_icons\Asset;

use Drupal\iconset\Asset\AssetInterface;

/**
 * ...
 */
class CodepointsAsset implements AssetInterface {


  /**
   * The list of icon data keyed by the icon ID.
   *
   * @var array
   */
  protected $icons;

  /**
   * ...
   *
   * @param string $url
   *   ...
   */
  public function __construct(string $url) {
    $this->icons = $this->fetchCodepoints($url);
  }

  /**
   *
   */
  protected function fetchCodepoints(string $url): array {
    $icons = [];

    $data = file_get_contents($url);
    if ($data === FALSE) {
      return [];
    }

    $lines = explode("\n", $data);
    foreach ($lines as $line) {
      if (empty($line)) {
        continue;
      }
      [$icon_id, $codepoint] = explode(' ', $line);
      $icons[$icon_id] = [
        'label' => $icon_id,
      ];
    }
    return $icons;
  }

  /**
   * {@inheritdoc}
   */
  public function getIcons() {
    return $this->icons;
  }

  /**
   * {@inheritdoc}
   */
  public function getIcon($icon_id) {
    return $this->icons[$icon_id] ?? FALSE;
  }

}
