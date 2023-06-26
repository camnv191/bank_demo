<section class="vh-100 gradient-custom" style="height: 100vh">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="border-radius: 1rem; background-color: #000; color: white;">
          <div class="card-body p-5 text-center">

            <form class="mb-md-5 mt-md-4" action="confirm_login.php" method="post">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="5">Please enter your login and password!</p>

              <?php if(isset($_COOKIE["error"])) { ?>
                <div class="alert alert-danger text-center">
                    <strong>'ERROR'</strong> <?php echo $_COOKIE["error"]; ?>
                </div>
              <?php }; ?>

              <div class="form-outline form-white mb-4">
                <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="user name" />
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="password" />
              </div>

              <button id="btn_login" class="btn btn-outline-light btn-lg px-5" style="background-color: #000; color: white;"" type="submit" name="login" value="login">Login</button>
            </form>

            <div>
              <p class="mb-0">Don't have an account? <a href="index.php?page=register" class="fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #6a11cb;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
    #btn_login {
        border: solid white;
    }
</style>