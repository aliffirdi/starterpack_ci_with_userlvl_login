<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <?php if (!empty($this->session->flashdata('error')) || !empty($this->session->flashdata('warning')) || !empty($this->session->flashdata('info')) || !empty($this->session->flashdata('success'))) { ?>
            <!--Register_alert-->
            <div class="alert alert-<?php if (!empty($this->session->flashdata('error'))) {echo "danger";} elseif (!empty($this->session->flashdata('warning'))) {echo "warning";} elseif (!empty($this->session->flashdata('info'))) {echo "info";} else {echo "success";} ?> alert-has-icon">
              <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
              <div class="alert-body">
                <div class="alert-title">{login_alert}</div>
                {error} {warning} {info} {success}
              </div>
            </div>
            <!--End Of Register_alert-->
            <?php } ?>

            <div class="card card-primary">
              <div class="card-header"><h4>Forgot Password</h4></div>

              <div class="card-body">
                <p class="text-muted">We will send a link to reset your password</p>
                <form method="POST">
                  <input type="hidden" name="{get_csrf_token_name}" value="{get_csrf_hash}">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Forgot Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              <a href="<?= base_url("auth") ?>">Back to Login</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php $this->load->view('dist/_partials/js'); ?>