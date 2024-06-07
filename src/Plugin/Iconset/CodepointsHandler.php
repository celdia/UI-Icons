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
   * URL to the codepoints file.
   */
  const CODEPOINTS_URL = 'https://raw.githubusercontent.com/google/material-design-icons/master/font/MaterialIconsOutlined-Regular.codepoints';

  /**
   * {@inheritdoc}
   */
  public function createAssets($asset_info, IconsetInterface $iconset) {
    // @todo get url from $asset_info,
    return new CodepointsAsset(static::CODEPOINTS_URL);
  }

  /**
   * {@inheritdoc}
   */
  public function supports(IconsetInterface $iconset) {
    // Check if the iconset supports this handler.
    return $iconset->getType() === 'codepoints';
  }

  /**
   *
   */
  public function build($icon_id, AssetInterface $iconset, array $options = []) {
    // @todo don't hardcode this here
    return [
      "#type" => "html_tag",
      "#tag" => "span",
      "#value" => $icon_id,
      "#attributes" => [
        "class" => [
          "material-icons-outlined",
        ],
      ],
      "#attached" => [
        "library" => [
          "ui_icons_test/material",
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
    return [];
  }

}
