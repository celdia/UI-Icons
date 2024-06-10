<?php

namespace Drupal\ui_icons\Plugin\Iconset;

use Drupal\Core\Plugin\PluginBase;
use Drupal\iconset\Asset\AssetInterface;
use Drupal\iconset\IconsetInterface;
use Drupal\iconset\Plugin\IconHandlerInterface;
use Drupal\ui_icons\Asset\CodepointsAsset;

/**
 * ...
 *
 * @IconsetIconHandler(
 *   id = "codepoints",
 *   label = @Translation("Codepoints"),
 * )
 */
class CodepointsHandler extends PluginBase implements IconHandlerInterface {

  /**
   * {@inheritdoc}
   */
  public function createAssets($asset_info, IconsetInterface $iconset) {
    return new CodepointsAsset($asset_info);
  }

  /**
   *
   */
  public function build($icon_id, AssetInterface $iconset, array $options = []) {
    $config = $this->configuration;
    return [
      '#type' => 'inline_template',
      "#template" => $config['template'],
      "#context" => [
        'icon_id' => $icon_id,
      ],
      "#attached" => [
        "library" => [
          $config['library'],
        ],
      ],
    ];
  }

  /**
   *
   */
  public function getJsSettings() {
    // @todo Implement getJsSettings() method.
    return [];
  }

  /**
   *
   */
  public function formatJson(AssetInterface $asset) {
    // @todo Implement formatJson() method.
    // return [];
    $icons = $asset->getIcons();
    $formatted_icons = [];

    foreach ($icons as $icon_id => $icon_data) {
      $formatted_icons[] = [
        'id' => $icon_id,
        'label' => $icon_data['label'],
      ];
    }

    return json_encode($formatted_icons);
  }

}
