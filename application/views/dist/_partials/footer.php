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
        swal(
          '<?php if (!empty($this->session->flashdata('error'))) {echo "Error";} elseif (!empty($this->session->flashdata('warning'))) {echo "Warning";} elseif (!empty($this->session->flashdata('info'))) {echo "Info";} else {echo "Sukses";} ?>',
          '<?= $this->session->flashdata('success'); ?><?= $this->session->flashdata('error'); ?><?= $this->session->flashdata('warning'); ?><?= $this->session->flashdata('info'); ?>',
          '<?php if (!empty($this->session->flashdata('error'))) {echo "error";} elseif (!empty($this->session->flashdata('warning'))) {echo "warning";} elseif (!empty($this->session->flashdata('info'))) {echo "info";} else {echo "success";} ?>'
          );
    });
    <?php } ?>
  </script>
  <!-- End of Modal SweetAlert -->