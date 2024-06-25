<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Argon Dashboard 2 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?php echo base_url('assets/dashboard/css/nucleo-icons.css') ?>" rel="stylesheet" />
  <link href="<?php echo base_url('assets/dashboard/css/nucleo-svg.css') ?>" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?php echo base_url('assets/dashboard/css/nucleo-svg.css') ?>" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?php echo base_url('assets/dashboard/css/argon-dashboard.css?v=2.0.4') ?>" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
								<?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <?php echo $this->session->flashdata('error'); ?>
											<a href="<?php echo base_url('/auth') ?>" type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>x</a>
                    </div>
                <?php endif; ?>
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your username and password to sign in</p>
                </div>
                <div class="card-body">
                  <form role="form" method="post" action="<?php echo base_url('auth/login'); ?>">
                    <div class="mb-3">
                      <input required name="username" type="text" class="form-control form-control-lg" placeholder="username" aria-label="username">
                    </div>
                    <div class="mb-3">
                      <input required name="password" type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="<?php echo base_url('auth/register') ?>" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"They Go Low We Get High"</h4>
                <p class="text-white position-relative">without study, your rebellion is nothing.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  
</body>

</html>
