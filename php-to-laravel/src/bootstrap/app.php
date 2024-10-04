<?php

use core\library\App;
use DI\ContainerBuilder;
use Spatie\Ignition\Ignition;

// require '../core/helpers/constants.php';
// require '../core/helpers/functions.php';


$app = App::create()
  ->withEnvironmentVariables()
  ->withErrorPage()
  ->withContainer();
