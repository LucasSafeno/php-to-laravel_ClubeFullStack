<?php

namespace app\controllers;

use app\library\Email;

class ProductController
{
  public function show(
    string $procuct,
    Email $email
  ) {
    dd($procuct, $email);
  } // show
}
