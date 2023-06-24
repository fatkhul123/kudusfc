<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create an account</title>
  <!-- Memuat library Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
  <section class="vh-100" style="background: url('assets/img/welcome.png');">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-12">
          <div class="card" style="border: none;">
            <div class="row g-0">
              <div class="col-lg-5 d-none d-lg-flex ">
                <img src="assets/img/login.png" alt="login form" class="img-fluid" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form method="POST" action="proses/proses-register.php">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <img src="assets/img/logo-transparant.png" style="width: 60px;">
                      <span class="h2 fw-bold mb-0 text-center">KUDUS FOOTBALL CLUB</span>
                    </div>
                    <h5 class="fw-normal pb-3" style="letter-spacing: 1px;">Create an account</h5>

                    <div class="form-outline">
                      <input type="text" id="form2Example1" class="form-control form-control-lg" name="nama" required>
                      <label class="form-label" for="form2Example1">Full Name</label>
                    </div>

                    <div class="form-outline">
                      <input type="text" id="form2Example2" class="form-control form-control-lg" name="username" required>
                      <label class="form-label" for="form2Example2">Username</label>
                    </div>

                    <div class="form-outline">
                      <input type="email" id="form2Example3" class="form-control form-control-lg" name="email" required>
                      <label class="form-label" for="form2Example3">Email address</label>
                    </div>

                    <div class="form-outline">
                      <input type="password" id="form2Example4" class="form-control form-control-lg" name="password" required>
                      <label class="form-label" for="form2Example4">Password</label>
                    </div>

                    <div class="mb-4 pt-1 text-center">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                    </div>

                    <p class="pb-lg-2 text-center" style="color: #393f81;">
                      Already have an account? <a href="login.php" style="color: #393f81;">Log In here</a>
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Memuat library jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <!-- Memuat library Bootstrap -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- Memuat library Google Sign-In -->
</body>

</html>
