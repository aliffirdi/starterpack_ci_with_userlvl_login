<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pengaturan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Pengaturan</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Pengaturan Sistem</h2>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Pengaturan</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" accept-charset="utf-8">
                      <input type="hidden" name="{get_csrf_token_name}" value="{get_csrf_hash}">
                    <?php
                    $basisdata = $this->data_model->ketika('site_options', array("option_url" => $this->uri->segment(3)));
                    $i = 1;
                    foreach ($basisdata->result() as $row) { ?>
                      <div class="form-group">
                        <label><?= $row->option_display_name ?></label>
                        <div class="input-group">
                          <input name="<?= $row->option_name ?>" value="{<?= $row->option_name ?>}" placeholder="<?= $row->option_display_name ?>" type="<?= $row->option_type_form ?>" class="form-control">
                        </div>
                      </div><?php } ?>
                      <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>
