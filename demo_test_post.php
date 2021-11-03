<?php
if(!empty($_POST['name']) AND !empty($_POST['qty'])) {
    $name = (string)$_POST['name'];
    $qty = (string)$_POST['qty'];
    echo '<script>alert("Welcome")</script>';
}
echo '<script>alert("Welcome to Geeks for Geeks")</script>';
//$query = mysql_query("SELECT * FROM `user_trials` WHERE `studentid` = '$studentIDString' LIMIT 1");
?>

