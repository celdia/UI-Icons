<?php

namespace Drupal\ui_icons_library\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Class IconDisplayController.
 */
class IconsetsController extends ControllerBase {

  const OVERVIEW_SLICE = 20;

  /**
   * Display icons.
   *
   * @return array
   *   Return render array.
   */
  public function overview() {
    $build = [];
    $iconsets = \Drupal::service('strategy.manager.iconset')->getIconsets();
    foreach ($iconsets as $iconset_id => $label) {
      $iconset = \Drupal::service('strategy.manager.iconset')->getInstance($iconset_id);
      $icons = $iconset->getIcons();
      $icons_id = array_keys($icons);
      $icons_id = array_slice($icons_id, 0, static::OVERVIEW_SLICE);
      $build[] = [
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#value' => $label,
      ];
      foreach ($icons_id as $icon_id) {
        $build[] = $iconset->build($icon_id);
      }
      $build[] = [
        '#type' => 'html_tag',
        '#tag' => 'p',
        0 => [
          '#type' => 'link',
          '#title' => $this->t("View more"),
          '#url' => Url::fromRoute('ui_icons.single', ["iconset_id" => $iconset_id]),
        ],
      ];
    }
    return $build;
  }

  /**
   * Display icons.
   *
   * @return array
   *   Return render array.
   */
  public function single(string $iconset_id) {
    $build = [];
    $iconset = \Drupal::service('strategy.manager.iconset')->getInstance($iconset_id);
    $icons = $iconset->getIcons();
    foreach ($icons as $icon_id => $icon) {
      $build[] = $iconset->build($icon_id);
    }
    return $build;
  }

}
