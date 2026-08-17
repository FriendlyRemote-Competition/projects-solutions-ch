<?php

session_start();
$_SESSION['login_error'] = '';

header('Location: /CH_module_a/C1');

$data = json_decode(file_get_contents("./users.json"));

if (!isset($_POST['username']) || !$_POST['username']) {
  $_SESSION['login_error'] .= 'Username is required. ';
}

if (!isset($_POST['password']) || !$_POST['password']) {
  $_SESSION['login_error'] .= 'Password is required. ';
}

if ($_SESSION['login_error']) {
  exit;
}

$users = array_filter($data, function ($row) {
  return $row->username == $_POST['username'];
});

if (empty($users) || hash("sha256", $_POST['password']) != array_pop($users)->password) {
  $_SESSION['login_error'] .= 'Invalid username or password. ';
  exit;
}

$_SESSION['success'] = "Login success";
$_SESSION['username'] = $_POST['username'];