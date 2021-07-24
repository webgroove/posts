<?php
$filename = $_GET['fn'] ?? null;
$mime_type = $_GET['mt'] ?? null;

if ($filename && $mime_type) download('./uploads/' . $filename, $mime_type);

function download($file_path, $mime_type) {
  if (!is_readable($file_path)) die;

  header('Content-Type: ' . $mime_type);
  header('X-Content-Type-Options: nosniff');
  header('Content-Length: ' . filesize($file_path));
  header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
  header('Connection: close');

  while (ob_get_level()) ob_end_clean();
  readfile($file_path);
  exit;
}
