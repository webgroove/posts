<?php
$x;

$tests = [
  'null' => null,
  '$x;' => $x,
  '[]' => [],
  '[1]' => [1],
  'true' => true,
  'false' => false,
  '0' => 0,
  '1' => 1,
  '-1' => -1,
  '\'\'' => '',
  '\'0\'' => '0',
  '\'1\'' => '1',
  '\'-1\'' => '-1',
  '\'true\'' => 'true',
  '\'false\'' => 'false',
];

echo '<pre>';

foreach ($tests as $k => $test) {
  echo 'if ( ', $k, ' ) => ';
  if ($test) echo 'true';
  else echo 'false';
  echo '<br>';
}

foreach ($tests as $k => $test) {
  echo 'isset ( ', $k, ' ) => ';
  var_dump(isset($test));
}

foreach ($tests as $k => $test) {
  echo 'is_null ( ', $k, ' ) => ';
  var_dump(is_null($test));
}

foreach ($tests as $k => $test) {
  echo 'empty ( ', $k, ' ) => ';
  var_dump(empty($test));
}

foreach ($tests as $k => $test) {
  echo '?: ( ', $k, ' ) => ';
  var_dump($test ? $test : false);
}

foreach ($tests as $k => $test) {
  echo '?? ( ', $k, ' ) => ';
  var_dump($test ?? false);
}

foreach ($tests as $k => $test) {
  echo '??= ( ', $k, ' ) => ';
  var_dump($test ??= false);
}
