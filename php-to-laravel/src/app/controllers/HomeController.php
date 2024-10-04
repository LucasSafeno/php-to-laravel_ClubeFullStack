<?php

namespace app\controllers;

use core\library\Layout;

class HomeController
{
  public function index()
  {
    view('home', [
      'title' => 'Home Page'
    ]);
  } // index
}// HomeController
