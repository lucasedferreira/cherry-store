<?php
if (!function_exists('object_to_array')) {
  function object_to_array($data)
  {
    $result = [];
    foreach ($data as $key => $value) {
      $result[$key] = (is_array($value) || is_object($value)) ? object_to_array($value) : $value;
    }
    return $result;
  }
}
