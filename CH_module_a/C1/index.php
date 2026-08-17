<?php
session_start();
?>

<html lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C1</title>
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" />
</head>
<body>
  <main class="container py-5">
    <h1>C1: Login System Using JSON File</h1>
    <?php if ($_SESSION['username']) { ?>
      <div class="card mt-4">
        <div class="card-body">
          <?php if ($_SESSION['success']) { ?>
            <div class="alert alert-success">
              <?= $_SESSION['success'] ?>
            </div>
          <?php } ?>

          <h2 class="card-title">Logged in as <?= $_SESSION['username'] ?></h2>
          <a href="logout.php" class="btn btn-primary mt-3">Logout</a>
        </div>
      </div>
    <?php } else { ?>
      <div class="card mt-4">
        <div class="card-body">
          <?php if ($_SESSION['login_error']) { ?>
            <div class="alert alert-danger">
              <?= $_SESSION['login_error'] ?>
            </div>
          <?php } ?>
          
          <h2 class="card-title">Login</h2>
          <form action="login.php" method="post">
            <label class="d-block mb-3">
              <span class="form-label">Username</span>
              <input type="text" class="form-control" name="username" />
            </label>
            <label class="d-block mb-3">
              <span class="form-label">Password</span>
              <input type="password" class="form-control" name="password" />
            </label>
            <input type="submit" value="Login" class="btn btn-primary" />
          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-body">
          <?php if ($_SESSION['register_error']) { ?>
            <div class="alert alert-danger">
              <?= $_SESSION['register_error'] ?>
            </div>
          <?php } ?>
          
          <h2 class="card-title">Register</h2>
          <form action="register.php" method="post">
            <label class="d-block mb-3">
              <span class="form-label">Username</span>
              <input type="text" class="form-control" name="username" />
            </label>
            <label class="d-block mb-3">
              <span class="form-label">Password</span>
              <input type="password" class="form-control" name="password" />
            </label>
            <input type="submit" value="Register" class="btn btn-primary" />
          </form>
        </div>
      </div>
    <?php } ?>
  </main>
  
</body>
</html>