<?php include 'include/db_Connection.php' ?>
<?php include 'include/functions.php' ?>
<?php include 'include/header.php' ?>

<?php LoginFunction() ?>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form action="" class="login_form" method="POST">
          <!-- Email input -->
          <div class="logo">
            <img width="100px" height="100px" src="images/1633344548320.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 1rem 1rem 1rem;" />
          </div>

          <h2>Login</h2>
          <div class="form-outline mb-4">
            <label class="form-label" for="form1Example13">Email address <strong>Or</strong> user Name</label>
            <input type="text" placeholder="Please type username or email" class="form-control form-control-lg" name="nameOrEmail" />

          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form1Example23">Password</label>
            <input type="password" name="password" placeholder="Please type password" class="form-control form-control-lg" />
            <small> <?php echo $errors ?></small>
          </div>
          <!-- Submit button -->
          <button type="submit" name="loginSubmit" class="btn btn-primary btn-lg btn-block">Login</button>
        </form>
      </div>
    </div>
  </div>
</section>
</body>

</html>