<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($this->uri->segment(1) != 'auth') {
  if (empty($this->session->userdata('login')) && $this->uri->segment(1) != 'register') {
    $this->session->set_flashdata('warning', $this->lang->line('login_belum_login'));
    redirect(base_url('auth'),'refresh');
  }
}
if ($this->uri->segment(1) == 'auth') {
  if (!empty($this->session->userdata('login'))) {
    redirect(base_url('dashboard'),'refresh');
  }
}
if ($this->uri->segment(1) == '') {
  if (!empty($this->session->userdata('login'))) {
    redirect(base_url('dashboard'),'refresh');
  }
}
if ($this->uri->segment(1) != "auth" && $this->uri->segment(1) != "register") {
  if ($this->website->access($this->uri->segment(1),$this->uri->segment(2)) == false) {
    $this->load->view('dist/_partials/access_denied');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{title} &mdash; {app_name}</title>
  
  <link rel="shortcut icon" href="<?= base_url("assets/img/stisla-fill.svg"); ?>"/>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
<?php
if ($this->uri->segment(1) == "dashboard" || $this->uri->segment(1) == "") { ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
<?php
}elseif ($this->uri->segment(1) == "auth") { ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-social/bootstrap-social.css">
<?php
}elseif ($this->uri->segment(1) == "register") { ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jquery-selectric/selectric.css">
<?php
} ?>

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">

  <!-- General JS Scripts -->
  <script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
</head>

<?php
if ($this->uri->segment(1) == "layout_transparent") {
  $this->load->view('dist/_partials/layout-2');
  $this->load->view('dist/_partials/sidebar-2');
}elseif ($this->uri->segment(1) == "layout_top_navigation") {
  $this->load->view('dist/_partials/layout-3');
  $this->load->view('dist/_partials/navbar');
}elseif ($this->uri->segment(1) != "auth" && $this->uri->segment(2) != "forgot_password"&& $this->uri->segment(1) != "register" && $this->uri->segment(1) != "auth_reset_password" && $this->uri->segment(2) != "errors_503" && $this->uri->segment(2) != "errors_403" && $this->uri->segment(2) != "errors_404" && $this->uri->segment(2) != "errors_500" && $this->uri->segment(2) != "utilities_contact" && $this->uri->segment(2) != "utilities_subscribe") {
  $this->load->view('dist/_partials/layout');
  $this->load->view('dist/_partials/sidebar');
}
?>
