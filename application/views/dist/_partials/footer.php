<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <footer class="main-footer">
        <div class="footer-left">
          {copyright} {app_name} <div class="bullet"></div> Rendered in <strong>{elapsed_time}</strong> seconds.
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

<?php $this->load->view('dist/_partials/js'); ?>
  <!-- Modal SweetAlert -->
  <script type="text/javascript">
  	<?php if (!empty($this->session->flashdata('success')) || !empty($this->session->flashdata('error')) || !empty($this->session->flashdata('warning')) || !empty($this->session->flashdata('info'))) { ?>
    $(document).ready(function() {
        swal('Sukses', '<?= $this->session->flashdata('success') ?>', 'success');
    });
<?php } ?>
  </script>
  <!-- End of Modal SweetAlert -->