<?php

namespace core\route;

use Exception;
use DI\Container;
use app\controllers\ErrorController;
use core\exceptions\ControllerNotFoundException;

class Router
{

  protected $routes = [];
  protected ?string $controller = null;
  protected $action;
  protected array $paramaters = [];

  public function __construct(private Container $container) {} // construct


  public function add(
    string $method,
    string $uri,
    array $route
  ) {
    $this->routes[$method][$uri] = $route;
  } // add

  public function execute()
  {
    foreach ($this->routes as $request => $routes) {
      if ($request === REQUEST_METHOD) {
        return $this->handleUri($routes);
      }
    }
  } // execute();


  private function handleUri(array $routes)
  {
    foreach ($routes as $uri => $route) {

      if ($uri === REQUEST_URI) {
        [$this->controller, $this->action] = $route;
        break;
      }

      $pattern = str_replace("/", "\/", trim($uri, "/"));
      if ($uri !== "/" && preg_match("/^$pattern$/", trim(REQUEST_URI, "/"), $this->paramaters)) {
        [$this->controller, $this->action] = $route;
        unset($this->paramaters[0]);
        break;
      }
    }

    if ($this->controller) {
      return $this->handleController();
    }

    return $this->handleNotFound();
  } // handleUri


  private function handleController()
  {
    if (!class_exists($this->controller) || !method_exists($this->controller, $this->action)) {
      throw new ControllerNotFoundException(
        "[$this->controller::$this->action] does not exist."
      );
    }

    $controller = $this->container->get($this->controller);
    $this->container->call([$controller, $this->action], [...$this->paramaters]);
  } // handleController



  private function handleNotFound()
  {
    (new ErrorController)->notFound();
  } // handleNotFound


} // Router
