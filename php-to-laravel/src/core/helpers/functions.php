<?php

use core\library\Layout;

function view($view, $data = [])
{
  return Layout::render($view, $data);
}
