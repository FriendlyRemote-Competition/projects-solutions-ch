<?php

session_start();
$_SESSION['register_error'] = '';

header('Location: /CH_module_a/C1');

$data = json_decode(file_get_contents("./users.json"));
if (!isset($_POST['username']) || !$_POST['username']) {
  $_SESSION['register_error'] .= 'Username is required. ';
}

if (!isset($_POST['password']) || !$_POST['password']) {
  $_SESSION['register_error'] .= 'Password is required. ';
}


if ($_SESSION['register_error']) {
  exit;
}

$users = array_filter($data, function ($row) {
  return $row->username == $_POST['username'];
});

if (!empty($users)) {
  $_SESSION['register_error'] .= 'Username already taken. ';
  exit;
}

$user = [
  'username' => $_POST['username'],
  'password' => hash("sha256", $_POST['password']),
];

$data[] = $user;

file_put_contents("./users.json", json_encode($data, JSON_PRETTY_PRINT));

$_SESSION['success'] = "Register success";
$_SESSION['username'] = $user['username'];
