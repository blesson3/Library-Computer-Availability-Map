<?php
require 'database.php';

try {
  $dbh = new PDO("mysql:host=$db_host;dbname=$database", $user, $password);
  $allQ = $dbh->prepare("SELECT * FROM compstatus");
  $allQ->execute();
  $results = $allQ->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  echo $e->getMessage();
}

// achieves the page being auto refreshed every 10 seconds
$refreshSec = 10;
$page = $_SERVER['PHP_SELF'];
echo "<html><head><meta http-equiv='refresh' content='$refreshSec' URL='$page'></head><body>";

foreach ($results as $r) {
  $floor = (intval($r["computer_number"]) <= 18) ? "the 1st floor" : "the 2nd floor";
  switch ($r["status"]) {
    case 1:
      $vStatus = "being used";
      $tColor = "red";
      break;
    case 0:
      $vStatus = "open";
      $tColor = "green";
      break;
    case -1:
      $vStatus = "shutdown";
      $tColor = "gray";
      break;
    default:
      $vStatus = "unknown status";
      $tColor = "black";
  }
  echo "<b><font color='$tColor'>".$r["computer_name"]."</font></b> on $floor is <font color='$tColor'>$vStatus</font>. Last updated ".$r["updated_at"]."<br>";
}

echo "</body></html>";
?>
