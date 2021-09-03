<?php
$tests = [
  'null' => null,
  '[]' => [],
  '0' => 0,
  '1' => 1,
  '-1' => -1,
  '1.1' => 1.1,
  '011' => 011,
  '0x1' => 0x1,
  '0b1' => 0b1,
  '1_1' => 1_1,
  '1e1' => 1e1,
  '1E-1' => 1E-1,
  '\'\'' => '',
  '\'a\'' => 'a',
  '\'0\'' => '0',
  '\'1\'' => '1',
  '\'+1\'' => '+1',
  '\'-1\'' => '-1',
  '\'1.1\'' => '1.1',
  '\'1 1\'' => '1 1',
  '\'１\'' => '１',
];

echo '<pre>';

foreach ($tests as $k => $test) {
  echo 'ctype_digit ( ', $k, ' ) => ';
  var_dump(ctype_digit($test));
}

foreach ($tests as $k => $test) {
  if ($test === []) continue;
  echo 'ctype_digit - strval ( ', $k, ' ) => ';
  var_dump(ctype_digit(strval($test)));
}

foreach ($tests as $k => $test) {
  echo 'is_int ( ', $k, ' ) => ';
  var_dump(is_int($test));
}

foreach ($tests as $k => $test) {
  echo 'is_float ( ', $k, ' ) => ';
  var_dump(is_float($test));
}

foreach ($tests as $k => $test) {
  echo 'is_numeric ( ', $k, ' ) => ';
  var_dump(is_numeric($test));
}

foreach ($tests as $k => $test) {
  if ($test === []) continue;
  echo 'preg_match ( ', $k, ' ) => ';
  var_dump(preg_match('/\A\d+\z/', $test));
}

foreach ($tests as $k => $test) {
  echo 'filter_var - FILTER_VALIDATE_INT ( ', $k, ' ) => ';
  var_dump(filter_var($test, FILTER_VALIDATE_INT));
}

foreach ($tests as $k => $test) {
  echo 'filter_var - FILTER_VALIDATE_FLOAT ( ', $k, ' ) => ';
  var_dump(filter_var($test, FILTER_VALIDATE_FLOAT));
}
