<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
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
              <div class="card-header"><h4>{register}</h4></div>

              <div class="card-body">
                <form method="POST">
                  <div class="row">
                    <input type="hidden" name="{get_csrf_token_name}" value="{get_csrf_hash}">
                    <div class="form-group col-6">
                      <label for="first_name">{register_first_name}</label>
                      <input required id="first_name" type="text" class="form-control" name="first_name" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">{register_last_name}</label>
                      <input required id="last_name" type="text" class="form-control" name="last_name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username">{register_username}</label>
                    <input required id="username" type="text" class="form-control" name="username">
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">{register_email}</label>
                    <input required id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="form-divider">
                    {register_y_country}
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="country">{register_country}</label>
                      <input required id="country" type="country" class="form-control" name="country">
                      <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-6">
                      <label for="province">{register_prov}</label>
                      <input required id="province" type="province" class="form-control" name="province">
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input required type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">{register_agree}</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      {register}
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