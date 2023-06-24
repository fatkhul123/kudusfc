<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign into your account</title>
  <!-- Memuat library Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../assets/img/logo-transparant.png" type="image/png">
</head>
<body>
<section class="vh-100" style="background : url('../assets/img/welcome.png');">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12">
        <div class="card" style="border: none;">
          <div class="row g-0">
            <div class="col-lg-5 d-none d-lg-flex ">
              <img src="../assets/img/login.png" alt="login form" class="img-fluid" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form method="POST" action="proses/proses-login-admin.php">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <img src="../assets/img/logo-transparant.png" style="width: 60px;">
                    <span class="h2 fw-bold mb-0 text-center">KUDUS FC-ADMIN</span>
                  </div>
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into admin account</h5>
                  <div class="form-outline mb-4">
                    <input type="text" name="username" id="form2Example17" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Username</label>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Password</label>
                  </div>
                  <div class="pt-1 mb-4 text-center">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>
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
