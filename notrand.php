<?php

session_start();

$_SESSION['friends_id'] = $_GET['friends_id'];
header('Location:friend.php');
