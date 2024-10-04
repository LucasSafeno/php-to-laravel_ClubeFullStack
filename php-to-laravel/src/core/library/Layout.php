<?php

namespace core\library;

use League\Plates\Engine;
use core\exceptions\ViewNotFoundException;

class Layout
{
  public static function render(
    string $view,
    array $data = []
  ) {


    if (!file_exists(VIEW_PATH . $view . '.php')) {
      throw new ViewNotFoundException("View not found: $view");
    }

    // Create new Plates instance
    $templates = new Engine(VIEW_PATH);

    // Render a template
    echo $templates->render($view, $data);
  }
}
