<?php

namespace core\library;

use DI\Container;
use Dotenv\Dotenv;
use DI\ContainerBuilder;
use Spatie\Ignition\Ignition;

class App
{

  public readonly Container $container;

  public static function create(): self
  {
    return new self;
  }

  public function withErrorPage()
  {
    Ignition::make()
      ->setTheme('dark')
      ->shouldDisplayException(env('ENV') === 'development')
      ->register();
    return $this;
  }

  public function withContainer()
  {

    $builder = new ContainerBuilder();
    $this->container = $builder->build();

    return $this;
  }

  public function withEnvironmentVariables()
  {

    $dotenv = Dotenv::createImmutable(dirname(__FILE__, 3));
    $dotenv->load();

    return $this;
  }
}
