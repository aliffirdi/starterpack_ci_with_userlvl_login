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
              <img src="{base_url}assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            
            <?php if (!empty($this->session->flashdata('error')) || !empty($this->session->flashdata('warning')) || !empty($this->session->flashdata('info')) || !empty($this->session->flashdata('success'))) { ?>
            <!--Login_alert-->
            <div class="alert alert-<?php if (!empty($this->session->flashdata('error'))) {echo "danger";} elseif (!empty($this->session->flashdata('warning'))) {echo "warning";} elseif (!empty($this->session->flashdata('info'))) {echo "info";} else {echo "success";} ?> alert-has-icon">
              <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
              <div class="alert-body">
                <div class="alert-title">{login_alert}</div>
                {error} {warning} {info} {success}
              </div>
            </div>
            <!--End Of Login_alert-->
            <?php } ?>
                    
            <div class="card card-primary">
              <div class="card-header"><h4>{login}</h4></div>

              <div class="card-body">
                <form method="POST" class="needs-validation" novalidate="">
                  <input type="hidden" name="{get_csrf_token_name}" value="{get_csrf_hash}">
                  <div class="form-group">
                    <label for="username">{login_username}</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      {login_fill_email}
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">{login_pass}</label>
                      <div class="float-right">
                        <a href="{base_url}auth/forgot_password" class="text-small">
                          {login_forgot_pass}
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      {login_fill_pass}
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input checked type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">{login_remember_me}</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      {login}
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">{login_login_by}</div>
                </div>
                <div class="row sm-gutters">
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-google">
                      <span class="fab fa-google"></span> Google
                    </a>
                  </div>
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                      <span class="fab fa-facebook"></span> Facebook
                    </a>                                
                  </div>
                </div>

              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              {login_punya_akun} <a href="{base_url}register">{login_buat_akun}</a>
            </div>
            <div class="simple-footer">
              {copyright} {tahun}<br/>Rendered in <strong>{elapsed_time}</strong> seconds.
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php $this->load->view('dist/_partials/js'); ?>
<script>
  	<?php if (!empty($this->session->flashdata('select_language'))) { ?>
    $(document).ready(function() {
      swal({
          title: 'Select Your Language',
          text: 'Once deleted, you will not be able to recover this imaginary file!',
          icon: 'warning',
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
          swal('Poof! Your imaginary file has been deleted!', {
            icon: 'success',
          });
          } else {
          swal('Your imaginary file is safe!');
          }
        });
    });
<?php } ?>
</script>