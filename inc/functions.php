<?php 

spl_autoload_register('classLoader');

function classLoader($classname) {
  $path = "classes/";
  $extension = ".class.php";
  $fullPath = $path . strtolower($classname) . $extension;

  if (!file_exists($fullPath)) {
      return false;
  }
  include $fullPath;
}