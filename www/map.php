<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
  <meta http-equiv='refresh' content='10'>
</head>
<body>

<style type="text/css">
#computer_map {
  background: no-repeat url('level1.png');
  display: block;
  width: 600px;
  height: 600px;
  overflow: hidden;
}

dt.available_comp_status_icon {
  /*background: no-repeat url('available.png');*/
  background-color: green;
}
dt.unavailable_comp_status_icon {
  /*background: no-repeat url('unavailable.png');*/
  background-color: red;
}
dt.shutdown_comp_status_icon {
  background-color: black;
}

dt.available_comp_status_icon, dt.unavailable_comp_status_icon, dt.shutdown_comp_status_icon {
  width: 27px;
  height: 27px;
}

dt.icon {
  display: inline-block;
  position: relative;
  text-indent: -9999px;
  outline: none;
  border: none;
  z-index: 10;
  text-decoration: none;
  padding-bottom: 0;
}
</style>

<?php

#add your database username and password
$db_host = "localhost";
$user="mattblessed";
$password="000373965";
$database="computer_availability";
try {
  $dbh = new PDO("mysql:host=$db_host;dbname=$database", $user, $password);
  $openQ = $dbh->prepare("SELECT * FROM compstatus where status = 0");
  $openQ->execute();
  $openComps = $openQ->rowCount();

  $totalQ = $dbh->prepare("SELECT * FROM compstatus");
  $totalQ->execute();
  $results = $totalQ->fetchAll(PDO::FETCH_ASSOC);

}
catch(PDOException $e) {
  echo $e->getMessage();
}

$dbh = null;
?>
<div class="pane-content">
  <div id="content">
    <h1>Library 1st floor computer availability</h1>
    <p>Computers available: <?php echo $openComps."/".count($results); ?></p>
    <div id="computer_map">
      <dl style="margin: 0">
          <?php
            foreach ($results as $r) {
              if($r["top_pos"] != 0){
                switch ($r['status']) {
                  case -1:
                    $class = "shutdown_comp_status_icon icon";
                    break;
                  case 0:
                    $class = "available_comp_status_icon icon";
                    break;
                  case 1:
                    $class = "unavailable_comp_status_icon icon";
                    break;
                }
                $alt = $r['computer_name'];
                $left = $r['left_pos'];
                $top = $r['top_pos'];

               echo "<dt class = \"$class\" alt=\"$alt\" style=\"left: ".$left."px; top: ".$top."px\">$alt</dt>";
              }
            }?>
        </dl>
      </div>
    </div>
  <p>Map is updated every 10 seconds. Last updated: <?php echo date("M j, Y \a\\t H:i:s "); ?></p>
</div>
