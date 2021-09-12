<?php
$array = [
  'Tsukumo Sana',
  'Ceres Fauna',
  'Ouro Kronii',
  'Nanashi Mumei',
  'Hakos Baelz',
];

// PHP 7.3 以上
$first = array_key_first($array);
$last = array_key_last($array);
foreach ($array as $k => $v) {
  if ($k === $first || $k === $last) continue;
  var_dump($v); // string(11) "Ceres Fauna", string(11) "Ouro Kronii", string(13) "Nanashi Mumei"
}

// PHP 7.3 未満
if (!function_exists('array_key_first')) {
  function array_key_first(array $array) {
    foreach ($array as $k => $v) return $k;
    return null;
  }
}

if (!function_exists('array_key_last')) {
  function array_key_last(array $array) {
    if (empty($array)) return null;
    return array_keys($array)[count($array) - 1];
  }
}

$first = array_key_first($array);
$last = array_key_last($array);
foreach ($array as $k => $v) {
  if ($k === $first || $k === $last) continue;
  var_dump($v); // string(11) "Ceres Fauna", string(11) "Ouro Kronii", string(13) "Nanashi Mumei"
}

// reset + end
$first = reset($array);
$last = end($array);
foreach ($array as $k => $v) {
  if ($v === $first || $v === $last) continue;
  var_dump($v); // string(11) "Ceres Fauna", string(11) "Ouro Kronii", string(13) "Nanashi Mumei"
}

// count
$i = 0;
$element_count = count($array);
foreach ($array as $v) {
  if ($i++ === 0 || $i === $element_count) continue;
  var_dump($v); // string(11) "Ceres Fauna", string(11) "Ouro Kronii", string(13) "Nanashi Mumei"
}