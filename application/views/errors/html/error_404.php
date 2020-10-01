<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$url_svr = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>404 Page Not Found</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= $url_svr; ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $url_svr; ?>assets/modules/fontawesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= $url_svr; ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= $url_svr; ?>assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
			 <h1>(*_*)</h1>
            <h4><?= $heading; ?></h4>
            <div class="page-description">
              <?= $message; ?>
              
            </div>
            <div class="page-search">
              <form>
                <div class="form-group floating-addon floating-addon-not-append">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">                          
                        <i class="fas fa-search"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-lg">
                        Search
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="mt-3">
                <a href="<?= $url_svr; ?>">Back to Home</a>
              </div>
            </div>
          </div>
        </div>
        <div class="simple-footer mt-5">
          Copyright &copy; Alif Firdi
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= $url_svr; ?>assets/modules/jquery.min.js"></script>
  <script src="<?= $url_svr; ?>assets/modules/popper.js"></script>
  <script src="<?= $url_svr; ?>assets/modules/tooltip.js"></script>
  <script src="<?= $url_svr; ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= $url_svr; ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= $url_svr; ?>assets/modules/moment.min.js"></script>
  <script src="<?= $url_svr; ?>assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="<?= $url_svr; ?>assets/js/scripts.js"></script>
  <script src="<?= $url_svr; ?>assets/js/custom.js"></script>
</body>
</html>
