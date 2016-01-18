<?php
require 'database.php';

$_ = $_POST; // easy way to debug with $_GET

$compName = $_["workstation"]; //computer name
$host = $_["host"];               // optional
$status = $_["status"];           // 1 or 0

#unless the computers name was empty
if($compName != ""){
  $compName = strtoupper($compName);
} else { #build the computer's name from the host
  $host_domain = strstr($host, '.');
  $compName = strtoupper(str_replace($host_domain, '', $host));
}

$compNumber = str_replace('LIBCAT', '', $compName);

#connect to the database
try {
  $dbh = new PDO("mysql:host=$db_host;dbname=$database", $user, $password);

  $checkQ = $dbh->prepare("select status from compstatus where computer_name = ?");
  $checkQ->bindParam(1, $compName);
  $checkQ->execute();
  $currentStatus = $checkQ->fetch();
  if ($checkQ->rowCount() > 0) {
    // workstation already exists, update it
    $updateStatusQ = $dbh->prepare("update compstatus set `status` = ? where `computer_name` = ?");
    var_dump($updateStatusQ->execute(array($status, $compName)));
    print_r($updateStatusQ->errorInfo());
  }
  else {
    // workstation does not exist, insert it
    $insertWQ = $dbh->prepare("insert into compstatus values (?, ?, ?, NOW())");
    var_dump($insertWQ->execute(array($compNumber, $compName, $status)));
    print_r($insertWQ->errorInfo());
  }

  // add to history table
  $historyQ = $dbh->prepare("insert into statushistory values (?, ?, ?, NOW())");
  print($historyQ->execute(array($compNumber, $compName, $status)));
  print_r($historyQ->errorInfo());
  //echo "Inserting $compNumber, $compName, $compUser, $status";
}
catch (PDOException $e) {
  echo $e->getMessage();
}

$dbh = null; // close connection
?>
