<?php


namespace Drupal\ui_icons\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class IconDisplayController.
 */
class IconDisplayController extends ControllerBase
{

  /**
   * Display icons.
   *
   * @return array
   *   Return render array.
   */
  public function display()
  {
    $build = [];
    $iconsets = \Drupal::service('strategy.manager.iconset')->getIconsets();
    foreach ($iconsets as $iconset_id=>$label) {
      $iconset = \Drupal::service('strategy.manager.iconset')->getInstance($iconset_id);
      $icons = $iconset->getIcons();
      $build[] = [
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#value' => $label,
];
    foreach ($icons as $icon_id => $icon) {
        $build[] = $iconset->build($icon_id);
      }
}
    return $build;
  }

}
