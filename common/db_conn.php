<?php
mysqli_report(MYSQLI_REPORT_STRICT);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $mysqli = new mysqli("localhost","root","","visualez");
} catch (Exception $e) {
  $data['success'] = FALSE;
  $data['message'] = $e->getMessage() ." OR Import database from db folder.";
  echo json_encode($data);
  exit;
}
?>