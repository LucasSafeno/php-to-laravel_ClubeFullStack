<?php

namespace app\controllers;

class ErrorController
{
  public function notFound()
  {
    view('errors/404', [
      'title' => 'Not found '
    ]);
  }
}
